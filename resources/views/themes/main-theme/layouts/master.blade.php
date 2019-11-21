<!DOCTYPE html>
<!--
   This is a starter template page. Use this page to start your new project from
   scratch. This page gets rid of all links and provides the needed markup only.
   -->
<html lang="en">

@include('themes.main-theme.includes.head')

<body class="fix-sidebar">
<!-- Preloader -->
@include('themes.main-theme.includes.preloader')
<div id="wrapper">
@include('themes.main-theme.includes.header')

<!-- Page Content -->
    <div id="page-wrapper">

    @yield('content')
    <!-- /.container-fluid -->
        @include('themes.main-theme.includes.footer')

    </div>
    <!-- /#page-wrapper -->
</div>
<!-- /#wrapper -->
<!-- jQuery -->
@include('themes.main-theme.includes.scripts')
</body>

</html>
