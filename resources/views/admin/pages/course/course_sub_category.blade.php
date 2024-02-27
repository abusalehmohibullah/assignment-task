@extends('layout.app')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="shop-breadcrumb">

                    <div class="breadcrumb-main">
                        <h4 class="text-capitalize breadcrumb-title">Course Sub Category</h4>
                        <div class="flex-wrap breadcrumb-action justify-content-center">
                            <a href="javascript:editModal('{{ route('course_sub_category.create', ['language' => app()->getLocale()]) }}','category-form-modal','form-modal','Add Sub Category')"
                                class="btn btn-sm btn-primary me-0 radius-md">
                                <i class="la la-plus"></i> Add Sub Cateory</a>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="px-20 userDatatable orderDatatable global-shadow py-30 px-sm-30 radius-xl w-100 mb-30">
                    <div class="flex-wrap project-top-wrapper d-flex justify-content-between mb-25 mt-n10">
                        <div class="flex-wrap d-flex align-items-center justify-content-center">
                            <div class="mt-10 project-search order-search global-shadow d-flex align-items-center gap-5">
                                <div class="d-flex align-items-center gap-2">
                                    <p>Id:</p>
                                    <select class="form-select" aria-label="Default select example">
                                        <option selected="">All</option>
                                        <option value="1">Latest</option>
                                        <option value="2">A-Z</option>
                                        <option value="3">Z-A</option>
                                    </select>
                                </div>


                                @php
                                    $status = request()->get('status');
                                    $is_featured = request()->get('is_featured');
                                    $search_text = request()->get('search_text');
                                    // dd($status, $is_featured);
                                @endphp
                                <!-- End: .project-search -->
                                <div class="d-flex align-items-center gap-2">
                                    <p>Status:</p>
                                    <select onchange="location = this.value;" class="form-select"
                                        aria-label="Default select example">
                                        <option value="?"
                                            {{ $is_featured == null && $status == null ? 'selected' : '' }}>All
                                        </option>
                                        <option value="?is_featured=1" {{ $is_featured == 1 ? 'selected' : '' }}>
                                            Featured</option>
                                        <option value="?status=0"
                                            {{ $status !== null && $status == 0 && $is_featured == null ? 'selected' : '' }}>
                                            Pending</option>
                                        <option value="?status=1"
                                            {{ $status !== null && $status == 1 && $is_featured == null ? 'selected' : '' }}>
                                            Approved</option>
                                    </select>
                                </div>
                            </div>
                            <!-- End: .project-category -->
                        </div><!-- End: .d-flex -->
                        <div class="content-center mt-10 d-flex align-items-center gap-4">
                            <form id="sort_courses" action="" method="GET">

                                <div class="order-search__form">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round" class="svg replaced-svg">
                                        <circle cx="11" cy="11" r="8"></circle>
                                        <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                                    </svg>
                                    <input value="{{ $search_text }}" name="search_text"
                                        class="border-0 form-control me-sm-2 box-shadow-none" type="search"
                                        placeholder="Search" aria-label="Search">

                                </div>
                            </form>
                        </div><!-- End: .content-center -->
                    </div>
                    <div class="tab-content" id="ap-tabContent">
                        <div class="tab-pane fade show active" id="ap-overview" role="tabpanel"
                            aria-labelledby="ap-overview-tab">
                            <!-- Start Table Responsive -->
                            <div class="table-responsive">
                                <table class="table mb-0 border-0 table-hover table-borderless">
                                    <thead style="background-color: rgba(116, 85, 247, .15)">
                                        <tr class="userDatatable-header">
                                            <th>
                                                <span class="userDatatable-title">SL</span>
                                            </th>
                                            <th>
                                                <span class="userDatatable-title">Sub Category Name</span>
                                            </th>
                                            <th>
                                                <span class="userDatatable-title">Parent Category</span>
                                            </th>
                                            <th>
                                                <span class="userDatatable-title">Total Course</span>
                                            </th>
                                            <th>
                                                <span class="userDatatable-title">Status</span>
                                            </th>
                                            <th>
                                                <span class="userDatatable-title float-end">Actions</span>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">

                                                    <div class="orderDatatable-title">
                                                        <p class="mb-0 d-block">
                                                            #1
                                                        </p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="orderDatatable-title">
                                                    HTML
                                                </div>
                                            </td>
                                            <td>
                                                <div class="orderDatatable-status d-inline-block">
                                                    Technology
                                                </div>
                                            </td>
                                            <td>
                                                <div class="orderDatatable-title">
                                                    1
                                                </div>
                                            </td>
                                            <td role="button">
                                                <div class="orderDatatable-status d-inline-block">
                                                    <div class="dm-switch-wrap">
                                                        <div
                                                            class="form-check form-switch form-switch-primary form-switch-sm">
                                                            <input type="checkbox" class="form-check-input" id="switch-s1"
                                                                checked>
                                                            <label class="form-check-label" for="switch-s1"></label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>

                                            <td>
                                                <ul class="flex-wrap mb-0 orderDatatable_actions d-flex float-end">

                                                    <li>
                                                        <a href="javascript:editModal('{{ route('course_sub_category.create', ['language' => app()->getLocale()]) }}','category-form-modal','form-modal')"
                                                            class="edit">
                                                            <svg width="17" height="17" viewBox="0 0 17 17"
                                                                fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <g clip-path="url(#clip0_202_51)">
                                                                    <path
                                                                        d="M11.7029 7.30469C11.7029 6.93793 11.4056 6.64062 11.0388 6.64062H4.19897C3.83221 6.64062 3.53491 6.93793 3.53491 7.30469C3.53491 7.67145 3.83221 7.96875 4.19897 7.96875H11.0388C11.4056 7.96875 11.7029 7.67145 11.7029 7.30469ZM4.19897 9.29688C3.83221 9.29688 3.53491 9.59418 3.53491 9.96094C3.53491 10.3277 3.83221 10.625 4.19897 10.625H8.35305C8.71981 10.625 9.01711 10.3277 9.01711 9.96094C9.01711 9.59418 8.71981 9.29688 8.35305 9.29688H4.19897Z"
                                                                        fill="#7455F7" />
                                                                    <path
                                                                        d="M5.7595 15.6719H3.53857C2.80625 15.6719 2.21045 15.0761 2.21045 14.3438V2.65625C2.21045 1.92392 2.80625 1.32812 3.53857 1.32812H11.7029C12.4352 1.32812 13.031 1.92392 13.031 2.65625V6.74023C13.031 7.107 13.3283 7.4043 13.695 7.4043C14.0618 7.4043 14.3591 7.107 14.3591 6.74023V2.65625C14.3591 1.19159 13.1675 0 11.7029 0H3.53857C2.07392 0 0.882324 1.19159 0.882324 2.65625V14.3438C0.882324 15.8084 2.07392 17 3.53857 17H5.7595C6.12626 17 6.42356 16.7027 6.42356 16.3359C6.42356 15.9692 6.12626 15.6719 5.7595 15.6719Z"
                                                                        fill="#7455F7" />
                                                                    <path
                                                                        d="M15.5354 9.6147C14.7586 8.83794 13.4948 8.83791 12.7185 9.61416L9.07269 13.2519C8.99528 13.3292 8.93814 13.4243 8.90635 13.529L8.11236 16.1429C8.0778 16.2567 8.07442 16.3776 8.10258 16.4932C8.13074 16.6087 8.1894 16.7145 8.27244 16.7996C8.35548 16.8848 8.45985 16.946 8.57464 16.977C8.68944 17.008 8.81045 17.0076 8.92504 16.9759L11.6054 16.2334C11.7157 16.2029 11.8162 16.1443 11.8972 16.0634L15.5354 12.4321C16.3121 11.6554 16.3121 10.3915 15.5354 9.6147ZM11.0825 15.0001L9.7341 15.3736L10.1287 14.0744L12.5887 11.6199L13.528 12.5592L11.0825 15.0001ZM14.5967 11.4926L14.4681 11.621L13.5289 10.6818L13.6571 10.5539C13.9161 10.295 14.3374 10.295 14.5963 10.5539C14.8552 10.8128 14.8552 11.2341 14.5967 11.4926ZM11.0388 3.98438H4.19897C3.83221 3.98438 3.53491 4.28168 3.53491 4.64844C3.53491 5.0152 3.83221 5.3125 4.19897 5.3125H11.0388C11.4056 5.3125 11.7029 5.0152 11.7029 4.64844C11.7029 4.28168 11.4056 3.98438 11.0388 3.98438Z"
                                                                        fill="#7455F7" />
                                                                </g>
                                                                <defs>
                                                                    <clipPath id="clip0_202_51">
                                                                        <rect width="17" height="17"
                                                                            fill="white" />
                                                                    </clipPath>
                                                                </defs>
                                                            </svg>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="javascript:deleteData('delete-category-form-1','Are you sure?','You want to delete this sub category?')"
                                                            class="remove">
                                                            <svg width="17" height="17" viewBox="0 0 17 17"
                                                                fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <path
                                                                    d="M2.0654 4.98047L2.94757 15.6299C3.01079 16.3979 3.66496 17 4.43587 17H12.5642C13.3351 17 13.9892 16.3979 14.0525 15.6299L14.9346 4.98047H2.0654ZM6.0093 15.0078C5.74859 15.0078 5.52925 14.805 5.51271 14.5409L5.01467 6.50572C4.99763 6.23093 5.20628 5.99456 5.48061 5.97753C5.76513 5.95757 5.9913 6.16868 6.0088 6.44346L6.50685 14.4786C6.52448 14.7632 6.29933 15.0078 6.0093 15.0078ZM8.99805 14.5098C8.99805 14.7851 8.77529 15.0078 8.5 15.0078C8.22471 15.0078 8.00195 14.7851 8.00195 14.5098V6.47461C8.00195 6.19932 8.22471 5.97656 8.5 5.97656C8.77529 5.97656 8.99805 6.19932 8.99805 6.47461V14.5098ZM11.9853 6.50575L11.4873 14.5409C11.4709 14.8024 11.253 15.0202 10.9591 15.0069C10.6848 14.9898 10.4761 14.7534 10.4931 14.4787L10.9912 6.4435C11.0082 6.16871 11.249 5.96879 11.5194 5.97756C11.7937 5.99459 12.0024 6.23097 11.9853 6.50575ZM14.9746 1.99219H11.9863V1.49414C11.9863 0.670238 11.3161 0 10.4922 0H6.50781C5.68391 0 5.01367 0.670238 5.01367 1.49414V1.99219H2.02539C1.47525 1.99219 1.0293 2.43814 1.0293 2.98828C1.0293 3.53836 1.47525 3.98438 2.02539 3.98438H14.9746C15.5248 3.98438 15.9707 3.53836 15.9707 2.98828C15.9707 2.43814 15.5248 1.99219 14.9746 1.99219ZM10.9902 1.99219H6.00977V1.49414C6.00977 1.21935 6.23302 0.996094 6.50781 0.996094H10.4922C10.767 0.996094 10.9902 1.21935 10.9902 1.49414V1.99219Z"
                                                                    fill="#D62020" />
                                                            </svg>
                                                        </a>
                                                        <form action="" method="post" id="delete-category-form-1">
                                                            @csrf
                                                            @method('delete')
                                                        </form>
                                                    </li>
                                                </ul>
                                            </td>
                                        </tr>
                                        <!-- End: tr -->
                                    </tbody>
                                </table>
                            </div>
                            <!-- Table Responsive End -->
                        </div>


                    </div>
                    <div class="d-flex justify-content-md-end justify-content-center mt-15 pt-25 border-top">
                    </div>

                </div><!-- End: .userDatatable -->
            </div><!-- End: .col -->
        </div>


        <!--Add Sub Category-->
        <div class="modal fade new-member " id="category-form-modal" role="dialog" tabindex="-1"
            aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content radius-xl">
                    <div class="modal-header">
                        <h6 class="modal-title fw-500" id="staticBackdropLabel">{{ trans('add-sub-category') }}</h6>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="svg replaced-svg">
                                <line x1="18" y1="6" x2="6" y2="18"></line>
                                <line x1="6" y1="6" x2="18" y2="18"></line>
                            </svg>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="new-member-modal" id="form-modal">
                            @include('admin.components.sub-category-form-modal')
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal -->


    </div>
@endsection
