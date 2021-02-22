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
    $dataPoints03 = array();
    foreach ($klosSum as $k) {
        array_push($dataPoints01, array("y" => $k->total, "label" => date('m.d D', strtotime($k->working_day)), "color" => "black"));
    }
    foreach ($WienSum as $k) {

        array_push($dataPoints02, array("y" => $k->total, "label" => date('m.d D', strtotime($k->working_day)), "color" => "black"));
    }

    foreach ($TotalSum as $k) {

        array_push($dataPoints03, array("y" => $k->total, "label" => date('m.d D', strtotime($k->working_day)), "color" => "red"));
    }

    $locat = array();
    foreach ($locations as $loc) {
        array_push($locat, $loc->location);
    }
    //array('Klosterneuburg', 'Wien', 'Tulln');
    $Days = array('Mon', 'Din', 'Mit', 'Don', 'Fri', 'Sam', 'Sun');
    ?>
    <div class="row">
        <div class="col-6">


            <div id="summery"
                 style=" width: 100%;height: 500px; background-color: white;padding:0 10px;color: white;">


                <?php

                $x = (new App\Http\Controllers\CompanyWorksController)->getfirstday();

                $t = date('Y-m', strtotime($x));

                for ($m = date('Y-m'); $m >= $t; $m = date('Y-m', strtotime("- 1 months", strtotime($m)))) {
                    $display = "none";

                    if ($m == date('Y-m')) {
                        $display = "block";
                    }

                    $firstday1 = date($m . '-01');
                    $lastday1 = date($m . '-15');
                    $firstday2 = date($m . '-16');
                    $lastday2 = date("Y-m-t", strtotime(date($m . '-10')));
                    $temp = date("F", strtotime(date($m . '-01')));
                    $label = date("Y-M", strtotime(date($m . '-01')));
                    echo "<div  class='some'>";
                    echo "<div class='one'><button onclick = 'w3.toggleShow(\"#$temp\")' > $label</button ></div>";
                    echo "<div id=$temp class='three' style='  display: $display;'>";
                    echo "<div class='four' style='overflow-y: scroll;'>";
                    echo ' <br><h6>' . $firstday1 . ' <br> ' . $lastday1 . '</h6>';

                    $worksLasrFirst = (new App\Http\Controllers\AdminPageController)->printearn($firstday1, $lastday1);
                    echo '<h5 style="font-weight:bold;"> ' . $worksLasrFirst . '  -  ' . $worksLasrFirst * 5.4 . ' <span style="color: black;"> € </span> </h5> ';

                    echo "<div class='row'>";
                    echo "<div class='col'>";
                    echo (new App\Http\Controllers\CompanyWorksController)->getaccountrWork($firstday1, $lastday1);

                    echo "</div><div class='col' style='font-size: .7vw;'>";
                    $shouldPay = 0;

                    foreach ($allDrivers as $allDriver) {

                        if($allDriver->name  != 'Farzad'){

                            $shouldPay +=   (new App\Http\Controllers\AdminPageController)->getDriverWork($firstday1, $lastday1, $allDriver->id) *  $allDriver->pay_order;
                        }

                        if((new App\Http\Controllers\AdminPageController)->getDriverWork($firstday1, $lastday1, $allDriver->id) !=0 ){
                        echo $allDriver->name . ' : ' . (new App\Http\Controllers\AdminPageController)->getDriverWork($firstday1, $lastday1, $allDriver->id) . ' -- '.(new App\Http\Controllers\AdminPageController)->getDriverWork($firstday1, $lastday1, $allDriver->id) *  $allDriver->pay_order.'€<br>';
}
                    }
                    echo "</div></div>";
                    echo "<h6 style='font-weight:bold;'> Shoud pay :  $shouldPay </h6>";
                    $eraned=$worksLasrFirst * 5.4 -$shouldPay;
                    echo "<h6 style='font-weight:bold;'> Earned : $eraned </h6>";
                    echo "</div>";

                    echo "<div class='five' style='overflow-y: scroll;'>";
                    echo ' <br><h6>' . $firstday2 . ' <br> ' . $lastday2 . '</h6>';
                    $worksLasrFirst = (new App\Http\Controllers\AdminPageController)->printearn($firstday2, $lastday2);
                    echo '<h5 style="font-weight:bold;"> ' . $worksLasrFirst . '  -  ' . $worksLasrFirst * 5.4 . ' € <span style="color: black;"> € </span>  </h5>';

                    echo "<div class='row'>";
                    echo "<div class='col'>";
                    echo (new App\Http\Controllers\CompanyWorksController)->getaccountrWork($firstday2, $lastday2);


                    echo "</div><div class='col' style='font-size: .7vw;'>";
                    $shouldPay = 0;
                    foreach ($allDrivers as $allDriver) {

                        if($allDriver->name  != 'Farzad'){

                            $shouldPay +=   (new App\Http\Controllers\AdminPageController)->getDriverWork($firstday2, $lastday2, $allDriver->id)  *  $allDriver->pay_order;
                        }

                        if((new App\Http\Controllers\AdminPageController)->getDriverWork($firstday2, $lastday2, $allDriver->id) != 0){
                        echo $allDriver->name . ' : ' . (new App\Http\Controllers\AdminPageController)->getDriverWork($firstday2, $lastday2, $allDriver->id) .' -- '. (new App\Http\Controllers\AdminPageController)->getDriverWork($firstday2, $lastday2, $allDriver->id) *  $allDriver->pay_order.'€<br>';
                    }}

                    echo "</div></div>";
                    echo "<h6 style='font-weight:bold;'>  Shoud pay :  $shouldPay </h6>";
                    $eraned=$worksLasrFirst * 5.4 -$shouldPay;
                    echo "<h6 style='font-weight:bold;'> Earned : $eraned </h6>";
                    echo "</div>";
                    echo "</div>";
                    echo "</div>";


                }


                ?>

            </div>
        </div>


        <div class="col-6">


            <div class="row" style="    padding: 0 30px;">
                <div class="col">
                    <?php
                    echo '<h6 style="font-size:2.4vw;">';
                    $date = date('Y-m-d');
                    $response = file_get_contents('http://api.weatherapi.com/v1/history.json?key=3fa2c903934841ed92885918201808&q=vienna&dt=' . $date);
                    $response = json_decode($response, true);
                    echo date('M.d D') . '  <br>' . $response['forecast']['forecastday'][0]['day']['maxtemp_c'] . '   °C' .
                        ' <br> ' . $response['forecast']['forecastday'][0]['day']['condition']['text'];
                    echo '<img src="' . $response['forecast']['forecastday'][0]['day']['condition']['icon'] . '"/>';
                    echo '</h6>';

                    ?>
                </div>
            </div>
            <div id="Total" style="height: 200px; width: 100%; padding: 5px;"></div>
            <div id="Kloster" style="height: 200px; width: 100%; padding: 5px;"></div>
            <div id="wien" style="height: 200px; width: 100%; padding: 5px;"></div>

            <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
        </div>
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
            newDropdown.style.color = "black";
            <?php
            $z = 1;
            foreach ($allDrivers as $driver) {
                $colortemp = "black";
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
                }, backgroundColor: "white",
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
                    color: "black",
                    dataPoints:<?php echo json_encode($dataPoints01, JSON_NUMERIC_CHECK); ?>
                }]
            });
            var chart02 = new CanvasJS.Chart("wien", {
                title: {
                    text: "Wien"
                },
                backgroundColor: "white",


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
                    color: "black",
                    dataPoints: <?php echo json_encode($dataPoints02, JSON_NUMERIC_CHECK); ?>
                }]
            });

            var chart03 = new CanvasJS.Chart("Total", {
                title: {
                    text: "Total"
                },
                backgroundColor: "white",


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
                    color: "black",
                    dataPoints: <?php echo json_encode($dataPoints03, JSON_NUMERIC_CHECK); ?>
                }]
            });


            chart01.render();
            chart02.render();
            chart03.render();

        }


    </script>



@stop
@section('footer')
@stop
