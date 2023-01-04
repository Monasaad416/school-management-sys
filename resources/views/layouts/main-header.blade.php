<!--header start-->
<nav class="admin-header navbar navbar-default col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
    <div class="container">
        <div class="text-left navbar-brand-wrapper">
            <a class="navbar-brand brand-logo" href="{{route('dashboard')}}"><img src={{asset('assets/images/logo.png')}} alt="logo" width="50" height="50"/></a>
            <a class="navbar-brand brand-logo-mini" href="index.html"><img src={{asset('assets/images/logo.png')}} alt="logo" width="30" height="30"/></a>
        </div>
        <!-- Top bar left -->

        <ul class="nav navbar-nav mr-auto">
            <li class="nav-item">
                <a id="button-toggle" class="button-toggle-nav inline-block ml-20 pull-left"
                    href="javascript:void(0);"><i class="zmdi zmdi-menu ti-align-right"></i></a>
            </li>
        </ul>
        <!-- top bar right -->
        <ul class="nav navbar-nav ml-auto">
            <ul class="d-flex justify-content-center align-items-center">
                {{-- Creating a language selector from mcamara/laravel-localization package --}}
                @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                    <li class="mr-2">
                        <a rel="alternate" hreflang="{{ $localeCode }}" href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                            {{ $properties['native'] }}
                        </a>
                    </li>
                @endforeach
            </ul>
            <li class="nav-item fullscreen">
                <a id="btnFullscreen" href="#" class="nav-link"><i class="ti-fullscreen"></i></a>
            </li>

      
            <li class="nav-item dropdown mr-30">
                <a class="nav-link nav-pill user-avatar" data-toggle="dropdown" href="#" role="button"
                    aria-haspopup="true" aria-expanded="false">
                    @if(auth('student')->check())
                        <img src="{{asset("assets/images/student.png")}}" alt="avatar">
                    @elseif(auth('teacher')->check())
                        <img src="{{asset("assets/images/teacher.png")}}" alt="avatar">
                    @elseif(auth('myparent')->check())
                        <img src="{{asset("assets/images/parent.png")}}" alt="avatar">
                    @else
                        <img src="{{asset("assets/images/admin.png")}}" alt="avatar">
                    @endif

                </a>
                <div class="dropdown-menu dropdown-menu-right">
                    <div class="dropdown-header">
                        <div class="media">
                            <div class="media-body">
                                @if(auth('student')->check())
                                    <h5 class="mt-0 mb-0">{{auth('student')->user()->name}}</h5>
                                    <span>{{auth('student')->user()->email}}</span>
                                @elseif(auth('teacher')->check())
                                    <h5 class="mt-0 mb-0">{{auth('teacher')->user()->name}}</h5>
                                <span>{{auth('teacher')->user()->email}}</span>
                                @elseif(auth('myparent')->check())
                                    <h5 class="mt-0 mb-0">{{auth('myparent')->user()->name}}</h5>
                                <span>{{auth('myparent')->user()->email}}</span>
                                @else
                                    <h5 class="mt-0 mb-0">{{auth('admin')->user()->name}}</h5>
                                <span>{{auth('admin')->user()->email}}</span>
                                @endif

                            </div>
                        </div>
                    </div>
                    <div class="dropdown-divider"></div>

                    <a class="dropdown-item" href="{{route('teacher.profile')}}"><i class="text-warning ti-user"></i>Profile</a>
                    <div class="dropdown-divider"></div>
    
                    @if(auth('student')->check())
                        <form method="GET" action="{{ route('logout','student') }}">
                    @elseif(auth('teacher')->check())
                        <form method="GET" action="{{ route('logout','teacher') }}">
                    @elseif(auth('myparent')->check())
                            <form method="GET" action="{{ route('logout','myparent') }}">
                    @else
                        <form method="GET" action="{{ route('logout','admin') }}">
                    @endif
                        @csrf
                        <a class="dropdown-item" href="#" onclick="event.preventDefault();this.closest('form').submit();"><i class="fa fa-sign-out" aria-hidden="true"></i>Logout</a>
                    </form>
                </div>
            </li>
        </ul>
    </div>
</nav>

        <!--header End-->
