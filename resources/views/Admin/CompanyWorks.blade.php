<h3>This is the company works page</h3>


<table style="width: 500px;">
    <tr>
        <th> Working Day</th>
        <th> Orders</th>
        <th> Name</th>


    </tr>
    @foreach($allworks as $work)
                <tr>
                    <td>{{date('M',strtotime( $work->working_day ))}}</td>
                    <td> {{$work->working_day}} </td>
                    <td> {{$work->orders}} </td>
                    <td> {{$work->name}} </td>

                </tr>
@endforeach

