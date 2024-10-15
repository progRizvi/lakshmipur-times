<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="shortcut icon" href="{{ asset($setting->favicon) }}" type="image/x-icon" />
    <link rel="stylesheet" href="{{ asset('website/css/all.min.css') }}" />
    <link href="{{ asset('website/css/style.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('global/toastr/toastr.min.css') }}">
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
    <script src="{{ asset('global/js/jquery-3.7.1.min.js') }}"></script>
    <script src="{{ asset('website/js/main.js') }}"></script>
    <script src="{{ asset('global/toastr/toastr.min.js') }}"></script>
    <script>
        // ajax setup
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            }
        })
    </script>

    <script>
        @if (Session::has('messege'))
            var type = "{{ Session::get('alert-type', 'info') }}"
            switch (type) {
                case 'info':
                    toastr.info("{{ Session::get('messege') }}");
                    break;
                case 'success':
                    toastr.success("{{ Session::get('messege') }}");
                    break;
                case 'warning':
                    toastr.warning("{{ Session::get('messege') }}");
                    break;
                case 'error':
                    toastr.error("{{ Session::get('messege') }}");
                    break;
            }
        @endif
    </script>

    <!-- JS start -->

    <script></script>

    @stack('scripts')
</body>

</html>
