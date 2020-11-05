@extends('../layouts.admin')


@section('content')

        <div class="breadcrumbs">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>Lecturers</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li class="active">Lecturers</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        @if(session()->has('msg'))
                <div class="sufee-alert alert with-close alert-success alert-dismissible fade show">
                    <span class="badge badge-pill badge-success">Success</span>
                    {{ session()->get('msg') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
            @endif

        <div class="content mt-3">
            <div class="card">
                <div class="card-header">
                    <strong class="card-title">All Lecturers list</strong>
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">Name</th>
                                <th scope="col">Email</th>
                                <th scope="col">Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($dep->users as $user)
                                @foreach($user->roles as $role)
                                    @if($role->name == 'lecturer')
                                        <tr>
                                            <td>{{$user->name}}</td>
                                            <td>{{$user->email}}</td>
                                            <td>
                                                <button type="button" class="btn btn-danger mb-1 btn-sm dlt_lec" value="/destroy_lecturer/{{$user->id}}">
                                                    Delete
                                                </button>
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div><!-- .content -->

@endsection



@section('script')

    <script>
        jQuery(document).ready(function() {
            jQuery(".dlt_lec").click(function() {
                 
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
            jQuery(".lecturer").addClass("active");
        });
    </script>

@endsection