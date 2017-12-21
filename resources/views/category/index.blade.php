@extends('layouts.app')
@section('content')
<div class="panel panel-default">
    @if(isset($category))
    <div class="panel-heading">Edit Item : <strong>{{$category->categoryName }}</strong></div>
    @else
    <div class="panel-heading"><strong>Create Item</strong></div>
    @endif
    <div class="panel-body">
        @if(isset($category))
        {!! Form::model( $category, ['route' => ['categories.update', $category->idCategory], 'method' => 'patch','class'=>'form-horizontal'] ) !!}
        @else
        {!! Form::open(['url' => 'categories','class'=>'form-horizontal']) !!}
        @endif
        <div class="form-group">
            {!! Form::label('program', null, ['class' => 'col-sm-2 control-label']) !!}
            <div class="col-sm-3">
                {!! Form::select('idProgram',$programs, null, ['class' => 'form-control']) !!}
            </div>
            {!! Form::label('Name Of Item', null, ['class' => 'col-sm-2 control-label']) !!}
            <div class="col-sm-3">
                {!! Form::text('categoryName', null, ['class' => 'form-control','placeholder'=>'Enter Name']) !!}
            </div>
        </div>
    </div>
    <div class="panel-footer">
        @if(isset($category))
        {!!  Form::submit('Update',['class'=>'btn btn-danger'])!!}
        @else
        <button type="submit" class="btn btn-danger">Save</button>
        @endif
       {!! Form::close() !!}
    </div>
</div>
<div class="panel panel-default">
    <div class="panel-heading"> <strong>Items</strong></div>
    <div class="panel-body">
        <table class="table table-bordered" id='table1'>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Program</th>
                    <th>Item Name</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($categories as $var)
                <tr>
                    <td>{{ $var->idCategory }}</td>
                    <td>{{ $var->program->programName }}</td>
                    <td>{{ $var->categoryName }}</td>
                    <td>
                        {{ Form::open(['route' => ['categories.destroy', $var->idCategory], 'method' => 'delete']) }}
                        <a href='{{url('/categories/'.$var->idCategory.'/edit')}}' class="btn btn-xs btn-warning">Edit</a>
                        <button class="btn btn-xs btn-danger" type="submit">Delete</button>
                        {{ Form::close() }}
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@stop