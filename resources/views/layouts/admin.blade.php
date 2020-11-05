@php
    namespace App;
    use Auth;

    $top_user= Auth::user();
    $top_dep=null;
    if (count($top_user->departments)>0) {
        foreach ($top_user->departments as $department) {
            $top_dep= $department;
        }
    }
    foreach ($top_user->roles as $ro) {
        $top_role= $ro->name;
    }
@endphp
<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js" lang="en">
<!--<![endif]-->

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{$title}}</title>
    <meta name="description" content="Sufee Admin - HTML5 Admin Template">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="apple-touch-icon" href="../../apple-icon.png">
    <link rel="shortcut icon" href="../../favicon.ico">

    <link rel="stylesheet" href="../../vendors/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../vendors/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="../../vendors/themify-icons/css/themify-icons.css">
    <link rel="stylesheet" href="../../vendors/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="../../vendors/selectFX/css/cs-skin-elastic.css">

    <link rel="stylesheet" href="../../vendors/datatables.net-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="../../vendors/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css">

    <link rel="stylesheet" href="../../vendors/chosen/chosen.min.css">
    <link rel="stylesheet" href="../../assets/css/style.css">
    <link rel="stylesheet" href="../../assets/css/my.css">

    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>

</head>

<body>


    <!-- Left Panel -->

    <aside id="left-panel" class="left-panel">
        <nav class="navbar navbar-expand-sm navbar-default">

            <div class="navbar-header">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main-menu" aria-controls="main-menu" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fa fa-bars"></i>
                </button>
                <a class="navbar-brand" href="./">
                    <h2 style="margin-top: -5px;">SLMS</h2>
                </a>
                <a class="navbar-brand hidden" href="./"><img src="../../images/logo2.png" alt="Logo"></a>
            </div>

            <div id="main-menu" class="main-menu collapse navbar-collapse">
                <ul class="nav navbar-nav">
                    <li class="dashboard">
                        <a href="/admin_dash"> <i class="menu-icon fa fa-dashboard"></i>Dashboard </a>
                    </li>
                    @if($top_role == "admin")
                        <h3 class="menu-title">Admin Section</h3><!-- /.menu-title -->
                        <li class="menu-item-has-children dropdown department">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-building-o"></i>Department</a>
                            <ul class="sub-menu children dropdown-menu">
                                <li><i class="fa fa-barcode"></i><a href="/department">Department Code</a></li>
                                <li><i class="fa fa-edit"></i><a href="/department/create">Edit Department</a></li>
                            </ul>
                        </li>
                        <li class="lecturer">
                            <a href="/lecturer"> <i class="menu-icon fa fa-user"></i>Lecturers</a>
                        </li>
                        <li class="menu-item-has-children dropdown batch">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-users"></i>Batch</a>
                            <ul class="sub-menu children dropdown-menu">
                                <li><i class="fa fa-plus-circle"></i><a href="/batch/create">Add Batch</a></li>
                                <li><i class="fa fa-list-alt"></i><a href="/batch">Batch List</a></li>
                            </ul>
                        </li>
                        <li class="menu-item-has-children dropdown manage_leaves">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-cog"></i>Manage Leaves</a>
                            <ul class="sub-menu children dropdown-menu">
                                <li><i class="fa fa-file-text-o"></i><a href="/leave_management">All Leaves</a></li>
                                <li><i class="fa fa-history"></i><a href="/leave_management/create">Leave History</a></li>
                            </ul>
                        </li>
                    @endif
                    
                    <h3 class="menu-title">Leave Management</h3><!-- /.menu-title -->
                    <li class="on_leave">
                        <a href="/on_leave"> <i class="menu-icon fa fa-clock-o"></i>On Leave</a>
                    </li>
                    <li class="menu-item-has-children dropdown my_leaves">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-flag"></i>My Leaves</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="fa fa-question-circle"></i><a href="/admin_application/create">Pending Leaves</a></li>
                            <li><i class="fa  fa-check-square-o"></i><a href="/approved_leaves">Approved Leaves</a></li>
                            <li><i class="fa fa-ban"></i><a href="/not_approved_leaves">Not Approved Leaves</a></li>
                        </ul>
                    </li>
                    <li class="all_leaves">
                        <a href="/admin_application"> <i class="menu-icon fa fa-file-text-o"></i>All Leaves</a>
                    </li>
                </ul>
            </div><!-- /.navbar-collapse -->
        </nav>
    </aside><!-- /#left-panel -->

    <!-- Left Panel -->

    <!-- Right Panel -->

    <div id="right-panel" class="right-panel">

        <!-- Header-->
        <header id="header" class="header">

            <div class="header-menu">

                <div class="col-sm-7">
                    <a id="menuToggle" class="menutoggle pull-left"><i class="fa fa fa-tasks"></i></a>
                    
                </div>

                <div class="col-sm-5">
                    <div class="user-area dropdown float-right">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            {{-- <img class="user-avatar rounded-circle" src="../../images/admin.jpg" alt="User Avatar"> --}}
                            <span class="my_user">{{$top_user->name}} <i class="fa fa-angle-down"></i></span>
                        </a>

                        <div class="user-menu dropdown-menu">
                            <a class="nav-link" href="/settings"><i class="fa fa-user"></i> Edit Profile</a>

                            <a class="nav-link" href="/settings/create"><i class="fa fa-cog"></i> Change Password</a>

                            <a class="nav-link" href="/logout"><i class="fa fa-power-off"></i> Logout</a>
                        </div>
                    </div>

                </div>
            </div>

        </header><!-- /header -->
        <!-- Header-->

        


	@yield('content')


    </div><!-- /#right-panel -->

    <!-- Right Panel -->

    <script src="../../vendors/jquery/dist/jquery.min.js"></script>
    <script src="../../vendors/popper.js/dist/umd/popper.min.js"></script>
    <script src="../../vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="../../assets/js/main.js"></script>
    <script src="../../vendors/chosen/chosen.jquery.min.js"></script>

    <script src="../../vendors/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="../../vendors/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="../../vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
    <script src="../../vendors/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js"></script>
    <script src="../../vendors/jszip/dist/jszip.min.js"></script>
    <script src="../../vendors/pdfmake/build/pdfmake.min.js"></script>
    <script src="../../vendors/pdfmake/build/vfs_fonts.js"></script>
    <script src="../../vendors/datatables.net-buttons/js/buttons.html5.min.js"></script>
    <script src="../../vendors/datatables.net-buttons/js/buttons.print.min.js"></script>
    <script src="../../vendors/datatables.net-buttons/js/buttons.colVis.min.js"></script>
    <script src="../../assets/js/init-scripts/data-table/datatables-init.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9.8.2/dist/sweetalert2.all.min.js"></script>

    <script>
        jQuery(document).ready(function() {
            jQuery(".standardSelect").chosen({
                disable_search_threshold: 10,
                no_results_text: "Oops, nothing found!",
                width: "100%"
            });
        });
    </script>

    @yield('script')

</body>

</html>






