@extends('Layout.pageLayout')
@section('MainPart')
    <div style="margin-left: 20px;  border-bottom: 6px solid green;padding: 10px; ">
        <a style="font-size:5vw; border: 2px solid green; padding: 10px; margin-right: 10px; " href="/logout"> Log
            out </a>
        <a style="font-size:5vw; border: 2px solid green; padding: 10px ; margin-right: 10px; "
           href="{{route('admin-drivers.index')}}"> Drivers </a>
        <a style="font-size:5vw; border: 2px solid green; padding: 10px; margin-right: 10px;"
           href="{{route('company-works.index')}}"> All orders </a>
    </div>
@stop
@section('centercontent')
    <div style="margin: 20px;">
        <h3 style="font-size:6vw;">Today : {{date('yy-m-d')}}</h3>
        <br>
        <?php
        echo '<h6 style="font-size:5vw;">';
        $date = date('yy-m-d');
        $response = file_get_contents('http://api.weatherapi.com/v1/history.json?key=3fa2c903934841ed92885918201808&q=vienna&dt=' . $date);
        $response = json_decode($response, true);
        echo date('D') . '  <br>' . $response['forecast']['forecastday'][0]['day']['maxtemp_c'] .
            ' <br> ' . $response['forecast']['forecastday'][0]['day']['condition']['text'];
        echo '<img src="' . $response['forecast']['forecastday'][0]['day']['condition']['icon'] . '"/>';
        echo '<br>';
        echo '<br>';
        $date = date('yy-m-d', strtotime($date . ' +1 day'));
        $response = file_get_contents('http://api.weatherapi.com/v1/history.json?key=3fa2c903934841ed92885918201808&q=vienna&dt=' . $date);
        $response = json_decode($response, true);
        echo date('D', strtotime(' +1 day')) . '  <br>' . $response['forecast']['forecastday'][0]['day']['maxtemp_c'] .
            ' <br> ' . $response['forecast']['forecastday'][0]['day']['condition']['text'];
        echo '<img src="' . $response['forecast']['forecastday'][0]['day']['condition']['icon'] . '"/>';
        echo '</h6>';
        ?>
        <br>
        <table style="width: 100%; font-size:2vw; border-top: 6px solid green; margin: 5px; ">
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
                        <td><?php echo abs(strtotime($work->end_working) - strtotime($work->start_working)) / (60 * 60) - $work->break   ; ?></td>
                    </tr>


    @endforeach
        </table>
    </div>
    @endif

@stop
@section('footer')
@stop
