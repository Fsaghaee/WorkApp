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
        echo ' <br>' . date('M.16', strtotime("-1 month")) . '  -  ' . date('M.t', strtotime("-1 month")) . '<h4>' . $worksLasrSecond . '  -  ' . $worksLasrSecond * 5.4 . ' € </h4><br>';

        foreach ($allDrivers as $driver) {
            echo (new App\Http\Controllers\CompanyWorksController)->getDriverWork(date('yy-m-16'), date('yy-m-t', strtotime("-1 month")), $driver->driver_id);
        }

        echo '</div><div class="col">';
        echo ' <br>' . date('M.01') . '  -  ' . date('M.15') . '<h4>' . $worksfirst . '  -  ' . $worksfirst * 5.4 . ' € </h4><br>';
        foreach ($allDrivers as $driver) {
            echo (new App\Http\Controllers\CompanyWorksController)->getDriverWork(date('yy-m-01'), date('yy-m-15'), $driver->driver_id);
        }

        echo '</div><div class="col">';
        echo ' <br>' . date('M.16') . '  -  ' . date('M.t') . '<h4>  ' . $workssecond . '  -  ' . $workssecond * 5.4 . ' € </h4><br>';
        foreach ($allDrivers as $driver) {
            echo (new App\Http\Controllers\CompanyWorksController)->getDriverWork(date('yy-m-16'), date('yy-m-t'), $driver->driver_id);
        }
        echo '</div>';

        ?>
        <table style="width: 99%; font-size:2vw; padding: 5px;text-align: center; ">
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
