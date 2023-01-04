<div class="scrollbar side-menu-bg">
    <ul class="nav navbar-nav side-menu" id="sidebarnav">
        <!-- menu title -->
            <!-- menu item Dashboard-->
        <li>
            <a href="{{route('teacher_dashboard')}}">
              <i class="ti-home"></i>
            {{trans('techs_trans.teacher_dashboard')}}
            </a>
        </li>

        <!-- menu item sections-->
        <li>
            <a href="javascript:void(0);" data-toggle="collapse" data-target="#sections">
                <div class="pull-left"><i class="fa fa-puzzle-piece" aria-hidden="true"></i><span class="right-nav-text">{{trans('sidebar_trans.sections')}}</span></div>
                <div class="pull-right"><i class="ti-plus"></i></div>
                <div class="clearfix"></div>
            </a>
            <ul id="sections" class="collapse" data-parent="#sidebarnav">
                <li><a href="{{route('t_sections')}}">{{trans('sec_trans.sections_list')}}</a></li>
            </ul>
        </li>

        <!-- menu item students-->
        <li>
            <a href="javascript:void(0);" data-toggle="collapse" data-target="#students">
                <div class="pull-left"><i class="fa fa-graduation-cap" aria-hidden="true"></i><span class="right-nav-text">{{trans('sidebar_trans.students')}}</span></div>
                <div class="pull-right"><i class="ti-plus"></i></div>
                <div class="clearfix"></div>
            </a>
            <ul id="students" class="collapse" data-parent="#sidebarnav">
                <li><a href="{{route('t_students')}}">{{trans('students_trans.students_list')}}</a></li>
            </ul>
        </li>

        <!-- menu item exams-->
        <li>
            <a href="javascript:void(0);" data-toggle="collapse" data-target="#exams">
                <div class="pull-left"><i class="fa fa-pencil-square-o" aria-hidden="true"></i><span class="right-nav-text">{{trans('techs_trans.exams')}}</span></div>
                <div class="pull-right"><i class="ti-plus"></i></div>
                <div class="clearfix"></div>
            </a>
            <ul id="exams" class="collapse" data-parent="#sidebarnav">
                <li><a href="{{route('t_quizzes.index')}}">{{trans('techs_trans.exams_list')}}</a></li>
            </ul>
        </li>



        <!-- menu item reports-->
        <li>
            <a href="javascript:void(0);" data-toggle="collapse" data-target="#reports">
                <div class="pull-left"><i class="fa fa-bars" aria-hidden="true"></i><span class="right-nav-text">{{trans('techs_trans.reports')}}</span></div>
                <div class="pull-right"><i class="ti-plus"></i></div>
                <div class="clearfix"></div>
            </a>
            <ul id="reports" class="collapse" data-parent="#sidebarnav">
                <li><a href="{{route('t_attendance.report')}}">{{trans('attendance_trans.attendance_report')}}</a></li>
            </ul>
        </li>


        <!-- menu item online class-->
        <li>
            <a href="javascript:void(0);" data-toggle="collapse" data-target="#online_classes">
                <div class="pull-left"><i class="fa fa-bars" aria-hidden="true"></i><span class="right-nav-text">{{trans('online_class_trans.page_title')}}</span></div>
                <div class="pull-right"><i class="ti-plus"></i></div>
                <div class="clearfix"></div>
            </a>
            <ul id="online_classes" class="collapse" data-parent="#sidebarnav">
                <li><a href="{{route('t_online_classes.index')}}">{{trans('online_class_trans.online_class_title')}}</a></li>
            </ul>
        </li>


        <!-- menu item profile-->
        <li>
            <a href="{{route('teacher.profile')}}"><i class="fa fa-user" aria-hidden="true"></i>{{trans('techs_trans.profile')}}</a>
        </li>








    </ul>
</div>


