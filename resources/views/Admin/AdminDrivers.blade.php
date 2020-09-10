@extends('Layout.pageLayout')
@section('MainPart')
    <div style="margin-left: 20px;  border-bottom: 6px solid green;padding: 10px; ">
        <a style="font-size:3vw; border: 2px solid green; padding: 10px;margin-right: 10px; " href="/logout"> Log
            out </a>
        <a style="font-size:3vw; border: 2px solid green; padding: 10px;margin-right: 10px; " href="/admin"> Main </a>
        <a style="font-size:3vw; border: 2px solid green; padding: 10px;margin-right: 10px; " href="/company-works"> All
            orders </a>
    </div>
@stop
@section('centercontent')
    <div style="margin: 20px;">
        <h5 style="font-size:5vw;"> {{auth()->user()->name }}'s Drivers :</h5>
        <br>
        <table style="width: 98%; font-size:1.2vw; border-top: 6px solid green ;margin: 10px; text-align: center;">
            <tr>
                <th> Name</th>
                <th> Family</th>
                <th> Address</th>
                <th> Tell</th>
                <th> Bank account</th>
            </tr>
            @foreach($drivers as $driver)
                <tr>
                    <td> {{$driver->name}} </td>
                    <td> {{$driver->family}} </td>
                    <td> {{$driver->address}}</td>
                    <td> {{$driver->tell}}</td>
                    <td> {{$driver->bank_account}}</td>
                </tr>
            @endforeach
        </table>
        <br>
    </div>
    <h5 style="font-size:4vw;font-weight: bold;text-align: center;">Add new driver</h5>
    <br>
    {!! Form::open(['method'=>'POST','action'=>'AdminDriversController@store' ,'style'=>'font-size:3vw;margin: 30px;']) !!}
    {!! form::label('name','Name :') !!}
    {!! form::text('name',null,['class'=>'form-control' ,'style'=>'font-size:3vw;']) !!}
    {!! form::label('family','Family :') !!}
    {!! form::text('family',null,['class'=>'form-control','style'=>'font-size:3vw;']) !!}
    {!! form::hidden('company_id', auth()->user()->id ,['class'=>'form-control']) !!}
    {!! form::label('birthday','Birthday :') !!}
    {!! form::date('birthday',null,['class'=>'form-control','style'=>'font-size:3vw;']) !!}
    {!! form::label('address','Address :') !!}
    {!! form::text('address',null,['class'=>'form-control','style'=>'font-size:3vw;']) !!}
    {!! form::label('insurance_number','Insurance Number :') !!}
    {!! form::text('insurance_number',null,['class'=>'form-control','style'=>'font-size:3vw;']) !!}
    {!! form::label('payment_method','Payment Method:') !!}
    {!! form:: select('payment_method',array('bar'=>'Bar','bank transfer'=>'Bank transfer'),['class'=>'form-control']) !!}
    {!! form::label('bank_account','Bank Account :') !!}
    {!! form::text('bank_account',null,['class'=>'form-control','style'=>'font-size:3vw;']) !!}
    {!! form::label('tell','Tell :') !!}
    {!! form::text('tell',null,['class'=>'form-control','style'=>'font-size:3vw;']) !!}
    {!! form::label('email','Email :') !!}
    {!! form::text('email',null,['class'=>'form-control','style'=>'font-size:3vw;']) !!}
    {!! form::hidden('password','Gutefahrt!',['class'=>'form-control']) !!}
    {!! form::submit('Add Driver',['class'=>'btn btn-primary','name'=>'form1','style'=>'font-size:3vw; padding:20px;margin: 30px;']) !!}
    {!! Form::close() !!}
    <?php $monate = array('Januar' => "Januar",
        'Februar' => "Februar",
        'M&auml;rz' => "M&auml;rz",
        'April' => "April",
        "Mai" => "Mai",
        "Juni" => "Juni",
        "Juli" => "Juli",
        "August" => "August",
        "September" => "September",
        "Oktober" => "Oktober",
        "November" => "November",
        "Dezember" => "Dezember");
    $driversArray = array();
    foreach ($drivers as $driver) {
        $driversArray[$driver->id] = $driver->name;
        //  array_push($driversArray, [ $driver->id => $driver->name]);
    }
    ?>
    <h5 style="font-size:4vw; font-weight: bold; text-align: center;">Add new Payment's slip</h5>
    <br>
    {!! Form::open(['method'=>'POST','action'=>'AdminDriversController@store','files'=>true ]) !!}
    {!! form::label('monat','Monat :',['style'=>'font-size:3vw;margin: 20px ;']) !!}
    {!! form:: select('monat',$monate,['class'=>'form-control']) !!}
    {!! form::label('due_date','Due Date :',['style'=>'font-size:3vw; margin: 20px ;']) !!}
    {!! form::date('due_date',null,['class'=>'form-control','style'=>'font-size:3vw;']) !!}
    {!! form::label('driver_id','Driver :',['style'=>'font-size:3vw;margin: 20px ;']) !!}
    {!! form:: select('driver_id',$driversArray,['class'=>'form-control']) !!}
    {!! form::hidden('company_id', auth()->user()->id ,)!!}
    {!! form::label('file','Lohnzettel :',['style'=>'font-size:3vw;margin: 20px ;']) !!}
    {!! form::file('file',['class'=>'form-control','style'=>'font-size:3vw;']) !!}
    {!! form::submit('Add Pay slip',['class'=>'btn btn-primary','name'=>'form2' ,'style'=>'font-size:3vw; padding:20px;margin: 30px;']) !!}
    {!! Form::close() !!}
@stop

