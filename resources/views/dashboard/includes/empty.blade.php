<!DOCTYPE html>
<html dir="rtl">
    <head>
        @include('dashboard.includes.header')
    </head>

    <body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">


       @include('dashboard.includes.navbar')

        @include('dashboard.includes.sidebar')

       @yield('content')

       @include('dashboard.includes.footer')
       @include('dashboard.includes.footer_js')

    </div>
    </body>
</html>
