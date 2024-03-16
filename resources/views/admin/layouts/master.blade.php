
<!DOCTYPE html>

<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Admin | @yield("title")</title>

 @include("admin.includes.css")
</head>
@php
    // $permissions = auth("admin")->user()->getAllPermissions()->pluck("name")->toArray();
@endphp
<body class="hold-transition sidebar-mini">
<div class="wrapper">

  <!-- Navbar -->
@include("admin.includes.navbar")
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->

@include("admin.includes.sidebar")
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">

    <!-- Main content -->
    <div class="content pt-3">
      <div class="container-fluid">
        @yield("master_content")
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
@include("admin.includes.rightbar")
  <!-- /.control-sidebar -->

  <!-- Main Footer -->
  @include("admin.includes.footer")
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

@include("admin.includes.script")
</body>
</html>
