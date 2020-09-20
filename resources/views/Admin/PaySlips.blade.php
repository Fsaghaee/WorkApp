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
    <h5 style="font-size:4vw; font-weight: bold; text-align: center;">Add new Payment's slip</h5>

    <div style="margin: 10px;">
    {!! Form::open(['method'=>'POST','action'=>'PaymentsController@store','files'=>true ]) !!}
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
    </div>
    <table style="width: 100%; font-size:2vw; border-top: 6px solid green; margin: 5px 20px; ">


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

                <td><a style="font-size:2vw;color: lightblue;"
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



@stop
