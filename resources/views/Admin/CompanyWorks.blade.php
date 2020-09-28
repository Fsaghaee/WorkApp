@extends('Layout.pageLayout')
@section('centercontent')
    <div style="margin:0 5px;background-color: gray;color: white;">

        <div style="margin: 0;width: 100%; background-color: gray; width: 100%; height: 50px;color: white;">

            <div id="summeryDiv" style="padding: 10px; display: inline-block;"><h4> Summery </h4></div>
            <div id="unknownDiv" style="padding: 10px; display: inline-block;"><h4> Unknown Orders </h4></div>
        </div>


        <div id="unknown" style="display: none;">

            <?php
            $templocation = array("" => 'Select/Auswählen', 'Klosterneuburg' => 'Klosterneuburg', 'Wien' => 'Wien', 'Tulln' => 'Tulln');
            $tempaccounts = array("" => 'Select/Auswählen', 'FarzadU1' => 'FarzadU1', 'FarzadU2' => 'FarzadU2', 'FarzadU3' => 'FarzadU3', 'FarzadU4' => 'FarzadU4', 'FarzadU5' => 'FarzadU5', 'FarzadU6' => 'FarzadU6', 'FarzadS' => 'FarzadS');

            ?>

            {!! Form::open(array('method'=>'POST','action'=>'CompanyWorksController@store','style'=>'font-size:4vw;margin: 30px;','onsubmit'=>'validateForm()')) !!}
            {!! form::label('working_day','Date/Datum :') !!}
            {!! form::date('working_day',null,array('class'=>'form-control')) !!}
            {!! form::label('orders','Orders/Bestellungen :') !!}
            {!! form::text('orders',null,['class'=>'form-control' ,'style'=>'font-size:4vw;','placeholder'=>'0','required']) !!}
            {!! form::label('working_account','Account/Konto :') !!}
            {!! form:: select('working_account',$tempaccounts,array('class'=>'form-control','id'=>'account')) !!}
            {!! form::label('location','Locations/Ort :') !!}
            {!! form::select('location',$templocation,array('class'=>'form-control','id'=>'locations')) !!}
            {!! form::hidden('company_id', auth()->user()->id ,['class'=>'form-control']) !!}
            {!! form::submit('Add Orders',['class'=>'btn btn-primary','style'=>'font-size:4vw; background-color: lightblue;color:black; padding:10px 20px;margin: 30px 5px;']) !!}
            {!! Form::close() !!}

        </div>
        <div id="summery">

            <?php
            echo '<div class="row" style="text-align: center;">';
            echo '<div class="col-6" >';
            echo '<h7 style="font-weight:600;">Klosterneuburg</h7>';
            echo '<div  style="overflow-y: scroll;display: block;height: 230px;">';
            echo '<table style="width: 100%; text-align: center !important;padding: 10px;margin: 5px;">';
            $border = "";
            foreach ($klosSum as $t) {

                if ((date('m-d', strtotime($t->working_day)) == date('m-t', strtotime($t->working_day))) || (date('m-d', strtotime($t->working_day)) == date('m-15', strtotime($t->working_day)))) {
                    $border = "border-top: 4px solid black; padding-top : 5px;";
                } else {
                    $border = "";
                }


                if (($t->total * 5.4) < 60) {
                    echo '<tr>';
                    echo '<td  style=" padding-left: 20px;padding-right: 90px; background-color: #57b846;' . $border . ' ">' . date('m-d D', strtotime($t->working_day)) . ' </td><td style="padding-left: 90px;padding-right: 90px;background-color: #57b846; ' . $border . ' "> ' . $t->total . '</td>';
                    echo '</tr>';
                } else {
                    echo '<tr>';
                    echo '<td style="padding-left: 20px;padding-right: 90px;' . $border . '">' . date('m-d D', strtotime($t->working_day)) . ' </td><td style="padding-left: 90px;padding-right: 90px;' . $border . ' "> ' . $t->total . '</td>';
                    echo '</tr>';
                }


            }
            echo '</table>';
            echo '</div>';
            echo '</div>';
            echo '<div class="col-6">';

            echo '<h7 style="font-weight:600;">Wien</h7>';
            echo '<div  style="overflow-y: scroll;display: block;height: 230px;">';
            echo '<table style="width: 100%; text-align: center !important;padding: 10px;margin: 5px;">';
            foreach ($WienSum as $t) {
                echo '<tr>';
                echo '<td style="padding-left: 20px;padding-right: 20px;">' . date('m-d D', strtotime($t->working_day)) . ' </td><td style="padding-left: 90px;padding-right: 90px;"> ' . $t->total . '</td>';
                echo '</tr>';
            }
            echo '</table>';
            echo '</div></div></div>';
            echo '<div class="row">';
            echo '<div class="col-6">';
            echo '<div  style="overflow-y: scroll;display: block;height: 190px;">';
            echo '<table style="width: 100%; text-align: center !important;padding: 10px;margin: 5px;">';
            foreach ($avgKlos as $x) {

                if (round($x->av, 2) < 14.8) {
                    echo '<tr>';
                    echo '<td style="padding-left: 90px;padding-right: 90px; background-color: slategray;">' . $x->day . ' </td><td style="padding-left: 90px;padding-right: 90px;background-color: slategray;"> ' . round($x->av, 2) . '</td>';
                    echo '</tr>';
                } else {
                    echo '<tr>';
                    echo '<td style="padding-left: 90px;padding-right: 90px; background-color: #117a8b;">' . $x->day . ' </td><td style="padding-left: 90px;padding-right: 90px;background-color: #117a8b;"> ' . round($x->av, 2) . '</td>';
                    echo '</tr>';
                }


            }
            echo '</table>';
            echo '</div></div>';
            echo '<div class="col-6">';
            echo '<div  style="overflow-y: scroll;display: block;height: 190px;">';
            echo '<table style="width: 100%; text-align: center !important;padding: 10px;margin: 5px;">';
            foreach ($avgWien as $x) {
                echo '<tr>';
                echo '<td style="padding-left: 90px;padding-right: 90px;">' . $x->day . ' </td><td style="padding-left: 90px;padding-right: 90px;"> ' . round($x->av, 2) . '</td>';
                echo '</tr>';

            }
            echo '</table>';
            echo '</div></div></div></div>';


            $total = 0;
            $workingDay = null;
            $workingDay = null;
            ?>

            <br>
            <div class="row">
                <div class="col-3">
                    <select id="inputDay" onclick="DaySearch()"
                            style="margin-top: 20px; background-color: gray;color: white;padding-left: 15px; font-size: 1vw;margin-left: 5px;">
                        <option value="">Select</option>
                        <option value="Mon">Mon</option>
                        <option value="Tue">Din</option>
                        <option value="Wed">Mit</option>
                        <option value="Thu">Don</option>
                        <option value="Fri">Fri</option>
                        <option value="Sat">Som</option>
                        <option value="Sun">Son</option>
                    </select><br>

                </div>
                <div class="col-3">
                    <input type="text" id="inputName"
                           style="padding-left: 15px; margin-top: 10px; background-color: gray;color: white;margin-left: 5px;"
                           onkeyup="NameSearch()" placeholder="Name"/><br>
                </div>
                <div class="col-3">

                    <select id="inputLocation" onclick="LocationSearch()"
                            style="margin-top: 20px; font-size: 1vw;background-color: gray;margin-left: 5px;color: white;padding-left: 15px;">
                        <option value="">Select</option>
                        <option value="K">Klosterneuburg</option>
                        <option value="W">Wien</option>
                    </select><br>

                </div>
                <div class="col-3">
                    <input type="text"
                           style="margin-top: 20px;background-color: gray;margin-left: 5px;color: white;padding-left: 15px;"
                           id="inputAccount" onkeyup="AccountSearch()" placeholder="Account"/>
                </div>
            </div>
            <div style="overflow-y: scroll; display: block; height: 800px;">
                <table
                    style="height: 350px;background-color: gray; text-align: center !important;padding: 10px;margin: 10px;width: 100%;"
                    id="driverTable">

                    @foreach($allworks as $work)
                        <?php
                        $color = '';
                        if (date('D', strtotime($work->working_day)) == 'Sun' || date('D', strtotime($work->working_day)) == 'Sat') {
                            $color = '#57b846';
                        } else {
                            $color = 'gray';
                        }
                        $workingDay = $work->working_day;
                        ?>
                        <tr style=" background-color:<?php echo $color ?>; text-align: center;">
                            <td style="padding:7px 10px;">{{date('M-d', strtotime($work->working_day))}} </td>
                            <td style="padding:7px 20px;">{{date('D', strtotime($work->working_day))}} </td>

                            <td style="padding:0 20px;"> {{$work->name}} </td>
                            <?php
                            if ($work->location == 'Klosterneuburg') {
                                echo '<td style="background-color: #6c757d;padding:0 20px;">' . $work->location[0] . '</td>';
                            } elseif ($work->location == 'Wien') {
                                echo '<td style="background-color: #1e7e34;padding:0 20px;">' . $work->location[0] . '</td>';
                            }
                            ?>
                            <td style="padding: 0 20px;"> {{$work->working_account}} </td>
                            <td style="border-left: #000000 2px solid;padding: 0 20px;"> {{$work->orders}} </td>
                            <td> {{$work->wetter_main}} </td>
                            <td> {{$work->wetter_temp}} </td>
                            <td>
                                <form style="padding:0 30px;" action="{{ route('company-works.destroy', $work->id) }}"
                                      method="POST">
                                    @method('DELETE')
                                    @csrf
                                    <button style="color: lightgray;padding-left: 25%;">X</button>
                                </form>


                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>

            <br>

            <script>

                var something01 = document.getElementById('summeryDiv');

                something01.style.cursor = 'pointer';
                something01.onclick = function () {
                    var x = document.getElementById('summery');
                    if (x.style.display === "none") {
                        x.style.display = "block";
                    } else {
                        x.style.display = "none";
                    }
                };
                var something01 = document.getElementById('unknownDiv');

                something01.style.cursor = 'pointer';
                something01.onclick = function () {
                    var x = document.getElementById('unknown');
                    if (x.style.display === "none") {
                        x.style.display = "block";
                    } else {
                        x.style.display = "none";
                    }
                };

                function DaySearch() {
                    var input, filter, table, tr, td, i, txtValue;
                    input = document.getElementById("inputDay");
                    filter = input.value.toUpperCase();
                    table = document.getElementById("driverTable");
                    tr = table.getElementsByTagName("tr");
                    for (i = 0; i < tr.length; i++) {
                        td = tr[i].getElementsByTagName("td")[1];
                        if (td) {
                            txtValue = td.textContent || td.innerText;
                            if (txtValue.toUpperCase().indexOf(filter) > -1) {
                                tr[i].style.display = "";
                            } else {
                                tr[i].style.display = "none";
                            }
                        }
                    }
                }

                function NameSearch() {
                    var input, filter, table, tr, td, i, txtValue;
                    input = document.getElementById("inputName");
                    filter = input.value.toUpperCase();
                    table = document.getElementById("driverTable");
                    tr = table.getElementsByTagName("tr");
                    for (i = 0; i < tr.length; i++) {
                        td = tr[i].getElementsByTagName("td")[2];
                        if (td) {
                            txtValue = td.textContent || td.innerText;
                            if (txtValue.toUpperCase().indexOf(filter) > -1) {
                                tr[i].style.display = "";
                            } else {
                                tr[i].style.display = "none";
                            }
                        }
                    }
                }

                function LocationSearch() {
                    var input, filter, table, tr, td, i, txtValue;
                    input = document.getElementById("inputLocation");
                    filter = input.value.toUpperCase();
                    table = document.getElementById("driverTable");
                    tr = table.getElementsByTagName("tr");
                    for (i = 0; i < tr.length; i++) {
                        td = tr[i].getElementsByTagName("td")[3];
                        if (td) {
                            txtValue = td.textContent || td.innerText;
                            if (txtValue.toUpperCase().indexOf(filter) > -1) {
                                tr[i].style.display = "";
                            } else {
                                tr[i].style.display = "none";
                            }
                        }
                    }
                }


                function AccountSearch() {
                    var input, filter, table, tr, td, i, txtValue;
                    input = document.getElementById("inputAccount");
                    filter = input.value.toUpperCase();
                    table = document.getElementById("driverTable");
                    tr = table.getElementsByTagName("tr");
                    for (i = 0; i < tr.length; i++) {
                        td = tr[i].getElementsByTagName("td")[4];
                        if (td) {
                            txtValue = td.textContent || td.innerText;
                            if (txtValue.toUpperCase().indexOf(filter) > -1) {
                                tr[i].style.display = "";
                            } else {
                                tr[i].style.display = "none";
                            }
                        }
                    }
                }

            </script>
        </div>
@stop
