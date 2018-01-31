@extends('layouts.app')
@section('content')
<div class="panel panel-default">
    @if(isset($certificate))
    <div class="panel-heading">Edit Certificate : <strong>{{$certificate->certificateName }}</strong></div>
    @else
    <div class="panel-heading"><strong>Create Certificate</strong></div>
    @endif
    <div class="panel-body">
        @if(isset($certificate))
        {!! Form::model( $certificate, ['route' => ['certificates.update', $certificate->idCertificate], 'method' => 'patch','class'=>'form-horizontal'] ) !!}
        @else
        {!! Form::open(['url' => 'certificates','class'=>'form-horizontal']) !!}
        @endif
        <div class="form-group">
            {!! Form::label('Name Of Certificate', null, ['class' => 'col-sm-2 control-label required']) !!}
            <div class="col-sm-5">
                {!! Form::text('certificateName', null, ['class' => 'form-control','placeholder'=>'Enter Name','maxlength'=>'30','minlength'=>'2','onkeypress'=>'return lettersOnly(event)']) !!}
            </div>
            <span class="help-block">
                    <strong>
                        @if($errors->has('certificateName'))
                        <p>{{ $errors->first('certificateName') }}</p>
                        @endif
                    </strong>
                </span> 
        </div>
        <div class="form-group">
            {!! Form::label('description', null, ['class' => 'col-sm-2 control-label required']) !!}
            <div class="col-sm-5">
                {!! Form::textarea('description', null, ['class' => 'form-control','size'=>'30x3','maxlength'=>'150','minlength'=>'2','onkeypress'=>'onlylettersandSpecialChar']) !!}
            </div>
            <span class="help-block">
                    <strong>
                        @if($errors->has('description'))
                        <p>{{ $errors->first('description') }}</p>
                        @endif
                    </strong>
                </span> 
        </div>
    </div>
    <div class="panel-footer">
        @if(isset($certificate))
        {!!  Form::submit('Update',['class'=>'btn btn-danger'])!!}
        <a href="{{url('/certificates')}}" class="btn btn-danger">Cancel</a>
        @else
        <!--{!!  Form::submit('Save',['class'=>'btn btn-warning'])!!}-->
	<button type="submit" class="btn btn-danger">Save</button>
        @endif
       {!! Form::close() !!}
    </div>
</div>
<div class="panel panel-default">
    <div class="panel-heading"> <strong>Certificates</strong></div>
    <div class="panel-body">
        <table class="table table-bordered table-hover table-striped dataTable" id='table1' >
            <thead>
                <tr>
                    <th>SNO</th>
                    <th>Certificate Name</th>
					<th>Description</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php $i=1;?>
                @foreach($certificates as $var)
                <tr>
                    <td>{{ $i }}</td>
                    <td>{{ $var->certificateName }}</td>
					<td>{{ $var->description }}</td>
                    <td>
                        <a href='{{url('/certificates/'.$var->idCertificate.'/editcertificate')}}' class="btn btn-sm btn-warning">Edit</a>
                      
                       <a href='{{url('/certificates/'.$var->idCertificate.'/deletecertificate')}}' class="btn btn-sm btn-danger">Delete</a>
                    </td>
                </tr>
                <?php $i++; ?>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@stop