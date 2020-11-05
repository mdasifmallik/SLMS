@extends('../layouts.admin')


@section('content')

        <div class="breadcrumbs">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>Department</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li class="active">Department</li>
                            <li class="active">Department Code</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>


        <!--department_code-->
        <div class="content mt-3">

            <div class="row">
                <div class="col-md-6">
                    <div class="card text-white bg-flat-color-1 text-center">
                        <div class="card-header">
                            <strong>Code for Lecturers</strong>
                        </div>
                        <div class="card-body">
                            <h1>{{$dep->lec_code}}</h1>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card text-white bg-flat-color-4 text-center">
                        <div class="card-header">
                            <strong>Code for Students</strong>
                        </div>
                        <div class="card-body">
                            <h1>{{$dep->stu_code}}</h1>
                        </div>
                    </div>
                </div>
            </div>

        </div> <!-- .content -->


@endsection


@section('script')

<script>
    jQuery(document).ready(function() {
        jQuery(".department").addClass("active");
    });

</script>

@endsection