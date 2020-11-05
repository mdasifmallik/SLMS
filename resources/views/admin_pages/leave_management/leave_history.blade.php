@extends('../layouts.admin')


@section('content')

        <div class="breadcrumbs">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>All Leave Histories</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li class="active">All Leave Histories</li>
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
                    <strong class="card-title">All Leave Histories</strong>
                </div>
                <div class="card-body scroll_beauty">
                    <table id="bootstrap-data-table-export" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">No.</th>
                                <th scope="col">Subject</th>
                                <th scope="col">Applicant</th>
                                <th scope="col">Roll</th>
                                <th scope="col">Batch</th>
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
                            @foreach($dep->users as $user)
								@foreach($user->roles as $role)
									@foreach($user->batches as $batch)
										@if($role->id == 3)
											@foreach($user->applications as $application)
												@if($application->delete_status == 3)
													@php
														foreach ($application->users as $a_user) {
															if ($a_user->id != 3) {
																$lec = $a_user;
															}
														}
													@endphp
													<tr>
		                                                <th scope="row">{{$count++}}</th>
		                                                <td>{{$application->subject}}</td>
		                                                <td>{{$user->name}}</td>
		                                                <td>{{$user->rolls->name}}</td>
		                                                <td>{{$batch->name}}</td>
		                                                <td>{{$application->from}} - {{$application->to}}</td>
		                                                <td>{{$lec->name}}</td>
		                                                @if($application->status == 2)
		                                                    <td class="text-warning">Pending</td>
		                                                @elseif($application->status == 3)
		                                                    <td class="text-success">Approved</td>          
		                                                @else
		                                                    <td class="text-danger">Not Approved</td>
		                                                @endif
		                                                <td><a href="/admin_application/{{$application->id}}" class="btn btn-primary btn-sm">Details</a></td>
		                                            </tr>
												@endif
											@endforeach
										@endif
									@endforeach
								@endforeach
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>

            <button class="btn btn-danger dlt_leave" value="/delete_leave_history">Delete all the leave histories!</button>

        </div> <!-- .content -->

@endsection


@section('script')

    <script>
        jQuery(document).ready(function() {
            jQuery(".dlt_leave").click(function() {
                 
                Swal.fire({
                  title: 'Are you sure?',
                  text: "You won't be able to revert this!",
                  icon: 'warning',
                  showCancelButton: true,
                  confirmButtonColor: '#3085d6',
                  cancelButtonColor: '#d33',
                  confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                  if (result.value) {
                    var link = jQuery(this).val();
                    window.location.href = link;
                  }
                })

            });
        });
        jQuery(document).ready(function() {
            jQuery(".manage_leaves").addClass("active");
        });
    </script>

@endsection