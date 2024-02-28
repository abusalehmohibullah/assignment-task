<div class="sidebar__menu-group">
    <ul class="sidebar_nav">
        <li class="menu-title mt-30">
            <span>{{ trans('menu.course-management') }}</span>
        </li>
        <li>
            <a href="{{ route('home') }}" class="{{ request()->is('/') ? 'active' : '' }}">
            <span class="nav-icon nav material-icons">home</span> Home
            </a>
        </li>
        <li class="has-child open">
            <a href="#" class="{{ request()->is('categories*') || request()->is('subcategories*') ? 'active' : '' }}">
                <span class="nav-icon nav material-icons">category</span>
                <span class="menu-text text-initial">Project Categories</span>
                <span class="toggle-icon"></span>
            </a>
            <ul style="top: 252.938px; left: 213px;">
                <li>
                    <a href="{{ route('categories.index') }}" class="{{ request()->is('categories*') ? 'active' : '' }}">
                        Category List
                    </a>
                </li>
                <li>
                    <a href="{{ route('subcategories.index') }}" class="{{ request()->is('subcategories*') ? 'active' : '' }}">
                        Sub Category List
                    </a>
                </li>
            </ul>

        </li>
    </ul>
</div>