<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Retrieve all categories from the database
        $categories = Category::all();

        // Pass the categories data to the view
        return view('admin.pages.course.course_category', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Render the view for the create category form
        $view = View::make('admin.components.category-form-modal')->render();

        // Return JSON response with the rendered view
        return response()->json(['view' => $view]);
    }



    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validation rules for the fields
        $validationRules = [
            'category_name' => 'required',
            'image' => 'required|mimes:jpg,jpeg,png,gif|max:2048', // 2MB (2048 KB) limit
        ];

        // Custom error messages for validation
        $customMessages = [
            'category_name.required' => 'Please provide a category name.',
            'image.required' => 'Please upload a thumbnail image.',
            'image.mimes' => 'Invalid file format. Only jpg, jpeg, png, gif files are allowed.',
            'image.max' => 'The thumbnail must not be larger than 2MB.',
        ];

        // Validate the incoming request data
        $validatedData = $request->validate($validationRules, $customMessages);

        // For insert operation, create a new Category model
        $category = new Category;
        $category->category_name = $validatedData['category_name'];
        $message = 'Category added successfully!';


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
                    $attachmentPath = $image->storeAs('category-thumbnail', $fileName, 'public');

                    // Save the file path in the database
                    $category->image = $attachmentPath;
                } else {
                    return redirect()->back()->withInput()->with('error', 'Failed to upload attachment.');
                }
            }

            // Save the model
            if ($category->save()) {
                return redirect()->route('categories.index')->with('success', $message);
            } else {
                throw new \Exception('Failed to save Category.');
            }
        } catch (\Exception $e) {
            // Handle the error
            return redirect()->back()->withInput()->with('error', $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        $view = view('admin.components.category-form-modal', compact('category'))->render();

        // Return JSON response with the rendered view and category data
        return response()->json([
            'view' => $view,
            'category' => $category
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        // Validation rules for the fields
        $validationRules = [
            'category_name' => 'required',
            'image' => 'nullable|mimes:jpg,jpeg,png,gif|max:2048', // 2MB (2048 KB) limit
        ];

        // Custom error messages for validation
        $customMessages = [
            'category_name.required' => 'Please provide a category name.',
            'image.mimes' => 'Invalid file format. Only jpg, jpeg, png, gif files are allowed.',
            'image.max' => 'The thumbnail must not be larger than 2MB.',
        ];

        $old_image_path = $category->image;
        // Validate the incoming request data
        $validatedData = $request->validate($validationRules, $customMessages);

        // For update operation, update the Category model
        $category->category_name = $validatedData['category_name'];
        $message = 'Category added successfully!';


        try {
            if ($request->hasFile('image')) {
                // Get the uploaded file from the request
                $image = $request->file('image');

                // Validate the file size and type
                if ($image->isValid()) {
                    // Delete the old image if it exists
                    if (Storage::disk('public')->exists($category->image)) {
                        Storage::disk('public')->delete($category->image);
                    }
                    // Get the original file name and extension
                    $originalName = pathinfo($category->image, PATHINFO_FILENAME);
                    $extension = $image->getClientOriginalExtension();

                    // Generate the new file name with the original name and new extension
                    $fileName = $originalName . '.' . $extension;

                    // Store the file in the storage directory with the generated name
                    $attachmentPath = $image->storeAs('category-thumbnail', $fileName, 'public');

                    // Save the file path in the database
                    $category->image = $attachmentPath;
                } else {
                    return redirect()->back()->withInput()->with('error', 'Failed to upload attachment.');
                }
            }

            // Save the model
            if ($category->update()) {
                return redirect()->route('categories.index')->with('success', $message);
            } else {
                throw new \Exception('Failed to save Category.');
            }
        } catch (\Exception $e) {
            // Handle the error
            return redirect()->back()->withInput()->with('error', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        if ($category->delete()) {
            // Delete the attached file if it exists
            if (!empty($category->image)) {
                if (Storage::disk('public')->exists($category->image)) {
                    Storage::disk('public')->delete($category->image);
                }
            }
            return response()->json(['message' => 'Category deleted successfully']);
        } else {
            return response()->json(['error' => 'Failed to delete category'], 500);
        }
    }

    public function status(Category $category)
    {
        // Determine the new status based on the current status of the category
        $newStatus = $category->status === 'pending' ? 'approved' : 'pending';

        // Update the category status
        $category->status = $newStatus;

        // Save the changes
        if ($category->save()) {
            // Return a JSON response with success message
            return response()->json(['message' => 'Status changed to ' . $newStatus]);
        } else {
            // Return a JSON response with error message
            return response()->json(['error' => 'Failed to update category status'], 500);
        }
    }

    public function featured(Category $category)
    {
        // Determine the new status based on the current status of the category
        $newStatus = $category->is_featured === 1 ? 0 : 1;

        // Update the category status
        $category->is_featured = $newStatus;

        if ($category->is_featured == 1) {
            $message = 'Category is featured now';
        } else {
            $message = 'Category is not featured anymore';
        }

        // Save the changes
        if ($category->update()) {
            // Return a JSON response with success message
            return response()->json(['message' => $message]);
        } else {
            // Return a JSON response with error message
            return response()->json(['error' => 'Failed to update category status'], 500);
        }
    }
}
