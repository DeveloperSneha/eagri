@extends('authority.blocks.block_layout')
@section('content')
<div class="panel panel-default">
    <div class="panel-heading"><strong>User : {{ $user->userName}}</strong></div>
    <div class="panel-body">
        <table class="table table-bordered table-hover table-striped dataTable" id='table1'>
            <thead>
                <tr>
                    <th>S.No.</th>
<!--                    <th>User</th>-->
                    <th>District</th>
                    <th>Subdivision</th>
                    <th>Block</th>
                    <th>Village Name</th>
                    <th>Section</th>
                    <th>Designation</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php $i=1;?>
                @foreach($userdesig as $var)
                <tr>
                    <td>{{ $i }}</td>
                    <td>{{$var->district->districtName }}</td>
                    <td>{{ $var->subdivision->subDivisionName}}</td>
                    <td>{{ $var->block->blockName}}</td>
                    <td>{{ $var->village->villageName}}</td>
                    <td>{{$var->designation->section->sectionName }}</td>
                    <td>{{$var->designation->designationName }}</td>
                    <td><a href='{{url('/authority/blocks/viuser/'.$var->iddesgignationdistrictmapping.'/edit')}}' class="btn btn-xs btn-warning">Edit</a>
                    </td>
                </tr>
                <?php $i++; ?>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@stop