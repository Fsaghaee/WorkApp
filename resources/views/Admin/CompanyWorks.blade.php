@extends('Layout.pageLayout')
@section('MainPart')
    <div style="margin-left: 20px;  border-bottom: 6px solid green;padding: 10px; ">
        <a style="font-size:5vw; border: 2px solid green; padding: 10px;margin-right: 10px; " href="/logout"> Log
            out </a>
        <a style="font-size:5vw; border: 2px solid green; padding: 10px;margin-right: 10px; " href="/admin"> Main </a>
        <a style="font-size:5vw; border: 2px solid green; padding: 10px;margin-right: 10px; " href="/admin-drivers">
            Drivers </a>
    </div>
@stop
@section('centercontent')
    <div style="margin: 20px;">


        <?php
echo '<div class="row">';
echo '<div class="col">';
        echo '<h7>Klosterneuburg</h7>';
        echo '<table style="overflow-y: scroll;width: 100%;display: block;height: 150px;border: 2px solid green;border-radius: 5px; text-align: center !important;padding: 10px;margin: 10px;">';
        echo '<tr>';
        echo '<th>Day</th>';
        echo '<th>Sum</th>';
        echo '</tr>';

        foreach ($klosSum as $t) {
            echo '<tr>';
            echo '<td>' . $t->working_day . ' </td><td> ' . $t->total . '</td>';
            echo '</tr>';
        }
        echo '</table>';
echo '</div>';
echo '<div class="col">';

        echo '<h7>Wien</h7>';
        echo '<table style="overflow-y: scroll;width: 100%;display: block;height: 150px;border: 2px solid green;border-radius: 5px; text-align: center !important;padding: 10px;margin: 10px;">';
        echo '<tr style="text-align: center;">';
        echo '<th>Day</th>';
        echo '<th>Sum</th>';
        echo '</tr>';

        foreach ($WienSum as $t) {
            echo '<tr>';
            echo '<td>' . $t->working_day . ' </td><td> ' . $t->total . '</td>';
            echo '</tr>';
        }
        echo '</table>';
echo '</div></div>';

        $avarageDayNumbers = array('Mon' => 0, 'Thu' => 0, 'Wed' => 0, 'Tue' => 0, 'Fri' => 0, 'Sat' => 0, 'Sun' => 0);
        $avarageDayOrders = array('Mon' => 0, 'Thu' => 0, 'Wed' => 0, 'Tue' => 0, 'Fri' => 0, 'Sat' => 0, 'Sun' => 0);

        foreach ($allworks as $work) {

            if ($work->location == 'Klosterneuburg') {
                switch (date('D', strtotime($work->working_day))) {


                    case 'Mon':
                        $avarageDayNumbers['Mon'] += 1;
                        $avarageDayOrders['Mon'] += $work->orders;
                        break;
                    case 'Thu':
                        $avarageDayNumbers['Thu'] += 1;
                        $avarageDayOrders['Thu'] += $work->orders;

                        break;
                    case 'Wed':
                        $avarageDayNumbers['Wed'] += 1;
                        $avarageDayOrders['Wed'] += $work->orders;

                        break;
                    case 'Tue':
                        $avarageDayNumbers['Tue'] += 1;
                        $avarageDayOrders['Tue'] += $work->orders;

                        break;
                    case 'Fri':
                        $avarageDayNumbers['Fri'] += 1;
                        $avarageDayOrders['Fri'] += $work->orders;

                        break;
                    case 'Sat':
                        $avarageDayNumbers['Sat'] += 1;
                        $avarageDayOrders['Sat'] += $work->orders;

                        break;
                    case 'Sun':
                        $avarageDayNumbers['Sun'] += 1;
                        $avarageDayOrders['Sun'] += $work->orders;
                        break;
                }
            }
        }
        echo '<div class ="row">';
        echo '<div class="col"><h6>Avarage Mon :' . $avarageDayOrders['Mon'] / $avarageDayNumbers['Mon'] . '<br>';
        echo ' Avarage Thu :' . $avarageDayOrders['Thu'] / $avarageDayNumbers['Thu'] . '<br>';
        echo ' Avarage Wed :' . $avarageDayOrders['Wed'] / $avarageDayNumbers['Wed'] . '<br>';
        echo ' Avarage Tue :' . $avarageDayOrders['Tue'] / $avarageDayNumbers['Tue'] . '<br>';
        echo '</h6></div><div class="col"><h6>';
        echo ' Avarage Fri :' . $avarageDayOrders['Fri'] / $avarageDayNumbers['Fri'] . '<br>';
        echo ' Avarage Sat :' . $avarageDayOrders['Sat'] / $avarageDayNumbers['Sat'] . '<br>';
        echo ' Avarage Son :' . $avarageDayOrders['Sun'] / $avarageDayNumbers['Sun'] . '<br>';
        echo '</h6>';
        echo '</div></div>';
        $total = 0;
        $workingDay = null;
        echo '<div class ="row">';
        echo '<div class="col">';
        echo ' <br>' . date('M.16', strtotime("-1 month")) . '  -  ' . date('M.t', strtotime("-1 month")) . '<h4>' . $worksLasrSecond . '  -  ' . $worksLasrSecond * 5.4 . ' € </h4>';

        foreach ($allDrivers as $driver) {
            echo (new App\Http\Controllers\CompanyWorksController)->getDriverWork(date('yy-m-16'), date('yy-m-t', strtotime("-1 month")), $driver->driver_id);
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
        echo '<br></div></div>';

        ?>

        <br>
        <div class="row">

            <div class="col"><input type="text" id="inputName" , onkeyup="NameSearch()" placeholder="Name"/></div>

            <div class="col"><select id="inputLocation" onclick="LocationSearch()" style="font-size: 1vw;">
                    <option value="">Select</option>
                    <option value="K">Klosterneuburg</option>
                    <option value="W">Wien</option>
                </select></div>
            <div class="col"><input type="text" id="inputAccount" onkeyup="AccountSearch()" placeholder="Account"/>
            </div>
            <br>
        </div>


        <script>

            function NameSearch() {
                var input, filter, table, tr, td, i, txtValue;
                input = document.getElementById("inputName");
                filter = input.value.toUpperCase();
                table = document.getElementById("driverTable");
                tr = table.getElementsByTagName("tr");
                for (i = 0; i < tr.length; i++) {
                    td = tr[i].getElementsByTagName("td")[1];
                    if (td) {
                        txtValue = td.textContent || td.innerText;
                        if (txtValue.toUpperCase().indexOf(filter) > -1) {
                            tr[i].style.display = "";
                        } else {
                            tr[i].style.display = "none";
                        }
                    }
                }
            }

            function LocationSearch() {
                var input, filter, table, tr, td, i, txtValue;
                input = document.getElementById("inputLocation");
                filter = input.value.toUpperCase();
                table = document.getElementById("driverTable");
                tr = table.getElementsByTagName("tr");
                for (i = 0; i < tr.length; i++) {
                    td = tr[i].getElementsByTagName("td")[2];
                    if (td) {
                        txtValue = td.textContent || td.innerText;
                        if (txtValue.toUpperCase().indexOf(filter) > -1) {
                            tr[i].style.display = "";
                        } else {
                            tr[i].style.display = "none";
                        }
                    }
                }
            }


            function AccountSearch() {
                var input, filter, table, tr, td, i, txtValue;
                input = document.getElementById("inputAccount");
                filter = input.value.toUpperCase();
                table = document.getElementById("driverTable");
                tr = table.getElementsByTagName("tr");
                for (i = 0; i < tr.length; i++) {
                    td = tr[i].getElementsByTagName("td")[3];
                    if (td) {
                        txtValue = td.textContent || td.innerText;
                        if (txtValue.toUpperCase().indexOf(filter) > -1) {
                            tr[i].style.display = "";
                        } else {
                            tr[i].style.display = "none";
                        }
                    }
                }
            }

        </script>


        <table style="width: 99%; font-size:2vw; padding: 5px;text-align: center; " id="driverTable">
            <tr>
                <th>Day</th>
                <th>Name</th>
                <th>Location</th>
                <th>Account</th>
                <th>Hours</th>
                <th>Earned</th>
                <th style="border-left: #000000 2px solid; padding-left: 5px;"> Orders</th>
                <th>Weather</th>
                <th>Temp</th>
            </tr>

            @foreach($allworks as $work)
                <?php
                $color = '';
                if (date('D', strtotime($work->working_day)) == 'Sun' || date('D', strtotime($work->working_day)) == 'Sat') {
                    $color = '#57b846';
                } else {
                    $color = 'white';
                }
                $workingDay = $work->working_day;
                ?>
                <tr style=" background-color:<?php echo $color ?>; text-align: center;">
                    <td>{{date('M-d D', strtotime($work->working_day))}} </td>
                    <td> {{$work->name}} </td>
                    <?php
                    if ($work->location == 'Klosterneuburg') {
                        echo '<td style="background-color: #6c757d;">' . $work->location[0] . '</td>';
                    } elseif ($work->location == 'Wien') {
                        echo '<td style="background-color: #1e7e34;">' . $work->location[0] . '</td>';
                    }
                    ?>
                    <td> {{$work->working_account}} </td>
                    <td><?php echo abs(strtotime($work->end_working) - strtotime($work->start_working)) / (60 * 60) - $work->break ?>   </td>
                    <td> {{$work->orders * 1.3}}  </td>
                    <td style="border-left: #000000 2px solid;"> {{$work->orders}} </td>
                    <td> {{$work->wetter_main}} </td>
                    <td> {{$work->wetter_temp}} </td>
                </tr>
            @endforeach
        </table>
    </div>
@stop
