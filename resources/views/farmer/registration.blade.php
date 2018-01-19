<!DOCTYPE html>
<html>
    @include('layouts.partials.head')
    <body style="background-color: #323232;">
    <div class="">
<!--        <div class="register-logo">
            <a href="{{url('/')}}"><img src="{{asset('dist/img/DOAH.png')}}" height="90" width="90"></a>
        </div>-->
        <div class="register-box-body" style="background-color: #323232;">
            <p class="register-box-msg" style="color:#fff">New Registration / नया पंजीकरण</p>
           
            <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <strong>New Registration / नया पंजीकरण</strong>
                    <a style="color:#fff" href="{{url('farmer/login')}}"><span style="float:right;"><i class="fa fa-home fa-2x"></i></span></a>
                </div>
                <div class="panel-body">
                    

                    <form class="form-horizontal" method="POST" action="{{ route('farmer.register.submit') }}">
                        {{ csrf_field() }}
                        <div class="form-group">
                            {!! Form::label('Name Of Farmer', null, ['class' => 'col-sm-2 control-label']) !!}
                            <div class="col-sm-4  {{ $errors->has('name') ? ' has-error' : '' }}">
                                {!! Form::text('name', null, ['class' => 'form-control','placeholder'=>'किसान का नाम','pattern'=>'^[^-\s][a-zA-Z_\s-]+$','maxlength'=>'40','minlength'=>'3','onkeypress'=>'return lettersOnly(event)']) !!}
                                @if ($errors->has('name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                                @endif
                            </div>
                            {!! Form::label('Father/Husband', null, ['class' => 'col-sm-2 control-label']) !!}
                            <div class="col-sm-4 {{ $errors->has('father_name') ? ' has-error' : '' }}">
                                {!! Form::text('father_name', null, ['class' => 'form-control','placeholder'=>'पिता/पति का नाम','maxlength'=>'50','minlength'=>'2','onkeypress'=>'return lettersOnly(event)']) !!}
                                @if ($errors->has('father_name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('father_name') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            {!! Form::label('Aadhaar No', null, ['class' => 'col-sm-2 control-label']) !!}
                            <div class="col-sm-4 {{ $errors->has('aadhaar') ? ' has-error' : '' }}{{ $errors->has('aadhaarabc') ? ' has-error' : '' }}">
                                {!! Form::text('aadhaar', null, ['class' => 'form-control','placeholder'=>'अपना आधार नंबर डाले','maxlength'=>'12','minlength'=>'12','onkeypress'=>'return isNumber(event)','id'=>'aadhaar']) !!}
                                @if ($errors->has('aadhaar'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('aadhaar') }}</strong>
                                </span>
                                @endif
                                @if ($errors->has('aadhaarabc'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('aadhaarabc') }}</strong>
                                </span>
                                @endif
                            </div>
                            {!! Form::label('Ration Card No.', null, ['class' => 'col-sm-2 control-label']) !!}
                            <div class="col-sm-4 {{ $errors->has('rcno') ? ' has-error' : '' }}">
                                {!! Form::text('rcno', null, ['class' => 'form-control','placeholder'=>'अपना राशन कार्ड नंबर डाले']) !!}
                                @if ($errors->has('rcno'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('rcno') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        
                        <div class="form-group">
                            {!! Form::label('Mobile No', null, ['class' => 'col-sm-2 control-label']) !!}
                            <div class="col-sm-4 {{ $errors->has('mobile') ? ' has-error' : '' }} ">
                                {!! Form::text('mobile', null, ['class' => 'form-control','placeholder'=>'अपना मोबाइल नंबर डाले ','maxlength'=>'10','minlength'=>'10','onkeypress'=>'return isNumber(event)', 'pattern'=>'^[6789]\d{9}$']) !!}
                                @if ($errors->has('name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('mobile') }}</strong>
                                </span>
                                @endif
                            </div>
                            {!! Form::label('Marital Status', null, ['class' => 'col-sm-2 control-label']) !!}
                            <div class="col-sm-4 {{ $errors->has('marital_status') ? ' has-error' : '' }}">
                                {!! Form::select('marital_status', getMaritalStatus(),null, ['class' => 'form-control']) !!}
                                @if ($errors->has('marital_status'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('marital_status') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            {!! Form::label('Gender', null, ['class' => 'col-sm-2 control-label']) !!}
                            <div class="col-sm-4 {{ $errors->has('gender') ? ' has-error' : '' }}">
                                {!! Form::select('gender', getGender(),null, ['class' => 'form-control']) !!}
                                @if ($errors->has('gender'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('gender') }}</strong>
                                </span>
                                @endif
                            </div>
                            {!! Form::label('Caste Category', null, ['class' => 'col-sm-2 control-label']) !!}
                            <div class="col-sm-4 {{ $errors->has('caste') ? ' has-error' : '' }}">
                                {!! Form::select('caste',getCasteCategory(), null, ['class' => 'form-control']) !!}
                                @if ($errors->has('caste'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('caste') }}</strong>
                                </span>
                                @endif
                            </div>
                            
                            
                        </div>
                        <legend>Land Details / ज़मीन का विवरण (In acres / एकड़ में )</legend>
                        <div class="form-group">
                            {!! Form::label('District', null, ['class' => 'col-sm-2 control-label']) !!}
                            <div class="col-sm-4 {{ $errors->has('idDistrict') ? ' has-error' : '' }}">
<!--                                <select name="idDistrict" class="form-control" id="idDistrict">
                                    <option value="" selected="selected">--- अपना जिला चुने ---</option>
                                    @foreach ($districts as $key => $value)
                                    <option value="{{ $key }}">{{ $value }}</option>
                                    @endforeach
                                </select>-->
                                {!! Form::select('idDistrict',$districts, null, ['class' => 'form-control','id'=>'idDistrict']) !!}
                                @if ($errors->has('idDistrict'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('idDistrict') }}</strong>
                                </span>
                                @endif
                            </div>
                            {!! Form::label('Location Of Land', null, ['class' => 'col-sm-2 control-label']) !!}
                                <div class="col-sm-4 {{ $errors->has('land_location') ? ' has-error' : '' }}">
                                    {!! Form::text('land_location', null, ['class' => 'form-control','placeholder'=>'जमीन का स्थान']) !!}
                                    @if ($errors->has('land_location'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('land_location') }}</strong>
                                        </span>
                                    @endif
                                </div>
                        
                        </div>
                        <div class="form-group">
                                                       
                            {!! Form::label('Block', null, ['class' => 'col-sm-2 control-label']) !!}
                            <div class="col-sm-4 {{ $errors->has('idBlock') ? ' has-error' : '' }}">
                                <select name="idBlock" class="form-control" id="idBlock">--- Select Block ---
                                    <option value="" selected="selected"></option></select>
                                @if ($errors->has('idBlock'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('idBlock') }}</strong>
                                </span>
                                @endif
                            </div>
                            {!! Form::label('Total Land', null, ['class' => 'col-sm-2 control-label']) !!}
                                <div class="col-sm-4 {{ $errors->has('total_land') ? ' has-error' : '' }}">
                                    {!! Form::text('total_land', null, ['class' => 'form-control','placeholder'=>'कुल रकबा ','maxlength'=>'8','minlength'=>'1','onkeyup'=>'checkDec(this)','pattern'=>'^[1-9]\d*(\.\d+)?$']) !!}
                                    @if ($errors->has('total_land'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('total_land') }}</strong>
                                        </span>
                                    @endif
                                </div> 
                            
                            
                        </div>
                        <div class="form-group">
                            {!! Form::label('Village', null, ['class' => 'col-sm-2 control-label']) !!}
                            <div class="col-sm-4 {{ $errors->has('idVillage') ? ' has-error' : '' }}">
                                <select name="idVillage" class="form-control" id="idVillage" >
                                    <option value="" selected="selected"></option>
                                </select>
                                @if ($errors->has('idVillage'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('idVillage') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        
                        <fieldset>
                            <legend>Bank Details / बैंक विवरण</legend>
<!--                            <strong>Bank Details</strong>-->
                            <div class="form-group">
                                {!! Form::label('IFSC', null, ['class' => 'col-sm-2 control-label']) !!}
                                <div class="col-sm-4 {{ $errors->has('ifsc_code') ? ' has-error' : '' }}">
                                   {!! Form::text('ifsc_code' ,null, ['class' => 'form-control ', 'placeholder'=>'अपना बैंक का IFSC Code डाले ']) !!}
                                    @if ($errors->has('ifsc_code'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('ifsc_code') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                {!! Form::label('Bank Name', null, ['class' => 'col-sm-2 control-label']) !!}
                                <div class="col-sm-4 {{ $errors->has('bank_name') ? ' has-error' : '' }}">
                                    {!! Form::text('bank_name', null, ['class' => 'form-control','placeholder'=>'बैंक का नाम','id'=>'bankname_1','pattern'=>'^[^-\s][a-zA-Z_\s-]+$','maxlength'=>'50','minlength'=>'3','onkeypress'=>'return lettersOnly(event)']) !!}
                                    @if ($errors->has('bank_name'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('bank_name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                {!! Form::label('Branch Details', null, ['class' => 'col-sm-2 control-label']) !!}
                                <div class="col-sm-4 {{ $errors->has('bank_branch') ? ' has-error' : '' }}">
                                    {!! Form::text('bank_branch', null, ['class' => 'form-control','placeholder'=>'अपने बैंक शाखा का नाम डाले ','id'=>'branchname_1','maxlength'=>'40','minlength'=>'3']) !!}
                                    @if ($errors->has('bank_branch'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('bank_branch') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                {!! Form::label('Account No.', null, ['class' => 'col-sm-2 control-label']) !!}
                                <div class="col-sm-4 {{ $errors->has('account_no') ? ' has-error' : '' }}">
                                    {!! Form::text('account_no', null, ['class' => 'form-control','placeholder'=>'अपने बैंक खाता नंबर डाले ','maxlength'=>'16','minlength'=>'12','onkeypress'=>'return isNumber(event)']) !!}
                                    @if ($errors->has('account_no'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('account_no') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>                            
                        </fieldset>
                        <div class="form-group">
                            <div class="col-sm-1"></div>
                            <div class='col-sm-11 checkbox-inline' {{ $errors->has('check') ? ' has-error' : '' }}">
                            <input type="checkbox" name="check" id="check">
                            <span style="font-color:black; font-size:17px;">All The Above Information Is Correct According To Me | मेरे द्वारा दिए गए सभी प्राप्त जानकारी सही है .</span>
                            @if ($errors->has('check'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('check') }}</strong>
                                        </span>
                                    @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-4 col-sm-4">
                                <button class="btn btn-block btn-success" type="submit">Register / पंजीकरण</button>
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
     $('#check').click(function (){
        var val = $(this).is(':checked');
        // $.load('url_here',{status:val});
    });
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
        var cur_dist = $( "#idDistrict option:selected" ).val();
        if(cur_dist){
            $.ajax({
                url: "{{url('/farmer/district/') }}"+'/' +cur_dist + "/blocks",
                type: "GET",
                dataType: "json",
                success:function(data) {
                    $('select[id="idBlock"]').empty();
                    $.each(data, function(key, value) {
                        $('select[id="idBlock"]').append('<option value="'+ key +'">'+ value +'</option>');
                    });
                }
            });
         }
                
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
                            $('select[name="idVillage"] ').append('<option value="'+ key +'">'+ value +'</option>');
                        });

                    }
                });
            }else{
                $('select[name="idVillage"]').empty();
            }
        });
        var cur_block = $( "#idBlock option:selected" ).val();
        if(cur_block){
            $.ajax({
                url: "{{url('/farmer/block/') }}"+'/' +cur_block + "/villages",
                type: "GET",
                dataType: "json",
                success:function(data) {
                    $('select[id="idVillage"]').empty();
                    $.each(data, function(key, value) {
                        $('select[id="idVillage"]').append('<option value="'+ key +'">'+ value +'</option>');
                    });
                }
            });
         }
        
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
