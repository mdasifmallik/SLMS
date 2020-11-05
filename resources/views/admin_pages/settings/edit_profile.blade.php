@extends('../layouts.admin')


@section('content')

        <div class="breadcrumbs">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>Settings</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li class="active">Edit Profile</li>
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
            	<div class="col-md-9">
            		<div class="card">
		                <div class="card-header">
		                    <strong class="card-title">Edit Profile</strong>
		                </div>
		                <div class="card-body">
		                    <form method="post" action="/settings" class="form-horizontal">
		                        @csrf
		                        <div class="row form-group">
		                            <div class="col-md-3">
		                                <label for="" class="form-control-label">Name:</label>
		                            </div>
		                            <div class="col-md-9">
		                                <input type="text" class="form-control" name="name" value="{{$user->name}}">
		                            </div>
		                        </div>
		                        <div class="row form-group">
		                            <div class="col-md-3">
		                                <label for="" class="form-control-label">Email:</label>
		                            </div>
		                            <div class="col-md-9">
		                                <input type="email" class="form-control" name="email" value="{{$user->email}}">
		                            </div>
		                        </div>
		                    
		                </div>
		                <div class="card-footer">
		                    <button type="submit" class="btn btn-primary">
		                        <i class="fa fa-dot-circle-o"></i> Update
		                    </button>
		                </div>
		                </form>
		                </div>
		            </div>
            	</div>
            </div>

        </div> <!-- .content -->

@endsection