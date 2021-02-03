@extends('Layout.pageLayout')

@section('centercontent')
    <div style="margin: 20px;">
        <h5 style="font-size:5vw;"> {{auth()->user()->name }}'s Drivers :</h5>
        <br>
        <div style="border-top: 6px solid lightgray ;"></div>
        <table style="width: 98%; font-size:1vw; margin:5px 0; text-align: center;color: black;padding-top: 5px;">

            @foreach($drivers as $driver)
                <tr>
                    <td style="border-bottom: 1px dotted gray;"> {{$driver->id}} </td>
                    <td style="border-bottom: 1px dotted gray;"> {{$driver->name}} </td>
                    <td style="border-bottom: 1px dotted gray;"> {{$driver->family}} </td>
                    <td style="border-bottom: 1px dotted gray;"> {{$driver->address}}</td>
                    <td style="border-bottom: 1px dotted gray;">  <?php echo strstr($driver->tell, '6'); ?></td>
                    <td style="border-bottom: 1px dotted gray;"> {{$driver->bank_account}}</td>
                    <td style="border-bottom: 1px dotted gray;"> {{$driver->email}}</td>
                    <td style="border-bottom: 1px dotted gray;"> {{$driver->birthday}}</td>
                    <td style="border-bottom: 1px dotted gray;"> {{$driver->insurance_number}}</td>
                    <td style="border-bottom: 1px dotted gray;"> {{$driver->pay_order}} €</td>
                </tr>
            @endforeach
        </table>
        <br>
    </div>
    <h5 style="font-size:1.vw;font-weight: bold;text-align: center;width: 100% ">Add new driver</h5>
    <br>
    <div class="row"style="padding: 10px;">
        <div class="col-6">
            {!! Form::open(['method'=>'POST','action'=>'AdminDriversController@store' ,'style'=>'font-size:1vw;']) !!}
            {!! form::label('name','Name :') !!}
            {!! form::text('name',null,['class'=>'form-control' ,'style'=>'font-size:1.2vw;']) !!}
            {!! form::label('family','Family :') !!}
            {!! form::text('family',null,['class'=>'form-control','style'=>'font-size:1.2vw;']) !!}
            {!! form::hidden('company_id', auth()->user()->id ,['class'=>'form-control']) !!}
            {!! form::label('birthday','Birthday :') !!}
            {!! form::date('birthday',null,['class'=>'form-control','style'=>'font-size:1vw;']) !!}
            {!! form::label('address','Address :') !!}
            {!! form::text('address',null,['class'=>'form-control','style'=>'font-size:1.2vw;']) !!}

            {!! form::label('insurance_number','Insurance Number :') !!}
            {!! form::text('insurance_number',null,['class'=>'form-control','style'=>'font-size:1.2vw;']) !!}


        </div>
        <div class="col-6">
            {!! form::label('pay_order','Payment for each order :') !!}
            {!! form::text('pay_order',null,['class'=>'form-control','style'=>'font-size:1.2vw;']) !!}
            {!! form::label('bank_account','Bank Account :') !!}
            {!! form::text('bank_account',null,['class'=>'form-control','style'=>'font-size:1.2vw;']) !!}
            {!! form::label('tell','Tell :') !!}
            {!! form::text('tell',null,['class'=>'form-control','style'=>'font-size:1.2vw;']) !!}
            {!! form::label('email','Email :') !!}
            {!! form::text('email',null,['class'=>'form-control','style'=>'font-size:1.2vw;']) !!}

            {!! form::label('register_date','Register date :') !!}
            {!! form::date('register_date',null,['class'=>'form-control','style'=>'font-size:1vw;']) !!}
            {!! form::label('unregister_date','Unregister date :') !!}
            {!! form::date('unregister_date',null,['class'=>'form-control','style'=>'font-size:1vw;']) !!}
        </div>

        {!! form::hidden('password','Gutefahrt!',['class'=>'form-control']) !!}
        {!! form::submit('Add Driver',['class'=>'btn btn-primary','name'=>'form1','style'=>'font-size:1.5vw; padding:20px;margin-left:20px;background-color: slategray;']) !!}
        {!! Form::close() !!}
    </div>




    <?php

    $t = [];
    foreach ($drivers as $driver){
        $t[$driver->id]=$driver->name.' '.$driver->family ;
    }


    ?>

    <h5 style="font-size:1.vw;font-weight: bold;text-align: center;width: 100% ">Update driver</h5>
    <div class="row"style="padding: 10px;">
        <div class="col-6">
            {!! Form::open(['route'=>['drverUpdate'],'method' => 'PATCH','style'=>'font-size:1vw;']) !!}
            {!! form::label('id','Driver :') !!}
            {!! form::select('id',$t,null,array('placeholder' => 'Select Driver','class' => 'form-control', 'style' => 'font-size:1.2vw;')) !!}
            {!! form::label('birthday','Birthday :') !!}
            {!! form::date('birthday',null,['class'=>'form-control','style'=>'font-size:1vw;']) !!}

            {!! form::label('bank_account','Bank Account :') !!}
            {!! form::text('bank_account',null,['class'=>'form-control','style'=>'font-size:1.2vw;']) !!}
            {!! form::label('tell','Tell :') !!}
            {!! form::text('tell',null,['class'=>'form-control','style'=>'font-size:1.2vw;']) !!}
        </div>
        <div class="col-6">
            {!! form::label('address','Address :') !!}
            {!! form::text('address',null,['class'=>'form-control','style'=>'font-size:1.2vw;']) !!}
            {!! form::label('pay_order','Payment for each order :') !!}
            {!! form::text('pay_order',null,['class'=>'form-control' ,'style'=>'font-size:1.2vw;']) !!}
            {!! form::label('register_date','Register date :') !!}
            {!! form::date('register_date',null,['class'=>'form-control','style'=>'font-size:1vw;']) !!}
            {!! form::label('unregister_date','Unregister date :') !!}
            {!! form::date('unregister_date',null,['class'=>'form-control','style'=>'font-size:1vw;']) !!}
        </div>
    </div>



    {!! form::submit('Update Driver',['class'=>'btn btn-primary','name'=>'form1','style'=>'font-size:1.5vw; padding:20px;margin-left:20px;background-color: slategray;']) !!}
    {!! Form::close() !!}


@stop

