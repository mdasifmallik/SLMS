@extends('../layouts.admin')


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
                            <li>Batch</li>
                            <li class="active">Batch List</li>
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

            <div class="row">
                <div class="col-md-9">
                    <div class="card mt-3">
                            <div class="card-header">
                                <strong class="card-title">Batch List</strong>
                            </div>
                            <div class="card-body">
                                <table class="table">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th scope="col">Batch Name</th>
                                            <th scope="col">Number of students</th>
                                            <th scope="col">Edit</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($dep->batches as $batch)
                                            <tr>
                                                <td scope="col">{{$batch->name}}</td>
                                                @php
                                                    $count= 0;
                                                    foreach ($batch->users as $user) {
                                                        foreach ($user->roles as $role) {
                                                            if ($role->name == 'student') {
                                                                $count++;
                                                            }
                                                        }
                                                    }
                                                @endphp
                                                <td scope="col">{{$count}}</td>
                                                <td scope="col"><a class="btn btn-primary btn-sm" href="/batch/{{$batch->id}}">Edit</a></td>
                                            </tr>
                                        @endforeach                                      
                                    </tbody>
                                </table>
                            </div>
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