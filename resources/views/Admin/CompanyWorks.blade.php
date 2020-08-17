<h3>This is the company works page</h3>
<table style="width: 500px;">
    <tr>
        <th> Month</th>
        <th> Working Day</th>
        <th> Orders</th>
        <th> Name</th>
        <th> Location</th>
<th>Account</th>
        <th> Weather </th>
        <th> Temp </th>
        <th> Hours </th>
        <th> Break </th>
        <th> Total </th>
        <th> Earned </th>
    </tr>
    <?php
    $total = 0;
    $workingDay = null;
    ?>
    @foreach($allworks as $work)
        <tr>
            <td>{{date('M',strtotime( $work->working_day ))}}</td>
            <td> {{$work->working_day}} </td>
            <td> {{$work->orders}} </td>
            <td> {{$work->name}} </td>
            <td> {{$work->location}} </td>
            <td> {{$work->working_account}} </td>
            <td> {{$work->wetter_main}} </td>
            <td> {{$work->wetter_temp}} </td>
            <td><?php echo abs(strtotime($work->end_working) - strtotime($work->start_working))/(60*60) ?>   </td>
            <td> {{$work->break}} </td>
            <td><?php echo abs(strtotime($work->end_working) - strtotime($work->start_working))/(60*60)- $work->break ?>   </td>
            <td> {{$work->orders * 1.3}}  </td>
        <?php
            $workingDay = $work->working_day;
            $total += $work->orders
            ?>
        </tr>
<?php
if (date('d', strtotime($workingDay)) == 15 || date('d', strtotime($workingDay)) == 1) {
    echo '<tr><td> Total : <td></td></td><td>' . $total . '</td><td>' . $total * 5.4 .' €' . '</td></tr>';
    $workingDay = 0;
}
?>
@endforeach

