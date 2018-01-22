@extends('authority.subdivisions.subdivision_layout')
@section('content')
<div class="panel panel-default">
    <div class="panel-heading"><strong>Registered Farmer</strong></div>
    <div class="panel-body">
        <table class="table table-bordered" id='table1'>
            <thead>
                <tr>
                    <th>S.No.</th>
                    <th>Farmer Name</th>
                    <th>District Name</th>
                    <th>Subdivision Name</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php $i = 1; ?>
                @foreach($farmers as $var)
                <tr>
                    <td>{{ $i}}</td>
                    <td>{{$var->name }}</td>
                    <td>{{$var->district->districtName}}</td>
                    <td>{{$var->subdivision->subDivisionName}}</td>
                    
                    <td></td>
                </tr>
                <?php $i++; ?>
             @endforeach
            </tbody>
        </table>
    </div>
</div>
@stop

