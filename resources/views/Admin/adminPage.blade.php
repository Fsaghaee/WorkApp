@extends('Layout.pageLayout')

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

            <div class="col" id="Kloster" style="height: 270px; width: 100%; padding: 5px;"></div>
            <div class="col" id="wien" style="height: 270px; width: 100%; padding: 5px;"></div>
            <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
        </div>


        <div style="margin-top: 20px;width: 100%;">

            <div id="summeryDiv" style="border: 1px solid green; height: 50px; width: 49%; float: left;"><h4
                    style="text-align: center; margin-top: 5px; font-family: 'Comic Sans MS'; "> Summery </h4></div>
            <div id="tableDiv" style="border: 1px solid green; height: 50px; width: 49%; float: right;"><h4
                    style="text-align: center; margin-top: 5px; font-family: 'Comic Sans MS'; "> Table </h4></div>
        </div>
        <div id="summery" style="margin-top: 10px;margin-bottom: 50px; display: none;width: 100%">
            <br>
            <div class="row">
                <div class="col">
                    <?php

                    echo ' <br>' . date('M.16', strtotime("-1 month")) . '  -  ' . date('M.t', strtotime("-1 month")) . '<h4>' . $worksLasrSecond . '  -  ' . $worksLasrSecond * 5.4 . ' € </h4>';
                    foreach ($allDrivers as $driver) {
                        echo (new App\Http\Controllers\CompanyWorksController)->getDriverWork(date('yy-m-16', strtotime("-1 month")), date('yy-m-t', strtotime("-1 month")), $driver->id);
                    }
                    echo '</div><div class="col">';
                    echo ' <br>' . date('M.01') . '  -  ' . date('M.15') . '<h4>' . $worksfirst . '  -  ' . $worksfirst * 5.4 . ' € </h4>';
                    foreach ($allDrivers as $driver) {
                        echo (new App\Http\Controllers\CompanyWorksController)->getDriverWork(date('yy-m-01'), date('yy-m-15'), $driver->id);
                    }

                    echo '</div><div class="col">';
                    echo ' <br>' . date('M.16') . '  -  ' . date('M.t') . '<h4>  ' . $workssecond . '  -  ' . $workssecond * 5.4 . ' € </h4>';
                    foreach ($allDrivers as $driver) {
                        echo (new App\Http\Controllers\CompanyWorksController)->getDriverWork(date('yy-m-16'), date('yy-m-t'), $driver->id);
                    }

                    ?>
                </div>
            </div>
            <div style="border-bottom: 2px solid green;margin-top: 10px;"></div>
            <div class="row">
                <div class="col">
                    <?php


                    echo (new App\Http\Controllers\CompanyWorksController)->getaccountrWork(date('yy-m-16', strtotime("-1 month")), date('yy-m-t', strtotime("-1 month")));
                    echo '</div><div class="col">';
                    echo (new App\Http\Controllers\CompanyWorksController)->getaccountrWork(date('yy-m-01'), date('yy-m-15'));
                    echo '</div><div class="col">';
                    echo (new App\Http\Controllers\CompanyWorksController)->getaccountrWork(date('yy-m-16'), date('yy-m-t'));

                    ?>
                </div>
            </div>

        </div>

        <table
            style="width: 97%; font-size:2vw; border-top: 6px solid green; margin:100px 15px;display: none;padding: 0 30px; "
            id="Table">
            <tr>
                <th> Orders</th>
                <th> Name</th>
                <th> Location</th>
                <th> Weather</th>
                <th> Temp</th>
            </tr>
            @if($works)
                @foreach($works as $work)
                    <tr>
                        <td> {{$work->orders}} </td>
                        <td> {{$work->name}}</td>
                        <td> {{$work->location[0]}} </td>
                        <td> {{$work->wetter_main}} </td>
                        <td> {{$work->wetter_temp}} </td>
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
                axisX: {
                    gridThickness: 0,
                    tickLength: 0,
                    lineThickness: 0,

                },
                axisY: {
                    gridThickness: 0,
                    tickLength: 0,
                    lineThickness: 0,

                },
                data: [{
                    type: "area",
                    dataPoints: <?php echo json_encode($dataPoints01, JSON_NUMERIC_CHECK); ?>
                }]
            });
            var chart02 = new CanvasJS.Chart("wien", {
                title: {
                    text: "Wien"
                },
                axisX: {
                    gridThickness: 0,
                    tickLength: 0,
                    lineThickness: 0,

                },
                axisY: {
                    gridThickness: 0,
                    tickLength: 0,
                    lineThickness: 0,

                },
                data: [{
                    type: "area",
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
