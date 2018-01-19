@extends('authority.subdivisions.subdivision_layout')
@section('content')
<div class="panel panel-default">
    <div class="panel-heading"><strong>Rejected Scheme</strong></div>
    <div class="panel-body">
        <table class="table table-bordered" id='table1'>
            <thead>
                <tr>
                    <th>S.No.</th>
                    <th>Farmer Name</th>
                    <th>Scheme Name</th>
                    <th>District Name</th>
                    <th>Block Name</th>
                    <th>Village Name</th>
                </tr>
            </thead>
            <tbody>
                <?php $i = 1; ?>
                @foreach($schemes as $var)
                <tr>
                    <td>{{ $i}}</td>
                    <td>{{$var->name }}</td>
                    <td>{{$var->schemeName }}</td>
                    <td>{{$var->districtName }}</td>
                    <td>{{$var->blockName }}</td>
                    <td>{{$var->villageName }}</td>
                </tr>
                <?php $i++; ?>
                @endforeach
                
            </tbody>
        </table>
    </div>
</div>
@stop