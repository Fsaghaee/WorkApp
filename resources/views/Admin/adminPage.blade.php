@extends('Layout.pageLayout')
@section('MainPart')
    <div style="margin: 20px;">
        <a href="/logout">Log out</a>
        <a href="/admin-drivers"> Drivers</a>
        <a href="/company-works"> All orders</a>

    </div>
@stop
@section('centercontent')
    <div style="margin: 20px;">

        <h3>Today : {{date('yy-m-d')}}</h3>


        <?php
        $date = date('yy-m-d');
        $response = file_get_contents('http://api.weatherapi.com/v1/history.json?key=3fa2c903934841ed92885918201808&q=vienna&dt=' . $date);
        $response = json_decode($response, true);
        echo date('D') . '  <br>' . $response['forecast']['forecastday'][0]['day']['maxtemp_c'] .
            ' <br> ' . $response['forecast']['forecastday'][0]['day']['condition']['text'];
        echo '<img src="' . $response['forecast']['forecastday'][0]['day']['condition']['icon'] . '"/>';
        echo '<br>';
        $date = date('yy-m-d', strtotime($date . ' +1 day'));
        $response = file_get_contents('http://api.weatherapi.com/v1/history.json?key=3fa2c903934841ed92885918201808&q=vienna&dt=' . $date);
        $response = json_decode($response, true);
        echo date('D', strtotime(' +1 day')) . '  <br>' . $response['forecast']['forecastday'][0]['day']['maxtemp_c'] .
            ' <br> ' . $response['forecast']['forecastday'][0]['day']['condition']['text'];
        echo '<img src="' . $response['forecast']['forecastday'][0]['day']['condition']['icon'] . '"/>';









        ?>
        <br>

        <table style="width: 90%;">
            <tr>
                <th> Working Day</th>
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
                    <td> {{$work->working_day}} </td>
                    <td> {{$work->orders}} </td>
                    <td> {{$work->name}} </td>
                    <td> {{$work->location}} </td>
                    <td> {{$work->wetter_main}} </td>
                    <td> {{$work->wetter_temp}} </td>
                    <td><?php echo abs(strtotime($work->end_working) - strtotime($work->start_working)) / (60 * 60) ?>   </td>
                    <td> {{$work->break}} </td>
                    <td><?php echo abs(strtotime($work->end_working) - strtotime($work->start_working)) / (60 * 60) - $work->break ?>   </td>
                </tr>
        </table>
    </div>
    @endforeach
@endif

@stop
@section('footer')
@stop
