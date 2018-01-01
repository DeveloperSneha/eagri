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
                    <td>{{ $var->scheme->schemeName }}</td>
                    <td>
                        <a href="{{action('Farmer\FarmerSchemeController@printDetails', $var->scheme)}}" class="btn btn-sm btn-danger">Print</a>
                        <a href="{{action('Farmer\FarmerSchemeController@downloadPDF', $var->scheme)}}" class="btn btn-sm btn-danger">Download PDF</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@stop