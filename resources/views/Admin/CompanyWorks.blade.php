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
        echo '<th style="padding-left: 110px;">Day</th>';
        echo '<th style="padding-left: 90px;">Sum</th>';
        echo '</tr>';

        foreach ($klosSum as $t) {
            echo '<tr>';
            echo '<td style="padding-left: 90px;">' . date('m-d D',strtotime( $t->working_day))  . ' </td><td style="padding-left: 90px;"> ' . $t->total . '</td>';
            echo '</tr>';
        }
        echo '</table>';
        echo '</div>';
        echo '<div class="col">';

        echo '<h7>Wien</h7>';
        echo '<table style="overflow-y: scroll;width: 100%;display: block;height: 150px;border: 2px solid green;border-radius: 5px; text-align: center !important;padding: 10px;margin: 10px;">';
        echo '<tr style="text-align: center;">';
        echo '<th style="padding-left: 110px;">Day</th>';
        echo '<th style="padding-left: 90px;"> Sum</th>';
        echo '</tr>';
        foreach ($WienSum as $t) {
            echo '<tr>';
            echo '<td style="padding-left: 90px;">' . date('m-d D',strtotime( $t->working_day)) . ' </td><td style="padding-left: 90px;"> ' . $t->total . '</td>';
            echo '</tr>';
        }
        echo '</table>';
        echo '</div></div>';
        echo '<div class="row">';
        echo '<div class="col">';
        echo '<table style="overflow-y: scroll;width: 100%;display: block;height: 195px;border: 2px solid green;border-radius: 5px; text-align: center !important;padding: 10px;margin: 10px;">';

        foreach ($avgKlos as $x) {
            echo '<tr>';
            echo '<td style="padding-left: 90px;">' . $x->day . ' </td><td style="padding-left: 90px;"> ' . round($x->av, 2) . '</td>';
            echo '</tr>';

        }
        echo '</table>';
        echo '</div>';
        echo '<div class="col">';
        echo '<table style="overflow-y: scroll;width: 100%;display: block;height: 195px;border: 2px solid green;border-radius: 5px; text-align: center !important;padding: 10px;margin: 10px;">';
        foreach ($avgWien as $x) {
            echo '<tr>';
            echo '<td style="padding-left: 90px;">' . $x->day . ' </td><td style="padding-left: 90px;"> ' . round($x->av, 2) . '</td>';
            echo '</tr>';

        }
        echo '</table>';
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

            <div class="col-3">
                <input type="text" id="inputName" style="margin-top: 10px;" onkeyup="NameSearch()" placeholder="Name"/><br>
                <select id="inputLocation"   onclick="LocationSearch()" style="margin-top: 20px; font-size: 1vw;">
                    <option value="">Select</option>
                    <option value="K">Klosterneuburg</option>
                    <option value="W">Wien</option>
                </select><br>
                <input type="text" style="margin-top: 20px;"  id="inputAccount" onkeyup="AccountSearch()" placeholder="Account"/>
            </div>

            <div class="col-9">

                <table style="overflow-y: scroll;width: 100%;display: block;height: 350px;border: 2px solid green;border-radius: 5px; text-align: center !important;padding: 10px;margin: 10px;" id="driverTable">
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
                            <td><?php echo round( abs(strtotime($work->end_working) - strtotime($work->start_working)) / (60 * 60) - $work->break,2) ?>   </td>
                            <td> {{$work->orders * 1.3}}  </td>
                            <td style="border-left: #000000 2px solid;"> {{$work->orders}} </td>
                            <td> {{$work->wetter_main}} </td>
                            <td> {{$work->wetter_temp}} </td>
                        </tr>
                    @endforeach
                </table>
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


    </div>
@stop
