<div class="scrollbar side-menu-bg">
    <ul class="nav navbar-nav side-menu" id="sidebarnav">
            <li>
                <a href="{{route('myparent.dashboard')}}">
                <i class="ti-home"></i>
                {{trans('parent_trans.parent_dashboard')}}
                </a>
            </li>
        <!-- menu item sons-->
        <li>
            <a href="{{route('sons.index')}}">
                <i class="fa fa-users" aria-hidden="true"></i>{{trans('parent_trans.sons')}}
            </a>
        </li>
        <!-- menu item attendance report-->
        <li>
            <a href="{{route('sons.attendance')}}">
                <i class="fa fa-calendar-check-o" aria-hidden="true"></i>{{trans('attendance_trans.attendance_report')}}
            </a>
        </li>
        <!-- menu item fees report -->
        <li>
            <a href="{{route('sons.fees')}}">
                <i class="fa fa-money" aria-hidden="true"></i>{{trans('fees_trans.fees_report')}}
            </a>
        </li>

        <!-- menu item profile-->
        <li>
            <a href="{{route('parent.profile')}}">
                <i class="fa fa-user" aria-hidden="true"></i>{{trans('techs_trans.profile')}}
            </a>
        </li>

    </ul>
</div>
