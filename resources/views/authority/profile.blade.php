@extends('authority.authority_layout')
@section('content')
<div class="row">
    <div class="col-sm-5">
        <div class="box box-success">
            <div class="box-body box-profile">
                <img class="profile-user-img img-responsive img-circle" alt="User profile picture" src="{{ asset('dist/img/user.jpg')}}">

                <h3 class="profile-username text-center">{{ $user->name }}</h3>

                <p class="text-muted text-center"><strong><strong></p>

                <ul class="list-group list-group-unbordered">
                    <li class="list-group-item">
                        <b>District  <a class="pull-right"></a></b>
                    </li>
                    
                    <li class="list-group-item">
                        <b>Section  <a class="pull-right"></a></b>
                    </li>
                    <li class="list-group-item">
                        <b>Designation  <a class="pull-right"></a></b>
                    </li>
                </ul>


            </div>
        </div>
    </div>
    @if($user->isComplete == 'N')
    <div class="col-sm-7">
        <div class="panel panel-default">
            <div class="panel-heading">
                <strong>Complete Your Profile</strong>
            </div>
            <div class="panel-body">
                {!! Form::open(['method' => 'PATCH', 'action' => ['Authority\AuthorityProfileController@update', $user->idUser,],'class'=>'form-horizontal']) !!}

                <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
                    {!! Form::label('Name :', null, ['class' => 'col-sm-4 control-label']) !!}
                    <div class="col-sm-6">
                        {!! Form::text('name', null, ['class' => 'form-control','placeholder'=>'Enter Name']) !!}
                    </div>
                </div>
                <div class="form-group {{ $errors->has('fatherName') ? ' has-error' : '' }}">
                    {!! Form::label('Father Name :', null, ['class' => 'col-sm-4 control-label']) !!}
                    <div class="col-sm-6">
                        {!! Form::text('fatherName', null, ['class' => 'form-control','placeholder'=>'Enter FatherName']) !!}
                    </div>
                </div>
                <div class="form-group {{ $errors->has('motherName') ? ' has-error' : '' }}">
                    {!! Form::label('Mother Name :', null, ['class' => 'col-sm-4 control-label']) !!}
                    <div class="col-sm-6">
                        {!! Form::text('motherName', null, ['class' => 'form-control','placeholder'=>'Enter MotherName']) !!}
                    </div>
                </div>
                <div class="form-group {{ $errors->has('dob') ? ' has-error' : '' }}">
                    {!! Form::label('Date Of Birth :', null, ['class' => 'col-sm-4 control-label']) !!}
                    <div class="col-sm-6">
                        {!! Form::text('dob', null, ['class' => 'form-control datepicker','placeholder'=>'Enter Date Of Birth']) !!}
                        @if ($errors->has('dob'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('dob') }}</strong>
                                        </span>
                                    @endif
                    </div>
                </div>
                <div class="form-group {{ $errors->has('aadhaar') ? ' has-error' : '' }}">
                    {!! Form::label('Aadhaar :', null, ['class' => 'col-sm-4 control-label']) !!}
                    <div class="col-sm-6">
                        {!! Form::text('aadhaar', null, ['class' => 'form-control','placeholder'=>'Enter Aadhaar here']) !!}
                    </div>
                </div>
                <div class="form-group {{ $errors->has('mobile') ? ' has-error' : '' }}">
                    {!! Form::label('Mobile :', null, ['class' => 'col-sm-4 control-label']) !!}
                    <div class="col-sm-6">
                        {!! Form::text('mobile', null, ['class' => 'form-control','placeholder'=>'Enter Mobile No.']) !!}
                    </div>
                </div>
                <div class="form-group {{ $errors->has('ofc_address') ? ' has-error' : '' }}">
                    {!! Form::label('Office Address :', null, ['class' => 'col-sm-4 control-label']) !!}
                    <div class="col-sm-6">
                        {!! Form::textarea('ofc_address', null, ['class' => 'form-control','size'=>'30x2']) !!}
                    </div>
                </div>
                <div class="form-group {{ $errors->has('address') ? ' has-error' : '' }}">
                    {!! Form::label('Address :', null, ['class' => 'col-sm-4 control-label']) !!}
                    <div class="col-sm-6">
                        {!! Form::textarea('address', null, ['class' => 'form-control','size'=>'30x2']) !!}
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