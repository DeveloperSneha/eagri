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
                        <b>User ID:</b> {{ $farmer->mobile}}<br>
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
                                    <td>{{ $farmer->name}}</td>
                                </tr>
                                <tr>
                                    <th>Username </th>
                                    <td>{{ $farmer->mobile  }}</td>
                                </tr>
                                <tr>
                                    <th>Password </th>
                                    <td>{{ $password }}</td>
                                </tr>
                                
                            </tbody>
                        </table>
                    </div>
                    
                    <!-- /.col -->
                </div>
                <!-- /.row -->

                
            </section>
            <!-- /.content -->
            <div class="col-xs-12">
                Helpline / Farmers Assistance Number : 0172-2571553<br>
                हेल्पलाइन / किसान सहायता नं: 0172-2571553

            </div>
        </div>
        <!-- ./wrapper -->
    </body>
</html>
