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
                    <div class="col-sm-4 invoice-col">
                        <address>
                            <img src="{{asset('dist/img/logo.png')}}" >
<!--                            <strong>Admin, Inc.</strong><br>
                            795 Folsom Ave, Suite 600<br>
                            San Francisco, CA 94107<br>
                            Phone: (804) 123-5432<br>
                            Email: info@almasaeedstudio.com-->
                        </address>
                    </div>
                    <!-- /.col -->
                    <div class="col-sm-4 invoice-col">
                        <address>
                            <strong>GOVERNMENT OF HARYANA</strong><br>
                            DEPARTMENT OF AGRICULTURE<br>
                            AND FARMER WELFARE,<br>
                            HARYANA<br>
                            
                        </address>
                    </div>
                    <!-- /.col -->
                    <div class="col-sm-4 invoice-col">
                        <b>Version NO.: 1.0</b><br>
                        <br>
                        <b>User ID:</b> {{ $fscheme->farmer->aadhaar}}<br>
                    </div>
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
                                    <td>{{ str_limit($fscheme->farmer->aadhaar, $limit = 2, $end = 'xxxxxxxxxx') }}</td>
                                </tr>
                                <tr>
                                    <th>Mobile No.</th>
                                    <td>{{ str_limit($fscheme->farmer->mobile, $limit = 2, $end = 'xxxxxxxxx') }}</td>
                                </tr>
                                <tr>
                                    <th>Unique Scheme Id Number</th>
                                    <td>{{ $fscheme->scheme->idScheme}}{{$fscheme->farmer->mobile}}{{$fscheme->farmer->aadhaar}}</td>
                                </tr>
                                <tr>
                                    <th>Applied Date And Time</th>
                                    <td>{{ $fscheme->created_at }}</td>
                                </tr>
                                <tr>
                                    <th>Scheme Name</th>
                                    <td>{{ $fscheme->scheme->schemeName}}</td>
                                </tr>
                                <tr>
                                    <th>Area (In Acres)</th>
                                    <td>{{ $fscheme->areaApplied }}</td>
                                </tr>
                                <tr>
                                    <th>Type Of Scheme</th>
                                    <td>{{ $fscheme->scheme->section->sectionName}}</td>
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
