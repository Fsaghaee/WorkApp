@extends('Layout.pageLayout')


@section('MainPart')
<a href="/logout" >Log out</a>
    <a href="/admin-drivers"> Drivers</a>
<a href="/company-works"> All orders</a>


<h3>Today : {{date('yy-m-d')}}</h3>


<table style="width: 500px;">
    <tr>
        <th> Working Day </th>
        <th> Orders </th>
        <th> Name </th>


    </tr>
@foreach($works as $work)
    <tr>
        <td> {{$work->working_day}} </td>
        <td> {{$work->orders}} </td>
        <td> {{$work->name}} </td>

    </tr>
@endforeach



@stop
@section('centercontent')



@stop
@section('footer')


@stop
