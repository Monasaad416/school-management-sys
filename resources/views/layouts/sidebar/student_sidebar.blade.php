<div class="scrollbar side-menu-bg">
    <ul class="nav navbar-nav side-menu" id="sidebarnav">

        <!-- menu item quiz-->
        <li>
            <a href="javascript:void(0);" data-toggle="collapse" data-target="#quiz">
                <div class="pull-left"><i class="ti-calendar"></i><span
                        class="right-nav-text">{{trans('quiz_trans.page_title')}}</span></div>
                <div class="pull-right"><i class="ti-plus"></i></div>
                <div class="clearfix"></div>
            </a>
            <ul id="quiz" class="collapse" data-parent="#sidebarnav">
                <li><a href="{{route('s_quizzes.index')}}">{{trans('quiz_trans.quizzes_list')}}</a></li>
            </ul>
        </li>
        <!-- menu item online classes-->
        <li>
            <a href="javascript:void(0);" data-toggle="collapse" data-target="#online_class">
                <div class="pull-left"><i class="ti-calendar"></i><span
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
                <div class="pull-left"><i class="ti-calendar"></i><span
                        class="right-nav-text">{{trans('books_trans.page_title')}}</span></div>
                <div class="pull-right"><i class="ti-plus"></i></div>
                <div class="clearfix"></div>
            </a>
            <ul id="book" class="collapse" data-parent="#sidebarnav">
                <li><a href="{{route('books.index')}}">{{trans('books_trans.books_list')}}</a></li>
            </ul>
        </li>

        <!-- menu item profile-->
        <li>
            <a href="{{route('student_profile.index')}}">
                <i class="fa fa-user" aria-hidden="true"></i>{{trans('techs_trans.profile')}}
            </a>
        </li>

    </ul>
</div>
