<!DOCTYPE html>
<html class="loading" lang="{{app()->getLocale()}}"
    data-textdirection="{{ LaravelLocalization::getCurrentLocaleDirection() }}">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="author" content="ELFOLY">
  <title>
        @yield('title')
  </title>
  <link rel="apple-touch-icon" href="{{asset('admin')}}/app-assets/images/ico/apple-icon-120.png">
  <link rel="shortcut icon" type="image/x-icon" href="{{ Storage::url('uploads/settings/' . setting('fav_icon')) }}">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Quicksand:300,400,500,700"
    rel="stylesheet">
  <link href="https://maxcdn.icons8.com/fonts/line-awesome/1.1/css/line-awesome.min.css" rel="stylesheet">

  <!-- BEGIN VENDOR CSS-->
  <link rel="stylesheet" type="text/css" href="{{asset('admin/app-assets/'.getFolder().'/vendors.css')}}">
  <!-- datatables -->
  <link rel="stylesheet" type="text/css"
        href="{{asset('admin/app-assets/vendors/css/tables/datatable/datatables.min.css')}}">

  <!-- END VENDOR CSS-->
  <!-- BEGIN MODERN CSS-->
  <link rel="stylesheet" type="text/css" href="{{asset('admin/app-assets/'.getFolder().'/app.css')}}">
  @if(app()->getLocale() == 'ar')
    <link rel="stylesheet" type="text/css" href="{{asset('admin/app-assets/'.getFolder().'/custom-rtl.css')}}">
  @endif
  <!-- END MODERN CSS-->
  <!-- BEGIN Page Level CSS-->
  <link rel="stylesheet" type="text/css" href="{{asset('admin/app-assets/'.getFolder().'/core/menu/menu-types/vertical-menu-modern.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('admin/app-assets/'.getFolder().'/core/colors/palette-gradient.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('admin/app-assets/fonts/simple-line-icons/style.css')}}">
  <!-- END Page Level CSS-->
  <!-- BEGIN Custom CSS-->
  <link rel="stylesheet" type="text/css" href="{{asset('admin/assets/css/style.css')}}">
  <!-- END Custom CSS-->
  <!-- Fonts -->
  <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <style>

        .table .dataTables_length {
            margin-top: 10px;
        }
        .not_read{
            background: #cccccc26 !important;
        }
    </style>
  @stack('style')
</head>

<body class="vertical-layout vertical-menu-modern 2-columns   menu-expanded fixed-navbar" data-open="click" data-menu="vertical-menu-modern"
  data-col="2-columns">
    <!-- fixed-top-->
    @include('layouts.admin._nav')
    <!-- ////////////////////////////////////////////////////////////////////////////-->
    @include('layouts.admin._main-menu')
    <!-- ////////////////////////////////////////////////////////////////////////////-->
    @yield('content')
    <!-- ////////////////////////////////////////////////////////////////////////////-->
    @include('layouts.admin._footer')
  <!-- BEGIN VENDOR JS-->
  <script src="{{asset('admin')}}/app-assets/vendors/js/vendors.min.js" type="text/javascript"></script>
  <script src="{{asset('admin')}}/app-assets/vendors/js/editors/ckeditor/ckeditor.js" type="text/javascript"></script>

  <!-- BEGIN VENDOR JS-->
  <script src="{{asset('admin/app-assets/vendors/js/tables/datatable/datatables.min.js')}}" type="text/javascript">
    </script>
  <!-- BEGIN PAGE VENDOR JS-->
  <script src="{{asset('admin')}}/app-assets/js/core/app-menu.js" type="text/javascript"></script>
  <script src="{{asset('admin')}}/app-assets/js/core/app.js" type="text/javascript"></script>
  <script src="{{asset('admin')}}/app-assets/js/scripts/customizer.js" type="text/javascript"></script>
  <!-- END MODERN JS-->

  @stack('script')
</body>

</html>
