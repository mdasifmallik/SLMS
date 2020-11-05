@extends('../layouts.admin')


@section('content')

        <div class="breadcrumbs">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>Dashboard</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li class="active">Dashboard</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>


        <div class="content mt-3">

            <div class="row">
                <div class="col-md-6">
                    <a href="/on_leave">
                        <div class="card card text-white bg-flat-color-1">
                            <div class="card-body">
                                <div class="stat-widget-one">
                                    <div class="stat-icon dib">
                                        <i class="fa fa-clock-o"></i>
                                    </div>
                                    <div class="stat-content dib">
                                        <div class="stat-text">Students On Leave</div>
                                        <div class="stat-digit">{{$current}}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-6">
                    <a href="/admin_application">
                        <div class="card card text-white bg-flat-color-2">
                            <div class="card-body">
                                <div class="stat-widget-one">
                                    <div class="stat-icon dib">
                                        <i class="fa fa-file-text-o"></i>
                                    </div>
                                    <div class="stat-content dib">
                                        <div class="stat-text">All Leaves</div>
                                        <div class="stat-digit">{{$all}}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <a href="/admin_application/create">
                        <div class="card card text-white bg-flat-color-3">
                            <div class="card-body">
                                <div class="stat-widget-one">
                                    <div class="stat-icon dib">
                                        <i class="fa fa-question-circle"></i>
                                    </div>
                                    <div class="stat-content dib">
                                        <div class="stat-text">Pending Leaves</div>
                                        <div class="stat-digit">{{$pending}}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-4">
                    <a href="/approved_leaves">
                        <div class="card card text-white bg-success">
                            <div class="card-body">
                                <div class="stat-widget-one">
                                    <div class="stat-icon dib">
                                        <i class="fa  fa-check-square-o"></i>
                                    </div>
                                    <div class="stat-content dib">
                                        <div class="stat-text">Approved Leaves</div>
                                        <div class="stat-digit">{{$approved}}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-4">
                    <a href="not_approved_leaves">
                        <div class="card card text-white bg-flat-color-4">
                            <div class="card-body">
                                <div class="stat-widget-one">
                                    <div class="stat-icon dib">
                                        <i class="fa fa-ban"></i>
                                    </div>
                                    <div class="stat-content dib">
                                        <div class="stat-text">Not approved Leaves</div>
                                        <div class="stat-digit">{{$declined}}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>

        </div> <!-- .content -->

@endsection


@section('script')

<script>
    jQuery(document).ready(function() {
        jQuery(".dashboard").addClass("active");
    });

</script>

@endsection