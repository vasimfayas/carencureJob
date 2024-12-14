<!-- Example: partials/sidebar.blade.php -->
<aside class="sidebar">
    <!-- Sidebar content here -->
    <aside class="sidenav navbar navbar-vertical navbar-expand-xs border-radius-lg fixed-start ms-2  bg-white my-2" id="sidenav-main">
    
    <hr class="horizontal dark mt-0 mb-2">
    <div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link {{request()->routeIs('dashboard')?'active bg-gradient-dark text-white':'text-dark'}}" href="{{route('dashboard')}}">
            <i class="material-symbols-rounded opacity-5">dashboard</i>
            <span class="nav-link-text ms-1">Dashboard</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{request()->routeIs('Job.index')?'active bg-gradient-dark text-white':'text-dark'}}" href="{{route('Job.index')}}">
            <i class="material-symbols-rounded opacity-5">table_view</i>
            <span class="nav-link-text ms-1">Job</span>
          </a>
        </li>
        
    </div>
    
  </aside>
</aside>