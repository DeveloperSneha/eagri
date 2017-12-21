@extends('authority.authority_layout')
@section('content')
<div class="panel panel-default">
    <div class="panel-heading"><strong>Schemes for Apporval</strong></div>
    <div class="panel-body">
        <table class="table table-bordered" id='table1'>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Farmer Name</th>
                    <th>Scheme Name</th>
                    <th>District Name</th>
                    <th>Block Name</th>
                    <th>Village Name</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($schemes as $var)
                <tr>
                    <td>{{ $var->idAppliedScheme }}</td>
                    <td>{{$var->name}}</td>
                    <td>{{$var->schemeName}}</td>
                    <td>{{$var->districtName}}</td>
                    <td>{{$var->blockName}}</td>
                    <td>{{$var->villageName}}</td>
                    <td> <a href='{{url('authority/schemes/'.$var->idAppliedScheme)}}' class="btn btn-xs btn-warning">View</a> </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@stop