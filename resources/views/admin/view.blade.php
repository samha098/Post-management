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

                <div class="py-12">

                    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                            <div class="p-6 text-gray-900">
                                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
                                    <h1 style="font-size: 36px; font-weight: bold;">{{ $post->title }}</h1>
                                    <div class=" bg-white shadow-sm rounded-lg p-6">
                                        <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->title }}"
                                            class="w-full h-[400px] object-cover mb-2">




                                        <p class="text-gray-700">{{ $post->description, 100}}</p>

                                    </div>

                                </div>
                            </div>
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
</body>

</html>