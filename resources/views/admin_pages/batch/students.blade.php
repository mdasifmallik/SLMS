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
                            <li><a href="/batch">Batch List</a></li>
                            <li class="active">{{$batch->name}} Batch</li>
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
                                <strong class="card-title">Students of {{$batch->name}} Batch</strong>
                            </div>
                            <div class="card-body">
                                <table id="bootstrap-data-table-export" class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th scope="col">Name</th>
                                            <th scope="col">Roll</th>
                                            <th scope="col">Email</th>
                                            <th scope="col">Edit</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($batch->users as $user)
                                            @foreach($user->roles as $role)
                                                @if($role->name == "student")
                                                    <tr>
                                                        <td scope="col">{{$user->name}}</td>
                                                        <td scope="col">{{$user->rolls->name}}</td>
                                                        <td scope="col">{{$user->email}}</td>
                                                        <td scope="col">
                                                            <button class="btn btn-primary btn-sm dlt_stu" value="/delete_student/{{$user->id}}">Delete</button>
                                                        </td>
                                                    </tr>
                                                @endif
                                            @endforeach
                                        @endforeach
                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                </div>
            </div>
            
            <button class="btn btn-danger dlt_batch" value="/delete_batch/{{$batch->id}}">Delete This Batch!</button>

        </div> <!-- .content -->

@endsection


@section('script')
    <script>
        jQuery(document).ready(function() {
            jQuery(".dlt_stu").click(function() {
                 
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

            jQuery(".dlt_batch").click(function() {
                 
                Swal.fire({
                  title: 'Are you sure?',
                  text: "All the students off this batch & applications that this students have made will also be deleted!",
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
    </script>
@endsection


@section('script')

<script>
    jQuery(document).ready(function() {
        jQuery(".batch").addClass("active");
    });

</script>

@endsection