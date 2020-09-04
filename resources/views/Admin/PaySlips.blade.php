@extends('Layout.pageLayout')

@section('MainPart')
    <div style="margin-left: 20px;  border-bottom: 6px solid green;padding: 10px; ">
        <a style="font-size:5vw; border: 2px solid green; padding: 10px; margin-right: 10px; " href="/logout"> Log
            out </a>
        <a style="font-size:5vw; border: 2px solid green; padding: 10px ; margin-right: 10px; "
           href="{{route('admin-drivers.index')}}"> Drivers </a>
        <a style="font-size:5vw; border: 2px solid green; padding: 10px;margin-right: 10px; " href="/admin"> Main </a>
        <a style="font-size:5vw; border: 2px solid green; padding: 10px; margin-right: 10px;"
           href="{{route('company-works.index')}}"> All orders </a>


    </div>
@stop

@section('centercontent')


    <table style="width: 100%; font-size:2vw; border-top: 6px solid green; margin: 5px; ">


        <tr>

            <th>Driver</th>
            <th>File</th>
            <th>Status</th>
            <th>Due Date</th>
        </tr>


        @foreach($payslips as $pay)
            <tr>

                <td>{{$pay->driver_id}}</td>

                <td><a style="font-size:2vw;" href="{{ $pay->slip_file_location }}"><?php echo str_replace(auth()->user()->id . '_', '', str_replace('.pdf', '', str_replace('payslips/', '', $pay->slip_file_location))); ?></a></td>
                <td> {{$pay->status }}</td>
                <td>{{$pay->due_date}}</td>
<td>
                {!! Form::open(['method' => 'DELETE',
  'route' => ['payments.destroy', $pay->id]]) !!}
                {!! Form::submit('Delete') !!}
                {!! Form::close() !!}

</td>

            </tr>

        @endforeach


    </table>



@stop
