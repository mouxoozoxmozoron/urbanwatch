<aside id="sidebar" class="sidebar">
    <ul class="sidebar-nav" id="sidebar-nav">

      {{-- Existing sections (Users, Incidences, Education, Station) remain unchanged --}}

      <!-- ========== Reported Issues Section ========== -->


      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#dashboard-nav" data-bs-toggle="collapse" href="#">
        <i class="bi bi-home-badge"></i><span>Dashboard</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="dashboard-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
        <li>
            <a href="{{ route('dashboard') }}">
            <i class="bi bi-circle"></i><span>Home</span>
            </a>
        </li>
        </ul>
    </li>


      {{-- let make role based navigation bars --}}
    @if (Auth::user()->user_type_id == 1)


      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#issues-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-exclamation-circle"></i><span>Reported Issues</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="issues-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
          <li>
            <a href="{{ route('incidences') }}">
              <i class="bi bi-circle"></i><span>All Issues</span>
            </a>
          </li>
          <li>
            <a href="{{ route('un-resolved-issues') }}">
              <i class="bi bi-circle"></i><span>Unresolved</span>
            </a>
          </li>

          <li>
            <a href="{{ route('resolved-issues') }}">
              <i class="bi bi-circle"></i><span>Resolved</span>
            </a>
          </li>
        </ul>
      </li><!-- End Reported Issues -->

      <!-- ========== Consultants Section ========== -->
      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#consultants-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-person-badge"></i><span>Consultants</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="consultants-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
          <li>
            <a href="{{ route('consultancy') }}">
              <i class="bi bi-circle"></i><span>All Consultants</span>
            </a>
          </li>

          <li>
            <a href="{{ route('consultancy-managers') }}">
              <i class="bi bi-circle"></i><span>Consultancy Admins</span>
            </a>
          </li>
        </ul>
      </li><!-- End Consultants -->

      <!-- ========== Subscribers Section ========== -->
      {{-- <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#subscribers-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-person-check"></i><span>Subscribers</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="subscribers-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
          <li>
            <a href="">
              <i class="bi bi-circle"></i><span>Subscriber List</span>
            </a>
          </li>
          <li>
            <a href="">
              <i class="bi bi-circle"></i><span>Manage Access</span>
            </a>
          </li>
        </ul>
      </li> --}}

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#management-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-tags"></i><span>Mnagement</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="management-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
          <li>
            <a href="{{ route('system-managers') }}">
              <i class="bi bi-circle"></i><span>Admins List</span>
            </a>
          </li>
        </ul>
      </li>


      <!-- ========== Issue Categories Section ========== -->

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#categories-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-tags"></i><span>Issue Categories</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="categories-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
          <li>
            <a href="">
              <i class="bi bi-circle"></i><span>Category List</span>
            </a>
          </li>
          <li>
            <a href="">
              <i class="bi bi-circle"></i><span>Add Category</span>
            </a>
          </li>
        </ul>
      </li><!-- End Issue Categories -->

      <!-- ========== Analytics Section ========== -->
      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#analytics-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-bar-chart-line"></i><span>Analytics</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="analytics-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
          <li>
            <a href="">
              <i class="bi bi-circle"></i><span>Reports</span>
            </a>
          </li>
          <li>
            <a href="">
              <i class="bi bi-circle"></i><span>Dashboards</span>
            </a>
          </li>
        </ul>
      </li><!-- End Analytics -->
 @endif





       <!-- ========== company Section ========== -->
       <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#company-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-person-badge"></i><span>company</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="company-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
          <li>
            <a href="{{ route('my-company') }}">
              <i class="bi bi-circle"></i><span>My company</span>
            </a>
          </li>
        </ul>
      </li><!-- End Consultants -->

    </ul>
  </aside>
