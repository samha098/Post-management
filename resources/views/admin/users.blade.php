<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title> Admin Dashboard</title>
    <!-- BOOTSTRAP STYLES-->
    <link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet" />
    <!-- FONTAWESOME STYLES-->
    <link href="{{ asset('css/font-awesome.css') }}" rel="stylesheet" />
    <!-- MORRIS CHART STYLES-->
    <link href="{{ asset('js/morris/morris-0.4.3.min.css') }}" rel="stylesheet" />
    <!-- CUSTOM STYLES-->
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet" />
    <!-- GOOGLE FONTS-->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body>
    <div id="wrapper">
        <nav class="navbar navbar-default navbar-cls-top " role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.html">Post Admin</a>
            </div>
            <div style="color: white;
padding: 15px 50px 5px 50px;
float: right;
font-size: 16px;"> <a href="{{ route('logout') }}"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                    class="btn btn-danger square-btn-adjust">Logout</a> </div>
        </nav>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
        </form>
        <!-- /. NAV TOP  -->
        <nav class="navbar-default navbar-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav" id="main-menu">
                    <li class="text-center">

                    </li>
                    <li>
                        <a href="{{ route('admin.dashboard') }}"><i class="fa fa-edit fa-3x"></i> Posts </a>
                    </li>


                    <li>
                        <a href="{{ route('admin.users') }}"><i class="fa fa-sitemap fa-3x"></i> Users</a>

                    </li>
                </ul>
                </li>

                </ul>

            </div>

        </nav>
        <!-- /. NAV SIDE  -->
        <div id="page-wrapper">
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                        <h2>Admin Dashboard</h2>
                        <h5>Welcome {{ Auth::user()->name }} </h5>
                    </div>
                </div>
                <!-- /. ROW  -->
                <hr />
                <div class="row">
                    <div class="col-md-12">
                        <!-- Advanced Tables -->
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                All Users
                            </div>
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered table-hover"
                                        id="dataTables-example">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Post Title</th>
                                                <th>Category</th>
                                                <th>Actions allowed</th>

                                            </tr>
                                        </thead>
                                        <tbody>


                                            @foreach ($users as $user)
                                            <tr class="odd gradeX">
                                                <td>{{ $user->name }}</td>
                                                <td>@foreach ($user->posts as $post)
                                                    <li>{{ $post->title }}</li>
                                                    @endforeach
                                                </td>
                                                <td class="center">

                                                    @foreach ($user->posts as $post)
                                                    <div>
                                                        @foreach ($post->categories as $category)
                                                        <span class="mr-2">{{ $category->name }}</span>
                                                        @endforeach
                                                    </div>
                                                    @endforeach

                                                </td>

                                                <td>
                                                    <div class="flex justify-between">

                                                        <div class="flex items-center">
                                                            <input type="checkbox" class="permission-checkbox"
                                                                data-user-id="{{ $user->id }}" data-permission="create"
                                                                @if($user->permissions->pluck('name')->contains('create'))
                                                            checked @endif>
                                                            <span>Create</span>
                                                        </div>
                                                        <div class="flex items-center">
                                                            <input type="checkbox" class="permission-checkbox"
                                                                data-user-id="{{ $user->id }}" data-permission="update"
                                                                @if($user->permissions->pluck('name')->contains('update'))
                                                            checked @endif>
                                                            <span>Update</span>
                                                        </div>
                                                        <div class="flex items-center">
                                                            <input type="checkbox" class="permission-checkbox"
                                                                data-user-id="{{ $user->id }}" data-permission="delete"
                                                                @if($user->permissions->pluck('name')->contains('delete'))
                                                            checked @endif>
                                                            <span>Delete</span>
                                                        </div>
                                                    </div>

                                                </td>
                                            </tr>
                                            @endforeach

                                        </tbody>
                                    </table>
                                </div>

                            </div>
                        </div>
                        <!--End Advanced Tables -->
                    </div>
                </div>

                <!-- /. ROW  -->
            </div>
            <!-- /. PAGE INNER  -->
        </div>
        <!-- /. PAGE WRAPPER  -->
    </div>
    <!-- /. WRAPPER  -->
    <!-- SCRIPTS -AT THE BOTOM TO REDUCE THE LOAD TIME-->
    <!-- JQUERY SCRIPTS -->
    <script src="{{ asset('js/jquery-1.10.2.js') }}"></script>
    <!-- BOOTSTRAP SCRIPTS -->
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <!-- METISMENU SCRIPTS -->
    <script src="{{ asset('js/jquery.metisMenu.js') }}"></script>
    <!-- MORRIS CHART SCRIPTS -->
    <script src="{{ asset('js/morris/raphael-2.1.0.min.js') }}"></script>
    <script src="{{ asset('js/morris/morris.js') }}"></script>

    <script src="{{ asset('js/dataTables/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('js/dataTables/dataTables.bootstrap.js') }}"></script>
    <script>
    $(document).ready(function() {
        $('#dataTables-example').dataTable();
    });
    </script>
    <script>
    document.querySelectorAll('.permission-checkbox').forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            const permission = this.dataset.permission;
            const userId = this.dataset.userId;
            const isChecked = this.checked;
            console.log(permission, userId, isChecked);
            // Send the data to the server
            fetch('update-permission', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
                            .getAttribute('content')


                    },
                    body: JSON.stringify({
                        userId: userId,
                        permission: permission,
                        isChecked: isChecked
                    })
                })
                .then(response => response.json())
                .then(data => {
                    console.log(data.message);
                })
                .catch(error => console.error('Error:', error));
        });
    });
    </script>
</body>

</html>