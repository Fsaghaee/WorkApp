<a href="/logout">Log out</a>
<?php


function stringInsert($str,$insertstr,$pos)
{
    $str = substr($str, 0, $pos) . $insertstr . substr($str, $pos);
    return $str;
}

$date=strtotime(now()->setTime(16,30,0));
$response = file_get_contents('https://api.openweathermap.org/data/2.5/onecall?lat=48.297554&&lon=16.33&dt='.$date.'&units=metric&%20exclude=hourly,daily&appid=ce89196cd42acfa4d84cd561fdb3fde0');
$response = json_decode($response, true);
echo '<h5>'.date('D',$date). '\'s weather :</h5>';
echo '<h3>'. $response['daily'][0]['temp']['max']. ' C';
echo '</br>';
echo $response['daily'][0]['weather'][0]['main'].'</h3>';
$Tdate=strtotime('+1 day',strtotime(now()->setTime(16,30,0)));
$Tresponse = file_get_contents('https://api.openweathermap.org/data/2.5/onecall?lat=48.297554&&lon=16.33&dt='.$Tdate.'&units=metric&%20exclude=hourly,daily&appid=ce89196cd42acfa4d84cd561fdb3fde0');
$Tresponse = json_decode($Tresponse, true);
echo '<h5>'.date('D',$Tdate). '\'s weather :</h5>';
echo '<h3>'. $Tresponse['daily'][0]['temp']['max']. ' C';
echo '</br>';
echo $Tresponse['daily'][0]['weather'][0]['main'].'</h3>';
echo '</br>';
//echo $response['main']['temp_max'];

?>
<table style="width: 500px;">
    <tr>
        <th> Day</th>

        <th> Orders</th>


    </tr>

    @foreach($works as $work)
        <tr>
            <td> {{$work->working_day}} </td>
            <td> {{$work->orders}} </td>

        </tr>
    @endforeach


</table>
<br>

<h2>{{auth()->user()->name }}'s Page</h2>
<br>
{!! Form::open(['method'=>'POST','action'=>'DriverPageController@store']) !!}

{!! form::hidden('working_day',now(),['class'=>'form-control']) !!}

{!! form::label('orders','Orders :') !!}
{!! form::text('orders',null,['class'=>'form-control']) !!}
<br>

{!! form::label('working_account','Account :') !!}
{!! form:: select('location',array('FarzadU1'=>'FarzadU1','FarzadU2'=>'FarzadU2','FarzadU3'=>'FarzadU3','FarzadU4'=>'FarzadU4')) !!}

<br>
{!! form::label('start_working','Start Time :') !!}
{!! form::time('start_working',now()->setTime(11,0,0),['class'=>'form-control']) !!}


{!! form::label('end_working','End Time :') !!}
{!! form::time('end_working',now()->setTime(23,0,0),['class'=>'form-control']) !!}
<br>
{!! form::label('break','Break :') !!}
{!! Form::number('break', null, ['class' => 'form-control','step' => '0.5','min'=>0]) !!}

<br>
{!! form::label('location','Locations :') !!}
{!! form:: select('location',array('Klosterneuburg'=>'Klosterneuburg','Wien'=>'Wien')) !!}
<br>
{!! form::hidden('company_id', auth()->user()->company_id ,['class'=>'form-control']) !!}
{!! form::hidden('company_id', auth()->user()->company_id ,['class'=>'form-control']) !!}
{!! form::hidden('wetter_temp', $response['daily'][0]['temp']['max'] ,['class'=>'form-control']) !!}
{!! form::hidden('wetter_main',$response['daily'][0]['weather'][0]['main'],['class'=>'form-control']) !!}



{!! form::hidden('driver_id', auth()->user()->id ,['class'=>'form-control']) !!}

{!! form::submit('Add Orders',['class'=>'btn btn-primary']) !!}


{!! Form::close() !!}
