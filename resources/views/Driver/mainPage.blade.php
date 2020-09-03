@extends('Layout.pageLayout')
@section('MainPart')
    <div style="margin-left: 20px;  border-bottom: 6px solid green;padding: 10px; ">
        <a style="font-size:5vw; border: 2px solid green; padding: 10px; " href="/logout">Log out</a>
    </div>
@stop
@section('centercontent')



    <div >
        <br>
        <h2 style="font-size:10vw;">{{auth()->user()->name }}'s Page</h2>
        <br>
        <?php
        function stringInsert($str, $insertstr, $pos)
        {
            $str = substr($str, 0, $pos) . $insertstr . substr($str, $pos);
            return $str;
        }
        $date = date('yy-m-d');
        $response = file_get_contents('http://api.weatherapi.com/v1/history.json?key=3fa2c903934841ed92885918201808&q=vienna&dt=' . $date);
        $response = json_decode($response, true);
        echo '<h6 style="font-size:5vw;">';
        echo date('D') . '  <br>' . $response['forecast']['forecastday'][0]['day']['maxtemp_c'] .
            ' <br> ' . $response['forecast']['forecastday'][0]['day']['condition']['text'];
        echo '<img src="' . $response['forecast']['forecastday'][0]['day']['condition']['icon'] . '"/>';
        echo '<br>';
        echo '<br>';
        $date = date('yy-m-d', strtotime($date . ' +1 day'));
        $Tresponse = file_get_contents('http://api.weatherapi.com/v1/history.json?key=3fa2c903934841ed92885918201808&q=vienna&dt=' . $date);
        $Tresponse = json_decode($Tresponse, true);
        echo date('D', strtotime(' +1 day')) . '  <br>' . $Tresponse['forecast']['forecastday'][0]['day']['maxtemp_c'] .
            ' <br> ' . $Tresponse['forecast']['forecastday'][0]['day']['condition']['text'];
        echo '<img src="' . $Tresponse['forecast']['forecastday'][0]['day']['condition']['icon'] . '"/>';
        echo '</h6>';
        ?>
        <table style="overflow-y: scroll;width: 100%;display: block;height: 250px;border: 2px solid green;border-radius: 5px; text-align: center !important;padding: 10px;margin: 10px;">
            <tr>
                <th  style="padding-left: 90px;padding-right: 90px;">Day/Tag</th>
                <th  style="padding-left: 90px;padding-right: 90px;">Orders/Bestellungen</th>
                <th  style="padding-left: 90px;padding-right: 90px;">Account/Konto</th>
                <th  style="padding-left: 90px;padding-right: 90px;">Location/Ort</th>
            </tr>
            @if(isset( $works))
                @foreach($works as $work)
                    <tr>
                        <td>  {{date('m-d',strtotime( $work->working_day))}} </td>
                        <td> {{$work->orders}} </td>
                        <td> {{$work->working_account}} </td>
                        <td> {{$work->location[0]}} </td>
                    </tr>
                @endforeach
            @endif
        </table>
        <br>

        <br>
        <?php
        $TempDate = array(
            date('yy-m-d', strtotime(now())) => date('M-d D', strtotime(now()))
        , date('yy-m-d', strtotime(now() . ' -1 day')) => date('M-d D', strtotime(now() . ' -1 day'))
        , date('yy-m-d', strtotime(now() . ' -2 day')) => date('M-d D', strtotime(now() . ' -2 day'))
        , date('yy-m-d', strtotime(now() . ' -3 day')) => date('M-d D', strtotime(now() . ' -3 day'))
        , date('yy-m-d', strtotime(now() . ' -4 day')) => date('M-d D', strtotime(now() . ' -4 day'))
        , date('yy-m-d', strtotime(now() . ' -5 day')) => date('M-d D', strtotime(now() . ' -5 day'))
        , date('yy-m-d', strtotime(now() . ' -6 day')) => date('M-d D', strtotime(now() . ' -6 day'))
        );
        ?>
        {!! Form::open(['method'=>'POST','action'=>'DriverPageController@store','style'=>'font-size:4vw;margin: 30px;']) !!}
        {!! form::label('working_day','Date/Datum :') !!}
        {!! form::select('working_day',$TempDate,['class'=>'form-control']) !!}
        {!! form::label('orders','Orders/Bestellungen :') !!}
        {!! form::text('orders',null,['class'=>'form-control' ,'style'=>'font-size:4vw;','placeholder'=>'0','required']) !!}
        {!! form::label('working_account','Account/Konto :') !!}
        {!! form:: select('working_account',array(''=>'Select/Auswählen','FarzadU1'=>'FarzadU1','FarzadU2'=>'FarzadU2','FarzadU3'=>'FarzadU3','FarzadU4'=>'FarzadU4','FarzadS'=>'FarzadS')) !!}
        <br>
        {!! form::label('start_working','Start Time/Startzeit :') !!}
        {!! form::time('start_working',now()->setTime(11,0,0),['class'=>'form-control','style'=>'font-size:4vw;']) !!}
        {!! form::label('end_working','End Time/Endzeit :') !!}
        {!! form::time('end_working',now()->setTime(22,30,0),['class'=>'form-control','style'=>'font-size:4vw;']) !!}
        {!! form::label('break','Break/Pause (Std) :') !!}
        {!! Form::number('break', null, ['class' => 'form-control','step' => '0.5','min'=>0,'style'=>'font-size:4vw;','placeholder'=>'0.5']) !!}
        {!! form::label('location','Locations/Ort :') !!}
        {!! form:: select('location',array(''=>'Select/Auswählen','Klosterneuburg'=>'Klosterneuburg','Wien'=>'Wien')) !!}
        {!! form::hidden('company_id', auth()->user()->company_id ,['class'=>'form-control']) !!}
        {!! form::hidden('company_id', auth()->user()->company_id ,['class'=>'form-control']) !!}
        {!! form::hidden('driver_id', auth()->user()->id ,['class'=>'form-control']) !!}
        {!! form::submit('Add Orders',['class'=>'btn btn-primary','style'=>'font-size:5vw; padding:20px;margin: 30px;']) !!}
        {!! Form::close() !!}
        <br>
        <table style="width: 90%; font-size:5vw; border-top: 6px solid green; margin: 30px; ">
            <tr>
                <th>Pay slips/Lohnzetteln :</th>
            </tr>
            @if(isset( $slips))
                @foreach($slips as $slip)
                    <tr>
                        <td>
                            <a style="font-size:5vw;"
                               href=" {{$slip->slip_file_location}}">   <?php echo str_replace(auth()->user()->id . '_', '', str_replace('.pdf', '', str_replace('payslips/', '', $slip->slip_file_location))); ?></a>
                        </td>
                    </tr>
                @endforeach
            @endif
        </table>
    </div>
@stop
