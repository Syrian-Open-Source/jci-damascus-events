<!-- This file is used to store sidebar items, starting with Backpack\Base 0.9.0 -->
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('dashboard') }}"><i class="la la-home nav-icon"></i> {{ trans('backpack::base.dashboard') }}</a></li>
<li class='nav-item'><a class='nav-link' href='{{ backpack_url('user') }}'><i class='nav-icon la la-user'></i> Users</a></li>
<li class='nav-item'><a class='nav-link' href='{{ backpack_url('event') }}'><i class='nav-icon la la-birthday-cake'></i> Events</a></li>
<li class="nav-item nav-dropdown">
    <a class="nav-link nav-dropdown-toggle" href="#"><i class="fa fa-key"></i> <span>Menus & Foods</span> <i class="fa fa-angle-left pull-right"></i></a>
    <ul class="nav-dropdown-items">
        <li class='nav-item'><a class='nav-link' href='{{ backpack_url('menu') }}'><i class='nav-icon la la-spoon'></i> Menus</a></li>
        <li class='nav-item'><a class='nav-link' href='{{ backpack_url('menu-item') }}'><i class='nav-icon la la-pencil'></i> Menu Food</a></li>
    </ul>
</li>
<li class="nav-item nav-dropdown">
    <a class="nav-link nav-dropdown-toggle" href="#"><i class="fa fa-key"></i> <span>Tables & Chairs</span> <i class="fa fa-angle-left pull-right"></i></a>
    <ul class="nav-dropdown-items">

        <li class='nav-item'><a class='nav-link' href='{{ backpack_url('food-table') }}'><i class='nav-icon la la-table'></i> Food tables</a></li>
        <li class='nav-item'><a class='nav-link' href='{{ backpack_url('chair-table') }}'><i class='nav-icon la la-question'></i> Chair tables</a></li>
    </ul>
</li>