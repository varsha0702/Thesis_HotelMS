<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Home Page</title>
    <link href="{{ asset('/bs5/bootstrap.min.css') }}" rel="stylesheet" />
    <script type="text/javascript" src="{{ asset('/vendor/jquery/jquery.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/bs5/bootstrap.bundle.min.js') }}"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"
        integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"
        integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous">
    </script>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">A Hotel</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup"
                aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav ms-auto">
                    <a class="nav-link mr-3" aria-current="page" href="#services">Services</a>
                    <a class="nav-link" href="#gallery">Gallery</a>
                    <a class="nav-link" href="{{ url('page/about-us') }}">About Us</a>
                    <a class="nav-link" href="{{ url('page/contact-us') }}">Contact Us</a>

                    

                    
                    @if (Session::has('stafflogin'))

                        <a class="nav-link" href="{{ url('staff/view-task') }}"> View Task</a>
                        <a class="nav-link" href="{{ url('staff/logout') }}">Logout</a>

                    @endif
                    @guest
                        <a class="nav-link" href="{{ route('login') }}">User Login</a>
                        <a class="nav-link" href="{{ url('staff-login') }}">Staff Login</a>
                        <a class="nav-link" href="{{ route('register') }}">Register</a>
                    @else
                    <a class="nav-link" href="{{ url('customer/add-testimonial') }}">Add Testimonial</a>
                    <a class="nav-link btn btn-sm btn-danger" href="{{ url('booking') }}">Booking</a>
                        <div class="dropdown ml-2">
                            <button class="btn btn-secondary dropdown-toggle mr-2" type="button" id="dropdownMenuButton1"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                {{Auth::user()->name}}
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                <li><a class="dropdown-item" href="profile">My Profile</a></li>
                                <li><a class="dropdown-item" href="history">My history</a></li>
                                <li> <a class="dropdown-item" href="{{ route('logout') }}"
									onclick="event.preventDefault();
												  document.getElementById('logout-form').submit();">
									 {{ __('Logout') }}
								 </a>

								 <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
									 @csrf
								 </form></li>
                            </ul>
                        </div>
                    @endguest

                </div>
            </div>

    </nav>
    <main>
        @yield('content')
    </main>
</body>

</html>
<style>
	.dropdown-toggle::after {
    display:none;
}
</style>