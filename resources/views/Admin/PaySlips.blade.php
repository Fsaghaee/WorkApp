@extends('Layout.pageLayout')


@section('centercontent')



    <?php
    $Temp = array(
        date('M-Y', strtotime(now() . ' -1 month')) => date('M-Y', strtotime(now() . ' -1 month'))
    , date('M-Y', strtotime(now())) => date('M-Y', strtotime(now()))

    , date('M-Y', strtotime(now() . ' -2 month')) => date('M-Y', strtotime(now() . ' -2 month'))
    , date('M-Y', strtotime(now() . ' -3 month')) => date('M-Y', strtotime(now() . ' -3 month'))
    , date('M-Y', strtotime(now() . ' -4 month')) => date('M-Y', strtotime(now() . ' -4 month'))
    , date('M-Y', strtotime(now() . ' -5 month')) => date('M-Y', strtotime(now() . ' -5 month'))
    );

    $driversArray = array();
    foreach ($drivers as $driver) {
        $driversArray[$driver->id] = $driver->name;
        //  array_push($driversArray, [ $driver->id => $driver->name]);
    }

    ?>

    <div class="row">
        <div class="col-3">
            <h5 style="font-size:1vw; font-weight: bold; text-align: center;">Add new Payment's slip</h5>

            <div style="margin: 10px;">
                {!! Form::open(['method'=>'POST','action'=>'PaymentsController@store','files'=>true ]) !!}
                {!! form::label('file','Lohnzettel :',['style'=>'font-size:1vw;']) !!}
                {!! form::file('file',['class'=>'form-control','id'=>'myPdf','style'=>'font-size:1vw;height: 2vw !important;    padding: 3px !important;']) !!}
                {!! form::label('monat','Monat :',['style'=>'font-size:1vw;']) !!}
                {!! form:: select('monat',$Temp,null,array('class'=>'form-control','id'=>'account','style'=>'font-size:1vw; height: 2vw !important;    padding: 0 !important;')) !!}
                {!! form::label('due_date','Due Date :',['style'=>'font-size:1vw;']) !!}
                {!! form::date('due_date',null,['class'=>'form-control','value '=>  date('Y-m-15', strtotime(now() . ' +1 month')),'style'=>'font-size:1vw;height: 2vw !important;    padding: 0 !important;']) !!}
                {!! form::label('driver_id','Driver :',['style'=>'font-size:1vw;']) !!}
                {!! form:: select('driver_id',$driversArray,null,array('class'=>'form-control','id'=>'account','style'=>'font-size:1vw; height: 2vw !important;    padding: 0 !important;')) !!}
                {!! form::hidden('company_id', auth()->user()->id ,)!!}

                {!! form::submit('Add Pay slip',['class'=>'btn btn-primary','name'=>'form2' ,'style'=>'font-size:1vw; padding:10px;margin: 20px;']) !!}
                {!! Form::close() !!}
            </div>
        </div>
        <div class="col-5">
            <canvas id="pdfViewer"></canvas>

        </div>
        <div class="col-4">

            <table style="width: 100%; font-size:1vw; border-top: 6px solid green;padding: 10px; ">


                <tr>

                    <th>Driver</th>
                    <th>File</th>
                    <th>Status</th>
                    <th>Due Date</th>
                    <th>Delete</th>
                </tr>


                @foreach($payslips as $pay)
                    <tr style="margin: 0;">

                        <td style="font-size: .6vw;">{{$pay->name}}</td>

                        <td><a style="font-size:0.6vw;color: blue;"
                               href="{{ $pay->slip_file_location }}"><?php echo str_replace($pay->driver_id . '_', '', str_replace('.pdf', '', str_replace('payslips/', '', $pay->slip_file_location))); ?></a>
                        </td>
                        <td style="font-size: 0.6vw;"> {{$pay->status }}</td>
                        <td style="font-size: 0.6vw;">{{$pay->due_date}}</td>
                        <td style="font-size: 0.6vw;">
                            {!! Form::open(['method' => 'DELETE',
              'route' => ['payments.destroy', $pay->id]]) !!}
                            {!! Form::submit('X',['style'=>'cursor: pointer; width: 40px;font-weight: bold;color: red; background-color: white;']) !!}
                            {!! Form::close() !!}

                        </td>

                    </tr>

                @endforeach


            </table>
        </div>

    </div>



    <script>

        // Loaded via <script> tag, create shortcut to access PDF.js exports.
        var pdfjsLib = window['pdfjs-dist/build/pdf'];
        // The workerSrc property shall be specified.
        pdfjsLib.GlobalWorkerOptions.workerSrc = 'https://mozilla.github.io/pdf.js/build/pdf.worker.js';


        $("#myPdf").on("change", function (e) {

            var file = e.target.files[0]
            if (file.type == "application/pdf") {
                var fileReader = new FileReader();
                fileReader.onload = function () {
                    var pdfData = new Uint8Array(this.result);
                    // Using DocumentInitParameters object to load binary data.
                    var loadingTask = pdfjsLib.getDocument({data: pdfData});
                    loadingTask.promise.then(function (pdf) {
                        console.log('PDF loaded');

                        // Fetch the first page
                        var pageNumber = 1;
                        pdf.getPage(pageNumber).then(function (page) {
                            console.log('Page loaded');

                            var scale = 1.5;
                            var viewport = page.getViewport({scale: scale});

                            // Prepare canvas using PDF page dimensions
                            var canvas = $("#pdfViewer")[0];
                            var context = canvas.getContext('2d');
                            canvas.height = viewport.height;
                            canvas.width = viewport.width;

                            // Render PDF page into canvas context
                            var renderContext = {
                                canvasContext: context,
                                viewport: viewport
                            };
                            var renderTask = page.render(renderContext);
                            renderTask.promise.then(function () {
                                console.log('Page rendered');
                            });
                        });
                    }, function (reason) {
                        // PDF loading error
                        console.error(reason);
                    });
                };
                fileReader.readAsArrayBuffer(file);
            }
        });
    </script>

@stop
