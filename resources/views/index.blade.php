<!DOCTYPE html>
<html>
<head>
  @include('css')
</head>

<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  {{-- header --}}
  @include('header')

  <!-- Left side column. contains the logo and sidebar -->
  @include('nav')

  <!-- Content Wrapper. Contains page content -->
  <div style="min-height: 600px;">
    <div class="content-wrapper">
      <div class="box box-default">
        <section class="content">
          @if($page == 'dashboard')
          @include('Super Admin/'.$page)
          @else
          @include(session('accType').'/'.$page)
          @endif

        </section>
      </div>
    </div>
  </div>


  {{-- footer --}}
  @include('footer')

</div>
 
  {{-- js files --}}
  @include('js')


</body>
</html>
