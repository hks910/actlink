<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>Admin Panel</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  
  <!-- Bootstrap CSS -->
  <link href="{{ asset('bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/style.css') }}" rel="stylesheet">
  
  <!-- Bootstrap JS -->
  <script src="{{ asset('bootstrap/js/bootstrap.bundle.min.js') }}"></script>
</head>

<body>
  <div id="wrapper">
    <nav class="navbar header-top fixed-top navbar-expand-lg navbar-dark bg-dark">
      <div class="container">
        <a class="navbar-brand" href="#">MyAdmin</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText"
          aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarText">
          <ul class="navbar-nav side-nav">
            <li class="nav-item">
              <a class="nav-link text-white {{ request()->is('/') ? 'text-light' : 'text-normal' }}" style="margin-left: 20px;" href="{{ route('admin.home') }}">Dashboard</a>
            </li>
            <li class="nav-item">
              <a class="nav-link {{ request()->is('admin-events') ? 'text-light' : 'text-normal' }}" style="margin-left: 20px;" href="{{ route('admin.events') }}">Events</a>
            </li>
            <li class="nav-item">
              <a class="nav-link {{ request()->is('admin/organizers') ? 'text-light' : 'text-normal' }}" style="margin-left: 20px;" href="{{ route('admin.organizers') }}">Organizations</a>
            </li>
            <li class="nav-item">
              <a class="nav-link {{ request()->is('admin/members') || request()->is('admin/members/*') ? 'text-light' : 'text-normal' }}" style="margin-left: 20px;" href="{{ route('admin.members.indexMember') }}">Members</a>
            </li>
          </ul>
          
          <ul class="navbar-nav ml-md-auto d-md-flex">
            <li class="nav-item">
              <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                {{-- {{ Auth::guard('admin')->user()->name }} --}}
                Admin
              </a>
              <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                <li>
                  <a class="dropdown-item" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                  <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                  </form>
                </li>
              </ul>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <div class="container-fluid">
      <main class="py-4">
        @yield('content')
      </main>
    </div>
  </div>
</body>

</html>
