@extends('Layout.pageLayout')

@section('centercontent')
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

    <div class="row">
        <div class="col-5">
            <h5 style="font-size:2vw; font-weight: bold; text-align: center;">Add new Payment's slip</h5>

            <div style="margin: 10px;">
                {!! Form::open(['method'=>'POST','action'=>'PaymentsController@store','files'=>true ]) !!}
                {!! form::label('monat','Monat :',['style'=>'font-size:1vw;']) !!}
                {!! form:: select('monat',$monate,null,array('class'=>'form-control','id'=>'account','style'=>'font-size:1vw; height: 3vw !important;    padding: 0 !important;')) !!}
                {!! form::label('due_date','Due Date :',['style'=>'font-size:1vw;']) !!}
                {!! form::date('due_date',null,['class'=>'form-control','style'=>'font-size:1vw;height: 3vw !important;    padding: 0 !important;']) !!}
                {!! form::label('driver_id','Driver :',['style'=>'font-size:1vw;']) !!}
                {!! form:: select('driver_id',$driversArray,null,array('class'=>'form-control','id'=>'account','style'=>'font-size:1vw; height: 3vw !important;    padding: 0 !important;')) !!}
                {!! form::hidden('company_id', auth()->user()->id ,)!!}
                {!! form::label('file','Lohnzettel :',['style'=>'font-size:1vw;']) !!}
                {!! form::file('file',['class'=>'form-control','style'=>'font-size:1vw;height: 3vw !important;    padding: 3px !important;']) !!}
                {!! form::submit('Add Pay slip',['class'=>'btn btn-primary','name'=>'form2' ,'style'=>'font-size:2vw; padding:20px;margin: 30px;']) !!}
                {!! Form::close() !!}
            </div>
        </div>
        <div class="col-7">

            <table style="width: 100%; font-size:1.2vw; border-top: 6px solid green; margin: 5px 20px; ">


                <tr>

                    <th>Driver</th>
                    <th>File</th>
                    <th>Status</th>
                    <th>Due Date</th>
                    <th>Delete</th>
                </tr>


                @foreach($payslips as $pay)
                    <tr>

                        <td>{{$pay->name}}</td>

                        <td><a style="font-size:1.2vw;color: lightblue;"
                               href="{{ $pay->slip_file_location }}"><?php echo str_replace($pay->driver_id . '_', '', str_replace('.pdf', '', str_replace('payslips/', '', $pay->slip_file_location))); ?></a>
                        </td>
                        <td> {{$pay->status }}</td>
                        <td>{{$pay->due_date}}</td>
                        <td>
                            {!! Form::open(['method' => 'DELETE',
              'route' => ['payments.destroy', $pay->id]]) !!}
                            {!! Form::submit('X',['style'=>'cursor: pointer; width: 40px;font-weight: bold;color: red; background-color: gray;']) !!}
                            {!! Form::close() !!}

                        </td>

                    </tr>

                @endforeach


            </table>
        </div>

    </div>




@stop
