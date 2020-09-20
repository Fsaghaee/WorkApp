@extends('Layout.pageLayout')

@section('centercontent')


    <?php
    $dataPoints01 = array();
    $dataPoints02 = array();

    foreach ($klosSum as $k) {
        array_push($dataPoints01, array("y" => $k->total, "label" => date('m.d D', strtotime($k->working_day)), "color" => "black"));

    }
    foreach ($WienSum as $k) {
        array_push($dataPoints02, array("y" => $k->total, "label" => date('m.d D', strtotime($k->working_day)), "color" => "black"));

    }

    ?>

    <div style="margin: 5px;">
        <div style="margin: 0;width: 100%; background-color: gray; width: 100%; height: 50px;color: white;">

            <div id="summeryDiv" style="padding: 10px; display: inline-block;"><h4> Summery </h4></div>
            <div id="tableDiv" style=" display: inline-block;padding: 10px; "><h4> Table </h4></div>
        </div>


        <div id="summery" style=" display: none;width: 100%; background-color: gray;padding:0 10px;color: white;">
            <br>
            <div class="row" style="text-align: center;padding-bottom: 5px;">
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
            <div style="border-bottom: 2px solid darkgray;margin-top: 0px;"></div>
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
        <div id="Table" style="display: none;">

            <?php
            $locat = array();
            foreach ($locations as $loc) {
                array_push($locat, $loc->location);
            }

            //array('Klosterneuburg', 'Wien', 'Tulln');
            $Days = array('Mon', 'Din', 'Mit', 'Don', 'Fri', 'Sam', 'Sun');
            ?>


            <table width="100%;">

                <tr>
                    <th style="text-align: center;"> Day</th>
                    <?php
                    for ($x = 0; $x < count($locat); $x++) {
                        $temp = substr($locat[$x], 0, 4);
                        echo " <th style=\"text-align: center;\">$temp - VorM.</th><th style=\"text-align: center;\"> $temp - NachM.</th>";
                    }
                    ?>

                </tr>

                <?php
                for ($i = 0; $i < count($Days); $i++) {
                    echo "<tr style='border-bottom: 1px solid black;'>";
                    echo "<td> $Days[$i]</td>";

                    for ($j = 0; $j < count($locat); $j++) {#
                        echo "<td>";
                        $tempinput = $locat[$j] . 'v' . $Days[$i];

                        echo " <div id='$tempinput'>";
                        echo "<input type=\"button\" value=\" + \" onClick=\"addNew('$tempinput');\" style='width: 95%;margin:0 5px; border: 1px solid lightgray; background-color: lightgray;border-radius: 15px;'>";
                        echo "</div>";
                        echo "</td>";
                        echo "<td>";


                        $tempinput = $locat[$j] . 'n' . $Days[$i];
                        echo " <div id='$tempinput'>";
                        echo "<input type=\"button\" value=\" + \" onClick=\"addNew('$tempinput');\"style='width: 95%;margin: 5px; border: 1px solid lightgray;background-color: lightgray;border-radius: 15px;'>";
                        echo "</div>";
                        echo "</td>";

                    }

                    echo "</tr>";
                }


                ?>

            </table>


            <table
                style="width: 100%; font-size:2vw; border-top: 6px solid darkgray; margin:0;padding: 0 10px;color: white;background-color: gray;min-height: 50px;">
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


    </div>

    <script>
        function addNew(pos) {

            var mainContainer = document.getElementById(pos);
            var newDiv = document.createElement('div');
            var newDropdown = document.createElement('select');
            newDropdown.style.height = "40px";
            newDropdown.style.float = "left";
           // newDropdown.style.minWidth = "75% !important";
            newDropdown.setAttribute('style','min-width: 75% !important;margin-left:5px;');
            newDropdown.style.fontSize = "2vw";
            newDropdown.style.padding = "5px";
            newDropdown.style.top = "0";
            newDropdown.style.borderRadius = "15px";
            newDropdown.style.backgroundColor = "gray";
            newDropdown.style.color = "white";
                <?php
                $z = 1;
                foreach ($allDrivers as $driver) {
                    echo "
           newDropdownOption$z = document.createElement('option');
           newDropdownOption$z.value = '$driver->name';
           newDropdownOption$z.text = '$driver->name';
           newDropdown.add(newDropdownOption$z);
        ";
                    $z++;
                }
                ?>
            var newAddButton = document.createElement('input');
            newAddButton.type = "button";
            newAddButton.value = " + ";
            var newDelButton = document.createElement('input');
            newDelButton.type = "button";
            newDelButton.value = " - ";
            newDelButton.style.width = "30px";

            newDelButton.style.borderRadius = "15px";
            newDelButton.style.height = "30px";
            newDelButton.style.backgroundColor = "lightsteelblue";
            newDelButton.style.margin = " 0 5px";
            newDelButton.style.float = "right";
            newDiv.appendChild(newDropdown);
            newDiv.appendChild(newDelButton);
            mainContainer.appendChild(newDiv);
            newAddButton.onclick = addNew;
            newDelButton.onclick = function () {
                mainContainer.removeChild(newDiv);
            };
        }

        window.onload = function () {

            var chart01 = new CanvasJS.Chart("Kloster", {
                title: {
                    text: "Klosterneuburg"
                }, backgroundColor: "gray",
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
                    color: "white",
                    dataPoints:<?php echo json_encode($dataPoints01, JSON_NUMERIC_CHECK); ?>
                }]
            });
            var chart02 = new CanvasJS.Chart("wien", {
                title: {
                    text: "Wien"
                },
                backgroundColor: "gray",


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
                    color: "white",
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
