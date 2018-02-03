@extends('farmer.farmer_layout')
@section('content')
<div class="panel panel-default">
    <div class="panel-heading">
        {{$fscheme->program->programName}} :: {{$fscheme->scheme->schemeName}} : <strong> Status</strong>
    </div>
    <div class="panel-body">
        <div class="table-responsive">
            <table class="table no-margin">
                <thead>
                    <tr>
                        <th></th>
                        <th>Authority</th>
                        <!--<th>Level</th>-->
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($auth_desig as $ad)
                    <tr>
                        <td></td>
                        <td>{{ $ad->designationName}}</td>
                        <!--<td>{{ $ad->level}}</td>-->
                        <td>
                            <?php
                            $apstatus = DB::table('schemeappreject')
                                    ->where('idAppliedScheme', '=', $fscheme->idAppliedScheme)
                                    ->where('idDesignation', '=', $ad->idDesignation)
                                    ->where('status', '=', 'A')
                                    ->get();
                            ?>
                            <?php
                            $rjstatus = DB::table('schemeappreject')
                                    ->where('idAppliedScheme', '=', $fscheme->idAppliedScheme)
                                    ->where('idDesignation', '=', $ad->idDesignation)
                                    ->where('status', '=', 'R')
                                    ->get();
                            ?>
                            @if(count($apstatus)>0)
                            <span class="label label-success">Approved</span>
                            @endif
                            @if(count($apstatus)==0 && count($rjstatus)==0)
                            <!--<span class="label label-info">Processing</span>-->
                            <span class="label label-warning">Pending</span>
                            @endif
                            @if(count($rjstatus)>0)
                            <span class="label label-danger">Rejected</span>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="panel-footer">
        <strong>Final Status : </strong>
        @if($fscheme->status == 'A')
        <span class="label label-success">Approved</span>
        @else @if($fscheme->status == 'R')
        <span class="label label-danger">Rejected</span>
        @else  @if($fscheme->status == 'N')
        <span class="label label-warning">Pending</span>
        @endif
        @endif
        @endif
    </div>
</div>
@stop