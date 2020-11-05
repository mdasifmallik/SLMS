@extends('layouts.admin')


@section('content')

        <div class="breadcrumbs">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>Batch</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li class="active">Batch</li>
                            <li class="active">Add Batch</li>
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
                <div class="col-md-6">
                    <div class="card mt-3">
                        <div class="card-body">
                            <form method="post" action="/batch" class="form-horizontal">
                                @csrf
                                <div class="row form-group">
                                    <div class="col-md-3">
                                        <label for="" class="form-control-label">Batch Name:</label>
                                    </div>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="batch_name">
                                    </div>
                                </div>
                            
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">
                                <i class="fa fa-dot-circle-o"></i> Submit
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
        jQuery(".batch").addClass("active");
    });

</script>

@endsection