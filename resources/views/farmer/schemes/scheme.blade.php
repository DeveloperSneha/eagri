@extends('farmer.farmer_layout')
@section('content')
<div class="panel panel-default">
    <div class="panel-heading">
        <strong>{{ $section->sectionName}} : Schemes</strong>
    </div>
    <div class="panel-body">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Available Scheme Programs</th>
                    <th>Action</th>
                </tr>
            </thead>
            <!--New-->
            <tbody>
                @foreach($schemes as $var) 
                <tr>
                    <td><strong>{{ $var->programName}} : </strong>{{ $var->schemeName}}</td>
                    @if($farmer->schemes->contains('idProgram', $var->idProgram))
                    <td><a href="#" class="btn btn-alert disabled">Already Applied</a></td>
                    @else
                    <td><a href="{{url('/farmer/program/'.$var->idProgram.'/apply')}}" class="btn btn-danger">Apply Scheme</a></td>
                    @endif
                </tr>
                @endforeach
            </tbody>
            <!--Old-->


        </table>
    </div>
</div>
@stop