<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Storage;

class SubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Initialize the query builder
        $query = SubCategory::query();

        // Check if the 'status' query parameter is set and filter accordingly
        if ($request->has('status')) {
            $query->where('status', $request->input('status'));
        }

        // Check if the 'search' query parameter is set and filter based on the search term
        if ($request->has('search_text')) {
            $searchTerm = $request->input('search_text');
            $query->where(function ($query) use ($searchTerm) {
                $query->where('sub_category_name', 'like', '%' . $searchTerm . '%');
            });
        }

        // Check if the 'sort_by' query parameter is set and apply sorting accordingly
        if ($request->has('sort_by')) {
            $sortBy = $request->input('sort_by');

            // Apply sorting based on the selected option
            switch ($sortBy) {
                case 'latest':
                    $query->latest();
                    break;
                case 'a-z':
                    $query->orderBy('id', 'asc');
                    break;
                case 'z-a':
                    $query->orderBy('id', 'desc');
                    break;
                default:
                    // Do nothing for unknown options
                    break;
            }
        }

        // Retrieve categories with subcategory counts based on the filtered query
        $subcategories = $query->with('category')->get();

        // Pass the subcategories data to the view
        return view('admin.pages.course.course_sub_category', compact('subcategories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        // Render the view for the create subcategory form
        $view = View::make('admin.components.sub-category-form-modal', compact('categories'))->render();

        // Return JSON response with the rendered view
        return response()->json([
            'view' => $view,
            'categories' => $categories
        ]);
    }



    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validation rules for the fields
        $validationRules = [
            'category_id' => 'required',
            'sub_category_name' => 'required',
            'image' => 'required|mimes:jpg,jpeg,png,gif|max:2048', // 2MB (2048 KB) limit
        ];

        // Custom error messages for validation
        $customMessages = [
            'category_id.required' => 'Please select a category.',
            'sub_category_name.required' => 'Please provide a sub-category name.',
            'image.required' => 'Please upload a thumbnail image.',
            'image.mimes' => 'Invalid file format. Only jpg, jpeg, png, gif files are allowed.',
            'image.max' => 'The thumbnail must not be larger than 2MB.',
        ];

        // Validate the incoming request data
        $validatedData = $request->validate($validationRules, $customMessages);

        // For insert operation, create a new subcategory model
        $subcategory = new SubCategory;
        $subcategory->category_id = $validatedData['category_id'];
        $subcategory->sub_category_name = $validatedData['sub_category_name'];
        $message = 'Sub-category added successfully!';


        try {
            if ($request->hasFile('image')) {
                // Get the uploaded file from the request
                $image = $request->file('image');

                // Validate the file size and type
                if ($image->isValid()) {
                    // Generate a unique name for the file based on the slug and the file extension
                    $extension = $image->getClientOriginalExtension();
                    $timestamp = Carbon::now()->timestamp;
                    $randomString = Str::random(10); // Generate a random string

                    // Concatenate the parts to create a unique filename
                    $fileName = $randomString . '-' . $timestamp . '.' . $extension;

                    // Store the file in the storage directory with the generated name
                    $attachmentPath = $image->storeAs('subcategory-thumbnail', $fileName, 'public');

                    // Save the file path in the database
                    $subcategory->image = $attachmentPath;
                } else {
                    return redirect()->back()->withInput()->with('error', 'Failed to upload attachment.');
                }
            }

            // Save the model
            if ($subcategory->save()) {
                return redirect()->route('subcategories.index')->with('success', $message);
            } else {
                throw new \Exception('Failed to save sub-category.');
            }
        } catch (\Exception $e) {
            // Handle the error
            return redirect()->back()->withInput()->with('error', $e->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SubCategory $subcategory)
    {
        $categories = Category::all();
        $view = view('admin.components.sub-category-form-modal', compact('categories', 'subcategory'))->render();

        // Return JSON response with the rendered view and subCategory data
        return response()->json([
            'view' => $view,
            'categories' => $categories,
            'subcategory' => $subcategory
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SubCategory $subcategory)
    {
        // Validation rules for the fields
        $validationRules = [
            'category_id' => 'required',
            'sub_category_name' => 'required',
            'image' => 'nullable|mimes:jpg,jpeg,png,gif|max:2048', // 2MB (2048 KB) limit
        ];

        // Custom error messages for validation
        $customMessages = [
            'category_id.required' => 'Please select a category.',
            'sub_category_name.required' => 'Please provide a sub-category name.',
            'image.mimes' => 'Invalid file format. Only jpg, jpeg, png, gif files are allowed.',
            'image.max' => 'The thumbnail must not be larger than 2MB.',
        ];

        $old_image_path = $subcategory->image;
        // Validate the incoming request data
        $validatedData = $request->validate($validationRules, $customMessages);

        // For update operation, update the subCategory model
        $subcategory->category_id = $validatedData['category_id'];
        $subcategory->sub_category_name = $validatedData['sub_category_name'];
        $message = 'Sub-category updated successfully!';


        try {
            if ($request->hasFile('image')) {
                // Get the uploaded file from the request
                $image = $request->file('image');

                // Validate the file size and type
                if ($image->isValid()) {
                    // Delete the old image if it exists
                    if (Storage::disk('public')->exists($subcategory->image)) {
                        Storage::disk('public')->delete($subcategory->image);
                    }
                    // Get the original file name and extension
                    $originalName = pathinfo($subcategory->image, PATHINFO_FILENAME);
                    $extension = $image->getClientOriginalExtension();

                    // Generate the new file name with the original name and new extension
                    $fileName = $originalName . '.' . $extension;

                    // Store the file in the storage directory with the generated name
                    $attachmentPath = $image->storeAs('subcategory-thumbnail', $fileName, 'public');

                    // Save the file path in the database
                    $subcategory->image = $attachmentPath;
                } else {
                    return redirect()->back()->withInput()->with('error', 'Failed to upload attachment.');
                }
            }

            // Save the model
            if ($subcategory->update()) {
                return redirect()->route('subcategories.index')->with('success', $message);
            } else {
                throw new \Exception('Failed to save subcategory.');
            }
        } catch (\Exception $e) {
            // Handle the error
            return redirect()->back()->withInput()->with('error', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SubCategory $subcategory)
    {
        if ($subcategory->delete()) {
            // Delete the attached file if it exists
            if (!empty($subcategory->image)) {
                if (Storage::disk('public')->exists($subcategory->image)) {
                    Storage::disk('public')->delete($subcategory->image);
                }
            }
            return response()->json(['message' => 'Sub-category deleted successfully']);
        } else {
            return response()->json(['error' => 'Failed to delete Sub-category'], 500);
        }
    }

    public function status(SubCategory $subcategory)
    {
        // Determine the new status based on the current status of the subcategory
        $newStatus = $subcategory->status === 'pending' ? 'approved' : 'pending';

        // Update the subcategory status
        $subcategory->status = $newStatus;

        // Save the changes
        if ($subcategory->save()) {
            // Return a JSON response with success message
            return response()->json(['message' => 'Status changed to ' . $newStatus]);
        } else {
            // Return a JSON response with error message
            return response()->json(['error' => 'Failed to update subcategory status'], 500);
        }
    }

    public function featured(SubCategory $subcategory)
    {
        // Determine the new status based on the current status of the subcategory
        $newStatus = $subcategory->is_featured === 1 ? 0 : 1;

        // Update the subcategory status
        $subcategory->is_featured = $newStatus;

        if ($subcategory->is_featured == 1) {
            $message = 'subcategory is featured now';
        } else {
            $message = 'subcategory is not featured anymore';
        }

        // Save the changes
        if ($subcategory->update()) {
            // Return a JSON response with success message
            return response()->json(['message' => $message]);
        } else {
            // Return a JSON response with error message
            return response()->json(['error' => 'Failed to update subcategory status'], 500);
        }
    }
}
