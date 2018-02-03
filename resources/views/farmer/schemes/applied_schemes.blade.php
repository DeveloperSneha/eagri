@extends('farmer.farmer_layout')
@section('content')
<div class="panel panel-default">
    <div class="panel-heading">
        <strong>Your Applied Schemes</strong>
    </div>
    <div class="panel-body">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Scheme Name</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($fschemes as $var)
                <tr>
                    <td><strong>{{ $var->program->programName}} : </strong>{{ $var->scheme->schemeName}}</td>
                    <td>
                        <a href="{{url('/farmer/prostatus/'.$var->idProgram)}}" class="btn btn-xs btn-primary">View Status</a>
                        <a href="{{action('Farmer\FarmerSchemeController@printDetails', $var->program)}}" class="btn btn-xs btn-danger" target="_blank">Print</a>
                        <a href="{{action('Farmer\FarmerSchemeController@downloadPDF', $var->program)}}" class="btn btn-xs btn-danger" target="_blank">Download PDF</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@stop