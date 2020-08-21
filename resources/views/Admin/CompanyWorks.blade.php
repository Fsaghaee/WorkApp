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
            <?php
            $total = 0;
            $workingDay = null;
            echo ' <br>Vom : ' . date('M-16') . '   Bis : ' . date('M-t') . ' : <h4>  ' . $workssecond . '  -  ' . $workssecond * 5.4 . ' € </h4>';
            echo ' <br>Vom : ' . date('M-1') . '   Bis : ' . date('M-15') . ' :  <h4>' . $worksfirst . '  -  ' . $worksfirst * 5.4 . ' € </h4><br>';
            ?>
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
