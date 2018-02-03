@extends('authority.blocks.block_layout')
@section('content')
<div class="row">
    <div class="col-sm-6">
        <div class="box box-success">
            <div class="box-body box-profile">
                <img class="profile-user-img img-responsive img-circle" alt="User profile picture" src="{{ asset('dist/img/user.jpg')}}">

                <h3 class="profile-username text-center">{{ $user->name }}</h3>

                <p class="text-muted text-center"><strong></strong></p>
                            <table class="table table-bordered dataTable">
                                <thead>
                                    <tr>
                                        <th>Section</th>
                                        <th>District</th>
                                        <th>Subdivision</th>
                                        <th>Block</th>
                                        <th>Designation</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($user_blockdesig as $var)
                                    <tr>
                                        <td>{{$var->designation->section->sectionName }}</td>
                                        <td>{{$var->subdivision->subDivisionName }}</td>
                                        <td>{{$var->district->districtName }}</td>
                                        <td>{{$var->block->blockName }}</td>
                                        <td>{{$var->designation->designationName }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
            </div>
        </div>
    </div>
    @if($user->isComplete == 'N')
    <div class="col-sm-6">
        <div class="panel panel-default">
            <div class="panel-heading">
                <strong>Complete Your Profile</strong>
            </div>
            <div class="panel-body">
                {!! Form::open(['method' => 'PATCH', 'action' => ['Authority\Block\ProfileController@update', $user->idUser,],'class'=>'form-horizontal']) !!}

                <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
                    {!! Form::label('Name :', null, ['class' => 'col-sm-4 control-label']) !!}
                    <div class="col-sm-6">
                        {!! Form::text('name', null, ['class' => 'form-control','placeholder'=>'Enter Name','pattern'=>'^[^-\s][a-zA-Z_\s-]+$','maxlength'=>'40','minlength'=>'3','onkeypress'=>'return lettersOnly(event)']) !!}
                    </div>
                </div>
                <div class="form-group {{ $errors->has('fatherName') ? ' has-error' : '' }}">
                    {!! Form::label('Father Name :', null, ['class' => 'col-sm-4 control-label']) !!}
                    <div class="col-sm-6">
                        {!! Form::text('fatherName', null, ['class' => 'form-control','placeholder'=>'Enter FatherName','pattern'=>'^[^-\s][a-zA-Z_\s-]+$','maxlength'=>'40','minlength'=>'3','onkeypress'=>'return lettersOnly(event)']) !!}
                    </div>
                </div>
                <div class="form-group {{ $errors->has('motherName') ? ' has-error' : '' }}">
                    {!! Form::label('Mother Name :', null, ['class' => 'col-sm-4 control-label']) !!}
                    <div class="col-sm-6">
                        {!! Form::text('motherName', null, ['class' => 'form-control','placeholder'=>'Enter MotherName','pattern'=>'^[^-\s][a-zA-Z_\s-]+$','maxlength'=>'40','minlength'=>'3','onkeypress'=>'return lettersOnly(event)']) !!}
                    </div>
                </div>
                <div class="form-group {{ $errors->has('dob') ? ' has-error' : '' }}">
                    {!! Form::label('Date Of Birth :', null, ['class' => 'col-sm-4 control-label']) !!}
                    <div class="col-sm-6">
                        {!! Form::text('dob', null, ['class' => 'form-control datepicker','placeholder'=>'Enter Date Of Birth','onkeypress'=>'return onlyNumbersandSpecialChar(event)']) !!}
                        <!-- @if ($errors->has('dob'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('dob') }}</strong>
                                        </span>
                                    @endif -->
                    </div>
                </div>
                <div class="form-group {{ $errors->has('aadhaar') ? ' has-error' : '' }}{{ $errors->has('aadhaarabc') ? ' has-error' : '' }}">
                    {!! Form::label('Aadhaar :', null, ['class' => 'col-sm-4 control-label']) !!}
                    <div class="col-sm-6">
                        {!! Form::text('aadhaar', null, ['class' => 'form-control','placeholder'=>'Enter Aadhaar here','maxlength'=>'12','minlength'=>'12','onkeypress'=>'return isNumber(event)','id'=>'aadhaar']) !!}
                        <!-- @if ($errors->has('aadhaarabc'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('aadhaarabc') }}</strong>
                                        </span>
                                    @endif -->
                    </div>
                </div>
                <div class="form-group {{ $errors->has('mobile') ? ' has-error' : '' }}">
                    {!! Form::label('Mobile :', null, ['class' => 'col-sm-4 control-label']) !!}
                    <div class="col-sm-6">
                        {!! Form::text('mobile', null, ['class' => 'form-control','placeholder'=>'Enter Mobile No.','maxlength'=>'10','minlength'=>'10','onkeypress'=>'return isNumber(event)', 'pattern'=>'^[6789]\d{9}$','pattern'=>'^(\d)(?!\1+$)\d{9}$']) !!}
                    </div>
                </div>
                <div class="form-group {{ $errors->has('ofc_address') ? ' has-error' : '' }}">
                    {!! Form::label('Office Address :', null, ['class' => 'col-sm-4 control-label']) !!}
                    <div class="col-sm-6">
                        {!! Form::textarea('ofc_address', null, ['class' => 'form-control','size'=>'30x2', 'minlength'=>'2', 'maxlength'=>'30', 'pattern'=>'^[a-zA-Z0-9 !@#$%^&*)(]{2,30}$']) !!}
                    </div>
                </div>
                <div class="form-group {{ $errors->has('address') ? ' has-error' : '' }}">
                    {!! Form::label('Address :', null, ['class' => 'col-sm-4 control-label']) !!}
                    <div class="col-sm-6">
                        {!! Form::textarea('address', null, ['class' => 'form-control','size'=>'30x2', 'minlength'=>'2', 'maxlength'=>'30', 'pattern'=>'^[a-zA-Z0-9 !@#$%^&*)(]{2,30}$']) !!}
                    </div>
                </div>
            </div>
            <div class="panel-footer">
                <button type="submit" class="btn btn-danger">Save</button>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
    @endif
    @if($user->isComplete == 'Y')
    <div class="col-sm-7">
        <div class="panel panel-default">
            <div class="panel-heading">Other Details</div>
            <div class="panel-body">
                <table class="table table-bordered">
                    <tr>
                        <th>Name</th>
                        <td>{{ $user->name }}</td>
                    </tr>
                    <tr>
                        <th>Father Name</th>
                        <td>{{ $user->fatherName }}</td>
                    </tr>
                    <tr>
                        <th>Mother Name</th>
                        <td>{{ $user->motherName }}</td>
                    </tr>
                    <tr>
                        <th>Date Of Birth</th>
                        <td>{{ $user->dob }}</td>
                    </tr>
                    <tr>
                        <th>Aadhaar</th>
                        <td>{{ $user->aadhaar }}</td>
                    </tr>
                    <tr>
                        <th>Mobile</th>
                        <td>{{ $user->mobile }}</td>
                    </tr>
                    <tr>
                        <th>Office Address</th>
                        <td>{{ $user->ofc_address }}</td>
                    </tr>
                    <tr>
                        <th>Address</th>
                        <td>{{ $user->address }}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
    @endif
</div>
@stop