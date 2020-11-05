@extends('layouts.student')


@section('content')

        <div class="breadcrumbs">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>My Leaves</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li class="active">My Leaves</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="content mt-3">

            <div class="card">
                <div class="card-header">
                    <strong class="card-title">My Leave Applications</strong>
                </div>
                <div class="card-body scroll_beauty">
                    <table id="bootstrap-data-table-export" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">No.</th>
                                <th scope="col">Subject</th>
                                <th scope="col">Date of leave</th>
                                <th scope="col">Applied to</th>
                                <th scope="col">Status</th>
                                <th scope="col">Details</th>
                            </tr>
                        </thead>
                        <tbody>
							@php
                                $count= 1;
                            @endphp

                            @foreach($user->applications as $application)
                                @if($application->delete_status == 2)
                                    @foreach($application->users as $lec_user)
                                        @if($user->id != $lec_user->id)
                                            <tr>
                                                <th scope="row">{{$count++}}</th>
                                                <td>{{$application->subject}}</td>
                                                <td>{{$application->from}} - {{$application->to}}</td>
                                                <td>{{$lec_user->name}}</td>
                                                @if($application->status == 2)
                                                    <td>Pending</td>
                                                @elseif($application->status == 3)
                                                    <td>Approved</td>          
                                                @else
                                                    <td>Not Approved</td>
                                                @endif
                                                <td><a href="/student_application/{{$application->id}}" class="btn btn-primary btn-sm">Details</a></td>
                                            </tr>
                                        @endif
                                    @endforeach
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </div> <!-- .content -->

        
@endsection


@section('script')

<script>
    jQuery(document).ready(function() {
        jQuery(".my_leaves").addClass("active");
    });

</script>

@endsection
