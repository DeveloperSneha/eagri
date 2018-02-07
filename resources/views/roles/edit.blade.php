<div class="panel panel-default">
    <div class="panel-heading">
        <strong>Edit Role</strong>
    </div>
    {!! Form::model($role, ['method' => 'PATCH', 'action' => ['RoleController@update', $role->idRole], 'class' => 'form-horizontal']) !!}
    <div class="panel-body">
        <div class="form-group">
            {!! Form::label('name','Name',['class' => 'col-sm-2 control-label required']) !!}
            <div class="col-sm-3">
                {!! Form::text('name',null,['class' => 'form-control']) !!}
                <span class="help-block">
                    <strong>
                        @if($errors->has('name'))
                        <p>{{ $errors->first('name') }}</p>
                        @endif
                    </strong>
                </span>
            </div>
            {!! Form::label('label','Label',['class' => 'col-sm-2 control-label']) !!}
            <div class="col-sm-3">
                {!! Form::text('label',null,['class' => 'form-control']) !!}
            </div>
        </div>
    </div>
    <div class="panel-footer">
        <button type="submit" class="btn btn-danger">Save</button>
        {!! Form::close() !!}
    </div>
</div>
