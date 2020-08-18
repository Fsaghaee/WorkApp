@extends('Layout.pageLayout')

@section('MainPart')
    <div style="margin-left: 20px;">
        <a href="/logout">Log out</a>
    </div>
@stop

@section('centercontent')
    <div class="row">
        <div class="col-6">
            <br>
            <h2>{{auth()->user()->name }}'s Page</h2>
            <br>
            <?php

            function stringInsert($str, $insertstr, $pos)
            {
                $str = substr($str, 0, $pos) . $insertstr . substr($str, $pos);
                return $str;
            }
            $date = date('yy-m-d');
            // echo $date;
            $response = file_get_contents('http://api.weatherapi.com/v1/history.json?key=3fa2c903934841ed92885918201808&q=vienna&dt=' . $date);
            $response = json_decode($response, true);
            echo date('D') . '  <br>' . $response['forecast']['forecastday'][0]['day']['maxtemp_c'] .
                ' <br> ' . $response['forecast']['forecastday'][0]['day']['condition']['text'];
            echo '<img src="' . $response['forecast']['forecastday'][0]['day']['condition']['icon'] . '"/>';

            echo '<br>';
            $date = date('yy-m-d', strtotime($date . ' +1 day'));



            $Tresponse = file_get_contents('http://api.weatherapi.com/v1/history.json?key=3fa2c903934841ed92885918201808&q=vienna&dt=' . $date);
            $Tresponse = json_decode($Tresponse, true);

            echo date('D', strtotime(' +1 day')) . '  <br>' . $Tresponse['forecast']['forecastday'][0]['day']['maxtemp_c'] .
                ' <br> ' . $Tresponse['forecast']['forecastday'][0]['day']['condition']['text'];
            echo '<img src="' . $Tresponse['forecast']['forecastday'][0]['day']['condition']['icon'] . '"/>';



            ?>
            <table style="width: 500px;">
                <tr>
                    <th> Day</th>

                    <th> Orders</th>


                </tr>

                @if($works)
                    @foreach($works as $work)
                        <tr>
                            <td> {{$work->working_day}} </td>
                            <td> {{$work->orders}} </td>

                        </tr>
                    @endforeach

                @endif
            </table>


            <table style="width: 500px;">
                <tr>
                    <th> File</th>

                    <th> Status</th>


                </tr>
@if($slips)
                @foreach($slips as $slip)
                    <tr>
                        <td>
                            <a href=" {{$slip->slip_file_location}}">   <?php echo str_replace(auth()->user()->id . '_', '', str_replace('.pdf', '', str_replace('payslips/', '', $slip->slip_file_location))); ?></a>
                        </td>
                        <td> {{$slip->status}} </td>

                    </tr>
                @endforeach
@endif

            </table>


            <br>

        </div>
        <div class="col-6">
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
            {!! form::hidden('wetter_temp', $response['forecast']['forecastday'][0]['day']['maxtemp_c'] ,['class'=>'form-control']) !!}
            {!! form::hidden('wetter_main',$response['forecast']['forecastday'][0]['day']['condition']['text'],['class'=>'form-control']) !!}


            {!! form::hidden('driver_id', auth()->user()->id ,['class'=>'form-control']) !!}

            {!! form::submit('Add Orders',['class'=>'btn btn-primary']) !!}


            {!! Form::close() !!}
        </div>
    </div>
    </div>
@stop
