<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="shortcut icon" href="{{ asset($setting->favicon) }}" type="image/x-icon" />
    <link rel="stylesheet" href="{{ asset('website/css/all.min.css') }}" />
    <link href="{{ asset('website/css/style.css') }}" rel="stylesheet" />
    <title>{{ $setting->app_name }}</title>
</head>

<body>

    @include('website.layout.partial.nav')

    <main>
        @yield('content')
    </main>

    <!-- footer section start -->
    @include('website.layout.partial.footer')
    <!-- footer section end -->

    <!-- JS start -->
    <script src="{{ asset('website/js/main.js') }}"></script>
    <!-- JS start -->
</body>

</html>
