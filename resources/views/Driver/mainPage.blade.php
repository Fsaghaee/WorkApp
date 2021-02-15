@extends('Layout.pageLayout')
@section('centercontent')

    <div>
        <script>


            function validateForm() {
                var wday = document.getElementById("working_day").value;
                var orders = document.getElementById("orders").value;
                var loc = document.getElementById("location").value;
                var acc = document.getElementById("working_account").value;
                if( acc == "") {
                    alert('Bitte vergessen Sie nicht, ein Konto auszuwählen');
                    return false;
                }else if(loc == ""){
                    alert('Bitte vergessen Sie nicht, einen Ort zu wählen');
                    return false;
                } else{
                    alert(
                        'Arbeitstag : ' + wday + '\nBestellungen : ' + orders + '\nKonto : ' +acc+' \nLocation : '+loc +'\nWenn etwas nicht stimmt, wenden Sie sich bitte an Ihren LeiterIn\n--Die Daten wurden gespeichert-- '
                    );
                    return true;
                }


            }


        </script>
        <h2 style="font-size:4vw;color: black; text-align: center;margin-top: 10px;"> Hallo {{auth()->user()->name }}</h2>
        <?php


        $TempDate = array(
            date('Y-m-d', strtotime(now())) => date('M-d D', strtotime(now()))
        , date('Y-m-d', strtotime(now() . ' -1 day')) => date('M-d D', strtotime(now() . ' -1 day'))
        , date('Y-m-d', strtotime(now() . ' -2 day')) => date('M-d D', strtotime(now() . ' -2 day'))
        , date('Y-m-d', strtotime(now() . ' -3 day')) => date('M-d D', strtotime(now() . ' -3 day'))
        , date('Y-m-d', strtotime(now() . ' -4 day')) => date('M-d D', strtotime(now() . ' -4 day'))
        , date('Y-m-d', strtotime(now() . ' -5 day')) => date('M-d D', strtotime(now() . ' -5 day'))
        , date('Y-m-d', strtotime(now() . ' -6 day')) => date('M-d D', strtotime(now() . ' -6 day'))
        );
        $templocation = array("" => 'Select/Auswählen', 'Klosterneuburg' => 'Klosterneuburg', 'Wien' => 'Wien');
        $tempaccounts = array("" => 'Select/Auswählen', 'FarzadU1' => 'FarzadU1', 'FarzadU2' => 'FarzadU2', 'FarzadU3' => 'FarzadU3', 'FarzadU4' => 'FarzadU4', 'FarzadU5' => 'FarzadU5', 'FarzadU6' => 'FarzadU6','FarzadU7' => 'FarzadU7','FarzadU8' => 'FarzadU8', 'FarzadS' => 'FarzadS');
        ?>
        <h3 style="font-size:4.4vw;color: black; text-align: center;"><br>  Letztes Mal<span style="font-size:4.8vw;font-weight: bold; color: red;">
                <?php
                if(!empty($lastwork->orders)){
                    echo $lastwork->orders;
                }else{
                    echo 'Sie haben Keine Bestellungen.';
                }


                ?> </span>

            Bestellungen.</h3>

        {!! Form::open(array('method'=>'POST','action'=>'DriverPageController@store','onsubmit'=>'validateForm()','style'=>'font-size:5vw;margin: 20px;')) !!}
        {!! form::label('working_day','Date/Datum :') !!}
        {!! form::select('working_day',$TempDate,null,array('class'=>'form-control','style'=>'font-size:5vw; height: 13vw;')) !!}
        {!! form::label('orders','Orders/Bestellungen :') !!}
        {!! form::text('orders',null,['class'=>'form-control' ,'style'=>'font-size:5vw;height: 13vw;','placeholder'=>'0','required']) !!}
        {!! form::label('working_account','Account/Konto :') !!}
        {!! form:: select('working_account',$tempaccounts,null,array('class'=>'form-control','id'=>'account','style'=>'font-size:5vw; height: 13vw')) !!}
        {!! form::label('location','Locations/Ort :') !!}
        {!! form:: select('location',$templocation,null,array('class'=>'form-control','id'=>'locations','style'=>'font-size:5vw; height: 13vw')) !!}
        {!! form::hidden('company_id', auth()->user()->company_id ,['class'=>'form-control']) !!}
        {!! form::hidden('driver_id', auth()->user()->id ,['class'=>'form-control']) !!}
        {!! form::submit('Add Orders',['class'=>'btn btn-primary','style'=>'font-size:6vw; background-color: lightblue;color:black; padding:10px 20px;margin: 30px 5px;']) !!}
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
                            <a style="font-size:5vw;color: lightblue;"
                               href=" {{$slip->slip_file_location}}">   <?php echo str_replace(auth()->user()->id . '_', '', str_replace('.pdf', '', str_replace('payslips/', '', $slip->slip_file_location))); ?></a>
                        </td>
                    </tr>
                @endforeach
            @endif
        </table>
    </div>



@stop
