<link rel="stylesheet" href="{{ asset('css/header.css') }}">

<header>
    <nav>
        <ul>
            <li><a href="{{ url('/login') }}">login</a></li>
            <li><a href="{{ url('/register') }}">register</a></li>
            <li><a href="{{ url('/dashboard') }}">Dashboard</a></li>
            <li><a href="{{ url('/clients') }}">Clients</a></li>
            <li><a href="{{ url('/settings') }}">Settings</a></li>
            <!-- Add more navigation links if needed -->
        </ul>
    </nav>
</header>
