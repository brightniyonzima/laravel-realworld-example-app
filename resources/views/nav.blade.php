<nav class="navbar navbar-expand-md navbar-dark bg-dark navbar-laravel">
    <div class="container-fluid">
        <a class="navbar-brand mb-0 h1" href="{{ url('/home') }}">
            <img src="{{ asset('uploads/logo/logo.jpg') }}" width="30" height="30" alt="">   {{ config('app.name', 'Laravel') }}
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            @auth
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="{{ route('home') }}">Dashboard <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Orders <span class="badge badge-danger">{{ get_orders() }}</span>
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item" href="{{ route('orders.index') }}">Active Orders</a>
                        <a class="dropdown-item" href="{{ url('completed_orders') }}">Completed Orders</a>
                        <a class="dropdown-item" href="{{ url('cancelled_orders') }}">Cancelled Orders</a>
                        <a class="dropdown-item" href="{{ route('orders.create') }}">Phone Orders</a>
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Restaurants & Menus
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item" href="{{ route('restaurants.create') }}">Add restaurants</a>
                        <a class="dropdown-item" href="{{ url('/restaurants') }}">Manage restaurants</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="{{ url('/menus/create') }}">Add menu</a>
                        <a class="dropdown-item" href="{{ url('/menus') }}">Manage menu</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="{{ url('/menu-items/create') }}">Add menu items</a>
                        <a class="dropdown-item" href="{{ url('/menu-items') }}">Manage menu items</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="{{ url('/menu-categories/create') }}">Add Menu category</a>
                        <a class="dropdown-item" href="{{ url('/menu-categories') }}">Manage Menu categories</a>
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Drivers
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item" href="{{ url('/drivers/create') }}">Add drivers</a>
                        <a class="dropdown-item" href="{{ url('/drivers') }}">Manage drivers</a>
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Neighbourhood
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item" href="{{ route('neighbourhoods.create') }}">Add neighbourhood</a>
                        <a class="dropdown-item" href="{{ route('neighbourhoods.index') }}">Manage neighbourhoods</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="{{ route('delivery-fee-matrix.index') }}">Delivery hood fee matrix</a>
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Reports
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item" href="#">Delivered orders</a>
                        <a class="dropdown-item" href="#">Revenue report</a>
                        <a class="dropdown-item" href="#">All customer's reports</a>
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Clients
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <!--<a class="dropdown-item" href="{{ route('clients.create') }}">Add client</a>-->
                        <a class="dropdown-item" href="{{ route('clients.index') }}">Manage clients</a>
                    </div>
                </li>
            </ul>
            @endauth
            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
                <!-- Authentication Links -->
                @guest
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Register</a>
                </li>
                @else
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        {{ Auth::user()->first_name }} {{ Auth::user()->last_name }} <span class="caret"></span>
                    </a>

                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('users.index') }}">Manage Admins</a>
                        <a class="dropdown-item" href="{{ route('roles.index') }}">Manage Roles</a>
                        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>
