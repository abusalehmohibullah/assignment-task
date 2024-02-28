<form action="{{ isset($subcategory) ? route('subcategories.update', $subcategory->id) : route('subcategories.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    @if (isset($subcategory))
    @method('PUT')
    @endif

    <div class="form-group mb-20">
        <label for="name47">Select Category</label>
        <select name="category_id" class="form-control" title="Select Category">
            <option value="">Select Category</option>
            @if (isset($categories))
            @foreach ($categories as $category)
            <option value="{{ $category->id }}" {{ isset($subcategory) && $category->id == $subcategory->category_id ? 'selected' : '' }}>
                {{ $category->category_name }}
            </option>

            @endforeach
            @endif
        </select>
    </div>

    <div class="form-group mb-20">
        <label for="name47">Sub Category Name</label>
        <input type="text" name="sub_category_name" value="{{ isset($subcategory) ? $subcategory->sub_category_name : old('sub_category_name') }}" class="form-control" id="name47" placeholder="Enter Sub Category Name">
    </div>


    <div>
        <h6 class="fw-500 mb-20">Sub Category Thumbnail</h6>
    </div>
    <div class="mb-4 account-profile d-flex align-items-center ">
        <div class="ap-img pro_img_wrapper">
            <input id="file-upload" type="file" name="image" class="d-none" accept="image/x-png,image/gif,image/jpeg" onchange="uploadFile(this, 'profile-priviewer')">
            <!-- Profile picture image-->
            <label for="file-upload">
                <img class="ap-img__main rounded wh-120 bg-lighter d-flex" src="{{ isset($subcategory) ? asset('storage/' . $subcategory->image) : asset('/assets/img/upload-file-140.png') }}" alt="profile" id="profile-priviewer">
                <span class="cross" id="remove_pro_pic">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="svg replaced-svg">
                        <path d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z">
                        </path>
                        <circle cx="12" cy="13" r="4"></circle>
                    </svg>
                </span>
            </label>
        </div>
        <div class="account-profile__title">
            <p class="fs-15 ms-20 fw-500 text-capitalize">Image format - jpg png jpeg gif image
                size - maximum size 2 MB Image Ratio - 1:1</p>
        </div>
    </div>
    <div class="button-group d-flex pt-25">
        <button type="submit" class="btn btn-primary btn-default btn-squared text-capitalize">Submit
        </button>
        <button type="button" class="btn btn-light btn-default btn-squared fw-400 text-capitalize b-light color-light" data-bs-dismiss="modal">Cancel</button>
    </div>
</form>