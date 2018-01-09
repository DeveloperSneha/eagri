<!DOCTYPE html>
<html>
    @include('layouts.partials.head')
    <div class="">
        <div class="register-logo">
            <a href="{{url('/')}}"><img src="{{asset('dist/img/DOAH.png')}}" height="100" width="160"></a>
        </div>

        <div class="register-box-body">
            <p class="register-box-msg">New Registration / नया पंजीकरण</p>
            <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <strong>New Registration / नया पंजीकरण</strong>
                </div>
                <div class="panel-body">
                    

                    <form class="form-horizontal" method="POST" action="{{ route('farmer.register.submit') }}">
                        {{ csrf_field() }}
                        <div class="form-group">
                            {!! Form::label('Name Of Farmer', null, ['class' => 'col-sm-2 control-label']) !!}
                            <div class="col-sm-4  {{ $errors->has('name') ? ' has-error' : '' }}">
                                {!! Form::text('name', null, ['class' => 'form-control','placeholder'=>'Enter Name']) !!}
                                @if ($errors->has('name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                                @endif
                            </div>
                            {!! Form::label('Father/Husband', null, ['class' => 'col-sm-2 control-label']) !!}
                            <div class="col-sm-4 {{ $errors->has('father_name') ? ' has-error' : '' }}">
                                {!! Form::text('father_name', null, ['class' => 'form-control','placeholder'=>'Enter Father/Husband Name']) !!}
                                @if ($errors->has('father_name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('father_name') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            {!! Form::label('Aadhar No', null, ['class' => 'col-sm-2 control-label']) !!}
                            <div class="col-sm-4 {{ $errors->has('aadhaar') ? ' has-error' : '' }}">
                                {!! Form::text('aadhaar', null, ['class' => 'form-control','placeholder'=>'Enter Aadhar No','']) !!}
                                @if ($errors->has('aadhaar'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('aadhaar') }}</strong>
                                </span>
                                @endif
                            </div>
                            {!! Form::label('Ration Card No.', null, ['class' => 'col-sm-2 control-label']) !!}
                            <div class="col-sm-4 {{ $errors->has('rcno') ? ' has-error' : '' }}">
                                {!! Form::text('rcno', null, ['class' => 'form-control','placeholder'=>'Enter Ration Card No.']) !!}
                                @if ($errors->has('rcno'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('rcno') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            {!! Form::label('Farmer Category', null, ['class' => 'col-sm-2 control-label']) !!}
                            <div class="col-sm-4 {{ $errors->has('farmer_category') ? ' has-error' : '' }}">
                                {!! Form::select('farmer_category',getFarmerCategory(), null, ['class' => 'form-control']) !!}
                                @if ($errors->has('farmer_category'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('farmer_category') }}</strong>
                                </span>
                                @endif
                            </div>
                            {!! Form::label('Gender', null, ['class' => 'col-sm-2 control-label']) !!}
                            <div class="col-sm-4 {{ $errors->has('gender') ? ' has-error' : '' }}">
                                {!! Form::select('gender', getGender(),null, ['class' => 'form-control']) !!}
                                @if ($errors->has('gender'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('gender') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            {!! Form::label('Marital Status', null, ['class' => 'col-sm-2 control-label']) !!}
                            <div class="col-sm-4 {{ $errors->has('marital_status') ? ' has-error' : '' }}">
                                {!! Form::select('marital_status', getMaritalStatus(),null, ['class' => 'form-control']) !!}
                                @if ($errors->has('marital_status'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('marital_status') }}</strong>
                                </span>
                                @endif
                            </div>
                            {!! Form::label('Caste Category', null, ['class' => 'col-sm-2 control-label']) !!}
                            <div class="col-sm-4 {{ $errors->has('caste') ? ' has-error' : '' }}">
                                {!! Form::select('caste', getCasteCategory(),null, ['class' => 'form-control']) !!}
                                @if ($errors->has('caste'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('caste') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            {!! Form::label('Mobile No', null, ['class' => 'col-sm-2 control-label']) !!}
                            <div class="col-sm-4 {{ $errors->has('mobile') ? ' has-error' : '' }} ">
                                {!! Form::text('mobile', null, ['class' => 'form-control','placeholder'=>'Enter MobileNo.']) !!}
                                @if ($errors->has('name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('mobile') }}</strong>
                                </span>
                                @endif
                            </div>
                            {!! Form::label('District', null, ['class' => 'col-sm-2 control-label']) !!}
                            <div class="col-sm-4 {{ $errors->has('idDistrict') ? ' has-error' : '' }}">
                                <select name="idDistrict" class="form-control">
                                    <option value="">--- Select District ---</option>
                                    @foreach ($districts as $key => $value)
                                    <option value="{{ $key }}">{{ $value }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('idDistrict'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('idDistrict') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            {!! Form::label('Block', null, ['class' => 'col-sm-2 control-label']) !!}
                            <div class="col-sm-4 {{ $errors->has('idBlock') ? ' has-error' : '' }}">
                                <select name="idBlock" class="form-control" >--- Select Block ---</select>
                                @if ($errors->has('idBlock'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('idBlock') }}</strong>
                                </span>
                                @endif
                            </div>
                            {!! Form::label('Village', null, ['class' => 'col-sm-2 control-label']) !!}
                            <div class="col-sm-4 {{ $errors->has('idVillage') ? ' has-error' : '' }}">
                                <select name="idVillage" class="form-control" >--- Select Village ---</select>
                                @if ($errors->has('idVillage'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('idVillage') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        <fieldset>
                            <legend>Bank And Land Details</legend>
<!--                            <strong>Bank Details</strong>-->
                            <div class="form-group">
                                {!! Form::label('IFSC', null, ['class' => 'col-sm-2 control-label']) !!}
                                <div class="col-sm-4 {{ $errors->has('ifsc_code') ? ' has-error' : '' }}">
                                   {!! Form::text('ifsc_code' ,null, ['class' => 'form-control ','id'=>'ifsccode_1']) !!}
                                    @if ($errors->has('ifsc_code'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('ifsc_code') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                {!! Form::label('Bank Name', null, ['class' => 'col-sm-2 control-label']) !!}
                                <div class="col-sm-4 ">
                                    {!! Form::text('bank_name', null, ['class' => 'form-control','placeholder'=>'Enter Bank Name','id'=>'branchname_1']) !!}
                                </div>
                            </div>
                            <div class="form-group">
                                {!! Form::label('Branch Details', null, ['class' => 'col-sm-2 control-label']) !!}
                                <div class="col-sm-4">
                                    {!! Form::text('bank_branch', null, ['class' => 'form-control','placeholder'=>'Enter Branch Details','id'=>'bankname_1']) !!}
                                </div>
                                {!! Form::label('Account No.', null, ['class' => 'col-sm-2 control-label']) !!}
                                <div class="col-sm-4 {{ $errors->has('account_no') ? ' has-error' : '' }}">
                                    {!! Form::text('account_no', null, ['class' => 'form-control']) !!}
                                    @if ($errors->has('account_no'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('account_no') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
<!--                            <strong>Land Details</strong>-->
                            <div class="form-group">
                                {!! Form::label('Location Of Land', null, ['class' => 'col-sm-2 control-label']) !!}
                                <div class="col-sm-4 {{ $errors->has('land_location') ? ' has-error' : '' }}">
                                    {!! Form::text('land_location', null, ['class' => 'form-control']) !!}
                                    @if ($errors->has('land_location'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('land_location') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                {!! Form::label('OwnershipOfLand', null, ['class' => 'col-sm-2 control-label']) !!}
                                <div class="col-sm-4 {{ $errors->has('land_owner') ? ' has-error' : '' }}">
                                    {!! Form::text('land_owner', null, ['class' => 'form-control']) !!}
                                    @if ($errors->has('land_owner'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('land_owner') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                {!! Form::label('Total Land', null, ['class' => 'col-sm-2 control-label']) !!}
                                <div class="col-sm-4 {{ $errors->has('total_land') ? ' has-error' : '' }}">
                                    {!! Form::text('total_land', null, ['class' => 'form-control']) !!}
                                    @if ($errors->has('total_land'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('total_land') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </fieldset>
                        <div class="form-group">
                            <div class="col-sm-offset-4 col-sm-4">
                                <button class="btn btn-block btn-success" name="btn-signup" style="background-color:maroon;border-color:maroon;" type="submit">Register</button>
                            </div>
                            <div class="col-sm-2">
                                <a style="float:right;" href="{{url('farmer/login')}}"><h4 style="color:maroon;"><b>Login / लॉगिन</b></h4></a>
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
        $('select[name="idDistrict"]').on('change', function() {
            var districtID = $(this).val();
            if(districtID) {
                $.ajax({
                    url: "{{url('/farmer/district/') }}"+'/' +districtID + "/blocks",
                    type: "GET",
                    dataType: "json",
                    success:function(data) {
                        $('select[name="idBlock"]').empty();
                        $.each(data, function(key, value) {
                            $('select[name="idBlock"]').append('<option value="'+ key +'">'+ value +'</option>');
                        });

                    }
                });
            }else{
                $('select[name="idBlock"]').empty();
            }
        });
        
        $('select[name="idBlock"]').on('change', function() {
            var blockID = $(this).val();
            if(blockID) {
                $.ajax({
                    url: "{{url('/farmer/block/') }}"+'/' +blockID + "/villages",
                    type: "GET",
                    dataType: "json",
                    success:function(data) {
                        $('select[name="idVillage"]').empty();
                        $.each(data, function(key, value) {
                            $('select[name="idVillage"]').append('<option value="'+ key +'">'+ value +'</option>');
                        });

                    }
                });
            }else{
                $('select[name="idVillage"]').empty();
            }
        });
    });
$('#ifsccode_1').autocomplete({
	source: function( request, response ) {
		$.ajax({
			url : "{{url('/farmer/bankdetails/') }}",
			dataType: "json",
			method: 'get',
			
			data: {
			   name_startsWith: request.term,
			   type: 'data',
			   row_num : 1
			},
			 success: function( data ) {
                                response( $.map( data, function( item ) {
                                        return {
						label: item[0],
						value: item[0],
						data : item
					}
				}));
			}
		});
	},
	autoFocus: true,	      	
	minLength: 0,
	select: function( event, ui ) {
		//var names = ui.item.data.split("|");						
		$('#bankname_1').val(ui.item.data[1]);
		$('#branchname_1').val(ui.item.data[2]);
	
	}		      	
});
			      
</script>
 </body>
</html>
