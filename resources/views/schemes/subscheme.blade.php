@extends('layouts.app')
@section('content')
<div class="panel panel-default">
    @if(isset($subscheme))
    <div class="panel-heading">Edit SubScheme : <strong>{{$subscheme->name }}</strong></div>
    @else
    <div class="panel-heading"><strong>Create SubScheme</strong></div>
    @endif
    <div class="panel-body">
        @if(isset($subscheme))
        {{ Form::model( $subscheme, ['route' => ['subschemes.update', $subscheme->id], 'method' => 'put','class'=>'form-horizontal'] ) }}
        @else
        {!! Form::open(['url' => 'subschemes','class'=>'form-horizontal']) !!}
        @endif
        <div class="form-group">
            {!! Form::label('Scheme', null, ['class' => 'col-sm-2 control-label']) !!}
            <div class="col-sm-4">
                {!! Form::select('scheme_id',getMainScheme(), null, ['class' => 'form-control']) !!}
            </div>
        </div>
        <div class="form-group">
            {!! Form::label('SubScheme Name', null, ['class' => 'col-sm-2 control-label']) !!}
            <div class="col-sm-4">
                {!! Form::text('name', null, ['class' => 'form-control','placeholder'=>'Enter Name']) !!}
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-5 col-sm-6">
                @if(isset($subscheme))
                {!!  Form::submit('Update',['class'=>'btn btn-primary'])!!}
                @else
                {!!  Form::submit('Save',['class'=>'btn btn-primary'])!!}
                @endif
            </div>
        </div>
       {!! Form::close() !!}
    </div>
</div>
<div class="panel panel-default">
    <div class="panel-heading"> <strong>SubSchemes</strong></div>
    <div class="panel-body">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($subschemes as $var)
                <tr>
                    <td>{{ $var->id }}</td>
                    <td>{{ $var->name }}</td>
                    <td><a href='{{url('/subschemes/'.$var->id.'/edit')}}' class="btn btn-xs btn-primary">Edit</a>
                        {{ Form::open(['route' => ['subschemes.destroy', $var->id], 'method' => 'delete']) }}
                        <button class="btn btn-xs btn-primary" type="submit">Delete</button>
                        {{ Form::close() }}
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@stop