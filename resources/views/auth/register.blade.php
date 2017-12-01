<!DOCTYPE html>
<html>
    @include('layouts.partials.head')
    <div class="">
        <div class="register-logo">
            <a href="{{url('/')}}"><img src="{{asset('dist/img/DOAH.png')}}" height="100" width="160"></a>
        </div>

        <div class="register-box-body">
            <p class="login-box-msg">New Registration / नया पंजीकरण</p>
            <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <strong>New Registration / नया पंजीकरण</strong>
                </div>
                <div class="panel-body">
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    <form class="form-horizontal" method="POST" action="{{ route('register') }}">
                        {{ csrf_field() }}
                        <div class="form-group">
                            {!! Form::label('Name Of Farmer', null, ['class' => 'col-sm-2 control-label']) !!}
                            <div class="col-sm-3  {{ $errors->has('name') ? ' has-error' : '' }}">
                                {!! Form::text('name', null, ['class' => 'form-control','placeholder'=>'Enter Name']) !!}
                                @if ($errors->has('name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                                @endif
                            </div>
                            {!! Form::label('Father/Husband Name', null, ['class' => 'col-sm-2 control-label']) !!}
                            <div class="col-sm-3">
                                {!! Form::text('father_name', null, ['class' => 'form-control','placeholder'=>'Enter Father/Husband Name']) !!}
                            </div>
                        </div>
                        <div class="form-group">
                            {!! Form::label('Aadhar No', null, ['class' => 'col-sm-2 control-label']) !!}
                            <div class="col-sm-3 {{ $errors->has('aadhaar') ? ' has-error' : '' }}">
                                {!! Form::text('aadhaar', null, ['class' => 'form-control','placeholder'=>'Enter Aadhar No']) !!}
                                @if ($errors->has('name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('aadhaar') }}</strong>
                                </span>
                                @endif
                            </div>
                            {!! Form::label('Ration Card No.', null, ['class' => 'col-sm-2 control-label']) !!}
                            <div class="col-sm-3">
                                {!! Form::text('rcno', null, ['class' => 'form-control','placeholder'=>'Enter Ration Card No.']) !!}
                            </div>
                        </div>
                        <div class="form-group">
                            {!! Form::label('Farmer Category', null, ['class' => 'col-sm-2 control-label']) !!}
                            <div class="col-sm-3">
                                {!! Form::text('farmer_category', null, ['class' => 'form-control','placeholder'=>'Enter Farmer Category']) !!}
                            </div>
                            {!! Form::label('Gender', null, ['class' => 'col-sm-2 control-label']) !!}
                            <div class="col-sm-3">
                                {!! Form::select('gender', getGender(),null, ['class' => 'form-control']) !!}
                            </div>
                        </div>
                        <div class="form-group">
                            {!! Form::label('Marital Status', null, ['class' => 'col-sm-2 control-label']) !!}
                            <div class="col-sm-3">
                                {!! Form::select('marital_status', getMaritalStatus(),null, ['class' => 'form-control']) !!}
                            </div>
                            {!! Form::label('Caste Category', null, ['class' => 'col-sm-2 control-label']) !!}
                            <div class="col-sm-3">
                                {!! Form::select('caste', getCasteCategory(),null, ['class' => 'form-control']) !!}
                            </div>
                        </div>
                        <div class="form-group">
                            {!! Form::label('Mobile No', null, ['class' => 'col-sm-2 control-label']) !!}
                            <div class="col-sm-3 {{ $errors->has('mobile') ? ' has-error' : '' }} ">
                                {!! Form::text('mobile', null, ['class' => 'form-control','placeholder'=>'Enter MobileNo.']) !!}
                                @if ($errors->has('name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('mobile') }}</strong>
                                </span>
                                @endif
                            </div>
                            {!! Form::label('District', null, ['class' => 'col-sm-2 control-label']) !!}
                            <div class="col-sm-3">
                                <select name="district" class="form-control">
                                    <option value="">--- Select District ---</option>
                                    @foreach ($districts as $key => $value)
                                    <option value="{{ $key }}">{{ $value }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            {!! Form::label('Block', null, ['class' => 'col-sm-2 control-label']) !!}
                            <div class="col-sm-3">
                                <select name="block" class="form-control" >--- Select Block ---</select>
                            </div>
                            {!! Form::label('Village', null, ['class' => 'col-sm-2 control-label']) !!}
                            <div class="col-sm-3">
                                <select name="village" class="form-control" >--- Select Village ---</select>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-4 col-sm-4">
                                <button class="btn btn-block btn-success" name="btn-signup" style="background-color:maroon;border-color:maroon;" type="submit">Register</button>
                            </div>
                            <div class="col-sm-2">
                                <a style="float:right;" href="{{url('login')}}"><h4 style="color:maroon;"><b>Login / लॉगिन</b></h4></a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            </div>
        </div>
    </div>

@include('layouts.partials.script')
<script>
    $(document).ready(function() {
        $('select[name="district"]').on('change', function() {
            var districtID = $(this).val();
            if(districtID) {
                $.ajax({
                    url: "{{url('/district/') }}"+'/' +districtID + "/blocks",
                    type: "GET",
                    dataType: "json",
                    success:function(data) {
                        $('select[name="block"]').empty();
                        $.each(data, function(key, value) {
                            $('select[name="block"]').append('<option value="'+ key +'">'+ value +'</option>');
                        });

                    }
                });
            }else{
                $('select[name="block"]').empty();
            }
        });
        
        $('select[name="block"]').on('change', function() {
            var blockID = $(this).val();
            if(blockID) {
                $.ajax({
                    url: "{{url('/block/') }}"+'/' +blockID + "/villages",
                    type: "GET",
                    dataType: "json",
                    success:function(data) {
                        $('select[name="village"]').empty();
                        $.each(data, function(key, value) {
                            $('select[name="village"]').append('<option value="'+ key +'">'+ value +'</option>');
                        });

                    }
                });
            }else{
                $('select[name="village"]').empty();
            }
        });
    });
</script>
 </body>
</html>
