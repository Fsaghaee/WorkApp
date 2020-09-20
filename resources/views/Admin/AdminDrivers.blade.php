@extends('Layout.pageLayout')

@section('centercontent')
    <div style="margin: 20px;">
        <h5 style="font-size:5vw;"> {{auth()->user()->name }}'s Drivers :</h5>
        <br>
        <div style="border-top: 6px solid lightgray ;"></div>
        <table style="width: 98%; font-size:1vw; margin:5px 0; text-align: center;color: white;padding-top: 5px;">

            @foreach($drivers as $driver)
                <tr>
                    <td style="border-bottom: 1px dotted gray;"> {{$driver->name}} </td>
                    <td style="border-bottom: 1px dotted gray;"> {{$driver->family}} </td>
                    <td style="border-bottom: 1px dotted gray;"> {{$driver->address}}</td>
                    <td style="border-bottom: 1px dotted gray;">  <?php echo strstr($driver->tell, '6'); ?></td>
                    <td style="border-bottom: 1px dotted gray;"> {{$driver->bank_account}}</td>
                    <td style="border-bottom: 1px dotted gray;"> {{$driver->email}}</td>
                    <td style="border-bottom: 1px dotted gray;"> {{$driver->birthday}}</td>
                    <td style="border-bottom: 1px dotted gray;"> {{$driver->insurance_number}}</td>
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


@stop

