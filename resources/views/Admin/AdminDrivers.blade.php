
@extends('Layout.pageLayout')


@section('MainPart')

<h4>this is the main part of drivers' page</h4>
@stop
@section('centercontent')


    {!! Form::open(['method'=>'POST','action'=>'AdminDriversController@store']) !!}

    {!! form::label('name','Name :') !!}
    {!! form::text('name',null,['class'=>'form-control']) !!}

    {!! form::label('family','Family :') !!}
    {!! form::text('family',null,['class'=>'form-control']) !!}
<br>
    {!! form::label('birthday','B irthday :') !!}

    {!! form::date('birthday',null,['class'=>'form-control']) !!}

    {!! form::label('address','Address :') !!}
    {!! form::text('address',null,['class'=>'form-control']) !!}
<br>
    {!! form::label('working_account','Account :') !!}
    {!! form::text('working_account',null,['class'=>'form-control']) !!}

    {!! form::label('insurance_number','Insurance Number :') !!}
    {!! form::text('insurance_number',null,['class'=>'form-control']) !!}
<br>
    {!! form::label('payment_method','Payment :') !!}
    {!! form::text('payment_method',null,['class'=>'form-control']) !!}

    {!! form::label('bank_account','Bank Account :') !!}
    {!! form::text('bank_account',null,['class'=>'form-control']) !!}
<br>
        {!! form::submit('Add Driver',['class'=>'btn btn-primary']) !!}


    {!! Form::close() !!}


@stop
@section('footer')


    <h1> this is the footer of AdminPage Page</h1>

@stop

