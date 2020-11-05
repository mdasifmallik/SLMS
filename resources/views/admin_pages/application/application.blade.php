@extends('../layouts.admin')


@section('content')

        <div class="breadcrumbs">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>Application</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li class="active">Leaves</li>
                            <li class="active">Application</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="content mt-3">
            @if(session()->has('msg'))
                <div class="sufee-alert alert with-close alert-success alert-dismissible fade show">
                    <span class="badge badge-pill badge-success">Success</span>
                    {{ session()->get('msg') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
            @endif

            <div class="card">
                <div class="card-header">
                    <strong class="card-title">Application Details</strong>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-3">
                            <h4>Subject</h4>
                        </div>
                        <div class="col-md-9">
                            <h4 class="display-4">{{$application->subject}}</h4>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-3">
                            <h4>Applicant</h4>
                        </div>
                        <div class="col-md-9">
                            <h4 class="display-4">Name: <mark>{{$stu->name}}</mark> | Roll: {{$stu->rolls->name}} | Batch: {{$ba->name}}</h4>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-3">
                            <h4>Applied To</h4>
                        </div>
                        <div class="col-md-9">
                            <h4 class="display-4">{{$lec->name}}</h4>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-3">
                            <h4>Date</h4>
                        </div>
                        <div class="col-md-9">
                            <h4 class="display-4">{{$application->from}} - {{$application->to}}</h4>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-3">
                            <h4>Description</h4>
                        </div>
                        <div class="col-md-9 typo-articles">
                            <p>{{$application->description}}</p>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-3">
                            <h4>Attached Images</h4>
                        </div>
                        <div class="col-md-9">
                            <div class="row">
                                @foreach($application->images as $image)
                                    <div class="col-md-3">
                                        <div class="card">
                                            <a href="../../images/{{$image->path}}">
                                                <img class="card-img-top" src="../../images/{{$image->path}}" alt="">
                                            </a>
                                        </div>    
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-3">
                            <h4>Status</h4>
                        </div>
                        <div class="col-md-9">
                            @if($application->status == 2)
                                <h4 class="display-4">Pending</h4>
                            @elseif($application->status == 3)
                                <h4 class="display-4">Approved</h4>         
                            @else
                                <h4 class="display-4">Not Approved</h4>
                            @endif                            
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <div class="col-md-9">
                                @if($lec->id == $user->id)
                                    @if($application->status == 2)
                                        <a href="/approve/{{$application->id}}" class="btn btn-success">Approve</a>
                                        <a href="/decline/{{$application->id}}" class="btn btn-danger">Decline</a>
                                    @elseif($application->status == 3)
                                        <a href="/decline/{{$application->id}}" class="btn btn-danger">Decline</a>         
                                    @else
                                        <a href="/approve/{{$application->id}}" class="btn btn-success">Approve</a>
                                    @endif 
                                @endif                      
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div> <!-- .content -->

@endsection