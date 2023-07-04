<!DOCTYPE html>

<html lang="en">

<head>
  <meta name="csrf-token" content="{{ csrf_token() }}" />
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title> Profession System CMS | @yield('title')

  </title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="{{asset('cms/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('cms/plugins/fontawesome-free/css/all.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('cms/dist/css/adminlte.min.css')}}">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <!-- SweetAlert CSS -->

  <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"
    integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <!-- CSS -->
  <link href="{{asset('cms/plugins/select2/css/select2.min.css')}}" rel="stylesheet" />
  <link href="{{asset('cms/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}" rel="stylesheet" />
  {{-- @include('spatie::permission::list-permissions'); --}}
  @yield('style')


</head>

<body class="hold-transition sidebar-mini">
  <!-- Site wrapper -->
  <div class="wrapper">
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
          <a href="{{route('admin.home')}}" class="nav-link">Home</a>
        </li>
      </ul>

      <!-- Right navbar links -->
      <ul class="navbar-nav ml-auto">
        <!-- Navbar Search -->
        <li class="nav-item">
          <a class="nav-link" data-widget="navbar-search" href="#" role="button">
            <i class="fas fa-search"></i>
          </a>
          <div class="navbar-search-block">
            <form class="form-inline">
              <div class="input-group input-group-sm">
                <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                  <button class="btn btn-navbar" type="submit">
                    <i class="fas fa-search"></i>
                  </button>
                  <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
            </form>
          </div>
        </li>

        <!-- Messages Dropdown Menu -->
        <li class="nav-item dropdown">
          <a class="nav-link" data-toggle="dropdown" href="#">
            <i class="far fa-comments"></i>
            <span class="badge badge-danger navbar-badge">3</span>
          </a>
          <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
            <a href="#" class="dropdown-item">
              <!-- Message Start -->
              <div class="media">
                <img src="{{asset('cms/dist/img/user1-128x128.jpg')}}" alt="User Avatar"
                  class="img-size-50 mr-3 img-circle">
                <div class="media-body">
                  <h3 class="dropdown-item-title">
                    Brad Diesel
                    <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                  </h3>
                  <p class="text-sm">Call me whenever you can...</p>
                  <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                </div>
              </div>
              <!-- Message End -->
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item">
              <!-- Message Start -->
              <div class="media">
                <img src="{{asset('cms/dist/img/user8-128x128.jpg')}}" alt="User Avatar"
                  class="img-size-50 img-circle mr-3">
                <div class="media-body">
                  <h3 class="dropdown-item-title">
                    John Pierce
                    <span class="float-right text-sm text-muted"><i class="fas fa-star"></i></span>
                  </h3>
                  <p class="text-sm">I got your message bro</p>
                  <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                </div>
              </div>
              <!-- Message End -->
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item">
              <!-- Message Start -->
              <div class="media">
                <img src="{{asset('cms/dist/img/user3-128x128.jpg')}}" alt="User Avatar"
                  class="img-size-50 img-circle mr-3">
                <div class="media-body">
                  <h3 class="dropdown-item-title">
                    Nora Silvester
                    <span class="float-right text-sm text-warning"><i class="fas fa-star"></i></span>
                  </h3>
                  <p class="text-sm">The subject goes here</p>
                  <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                </div>
              </div>
              <!-- Message End -->
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
          </div>
        </li>
        <!-- Notifications Dropdown Menu -->
        <li class="nav-item dropdown">
          <a class="nav-link" data-toggle="dropdown" href="#">
            <i class="far fa-bell"></i>
            <span class="badge badge-warning navbar-badge">15</span>
          </a>
          <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
            <span class="dropdown-item dropdown-header">15 Notifications</span>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item">
              <i class="fas fa-envelope mr-2"></i> 4 new messages
              <span class="float-right text-muted text-sm">3 mins</span>
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item">
              <i class="fas fa-users mr-2"></i> 8 friend requests
              <span class="float-right text-muted text-sm">12 hours</span>
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item">
              <i class="fas fa-file mr-2"></i> 3 new reports
              <span class="float-right text-muted text-sm">2 days</span>
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
          </div>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-widget="fullscreen" href="#" role="button">
            <i class="fas fa-expand-arrows-alt"></i>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
            <i class="fas fa-th-large"></i>
          </a>
        </li>
      </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="cms/index3.html" class="brand-link">
        {{-- <img src="{{asset('cms/dist/img/AdminLTELogo.png')}}" alt="AdminLTE Logo"
        class="brand-image img-circle elevation-3" style="opacity: .8"> --}}
        <span class="brand-text font-weight-light"><img
            src="{{Storage::dist('public')->url('logo/logoProfessionalSystem.jpeg')}}" alt="" srcset=""></span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">
        <!-- Sidebar user (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
          <div class="image">
            <img
              src="https://st3.depositphotos.com/6672868/13701/v/450/depositphotos_137014128-stock-illustration-user-profile-icon.jpg"
              class="img-circle elevation-2" alt="User Image">
          </div>
          <div class="info">
            <a href="#" class="d-block">{{auth('admin')->user()->name}}</a>
          </div>
        </div>

        <!-- SidebarSearch Form -->
        <div class="form-inline">
          <div class="input-group" data-widget="sidebar-search">
            <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
            <div class="input-group-append">
              <button class="btn btn-sidebar">
                <i class="fas fa-search fa-fw"></i>
              </button>
            </div>
          </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->



            <li class="nav-header">Content Managment</li>
            @canany(['Index-Speciality' , 'Create-Speciality' , 'Restore-Speciality'])
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-briefcase"></i>
                <p>
                  specialities
                  <i class="fas fa-angle-left right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                @can('Index-Speciality')
                <li class="nav-item">
                  <a href="{{route('specialities.index')}}" class="nav-link">
                    <i class="nav-icon fas fa-th-list"></i>
                    <p>Index</p>
                  </a>
                </li>
                @endcan

                @can('Create-Speciality')
                <li class="nav-item">
                  <a href="{{route('specialities.create')}}" class="nav-link">
                    <i class="nav-icon fas fa-plus-circle"></i>
                    <p>Create</p>
                  </a>
                </li>
                @endcan

                @can('Restore-Speciality')
                <li class="nav-item">
                  <a href="{{route('specialities.restore')}}" class="nav-link">
                    <i class="nav-icon fas fa-trash-restore"></i>
                    {{-- <i class=" fas fa-trash-can-arrow-up"></i> --}}
                    <p>Restore</p>
                  </a>
                </li>
                @endcan
              </ul>
            </li>
            @endcanany

            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-hammer"></i>
                <p>
                  professions
                  <i class="fas fa-angle-left right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="{{route('professional.index')}}" class="nav-link">
                    <i class="nav-icon fas fa-th-list"></i>
                    <p>Index</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{route('professional.create')}}" class="nav-link">
                    <i class="nav-icon fas fa-plus-circle"></i>
                    <p>Create</p>
                  </a>
                </li>

                <li class="nav-item">
                  <a href="{{route('professional.restore')}}" class="nav-link">
                    <i class="nav-icon fas fa-trash-restore"></i>
                    <p>Restore</p>
                  </a>
                </li>
              </ul>
            </li>


            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-city"></i>
                <p>
                  City
                  <i class="fas fa-angle-left right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="{{route('cities.index')}}" class="nav-link">
                    <i class="nav-icon fas fa-th-list"></i>
                    <p>Index</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{route('cities.create')}}" class="nav-link">
                    <i class="nav-icon fas fa-plus-circle"></i>
                    <p>Create</p>
                  </a>
                </li>

              </ul>
            </li>


            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-images"></i>
                <p>
                  Images
                  <i class="fas fa-angle-left right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="{{route('images.index')}}" class="nav-link">
                    <i class="nav-icon fas fa-th-list"></i>
                    <p>Index</p>
                  </a>
                </li>
              </ul>
            </li>


            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-align-left"></i>
                <p>
                  Projects
                  <i class="fas fa-angle-left right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="{{route('project.index')}}" class="nav-link">
                    <i class="nav-icon fas fa-th-list"></i>
                    <p>Index</p>
                  </a>
                </li>
              </ul>
            </li>


            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-briefcase"></i>
                <p>
                  Workers
                  <i class="fas fa-angle-left right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="{{route('worker.index')}}" class="nav-link">
                    <i class="nav-icon fas fa-th-list"></i>
                    <p>Index</p>
                  </a>
                </li>
              </ul>
            </li>
            {{-- worker.index --}}


            @canany(['Create_Permissions' , 'Delete_Permissions' , 'Update_Permissions' , 'Index_Permissions'
            ,'Create_Roles' , 'Delete_Roles' , 'Update_Roles' , 'Index_Roles'])
            <li class="nav-header">Roles and Permissions</li>
            {{-- @canany(['create_role', 'index_role']) --}}

            @canany(['Create_Roles' , 'Delete_Roles' , 'Update_Roles' , 'Index_Roles'])
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-user-tag"></i>
                <p>
                  Roles
                  <i class="fas fa-angle-left right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                @can('Index_Roles')
                <li class="nav-item">
                  <a href="{{route('roles.index')}}" class="nav-link">
                    <i class="nav-icon fas fa-th-list"></i>
                    <p>Index</p>
                  </a>
                </li>
                @endcan
                @can('Create_Roles')
                <li class="nav-item">
                  <a href="{{route('roles.create')}}" class="nav-link">
                    <i class="nav-icon fas fa-plus-circle"></i>
                    <p>Create</p>
                  </a>
                </li>
                @endCan

              </ul>
            </li>

            @endcanany
            @canany(['Create_Permissions' , 'Delete_Permissions' , 'Update_Permissions' , 'Index_Permissions'])

            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-magic"></i>
                <p>
                  permissions
                  <i class="fas fa-angle-left right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                @can('Index_Permissions')
                <li class="nav-item">
                  <a href="{{route('permission.index')}}" class="nav-link">
                    <i class="nav-icon fas fa-th-list"></i>
                    <p>Index</p>
                  </a>
                </li>
                @endcan
                @can('Create_Permissions')
                <li class="nav-item">
                  <a href="{{route('permission.create')}}" class="nav-link">
                    <i class="nav-icon fas fa-plus-circle"></i>
                    <p>Create</p>
                  </a>
                </li>
                @endcan

              </ul>
            </li>

            @endcanany
            @endcanany
            <li class="nav-header">HR</li>
            {{-- @canany(['create_role', 'index_role']) --}}


            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-users"></i>
                {{-- <i class="nav-icon fas fa-user-tag"></i> --}}
                <p>
                  User
                  <i class="fas fa-angle-left right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                {{-- @can('index_role') --}}
                <li class="nav-item">
                  <a href="{{route('users.index')}}" class="nav-link">
                    <i class="nav-icon fas fa-th-list"></i>
                    <p>Index</p>
                  </a>
                </li>
                {{-- @endcan --}}


              </ul>
            </li>
            {{-- @endcanany --}}
            @canany(['Update_Admin', 'Create_Admin' , 'Delete_Admin' , 'Index_Admin'])

            <li class="nav-item">

              <a href="#" class="nav-link">
                {{-- <i class="nav-icon fas fa-users"></i> --}}
                <i class="nav-icon fas fa-user-tie"></i>
                <p>
                  Admin
                  <i class="fas fa-angle-left right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                @can('Index_Admin')
                <li class="nav-item">
                  <a href="{{route('admins.index')}}" class="nav-link">
                    <i class="nav-icon fas fa-th-list"></i>
                    <p>Index</p>
                  </a>
                </li>
                @endcan
                @can('Create_Admin')
                <li class="nav-item">
                  <a href="{{route('admins.create')}}" class="nav-link">
                    <i class="nav-icon fas fa-plus-circle"></i>
                    <p>create</p>
                  </a>
                </li>
                @endcan

              </ul>
            </li>
            @endcanany



            <li class="nav-header">Setting</li>

            <li class="nav-item">
              <a href="{{route('Admin.page_change_password')}}" class="nav-link">
                <i class="nav-icon fas fa-lock"></i>
                <p>Change Password</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{route('admin.logout')}}" class="nav-link">
                <i class="nav-icon fas fa-sign-out-alt"></i>
                <p>LogOut </p>
              </a>
            </li>



          </ul>
        </nav>
        <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>@yield('page-title')</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{route('admin.home')}}">Home</a></li>
                <li class="breadcrumb-item active">@yield('small-title')</li>
              </ol>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>

      <!-- Main content -->
      @yield('content')
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <footer class="main-footer">
      <div class="float-right d-none d-sm-block">
        <b>Version</b> {{env('APP_VERSION')}}
      </div>
      <strong>Copyright &copy; 2023-2024 <a href="#">{{env('APP_NAME')}}</a>.</strong> All rights reserved.
    </footer>

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
      <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
  </div>
  <!-- ./wrapper -->

  <!-- jQuery -->
  <script src="{{asset('cms/plugins/jquery/jquery.min.js')}}"></script>
  <!-- Bootstrap 4 -->
  <script src="{{asset('cms/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
  <!-- AdminLTE App -->
  <script src="{{asset('cms/dist/js/adminlte.min.js')}}"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="{{asset('cms/dist/js/demo.js')}}"></script>

  @yield('script')
</body>

</html>