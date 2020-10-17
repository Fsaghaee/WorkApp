<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <title>Work Page</title>
    <script src="vendor/jquery/jquery-3.2.1.min.js"></script>
    <link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="css/util.css">
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://www.w3schools.com/lib/w3.js"></script>

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>

<style>
    body html {
        font-family: Raleway-Regular, sans-serif !important;
    }


    .some {
        display: flex;
        margin: 10px; /* new */
        text-align: center;
        width: 100%;
    }

    .one {
        border: 2px white solid;
        border-radius: 5px;
        margin: 3px;
        font-size: 2.2vw !important;
        min-width: 250px;
        height: 70px;
        padding: 5px;
        overflow-x: scroll;
        overflow-y: hidden;
        -webkit-overflow-scrolling: touch;
    }

    .three {

        width: 100%;
        height: 400px;
    }

    .four {
        float: left;
        margin: 3px;
        border: 2px white solid;
        border-radius: 5px;
        width: 45%;
        height: 400px;
    }

    .five {
        float: right;
        margin: 3px;
        border: 2px white solid;
        border-radius: 5px;
        width: 45%;
        height: 400px;
    }


    .dropbtn {
        background-color: gray;
        color: white;
        margin-top: 10px;
        border-radius: 5px;
        padding: 10px 20px;
        font-size: 2vw;
        border: 1px solid gray;
        cursor: pointer;

    }

    .dropbtn:hover, .dropbtn:focus {
        background-color: darkgray;
    }

    .dropdown {
        margin: 5px;

        position: relative;
        display: inline-block;
    }

    .dropdown-content {
        display: none;
        position: absolute;
        background-color: #f1f1f1;
        min-width: 160px;
        overflow: auto;
        box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
        z-index: 1;
    }

    .dropdown-content a {
        color: black;
        padding: 12px 16px;
        text-decoration: none;
        display: block;
    }

    .dropdown a:hover {
        background-color: #ddd;
    }

    .show {
        display: block;
    }

    ::-webkit-scrollbar {
        width: 1px;
    }
</style>
<body style="background-color: gray;">
<div class="container-fluid" style="background-color: gray;">
    <?php setlocale(LC_TIME, "de_DE"); ?>


    <div class="dropdown">
        <button onclick="dropdownMenu()" class="dropbtn" style="background-color: slategray;">Menu</button>
        <div id="myDropdown" class="dropdown-content" style="background-color: lightgray;color: white;">
            <?php
            if (auth()->user()) {
            if (auth()->user()->company_id == 0) {
            ?>
            <a style='font-size:2.2vw;font-weight: bold; padding: 10px;' href='/admin'> Main </a>
            <a style='font-size:2vw; padding: 10px; ' href='{{route("company-works.index")}}'> All orders </a>
            <a style='font-size:2vw;  padding: 10px ;   ' href='{{route('admin-drivers.index')}}'> Drivers </a>
            <a style='font-size:2vw;  padding: 10px;' href=' {{route('payments.index')}}'> Pay Slips </a>
            <?php
            }
            }
            ?>
            <a style="font-size:2vw; padding: 10px; font-weight: bold; color: red;" href="/logout"> Log out </a>
        </div>
    </div>
    <script>


        function dropdownMenu() {
            document.getElementById("myDropdown").classList.toggle("show");


        }


        window.onclick = function (event) {
            if (!event.target.matches('.dropbtn')) {
                var dropdowns = document.getElementsByClassName("dropdown-content");
                var i;
                for (i = 0; i < dropdowns.length; i++) {
                    var openDropdown = dropdowns[i];
                    if (openDropdown.classList.contains('show')) {
                        openDropdown.classList.remove('show');
                    }
                }
            }
        }

    </script>
    @yield('MainPart')
<!--===============================================================================================-->

    @yield('centercontent')
    @yield('footer')
</div>
</body>
</html>
