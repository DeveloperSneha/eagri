@extends('authority.authority_layout')
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
                    <td>{{$var->applied_scheme->farmer->name}}</td>
                    <td>{{$var->applied_scheme->scheme->schemeName}}</td>
                    <td>{{$var->applied_scheme->farmer->district->districtName}}</td>
                    <td>{{$var->applied_scheme->farmer->block->blockName}}</td>
                    <td>{{$var->applied_scheme->farmer->village->villageName}}</td>
                </tr>
                @endforeach
                <?php $i++; ?>
            </tbody>
        </table>
    </div>
</div>
@stop