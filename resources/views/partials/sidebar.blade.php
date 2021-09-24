   <!-- Sidebar -->
   <ul class="navbar-nav bg-gradient-warning sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fa fa-search"></i>
        </div>
        <div class="sidebar-brand-text mx-2">ElasticSearch</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">
    
    <!-- Nav Item - Dashboard -->
    <li class="nav-item {{ (request()->is('/*')) ? 'active' : '' }}">
        <a class="nav-link" href="/">
            <i class="fas fa-fw fa-file"></i>
            <span>Documents</span></a>
    </li>
    
      <!-- Nav Item - System Users -->
      <li class="nav-item {{ (request()->is('*search*')) ? 'active' : '' }}">
        <a class="nav-link" href="{{URL::to('/search')}}">
            <i class="fas fa-search"></i>
            <span>Search</span></a>
    </li>


</ul>
<!-- End of Sidebar -->