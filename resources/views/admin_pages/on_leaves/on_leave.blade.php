@extends('../layouts.admin')


@section('content')

        <div class="breadcrumbs">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>On Leave</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li class="">Leaves</li>
                            <li class="active">On Leave</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="content mt-3">

            <div class="card">
                <div class="card-header">
                    <strong class="card-title">Students currently on leave</strong>
                </div>
                <div class="card-body scroll_beauty">
                    <table id="bootstrap-data-table-export" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">No.</th>
                                <th scope="col">Student Name</th>
                                <th scope="col">Batch</th>
                                <th scope="col">Roll</th>
                                <th scope="col">Application Subject</th>
                                <th scope="col">Date of leave</th>
                                <th scope="col">Approved By</th>
                                <th scope="col">Details</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $count= 1;
                            @endphp
                            @foreach($d_head->applications as $application)
                                @if($application->delete_status == 2)
                                    @foreach($application->users as $user)
                                        @if($application->status == 3)
                                            @if($application->from <= $date && $application->to >= $date)
                                                @if($d_head->id != $user->id)
                                                    @foreach($user->batches as $batch)
                                                        <tr>
                                                            <th scope="row">{{$count++}}</th>
                                                            <td>{{$user->name}}</td>
                                                            <td>{{$batch->name}}</td>
                                                            <td>{{$user->rolls->name}}</td>
                                                            <td>{{$application->subject}}</td>
                                                            <td>{{$application->from}} - {{$application->to}}</td>
                                                            <td>{{$d_head->name}}</td>
                                                            <td><a href="/admin_application/{{$application->id}}" class="btn btn-primary btn-sm">Details</a></td>
                                                        </tr>
                                                    @endforeach
                                                @endif
                                            @endif
                                        @endif
                                    @endforeach
                                @endif
                            @endforeach

                            @if($d_head->id != $d_lec->id)
                                @foreach($d_lec->applications as $application)
                                    @if($application->delete_status == 2)
                                        @foreach($application->users as $user)
                                            @if($application->status == 3)
                                                @if($application->from <= $date && $application->to >= $date)
                                                    @if($d_lec->id != $user->id)
                                                        @foreach($user->batches as $batch)
                                                            <tr>
                                                                <th scope="row">{{$count++}}</th>
                                                                <td>{{$user->name}}</td>
                                                                <td>{{$batch->name}}</td>
                                                                <td>{{$user->rolls->name}}</td>
                                                                <td>{{$application->subject}}</td>
                                                                <td>{{$application->from}} - {{$application->to}}</td>
                                                                <td>{{$d_lec->name}}</td>
                                                                <td><a href="/admin_application/{{$application->id}}" class="btn btn-primary btn-sm">Details</a></td>
                                                            </tr>
                                                        @endforeach
                                                    @endif
                                                @endif
                                            @endif
                                        @endforeach
                                    @endif
                                @endforeach
                            @endif

                        </tbody>
                    </table>
                </div>
            </div>

        </div> <!-- .content -->

@endsection


@section('script')

<script>
    jQuery(document).ready(function() {
        jQuery(".on_leave").addClass("active");
    });

</script>

@endsection