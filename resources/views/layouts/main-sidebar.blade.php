<div class="container-fluid">
    <div class="row">
        <!-- Left Sidebar start-->
        <div class="side-menu-fixed">
            @if (Auth::guard('student')->check()) {
                @include('layouts.sidebar.student_sidebar')
            }
            @elseif (Auth::guard('teacher')->check()) {
                @include('layouts.sidebar.teacher_sidebar')
            }
            @elseif (Auth::guard('myparent')->check()) {
                @include('layouts.sidebar.myparent_sidebar')
            }
            @elseif (Auth::guard('admin')->check()) {
                @include('layouts.sidebar.admin_sidebar')
            }
            @endif


            
        </div>

        <!-- Left Sidebar End-->

        <!--=================================
