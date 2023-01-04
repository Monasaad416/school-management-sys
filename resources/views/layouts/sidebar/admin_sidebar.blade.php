<div class="scrollbar side-menu-bg">
    <ul class="nav navbar-nav side-menu" id="sidebarnav">
        <!-- menu item admins-->
        <li>
            <a href="javascript:void(0);" data-toggle="collapse" data-target="#admins">
                <div class="pull-left"><i class="fa fa-lock" aria-hidden="true"></i><span
                        class="right-nav-text">{{trans('sidebar_trans.admin')}}</span></div>
                <div class="pull-right"><i class="ti-plus"></i></div>
                <div class="clearfix"></div>
            </a>
            <ul id="admins" class="collapse" data-parent="#sidebarnav">
                <li><a href="{{route('dashboard')}}">{{trans('admins_trans.page_title')}}</a></li>
                <li><a href="{{route('admins.index')}}">{{trans('admins_trans.admins_list')}}</a></li>
            </ul>
        </li>
        <!-- menu item grades-->
        <li>
            <a href="javascript:void(0);" data-toggle="collapse" data-target="#grades">
                <div class="pull-left"><i class="fa fa-hashtag" aria-hidden="true"></i><span
                        class="right-nav-text">{{trans('sidebar_trans.grades')}}</span></div>
                <div class="pull-right"><i class="ti-plus"></i></div>
                <div class="clearfix"></div>
            </a>
            <ul id="grades" class="collapse" data-parent="#sidebarnav">
                <li><a href="{{route('grades.index')}}">{{trans('sidebar_trans.grades-list')}}</a></li>
            </ul>
        </li>
        <!-- menu item levels-->
        <li>
            <a href="javascript:void(0);" data-toggle="collapse" data-target="#levels">
                <div class="pull-left"><i class="fa fa-hashtag" aria-hidden="true"></i><span
                        class="right-nav-text">{{trans('sidebar_trans.levels')}}</span></div>
                <div class="pull-right"><i class="ti-plus"></i></div>
                <div class="clearfix"></div>
            </a>
            <ul id="levels" class="collapse" data-parent="#sidebarnav">
                <li><a href="{{route('levels.index')}}">{{trans('levels_trans.levels_list')}}</a></li>
            </ul>
        </li>
        <!-- menu item sections-->
        <li>
            <a href="javascript:void(0);" data-toggle="collapse" data-target="#sections">
                <div class="pull-left"><i class="fa fa-hashtag" aria-hidden="true"></i><span
                        class="right-nav-text">{{trans('sidebar_trans.sections')}}</span></div>
                <div class="pull-right"><i class="ti-plus"></i></div>
                <div class="clearfix"></div>
            </a>
            <ul id="sections" class="collapse" data-parent="#sidebarnav">
                <li><a href="{{route('sections.index')}}">{{trans('sec_trans.sections_list')}}</a></li>
            </ul>
        </li>
        <!-- menu item students-->
        <li>
            <a href="javascript:void(0);" data-toggle="collapse" data-target="#students">
                <div class="pull-left"><i class="fa fa-child" aria-hidden="true"></i><span class="right-nav-text">{{trans('sidebar_trans.students')}}</span></div>
                <div class="pull-right"><i class="ti-plus"></i></div>
                <div class="clearfix"></div>
            </a>
            <ul id="students" class="collapse" data-parent="#sidebarnav">
                <li><a href="{{route('students.create')}}">{{trans('sidebar_trans.add_student')}}</a></li>
                <li><a href="{{route('students.index')}}">{{trans('sidebar_trans.all_student')}}</a></li>
                <li><a href="{{route('promotions.index')}}">{{trans('sidebar_trans.promotions')}}</a></li>
                <li><a href="{{route('promotions.create')}}">{{trans('sidebar_trans.promotions_management')}}</a></li>
            </ul>
        </li>

        <!-- menu item teachers-->
        <li>
            <a href="javascript:void(0);" data-toggle="collapse" data-target="#teachers">
                <div class="pull-left"><i class="fa fa-user" aria-hidden="true"></i><span
                        class="right-nav-text">{{trans('sidebar_trans.teachers')}}</span></div>
                <div class="pull-right"><i class="ti-plus"></i></div>
                <div class="clearfix"></div>
            </a>
            <ul id="teachers" class="collapse" data-parent="#sidebarnav">
                <li><a href="{{route('teachers.index')}}">{{trans('techs_trans.teachers_list')}}</a></li>
            </ul>
        </li>

        <!-- menu item parents-->
        <li>
            <a href="javascript:void(0);" data-toggle="collapse" data-target="#parents">
                <div class="pull-left"><i class="fa fa-users" aria-hidden="true"></i><span
                        class="right-nav-text">{{trans('sidebar_trans.parents')}}</span></div>
                <div class="pull-right"><i class="ti-plus"></i></div>
                <div class="clearfix"></div>
            </a>
            <ul id="parents" class="collapse" data-parent="#sidebarnav">
                <li><a href="{{route('show_parent')}}">{{trans('parent_trans.all_parents')}}</a></li>
            </ul>
        </li>
        <!-- menu item subjects-->
        <li>
            <a href="javascript:void(0);" data-toggle="collapse" data-target="#subjects">
                <div class="pull-left"><i class="fa fa-leanpub" aria-hidden="true"></i><span
                        class="right-nav-text">{{trans('sidebar_trans.subjects')}}</span></div>
                <div class="pull-right"><i class="ti-plus"></i></div>
                <div class="clearfix"></div>
            </a>
            <ul id="subjects" class="collapse" data-parent="#sidebarnav">
                <li><a href="{{route('subjects.index')}}">{{trans('subjects_trans.subjects_list')}}</a></li>
            </ul>
        </li>
        <!-- menu item quiz-->
        <li>
            <a href="javascript:void(0);" data-toggle="collapse" data-target="#quiz">
                <div class="pull-left"><i class="fa fa-pencil" aria-hidden="true"></i><span
                        class="right-nav-text">{{trans('quiz_trans.page_title')}}</span></div>
                <div class="pull-right"><i class="ti-plus"></i></div>
                <div class="clearfix"></div>
            </a>
            <ul id="quiz" class="collapse" data-parent="#sidebarnav">
                <li><a href="{{route('quizzes.index')}}">{{trans('quiz_trans.quizzes_list')}}</a></li>
            </ul>
        </li>
        <!-- menu item online classes-->
        <li>
            <a href="javascript:void(0);" data-toggle="collapse" data-target="#online_class">
                <div class="pull-left"><i class="fa fa-window-restore" aria-hidden="true"></i><span
                        class="right-nav-text">{{trans('online_class_trans.page_title')}}</span></div>
                <div class="pull-right"><i class="ti-plus"></i></div>
                <div class="clearfix"></div>
            </a>
            <ul id="online_class" class="collapse" data-parent="#sidebarnav">
                <li><a href="{{route('online_classes.index')}}">{{trans('online_class_trans.online_classes_list')}}</a></li>
            </ul>
        </li>
        <!-- menu item online course materials-->
        <li>
            <a href="javascript:void(0);" data-toggle="collapse" data-target="#book">
                <div class="pull-left"><i class="fa fa-book" aria-hidden="true"></i><span
                        class="right-nav-text">{{trans('books_trans.page_title')}}</span></div>
                <div class="pull-right"><i class="ti-plus"></i></div>
                <div class="clearfix"></div>
            </a>
            <ul id="book" class="collapse" data-parent="#sidebarnav">
                <li><a href="{{route('books.index')}}">{{trans('books_trans.books_list')}}</a></li>
            </ul>
        </li>

        <!-- menu item attendance-->
        <li>
            <a href="javascript:void(0);" data-toggle="collapse" data-target="#attendance">
                <div class="pull-left"><i class="fa fa-calendar-check-o" aria-hidden="true"></i><span
                        class="right-nav-text">{{trans('sidebar_trans.attendance')}}</span></div>
                <div class="pull-right"><i class="ti-plus"></i></div>
                <div class="clearfix"></div>
            </a>
            <ul id="attendance" class="collapse" data-parent="#sidebarnav">
                <li><a href="{{route('attendance.index')}}">{{trans('attendance_trans.students_list')}}</a></li>
            </ul>
        </li>
        <!-- menu item graduation-->
        <li>
            <a href="javascript:void(0);" data-toggle="collapse" data-target="#graduation">
                <div class="pull-left"><i class="fa fa-graduation-cap" aria-hidden="true"></i><span
                        class="right-nav-text">{{trans('sidebar_trans.students_graduation')}}</span></div>
                <div class="pull-right"><i class="ti-plus"></i></div>
                <div class="clearfix"></div>
            </a>
            <ul id="graduation" class="collapse" data-parent="#sidebarnav">
                <li><a href="{{route('graduation.create')}}">{{trans('graduation_trans.create_grad')}}</a></li>
                <li><a href="{{route('graduation.index')}}">{{trans('graduation_trans.all_grads')}}</a></li>
            </ul>
        </li>

        <!-- menu item settings-->
        <li>
            <a href="{{route('settings')}}"><i class="fa fa-cog" aria-hidden="true"></i>{{trans('sidebar_trans.settings')}}</a>
        </li>
        <!-- menu item fees-->
        <li>
            <a href="javascript:void(0);" data-toggle="collapse" data-target="#fees">
                <div class="pull-left"><i class="fa fa-money" aria-hidden="true"></i><span
                        class="right-nav-text">{{trans('sidebar_trans.school_fees')}}</span></div>
                <div class="pull-right"><i class="ti-plus"></i></div>
                <div class="clearfix"></div>
            </a>
            <ul id="fees" class="collapse" data-parent="#sidebarnav">
                <li><a href="{{route('fees.create')}}">{{trans('fees_trans.add_fees')}}</a></li>
                <li><a href="{{route('fees.index')}}">{{trans('fees_trans.all_fees')}}</a></li>
                <li><a href="{{route('invoices.index')}}">{{trans('fees_trans.invoices')}}</a></li>
                <li><a href="{{route('receipt_students.index')}}">{{trans('fees_trans.cash_receipts')}}</a></li>
                <li><a href="{{route('processing_fees.index')}}">{{trans('fees_trans.fees_exclusion')}}</a></li>
                <li><a href="{{route('payments_fund.index')}}">{{trans('fees_trans.payment_voucher')}}</a></li>
            </ul>
        </li>
    </ul>
</div>
