@extends('layouts.student')


@section('content')

        <div class="breadcrumbs">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>Apply</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li class="active">Apply</li>
                            <li class="active"><a href="">Apply To Lecturer</a></li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>


        <div class="content">

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

            <div class="card mt-3">
                <div class="card-header">
                    <strong>Apply To Lecturer</strong>
                </div>
                <div class="card-body card-block">
                    <form action="/student_application" method="post" enctype="multipart/form-data" class="form-horizontal">
                        @csrf
                        <div class="row form-group">
                            <div class="col col-md-3"><label for="text-input" class=" form-control-label">Subject</label></div>
                            <div class="col-12 col-md-9">
                                <input type="text" id="text-input" name="subject" placeholder="Subject of your application" class="form-control">
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col col-md-3"><label for="email-input" class=" form-control-label">Date</label></div>
                            <div class="col-12 col-md-1">
                                <label for="">From:</label>
                            </div>
                            <div class="col-12 col-md-3">
                                <input type="date" id="email-input" name="from" placeholder="Enter Email" class="form-control">
                            </div>
                            <div class="col-12 col-md-1"></div>
                            <div class="col-12 col-md-1">
                                <label for="">To:</label>
                            </div>
                            <div class="col-12 col-md-3">
                                <input type="date" id="email-input" name="to" placeholder="Enter Email" class="form-control">
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col col-md-3"><label for="file-multiple-input" class=" form-control-label">Apply To</label></div>
                            <div class="col-12 col-md-9">
                                <select data-placeholder="Choose a lecturer..." class="standardSelect" tabindex="1" name="apply_to">
                                    <option value=""></option>
                                    @foreach($dep->users as $user)
                                        @foreach($user->roles as $role)
                                            @if($role->name == "lecturer")
                                                <option value="{{$user->id}}">{{$user->name}}</option>
                                            @endif
                                        @endforeach
                                    @endforeach                                    
                                </select>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col col-md-3"><label for="textarea-input" class=" form-control-label">Description</label></div>
                            <div class="col-12 col-md-9"><textarea name="description" id="textarea-input" rows="9" placeholder="Content..." class="form-control"></textarea></div>
                        </div>
                        <div class="row form-group">
                            <div class="col col-md-3"><label for="file-multiple-input" class=" form-control-label">Attach Images</label></div>
                            <div class="col-12 col-md-9">
                                <div class="well" data-bind="fileDrag: multiFileData">
                                    <div class="form-group row">
                                        <div class="col-md-6">
                                            <!-- ko foreach: {data: multiFileData().dataURLArray, as: 'dataURL'} -->
                                            <img style="height: 100px; margin: 5px;" class="img-rounded  thumb" data-bind="attr: { src: dataURL }, visible: dataURL">
                                            <!-- /ko -->
                                            <div data-bind="ifnot: fileData().dataURL">
                                                <label class="drag-label">Drag files here</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <input name="images[]" type="file" multiple data-bind="fileInput: multiFileData, customFileInput: {
                                              buttonClass: 'btn btn-success',
                                              fileNameClass: 'disabled form-control',
                                              onClear: onClear,
                                              onInvalidFileDrop: onInvalidFileDrop
                                            }">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">
                        <i class="fa fa-dot-circle-o"></i> Apply
                    </button>
                </div>
                </form>
            </div>

        </div> <!-- .content -->

@endsection


@section('script')

<script>
    jQuery(document).ready(function() {
        jQuery(".apply_to_lec").addClass("active");
    });

</script>

@endsection