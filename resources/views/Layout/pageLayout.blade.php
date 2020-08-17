<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <?php date_default_timezone_set("Europe/Berlin");
    setlocale(LC_TIME, "de_DE.utf8");
    ?>

    <meta charset="utf-8">


    <title>Klosterneueburg Page</title>

    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

</head>
<body>
    <div class="container">
        @yield('MainPart')


    </div>


@yield('centercontent')





    @yield('footer')





</body>
</html>
