@extends('authority.districts.district_layout')
@section('content')
<div class="row">
    <div class="col-sm-4">
        <div id="piechart_3d" style="height: 300px;"></div>
    </div>
    <div class="col-sm-4">
        <div id='barchart' style="height: 300px;"></div>
    </div>
</div>
<div class="panel panel-default" style="margin-top: 20px;">
    <div class="panel-heading">
        <strong>Farmer Applied All Scheme Status</strong>
    </div>
    <div class="panel-body">
        <div class="table-responsive">
            <table class="table no-margin">
                <thead>
                    <tr>
                        <th>Scheme(Program)</th>
                        <th>Status</th>
                        <th>Complete</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td></td>
                        <td></td>
                        <td>
                            <div class="progress">
                                <div class="progress-bar progress-bar-success progress-bar-striped" role="progressbar"
                                     aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width:40%">
                                    40% Complete (success)
                                </div>
                            </div>

                            <div class="progress">
                                <div class="progress-bar progress-bar-info progress-bar-striped" role="progressbar"
                                     aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width:50%">
                                    50% Complete (info)
                                </div>
                            </div>

                            <div class="progress">
                                <div class="progress-bar progress-bar-warning progress-bar-striped" role="progressbar"
                                     aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width:60%">
                                    60% Complete (warning)
                                </div>
                            </div>

                            <div class="progress">
                                <div class="progress-bar progress-bar-danger progress-bar-striped" role="progressbar"
                                     aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width:70%">
                                    70% Complete (danger)
                                </div>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@stop
@section('script')
<script type="text/javascript">
      google.charts.load("current", {packages:['bar', 'corechart', 'table']});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {
        var record={!! json_encode($user) !!};
       // Create our data table.
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Value');
        data.addColumn('number', 'Status');
        for(var k in record){
            var v = record[k];
            data.addRow([k,v]);
          }
        var options = {
            title: 'Approved Or Rejected Schemes By You In this District',
            slices: {0: {color: 'green'}, 1:{color: 'orange'}, 2:{color: 'red'}},
            is3D: true
        };
        var chart = new google.visualization.PieChart(document.getElementById('piechart_3d'));
        chart.draw(data, options);
      }
    </script>
@stop
