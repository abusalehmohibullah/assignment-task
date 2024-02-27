<form action="" method="POST" enctype="multipart/form-data">
    @csrf

    @method('PUT')
    <div class="form-group mb-20">
        <label for="name47">{{ trans('course.category-name') }}</label>
        <input type="text" name="category_name" value="" class="form-control" id="name47"
            placeholder="Enter Category Name">
    </div>

    <div>
        <h6 class="fw-500 mb-20">{{ trans('course.course_thumb') }}</h6>
    </div>
    <div class="mb-4 account-profile d-flex align-items-center ">
        <div class="ap-img pro_img_wrapper">
            <input id="file-upload" type="file" name="image" class="d-none"
                accept="image/x-png,image/gif,image/jpeg" onchange="uploadFile(this, 'profile-priviewer')">
            <!-- Profile picture image-->
            <label for="file-upload">
                <img class="ap-img__main rounded wh-120 bg-lighter d-flex"
                    src="{{ asset('assets/img/upload-file-140.png') }}" alt="profile" id="profile-priviewer">
                <span class="cross" id="remove_pro_pic">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="svg replaced-svg">
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
        <button type="submit"
            class="btn btn-primary btn-default btn-squared text-capitalize">{{ trans('course.submit') }}
        </button>
        <button type="button" class="btn btn-light btn-default btn-squared fw-400 text-capitalize b-light color-light"
            data-bs-dismiss="modal">Cancel</button>
    </div>
</form>
