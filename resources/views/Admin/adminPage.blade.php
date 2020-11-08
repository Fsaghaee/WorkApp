@extends('Layout.pageLayout')

@section('centercontent')

    <script src="js/html2canvas.js"></script>
    <script>
        function doCapture() {
            window.scrollTo(0, 0);
            html2canvas(document.getElementById('Table'), {
                ignoreElements: function (element) {
                    if ('button' == element.type || "ignoredTable" == element.id) {
                        return true;
                    }
                }
            }).then(function (canvas) {
                var img = document.createElement('a');
                img.href = canvas.toDataURL('image/jpeg').replace('image/jpeg', 'image/octet-stream');
                // Name of downloaded file
                var today = new Date();
                img.download = today.getFullYear() + '-' + (today.getMonth() + 1) + '-' + today.getDate() + `.jpg`;
                img.click();
            });
        }


    </script>
    <?php

    $dataPoints01 = array();
    $dataPoints02 = array();
    foreach ($klosSum as $k) {
        array_push($dataPoints01, array("y" => $k->total, "label" => date('m.d D', strtotime($k->working_day)), "color" => "black"));
    }
    foreach ($WienSum as $k) {
        array_push($dataPoints02, array("y" => $k->total, "label" => date('m.d D', strtotime($k->working_day)), "color" => "black"));
    }
    $locat = array();
    foreach ($locations as $loc) {
        array_push($locat, $loc->location);
    }
    //array('Klosterneuburg', 'Wien', 'Tulln');
    $Days = array('Mon', 'Din', 'Mit', 'Don', 'Fri', 'Sam', 'Sun');
    ?>

    <div style="margin: 5px; overflow-y: scroll;">


        <div style="margin: 0;width: 100%; background-color: gray; width: 100%; height: 50px;color: white;">

            <div id="summeryDiv" style="padding: 10px; display: inline-block;"><h4> Summery </h4></div>
            <div id="tableDiv" style=" display: inline-block;padding: 10px; "><h4> Table </h4></div>
        </div>


        <div id="summery"
             style=" display: none;width: 100%;height: 500px; background-color: gray;padding:0 10px;color: white;display: none;">


            <?php
            $x = (new App\Http\Controllers\CompanyWorksController)->getfirstday();
            $t = date('m', strtotime($x));

            for ($m = date('m'); $m >= $t; $m--) {
                $firstday1 = date('yy-' . $m . '-01');

                $lastday1 = date('yy-' . $m . '-15');
                $firstday2 = date('yy-' . $m . '-16');
                $lastday2 = date("Y-m-t", strtotime(date('yy-' . $m . '-t'))) ;
                $temp = date("F", strtotime(date('yy-' . $m . '-01')));
                $label = date("yy-M", strtotime(date('yy-' . $m . '-01')));
                echo "<div  class='some'>";
                echo "<div class='one'><button onclick = 'w3.toggleShow(\"#$temp\")' > $label</button ></div>";
                echo "<div id=$temp class='three' style='  display: none;'>";
                echo "<div class='four' style='overflow-y: scroll;'>";
                echo ' <br><h3>' . $firstday1 . ' ** ' . $lastday1 . '</h3>';

                (new App\Http\Controllers\AdminPageController)->printearn($firstday1, $lastday1);
                echo "<div class='row'>";
                echo "<div class='col'>";
                echo (new App\Http\Controllers\CompanyWorksController)->getaccountrWork($firstday1, $lastday1);
                $total = 0;
                echo "</div><div class='col'>";
                foreach ($allDrivers as $allDriver) {
                    if ($allDriver->name == 'Farzad') {
                        echo $allDriver->name . ' : ' . (new App\Http\Controllers\AdminPageController)->getDriverWork($firstday1, $lastday1, $allDriver->id) . '  ( ' . (new App\Http\Controllers\AdminPageController)->getDriverWork($firstday1, $lastday1, $allDriver->id) * 5.4 . ' € )<br>';
                    } elseif ($allDriver->name == 'Reza') {
                        echo $allDriver->name . ' : ' . (new App\Http\Controllers\AdminPageController)->getDriverWork($firstday1, $lastday1, $allDriver->id) . '  ( ' . (new App\Http\Controllers\AdminPageController)->getDriverWork($firstday1, $lastday1, $allDriver->id) * 4.1 . ' € )<br>';
                    } else {
                        echo $allDriver->name . ' : ' . (new App\Http\Controllers\AdminPageController)->getDriverWork($firstday1, $lastday1, $allDriver->id) . '  ( ' . (new App\Http\Controllers\AdminPageController)->getDriverWork($firstday1, $lastday1, $allDriver->id) * 4 . ' € )<br>';
                    }
                    if ($allDriver->name == 'Farzad') {
                        $total += (new App\Http\Controllers\AdminPageController)->getDriverWork($firstday1, $lastday1, $allDriver->id) * 5.4;
                    } elseif ($allDriver->name == 'Reza') {
                        $total += (new App\Http\Controllers\AdminPageController)->getDriverWork($firstday1, $lastday1, $allDriver->id) * 1.3;
                    } else {
                        $total += (new App\Http\Controllers\AdminPageController)->getDriverWork($firstday1, $lastday1, $allDriver->id) * 1.4;
                    }
                }
                echo "</div></div>";
                echo '<h3 style="color: red;font-weight: bold;">' .$total.'</h3>';
                echo "</div>";

                echo "<div class='five' style='overflow-y: scroll;'>";

                echo ' <br><h3>' . $firstday2 . ' ** ' . $lastday2 . '</h3>';

                (new App\Http\Controllers\AdminPageController)->printearn($firstday2, $lastday2);
                echo "<div class='row'>";
                echo "<div class='col'>";
                echo (new App\Http\Controllers\CompanyWorksController)->getaccountrWork($firstday2, $lastday2);
                $total = 0;

                echo "</div><div class='col'>";
                foreach ($allDrivers as $allDriver) {
                    if ($allDriver->name == 'Farzad') {
                        echo $allDriver->name . ' : ' . (new App\Http\Controllers\AdminPageController)->getDriverWork($firstday2, $lastday2, $allDriver->id) . '  ( ' . (new App\Http\Controllers\AdminPageController)->getDriverWork($firstday2, $lastday2, $allDriver->id) * 5.4 . ' € )<br>';
                    }elseif ($allDriver->name == 'Farzad') {
                        echo $allDriver->name . ' : ' . (new App\Http\Controllers\AdminPageController)->getDriverWork($firstday2, $lastday2, $allDriver->id) . '  ( ' . (new App\Http\Controllers\AdminPageController)->getDriverWork($firstday2, $lastday2, $allDriver->id) * 4.1 . ' € )<br>';
                    }else{

                            echo $allDriver->name . ' : ' . (new App\Http\Controllers\AdminPageController)->getDriverWork($firstday2, $lastday2, $allDriver->id) . '  ( ' . (new App\Http\Controllers\AdminPageController)->getDriverWork($firstday2, $lastday2, $allDriver->id) * 4 . ' € )<br>';

                    }

                    if ($allDriver->name == 'Farzad') {
                        $total += (new App\Http\Controllers\AdminPageController)->getDriverWork($firstday2, $lastday2, $allDriver->id) * 5.4;
                    } elseif ($allDriver->name == 'Reza') {
                        $total += (new App\Http\Controllers\AdminPageController)->getDriverWork($firstday2, $lastday2, $allDriver->id) * 1.3;
                    } else {
                        $total += (new App\Http\Controllers\AdminPageController)->getDriverWork($firstday2, $lastday2, $allDriver->id) * 1.4;
                    }

                }
                echo "</div></div>";
                echo '<h3 style="color: red;font-weight: bold;">' .$total.'</h3>';
                echo "</div>";
                echo "</div>";
                echo "</div>";


            }


            ?>

        </div>

    </div>
    </div>







    <div id="Table" style="display: none;padding: 10px;">
        <button onclick="doCapture()" style="border: 1px solid lightgray;padding: 5px;border-radius: 5px;">Dinstplan
            von <?php echo date('yy-M-d'); ?></button>
        <table style="width: 100%;">
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
    </div>
    <div class="row" style="    padding: 0 30px;">
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

        <div  id="Kloster" style="height: 270px; width: 100%; padding: 5px;"></div>
        <div  id="wien" style="height: 270px; width: 100%; padding: 5px;"></div>
        <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>

    </div>
    <script>


        function addNew(pos) {

            var mainContainer = document.getElementById(pos);
            var newDiv = document.createElement('div');
            newDiv.style.marginBottom = "5px";
            var newDropdown = document.createElement('select');

            newDropdown.style.float = "left";

            // newDropdown.style.minWidth = "75% !important";
            newDropdown.setAttribute('style', 'min-width: 75% !important;margin-left:5px;height:35px;');
            newDropdown.style.fontSize = "1.2vw";
            newDropdown.style.padding = "2px";
            newDropdown.style.top = "0";
            newDropdown.style.borderRadius = "15px";
            newDropdown.style.backgroundColor = "gray";
            newDropdown.style.color = "white";
                <?php
                $z = 1;
                foreach ($allDrivers as $driver) {
                    $colortemp = "white";
                    echo "

           newDropdownOption$z = document.createElement('option');
           newDropdownOption$z.value = '$driver->id';
           newDropdownOption$z.text = '$driver->name';
           newDropdownOption$z.style.color='$colortemp';
           newDropdownOption$z.style.textAlign='center';
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
