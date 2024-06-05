<header>
    <nav class="navbar navbar-expand-lg navbar-light home-header">
        <a class="navbar-brand" href="/">
            <img class="brand-title" src="{{ asset('assets/images/logo.jpg') }}" alt="" height="80">
        </a>

        <div class="header-left">
            <div>
                <a href="{{ route('home') }}" class="dropdown-item"> <span class="nav-link">Home</span></a>

                @auth
                    @if (auth()->user()->role == 'teacher')
                        <a href="{{ route('dashboard') }}" class="dropdown-item"> <span class="nav-link">Teacher
                                Portal</span></a>
                    @endif
                    @if (auth()->user()->role == 'student')
                        <a href="{{ route('student.dashboard') }}" class="dropdown-item"> <span class="nav-link">Student
                                Portal</span></a>
                    @endif
                @endauth
            </div>
        </div>
        @auth
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <span class="nav-link">Logged in as {{ auth()->user()->name }}</span>
                    </li>
                    <li class="nav-item">
                        @if (auth()->user()->role == 'teacher')
                            <a href="{{ route('logout') }}" class="nav-link"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <span class="ml-2">Logout</span>
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        @endif
                        @if (auth()->user()->role == 'student')
                            <a href="{{ route('student.logout') }}" class="nav-link"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <span class="ml-2">Logout</span>
                            </a>
                            <form id="logout-form" action="{{ route('student.logout') }}" method="POST"
                                style="display: none;">
                                @csrf
                            </form>
                        @endif
                    </li>
                </ul>
            </div>
        @endauth
    </nav>
</header>
