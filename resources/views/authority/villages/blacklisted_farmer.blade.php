@extends('authority.villages.village_layout')
@section('content')
<div class="panel panel-default">
    <div class="panel-heading"><strong>Blacklisted Farmer</strong></div>
    <div class="panel-body">
        <table class="table table-bordered" id='table1'>
            <thead>
                <tr>
                    <th>S.No.</th>
                    <th>Farmer Name</th>
                    <th>District Name</th>
                    <th>Block Name</th>
                    <th>Village Name</th>
                </tr>
            </thead>
            <tbody>
                <?php $i = 1; ?>
                @foreach($farmers as $var)
                <tr>
                    <td>{{ $i}}</td>
                    <td>{{$var->name }}</td>
                    <td>{{$var->district->districtName}}</td>
                    <td></td>
                    <td></td>
                </tr>
                <?php $i++; ?>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@stop