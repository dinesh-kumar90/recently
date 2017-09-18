<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    @yield('styles')
</head>
<body>
    

        @yield('content')
    

    <!-- Scripts -->
    <script src="https://cdn.shopify.com/s/assets/external/app.js?{{ date('YmdH') }}"></script>
        <script type="text/javascript">
            ShopifyApp.init({
                apiKey: '{{ config('shopify-app.api_key') }}',
                shopOrigin: 'https://{{ ShopifyApp::shop()->shopify_domain }}',
                debug: false,
                forceRedirect: true
            });
        </script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/jscolor/2.0.4/jscolor.min.js"></script>
   
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
     @yield('scripts')

</body>
</html>
