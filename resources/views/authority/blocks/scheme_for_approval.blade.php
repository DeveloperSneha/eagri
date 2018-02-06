@extends('authority.blocks.block_layout')
@section('content')
<div class="panel panel-default">
    <div class="panel-heading"><strong>Schemes for Apporval</strong></div>
    <div class="panel-body">
        <table class="table table-bordered" id='table1'>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Farmer Name</th>
                    <th>Scheme</th>
                    <th>Program</th>
                    <th>District</th>
                    <th>Subdivision</th>
                    <th>Block</th>
                    <th>Village</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @if(isset($schemes))
                @foreach($schemes as $var)
                <tr>
                    <td>{{ $var->idAppliedScheme }}</td>
                    <td>{{$var->name}}</td>
                    <td>{{$var->schemeName}}</td>
                    <td>{{$var->programName}}</td>
                    <td>{{$var->districtName}}</td>
                    <td>{{$var->subDivisionName}}</td>
                    <td>{{$var->blockName}}</td>
                    <td>{{$var->villageName}}</td>
                    <td> <a href='{{url('authority/blocks/approvescheme/'.$var->idSchemeappreject.'/viewscheme')}}' class="btn btn-xs btn-warning">View</a> </td>
                </tr>
                @endforeach
                @endif
                @if(isset($sch_with_noresponse))
                @foreach($sch_with_noresponse as $var)
                <tr>
                    <td>{{ $var->idAppliedScheme }}</td>
                    <td>{{$var->name}}</td>
                    <td>{{$var->schemeName}}</td>
                    <td>{{$var->programName}}</td>
                    <td>{{$var->districtName}}</td>
                    <td>{{$var->blockName}}</td>
                    <td>{{$var->villageName}}</td>
                    <td> <a href='{{url('authority/blocks/approvescheme/'.$var->idAppliedScheme.'/view')}}' class="btn btn-xs btn-warning">View</a> </td>
                </tr>
                @endforeach
                @endif
            </tbody>
        </table>
    </div>
</div>
@stop