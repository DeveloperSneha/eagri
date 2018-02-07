<div class="panel panel-default">
    <div class="panel-heading">
        <strong>New User</strong>
    </div>
    {!! Form::open(['url' => 'useradm', 'class' => 'form-horizontal']) !!}
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
        </div>
        <div class="form-group">
            {!! Form::label('Role','Role',['class' => 'col-sm-2 control-label required']) !!}
            <div class="col-sm-3">
                {!! Form::select('idRole',$roles,null,['class' => 'form-control']) !!}
                <span class="help-block">
                    <strong>
                        @if($errors->has('idRole'))
                        <p>{{ $errors->first('idRole') }}</p>
                        @endif
                    </strong>
                </span>
            </div>
        </div>
        <div class="form-group">
            {!! Form::label('aadhaar','Aadhaar',['class' => 'col-sm-2 control-label required']) !!}
            <div class="col-sm-3">
                {!! Form::text('aadhaar', null, ['class' => 'form-control','placeholder'=>'Enter Aadhaar here','maxlength'=>'12','minlength'=>'12','onkeypress'=>'return isNumber(event)','id'=>'aadhaar']) !!}
                <span class="help-block">
                    <strong>
                        @if($errors->has('aadhaar'))
                        <p>{{ $errors->first('aadhaar') }}</p>
                        @endif
                    </strong>
                </span>
                 <span class="help-block">
                    <strong>
                        @if($errors->has('aadhaarabc'))
                        <p>{{ $errors->first('aadhaarabc') }}</p>
                        @endif
                    </strong>
                </span>
            </div>
        </div>
        <div class="form-group">
            {!! Form::label('mobile','Mobile',['class' => 'col-sm-2 control-label required']) !!}
            <div class="col-sm-3">
                {!! Form::text('mobile', null, ['class' => 'form-control','placeholder'=>'Enter Mobile No.','maxlength'=>'10','minlength'=>'10','onkeypress'=>'return isNumber(event)', 'pattern'=>'^[6789]\d{9}$','pattern'=>'^(\d)(?!\1+$)\d{9}$']) !!}
                <span class="help-block">
                    <strong>
                        @if($errors->has('mobile'))
                        <p>{{ $errors->first('mobile') }}</p>
                        @endif
                    </strong>
                </span>
            </div>
        </div>
    </div>
    <div class="panel-footer">
        <button type="submit" class="btn btn-danger">Save</button>
        {!! Form::close() !!}
    </div>
</div>
