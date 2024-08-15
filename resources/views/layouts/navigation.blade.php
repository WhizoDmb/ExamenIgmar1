<header class="d-flex justify-content-center py-3">
    <!-- Logo and Title -->
    <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto link-body-emphasis text-decoration-none">
        <svg class="bi me-2" width="40" height="32"><use xlink:href="#bootstrap"></use></svg>
        <span class="fs-4">Practica</span>
    </a>

    <!-- Navigation Links -->
    <ul class="nav nav-pills">
        <li class="nav-item"><a href="#" class="nav-link" style="color:black" aria-current="page">Inicio</a></li>
    </ul>

    <!-- Additional Links -->
    <ul class="nav nav-pills">
        <li class="nav-item"><a href="{{ route('dashboard') }}" class="nav-link" style="color:black">Dashboard</a></li>
        <li class="nav-item"><a href="{{ route('profile.edit') }}" class="nav-link" style="color:black">Profile</a></li>
        <li class="nav-item">
            <form method="POST" action="{{ route('logout') }}" class="d-inline">
                @csrf
                <button type="submit" class="btn btn-link nav-link" style="color:black">Log Out</button>
            </form>
        </li>
        <li class="nav-item"><span class="nav-link" style="color:black">{{ Auth::user()->name }}</span></li>
    </ul>
</header>