@extends('Layout.pageLayout')
@section('MainPart')
    <div style="margin-left: 20px;  border-bottom: 6px solid green;padding: 10px; ">
        <a style="font-size:3vw; border: 2px solid green; padding: 10px; margin-right: 10px; " href="/logout"> Log
            out </a>
        <a style="font-size:3vw; border: 2px solid green; padding: 10px ; margin-right: 10px; "
           href="{{route('admin-drivers.index')}}"> Drivers </a>
        <a style="font-size:3vw; border: 2px solid green; padding: 10px; margin-right: 10px;"
           href="{{route('company-works.index')}}"> All orders </a>
        <a style="font-size:3vw; border: 2px solid green; padding: 10px; margin-right: 10px;"
           href="{{route('payments.index')}}"> Pay Slips </a>
    </div>
@stop
@section('centercontent')


    <?php
    $dataPoints01 = array();
    $dataPoints02 = array();

    foreach ($klosSum as $k) {
        array_push($dataPoints01, array("y" => $k->total, "label" => date('m.d D', strtotime($k->working_day))));

    }
    foreach ($WienSum as $k) {
        array_push($dataPoints02, array("y" => $k->total, "label" => date('m.d D', strtotime($k->working_day))));

    }


    ?>

    <div style="margin: 20px;">

        <div class="row">

            <div class="col">

                <?php


                echo '<h6 style="font-size:3vw;">';
                $date = date('yy-m-d');
                $response = file_get_contents('http://api.weatherapi.com/v1/history.json?key=3fa2c903934841ed92885918201808&q=vienna&dt=' . $date);
                $response = json_decode($response, true);
                echo date('M.d D') . '  <br>' . $response['forecast']['forecastday'][0]['day']['maxtemp_c'] .
                    ' <br> ' . $response['forecast']['forecastday'][0]['day']['condition']['text'];
                echo '<img src="' . $response['forecast']['forecastday'][0]['day']['condition']['icon'] . '"/>';
                echo '</h6>';

                echo '</div><div class="col"><h6 style="font-size:3vw;">';
                $date = date('yy-m-d', strtotime($date . ' +1 day'));
                $response = file_get_contents('http://api.weatherapi.com/v1/history.json?key=3fa2c903934841ed92885918201808&q=vienna&dt=' . $date);
                $response = json_decode($response, true);
                echo date('M.d D', strtotime(' +1 day')) . '  <br>' . $response['forecast']['forecastday'][0]['day']['maxtemp_c'] .
                    ' <br> ' . $response['forecast']['forecastday'][0]['day']['condition']['text'];
                echo '<img src="' . $response['forecast']['forecastday'][0]['day']['condition']['icon'] . '"/>';
                echo '</h6>';
                ?>

            </div>
        </div>

        <div class="row">

            <div class="col" id="Kloster" style="height: 370px; width: 100%; padding: 5px;"></div>
            <div class="col" id="wien" style="height: 370px; width: 100%; padding: 5px;"></div>
            <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
        </div>


        <br>


        <div id="summeryDiv" style="border: 1px solid green; height: 50px; width: 100%;"><h4
                style="text-align: center; margin-top: 5px; font-family: 'Comic Sans MS'; "> Summery </h4></div>


        <div id="summery" style="margin-top: 10px;margin-bottom: 10px; display: none;">
            <?php

            echo '<div class ="row">';
            echo '<div class="col">';
            echo ' <br>' . date('M.16', strtotime("-1 month")) . '  -  ' . date('M.t', strtotime("-1 month")) . '<h4>' . $worksLasrSecond . '  -  ' . $worksLasrSecond * 5.4 . ' € </h4>';

            foreach ($allDrivers as $driver) {
                echo (new App\Http\Controllers\CompanyWorksController)->getDriverWork(date('yy-m-16', strtotime("-1 month")), date('yy-m-t', strtotime("-1 month")), $driver->driver_id);
            }

            echo '</div><div class="col">';
            echo ' <br>' . date('M.01') . '  -  ' . date('M.15') . '<h4>' . $worksfirst . '  -  ' . $worksfirst * 5.4 . ' € </h4>';
            foreach ($allDrivers as $driver) {
                echo (new App\Http\Controllers\CompanyWorksController)->getDriverWork(date('yy-m-01'), date('yy-m-15'), $driver->driver_id);
            }

            echo '</div><div class="col">';
            echo ' <br>' . date('M.16') . '  -  ' . date('M.t') . '<h4>  ' . $workssecond . '  -  ' . $workssecond * 5.4 . ' € </h4>';
            foreach ($allDrivers as $driver) {
                echo (new App\Http\Controllers\CompanyWorksController)->getDriverWork(date('yy-m-16'), date('yy-m-t'), $driver->driver_id);
            }
            echo '</div></div>';

            ?>

            <br>


            <!-- shows here  -->
            <br>
            <div style="border-bottom: 2px solid green;"></div>

            <?php
            echo '<div class ="row">';
            echo '<div class="col">';

            echo (new App\Http\Controllers\CompanyWorksController)->getaccountrWork(date('yy-m-16', strtotime("-1 month")), date('yy-m-t', strtotime("-1 month")));
            echo '</div><div class="col">';
            echo (new App\Http\Controllers\CompanyWorksController)->getaccountrWork(date('yy-m-01'), date('yy-m-15'));
            echo '</div><div class="col">';
            echo (new App\Http\Controllers\CompanyWorksController)->getaccountrWork(date('yy-m-16'), date('yy-m-t'));
            echo '</div></div>';
            ?>
                <div  style="border-top: 3px solid green;"></div></div>
            <div id="tableDiv" style="border: 1px solid green; height: 50px; width: 100%; margin-top: 10px;"><h4
                    style="text-align: center; margin-top: 5px; font-family: 'Comic Sans MS'; "> Table </h4></div>
            <table style="width: 100%; font-size:2vw; border-top: 6px solid green; margin: 5px;display: none; "
                   id="Table">
                <tr>
                    <th> Orders</th>
                    <th> Name</th>
                    <th> Location</th>
                    <th> Weather</th>
                    <th> Temp</th>
                    <th> Hours</th>
                    <th> Break</th>
                    <th> Total</th>
                </tr>
                @if($works)
                    @foreach($works as $work)
                        <tr>
                            <td> {{$work->orders}} </td>
                            <td> {{$work->name}}</td>
                            <td> {{$work->location[0]}} </td>
                            <td> {{$work->wetter_main}} </td>
                            <td> {{$work->wetter_temp}} </td>
                            <td><?php echo abs(strtotime($work->end_working) - strtotime($work->start_working)) / (60 * 60) ?>   </td>
                            <td> {{$work->break}} </td>
                            <td><?php echo abs(strtotime($work->end_working) - strtotime($work->start_working)) / (60 * 60) - $work->break; ?></td>
                        </tr>


                    @endforeach
                @endif
            </table>
        </div>
        <script>
            window.onload = function () {

                var chart01 = new CanvasJS.Chart("Kloster", {
                    title: {
                        text: "Klosterneuburg"
                    },
                    axisY: {
                        title: "Orders"
                    },
                    data: [{
                        type: "line",
                        dataPoints: <?php echo json_encode($dataPoints01, JSON_NUMERIC_CHECK); ?>
                    }]
                });
                var chart02 = new CanvasJS.Chart("wien", {
                    title: {
                        text: "Wien"
                    },
                    axisY: {
                        title: "Orders"
                    },
                    data: [{
                        type: "line",
                        dataPoints: <?php echo json_encode($dataPoints02, JSON_NUMERIC_CHECK); ?>
                    }]
                });
                chart01.render();
                chart02.render();

            }


            var something = document.getElementById('tableDiv');

            something.style.cursor = 'pointer';
            something.onclick = function () {
                var x = document.getElementById('Table');
                if (x.style.display === "none") {
                    x.style.display = "block";
                } else {
                    x.style.display = "none";
                }
            };

            var something01 = document.getElementById('summeryDiv');

            something01.style.cursor = 'pointer';
            something01.onclick = function () {
                var x = document.getElementById('summery');
                if (x.style.display === "none") {
                    x.style.display = "block";
                } else {
                    x.style.display = "none";
                }
            };


        </script>



@stop
@section('footer')
@stop
