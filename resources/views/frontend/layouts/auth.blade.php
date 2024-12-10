<!DOCTYPE html>
<html lang="zxx">
<head>
    @include('frontend.layouts.head')
</head>
<body class="js">
    
    @include('frontend.layouts.notification')
    @include('frontend.layouts.header')

    <!-- Content Section -->
    <div class="content-wrapper">
        @yield('content')
    </div>

    @include('frontend.layouts.footer')
    @include('frontend.layouts.script')

</body>
</html> 