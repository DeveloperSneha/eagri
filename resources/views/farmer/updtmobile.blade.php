@extends('farmer.farmer_layout')
@section('content')
<div class="panel panel-default">
    <div class="panel-heading">
        <strong>Update Mobile Number</strong>
    </div>
    {!! Form::open(['url' => 'farmer/updtmobile','class'=>'form-horizontal']) !!}
    <div class="panel-body">
        <div class="form-group">
            {!! Form::label('New Mobile Number :', null, ['class' => 'col-sm-4 control-label required']) !!}
            <div class="col-sm-3">
                {!! Form::text('mobile', null, ['class' => 'form-control','minlength'=>'10','maxlength'=>'10','onkeypress'=>'return isNumber(event)', 'pattern'=>'^[6789]\d{9}$','pattern'=>'^(\d)(?!\1+$)\d{9}$']) !!}
                
            </div>
            <!-- <span class="help-block">
                    <strong>
                        @if($errors->has('mobile'))
                        <p>{{ $errors->first('mobile') }}</p>
                        @endif
                    </strong>
                </span> -->
        </div>
        <div class="panel-footer">
        <button type="submit" class="btn btn-danger">Send Request For Update</button>
    </div>
    {!! Form::close() !!}
</div>
@stop