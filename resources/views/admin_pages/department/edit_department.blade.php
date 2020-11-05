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
                            <li class="active">Edit Department</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>


        <div class="content mt-3">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if(session()->has('msg'))
                <div class="sufee-alert alert with-close alert-success alert-dismissible fade show">
                    <span class="badge badge-pill badge-success">Success</span>
                    {{ session()->get('msg') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
            @endif

            <div class="row">
                <div class="col-md-8">
                    <div class="card">
                <div class="card-body">
                    <form method="post" action="/department/{{$dep->id}}" class="form-horizontal">
                        @csrf
                        <input type="hidden" name="_method" value="PUT">
                        <div class="row form-group">
                            <div class="col-md-3">
                                <label for="" class="form-control-label">Department Name:</label>
                            </div>
                            <div class="col-md-9">
                                <input type="text" class="form-control" value="{{$dep->name}}" name="department_name">
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-md-3">
                                <label for="" class="form-control-label">Code for Lecturers:</label>
                            </div>
                            <div class="col-md-9">
                                <input type="text" class="form-control" value="{{$dep->lec_code}}" name="lecturers_code">
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-md-3">
                                <label for="" class="form-control-label">Code for Students:</label>
                            </div>
                            <div class="col-md-9">
                                <input type="text" class="form-control" value="{{$dep->stu_code}}" name="students_code">
                            </div>
                        </div>
                    
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">
                        <i class="fa fa-dot-circle-o"></i> Save
                    </button>
                </div>
                </form>
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
