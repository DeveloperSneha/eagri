@extends('authority.districts.district_layout')
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
                    <th>Program Name</th>
                    <th>District Name</th>
                    <!--<th>Block Name</th>-->
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
                    <td>{{ $var->programName }}</td>
                    <td>{{$var->districtName}}</td>
                    <td> <a href='{{url('authority/districts/aprvrejectscheme/'.$var->idSchemeappreject.'/view')}}' class="btn btn-xs btn-warning">View</a> </td>
                </tr>
                @endforeach
                @endif
                @if(isset($sch_with_noresponse))
                @foreach($sch_with_noresponse as $var)
                <tr>
                    <td>{{ $var->idAppliedScheme }}</td>
                    <td>{{$var->name}}</td>
                    <td>{{$var->schemeName}}</td>
                    <td>{{ $var->programName }}</td>
                    <td>{{$var->districtName}}</td>
                    <td> <a href='{{url('authority/districts/aprvrejectscheme/'.$var->idAppliedScheme.'/view')}}' class="btn btn-xs btn-warning">View</a> </td>
                </tr>
                @endforeach
                @endif
                @if(isset($sch_with_lower_response))
                @foreach($sch_with_lower_response as $var)
                <tr>
                    <td>{{ $var->idAppliedScheme }}</td>
                    <td>{{$var->name}}</td>
                    <td>{{$var->schemeName}}</td>
                    <td>{{ $var->programName }}</td>
                    <td>{{$var->districtName}}</td>
                    <td> <a href='{{url('authority/districts/aprvrejectscheme/'.$var->idSchemeappreject.'/viewscheme')}}' class="btn btn-xs btn-warning">View</a> </td>
                </tr>
                @endforeach
                @endif
                @if(isset($sch_with_lowest_response))
                @foreach($sch_with_lowest_response as $var)
                <tr>
                    <td>{{ $var->idAppliedScheme }}</td>
                    <td>{{$var->name}}</td>
                    <td>{{$var->schemeName}}</td>
                    <td>{{ $var->programName }}</td>
                    <td>{{$var->districtName}}</td>
                    <td> <a href='{{url('authority/districts/aprvrejectscheme/'.$var->idSchemeappreject.'/viewscheme')}}' class="btn btn-xs btn-warning">View</a> </td>
                </tr>
                @endforeach
                @endif
            </tbody>
        </table>
    </div>
</div>
@stop