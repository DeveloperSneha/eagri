<!DOCTYPE html>
<html>
    @include('layouts.partials.head')
    <body onload="window.print();">
        <div class="wrapper">
            <!-- Main content -->
            <section class="invoice">
                <!-- title row -->
                <div class="row">
                    <div class="col-xs-12">
                        <h2 class="page-header">
                        </h2>
                    </div>
                    <!-- /.col -->
                </div>
                <!-- info row -->
                <div class="row invoice-info">
                    <table class="table">
                    <!-- <div class="col-xs-4 invoice-col"> -->
                    <tr>
                        <td style="text-align: center;">
                        <address>
                            <img src="{{asset('dist/img/logo.png')}}" >
                        </address>
                    </td>
                    <!-- </div> -->
                    <!-- /.col -->
                    <!-- <div class="col-xs-4 invoice-col"> -->
                    <td> <center>   <address>
                            <strong>GOVERNMENT OF HARYANA<br>
                                DEPARTMENT OF AGRICULTURE<br>
                                AND FARMER WELFARE,<br>
                                HARYANA<br>
                            </strong>
                        </address></center>
                    </td>
                    <!-- </div> -->
                    <!-- /.col -->
                    <!-- <div class="col-xs-4 invoice-col"> -->
                        <td style="text-align: center;">
                        <b>Version NO.: 1.0</b><br>
                        <br>
                        <b>User ID:</b>{{ $fscheme->farmer->aadhaar}}<br>
                    
                    <!-- </div> -->
                </td>
            </tr>
                    <!-- /.col -->
                </table>
                    <!-- /.col -->
                </div>
                <!-- /.row -->

                <!-- Table row -->
                <div class="row">
                    <div class="col-xs-12 table-responsive">
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <th>Name Of Farmer </th>
                                    <td>{{ $fscheme->farmer->name}}</td>
                                </tr>
                                 <tr>
                                    <th>Aadhaar Number</th>
                                    <td>
                                        {{ substr($fscheme->farmer->aadhaar, 0, 2) . str_repeat('X', strlen($fscheme->farmer->aadhaar) - 4) . substr($fscheme->farmer->aadhaar, -2)}}
                                        </td>
                                </tr>
                                <tr>
                                    <th>Mobile No.</th>
                                    
                                    <td>
                                    {{ substr($fscheme->farmer->mobile, 0, 2) . str_repeat('X', strlen($fscheme->farmer->mobile) - 4) . substr($fscheme->farmer->mobile, -2)}}
                                    </td>
                                </tr>
                                
                                
                                <tr>
                                    <th>Scheme Name</th>
                                    <td>{{ $fscheme->scheme->schemeName}}</td>
                                </tr>
                                <tr>
                                    <th>Program Name</th>
                                    <td>{{ $fscheme->program->programName}}</td>
                                </tr>
                                <tr>
                                    <th>Applied Date And Time</th>
                                    <td>{{ $fscheme->created_at }}</td>
                                </tr>
                                <tr>
                                    <th>Area (In Acres)</th>
                                    <td>{{ $fscheme->areaApplied }}</td>
                                </tr>
                                
                            </tbody>
                        </table>
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->

                
            </section>
            <!-- /.content -->
        </div>
        <!-- ./wrapper -->
    </body>
</html>
