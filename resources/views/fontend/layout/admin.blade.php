<!DOCTYPE html>
<html lang="en">
<head>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Admin</title>
        <link type="text/css" href="{{ asset('fontend/assets/css/bootstrap.min.css') }}" rel="stylesheet">
        <link type="text/css" href="{{ asset('fontend/assets/css/bootstrap-responsive.min.css') }}" rel="stylesheet">
        <link type="text/css" href="{{ asset('fontend/assets/css/theme.css') }}" rel="stylesheet">
        <link type="text/css" href="{{ asset('fontend/assets/css/chart.css') }}" rel="stylesheet">
        <link type="text/css" href="{{ asset('fontend/assets/css/font-awesome.css') }}" rel="stylesheet">
        {{--  <link type="text/css" href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600'
            rel='stylesheet'>  --}}
        <link rel="stylesheet" href="{{ asset('fontend/assets/font-awesome/css/font-awesome.min.css') }}">
        {{-- link css page contact --}}
        <link type="text/css" href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600'
            rel='stylesheet'>
    </head>
    <body>
        <div class="navbar navbar-fixed-top">
            <div class="navbar-inner">
                <div class="container">
                    <a class="btn btn-navbar" data-toggle="collapse" data-target=".navbar-inverse-collapse">
                        <i class="icon-reorder shaded"></i></a><a class="brand" href="{{ route('index') }}">Home</a>
                    <div class="nav-collapse collapse navbar-inverse-collapse">
                        <ul class="nav nav-icons">
                            <li><a href="{{ route('admin-contact', ['id'=>1]) }}"><i class="icon-envelope"></i></a></li>
                            <li><a href="{{ route('admin') }}"><i class="icon-eye-open"></i></a></li>
                            <li><a href="{{ route('admin-chart') }}"><i class="icon-bar-chart"></i></a></li>
                        </ul>
                        <form class="navbar-search pull-left input-append" action="#">
                        <input type="text" class="span3">
                        <button class="btn" type="button">
                            <i class="icon-search"></i>
                        </button>
                        </form>
                        <ul class="nav pull-right">
                            <li class="nav-user dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <img src="https://thuthuatnhanh.com/wp-content/uploads/2020/01/hinh-anh-chat-ngau-dep.jpg" class="nav-avatar" />
                                <b class="caret"></b></a>
                                <ul class="dropdown-menu">
                                    <li><a href="#">Your Profile</a></li>
                                    <li><a href="#">Edit Profile</a></li>
                                    <li><a href="#">Account Settings</a></li>
                                    <li class="divider"></li>
                                    <li><a href="{{ route('logout')}}">Logout</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                    <!-- /.nav-collapse -->
                </div>
            </div>
            <!-- /navbar-inner -->
        </div>
        <!-- /navbar -->
        <div class="wrapper">
            <div class="container">
                <div class="row">
                    <div class="span3">
                        <div class="sidebar">
                            <ul class="widget widget-menu unstyled">
                                <li class="active"><a href="{{ route('admin') }}"><i class="menu-icon icon-dashboard"></i>Dashboard</a></li>
                                
                                <li><a class="collapsed" data-toggle="collapse" href="#productmanager"><i class="menu-icon icon-cog">
                                </i><i class="icon-chevron-down pull-right"></i><i class="icon-chevron-up pull-right">
                                </i>Product Manager </a>
                                    <ul id="productmanager" class="collapse unstyled">
                                        <li><a href="{{ route('addproduct') }}"><i class="menu-icon icon-plus"></i>Add Product </a>
                                        </li>
                                        <li><a href="{{ route('product') }}"><i class="menu-icon icon-edit"></i>Product</a></li>
                                            {{--  <b class="label green pull-right">11</b> </a></li>  --}}
                                    </ul>
                                </li> 
                                    {{--  <b class="label green pull-right">11</b> </a></li>  --}}
                                <li><a href="{{ route('manageorder') }}"><i class="menu-icon icon-tasks"></i>Manager Order</a></li>
                                {{-- <b class="label orange pull-right">
                                    19</b> --}}
                            </ul>
                            <!--/.widget-nav-->
                            
                            
                            <ul class="widget widget-menu unstyled">
                                <li><a href="{{ route('admin-contact') }}"><i class="menu-icon icon-bold"></i> Message <b class="label orange pull-right">@if (isset($quantityMessageUnread))
                                    {{number_format($quantityMessageUnread)}}
                                @endif</b></a></li>
                                <li><a href="{{ route('admin-chart') }}"><i class="menu-icon icon-bar-chart"></i>Charts </a></li>
                            </ul>
                            <!--/.widget-nav-->
                            <ul class="widget widget-menu unstyled">
                                <li><a class="collapsed" data-toggle="collapse" href="#togglePages"><i class="menu-icon icon-cog">
                                </i><i class="icon-chevron-down pull-right"></i><i class="icon-chevron-up pull-right">
                                </i>Users </a>
                                    <ul id="togglePages" class="collapse unstyled">
                                        <li><a href="{{ route('profile', ['id'=>Auth::user()->id]) }}"><i class="icon-inbox"></i>Profile </a></li>
                                        <li><a href="{{ route('showlistuser') }}"><i class="icon-inbox"></i>All Users </a></li>
                                    </ul>
                                </li>
                                <li><a href="{{ route('logout') }}"><i class="menu-icon icon-signout"></i>Logout </a></li>
                            </ul>
                        </div>
                        <!--/.sidebar-->
                    </div>
                    <!--/.span3-->
                    @yield('content')
                </div>
            </div>
            <!--/.container-->
        </div>
        <!--/.wrapper-->
        <div class="footer">
            <div class="container">
                <b class="copyright">&copy; 2014 Edmin - EGrappler.com </b>All rights reserved.
            </div>
        </div>
        <script src="https://kit.fontawesome.com/9160225bd1.js" crossorigin="anonymous"></script>
        <script src="{{ asset('fontend/assets/js/jquery-1.9.1.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('fontend/assets/js/jquery-ui-1.10.1.custom.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('fontend/assets/js/bootstrap.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('fontend/assets/js/jquery.flot.js') }}" type="text/javascript"></script>
        <script src="{{ asset('fontend/assets/js/jquery.flot.resize.js') }}" type="text/javascript"></script>
        <script src="{{ asset('fontend/assets/js/jquery.dataTables.js') }}" type="text/javascript"></script>
        <script src="{{ asset('fontend/assets/js/common.js') }}" type="text/javascript"></script>
    </body>
