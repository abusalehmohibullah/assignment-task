<div class="sidebar__menu-group">
    <ul class="sidebar_nav">
        <li class="menu-title mt-30">
            <span>{{ trans('menu.course-management') }}</span>
        </li>
        <li class="has-child open">
            <a href="#" class="active">
                <span class="nav-icon nav material-icons">category</span>
                <span class="menu-text text-initial">Project Categories</span>
                <span class="toggle-icon"></span>
            </a>
            <ul style="top: 252.938px; left: 213px;">
                <li>
                    <a href="{{ route('category-page') }}" class="active">
                        Category List
                    </a>
                </li>
                <li>
                    <a href="{{ route('subcategory-page') }}" class="">
                        Sub Category List
                    </a>
                </li>
            </ul>
        </li>
    </ul>
</div>
