@extends('farmer.farmer_layout')
@section('content')
<div class="panel panel-success">
    <div class="panel-heading">
        <strong>{{ $section->sectionName}} : Schemes</strong>
    </div>
    <div class="panel-body">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Scheme Name</th>
                    <th>Action</th>
                </tr>
            </thead>
            <!--New-->
            <tbody>
                @foreach($schemes as $var) 
               <tr>
                    <td>{{ $var->schemeName}}</td>
                    @if($farmer->schemes->contains('idScheme', $var->idScheme))
                    <td><a href="#" class="btn btn-danger disabled">Apply Here</a></td>

                    @else
                    <td><a href="{{url('/farmer/scheme/'.$var->idScheme.'/apply')}}" class="btn btn-danger">Apply Here</a></td>
                    @endif
                </tr>
                @endforeach
            </tbody>
            <!--Old-->
            
            
        </table>
    </div>
</div>
@stop