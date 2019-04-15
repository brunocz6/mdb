<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <script type="text/javascript" src="/mdb/public/vendor/unisharp/laravel-ckeditor/ckeditor.js"></script>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>


    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
</head>
<body>
    <div id="app">
        
        @include('inc.navbar')

        <main class="py-4">
            @include('inc.messages')
            @yield('content')
        </main>
    </div>

    <script type="text/javascript">
        $(document).ready(function () {
            $(".redirector").click(function () {
                window.location = this.dataset.url;
            });

            $(document).ready(function(){
                $(".card-movie").hover(function(){
                    $(this).css("bottom", "2px");
                }, function(){
                    $(this).css("bottom", "0px");
                });
            });
        });


        // CKEDITOR.instances['article-ckeditor'].destroy()
        CKEDITOR.replace( 'article-ckeditor' );
    </script>
</body>
</html>
