@extends('Layout.pageLayout')
@section('MainPart')
    <h5> {{auth()->user()->name }}'s Drivers :</h5>
    <table style="width: 500px;">
        <tr>
            <th> Name</th>
            <th> Family</th>
            <th> ID</th>
            <th> Address</th>
            <th> Account</th>
        </tr>
        @foreach($drivers as $driver)
            <tr>
                <td> {{$driver->name}} </td>
                <td> {{$driver->family}} </td>
                <td> {{$driver->id}} </td>
                <td> {{$driver->address}}
                <td> {{$driver->working_account}} </td>
            </tr>
        @endforeach
    </table>
    <br>
@stop
@section('centercontent')
    {!! Form::open(['method'=>'POST','action'=>'AdminDriversController@store']) !!}
    {!! form::label('name','Name :') !!}
    {!! form::text('name',null,['class'=>'form-control']) !!}
    {!! form::label('family','Family :') !!}
    {!! form::text('family',null,['class'=>'form-control']) !!}
    {!! form::hidden('company_id', auth()->user()->id ,['class'=>'form-control']) !!}
    <br>
    {!! form::label('birthday','Birthday :') !!}
    {!! form::date('birthday',null,['class'=>'form-control']) !!}
    {!! form::label('address','Address :') !!}
    {!! form::text('address',null,['class'=>'form-control']) !!}
    <br>

    {!! form::label('insurance_number','Insurance Number :') !!}
    {!! form::text('insurance_number',null,['class'=>'form-control']) !!}
    <br>
    {!! form::label('payment_method','Payment Method:') !!}
    {!! form:: select('payment_method',array('bar'=>'Bar','bank transfer'=>'Bank transfer')) !!}
    {!! form::label('bank_account','Bank Account :') !!}
    {!! form::text('bank_account',null,['class'=>'form-control']) !!}
    <br>
    {!! form::label('tell','Tell :') !!}
    {!! form::text('tell',null,['class'=>'form-control']) !!}
    {!! form::label('email','Email :') !!}
    {!! form::text('email',null,['class'=>'form-control']) !!}
    <br>
    <br>
    {!! form::label('password','Password :') !!}
    {!! form::password('password',null,['class'=>'form-control']) !!}
    {!! form::submit('Add Driver',['class'=>'btn btn-primary','name'=>'form1']) !!}
    {!! Form::close() !!}
@stop
@section('footer')
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
    {!! Form::open(['method'=>'POST','action'=>'AdminDriversController@store','files'=>true]) !!}
    {!! form::label('monat','Monat :') !!}
    {!! form:: select('monat',$monate) !!}
    {!! form::label('due_date','Due Date :') !!}
    {!! form::date('due_date',null,['class'=>'form-control']) !!}
    {!! form::label('driver_id','Driver :') !!}
    {!! form:: select('driver_id',$driversArray) !!}
    {!! form::hidden('company_id', auth()->user()->id ,['class'=>'form-control']) !!}
    {!! form::label('file','Lohnzettel :') !!}
    {!! form::file('file',['class'=>'form-control']) !!}
    {!! form::submit('Add Driver',['class'=>'btn btn-primary','name'=>'form2']) !!}
    {!! Form::close() !!}
@stop

