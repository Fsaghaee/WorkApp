@extends('Layout.pageLayout')


@section('MainPart')
<a href="/logout" >Log out</a>
    <a href="/admin-drivers"> Drivers</a>
<a href="/company-works"> All orders</a>


<h3>Today : {{date('yy-m-d')}}</h3>
<?php
$date=strtotime(now()->setTime(16,30,0));

$response = file_get_contents('https://api.openweathermap.org/data/2.5/onecall?lat=48.297554&&lon=16.33&dt='.$date.'&units=metric&%20exclude=hourly,daily&appid=ce89196cd42acfa4d84cd561fdb3fde0');
$response = json_decode($response, true);
echo '<h5>'.date('D',$date). '\'s weather :'. $response['daily'][0]['temp']['max']. ' C    '.$response['daily'][0]['weather'][0]['main'].'</h5>';

$date=strtotime('+1 day',strtotime(now()->setTime(16,30,0)));

$response = file_get_contents('https://api.openweathermap.org/data/2.5/onecall?lat=48.297554&&lon=16.33&dt='.$date.'&units=metric&%20exclude=hourly,daily&appid=ce89196cd42acfa4d84cd561fdb3fde0');
$response = json_decode($response, true);
echo '<h5>'.date('D',$date). '\'s weather :';
echo $response['daily'][0]['temp']['max']. ' C    ';
echo $response['daily'][0]['weather'][0]['main'];
echo '</h5>';
 ?>
<table style="width: 500px;">
    <tr>
        <th> Working Day </th>
        <th> Orders </th>
        <th> Name </th>
        <th> Location </th>
        <th> Weather </th>
        <th> Temp </th>
        <th> Hours </th>
        <th> Break </th>
        <th> Total </th>
    </tr>
@foreach($works as $work)
    <tr>
        <td> {{$work->working_day}} </td>
        <td> {{$work->orders}} </td>
        <td> {{$work->name}} </td>
        <td> {{$work->location}} </td>
        <td> {{$work->wetter_main}} </td>
        <td> {{$work->wetter_temp}} </td>
        <td><?php echo abs(strtotime($work->end_working) - strtotime($work->start_working))/(60*60) ?>   </td>
        <td> {{$work->break}} </td>
        <td><?php echo abs(strtotime($work->end_working) - strtotime($work->start_working))/(60*60)- $work->break ?>   </td>

    </tr>
@endforeach



@stop
@section('centercontent')



@stop
@section('footer')


@stop
