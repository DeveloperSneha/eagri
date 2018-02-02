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
           
            <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <strong>New Registration / नया पंजीकरण</strong>
                    <a style="color:#fff" href="{{url('farmer/login')}}"><span style="float:right;"><i class="fa fa-home fa-2x"></i></span></a>
                </div>
                <div class="panel-body">
                    

                    <form class="form-horizontal" method="POST" action="{{ route('farmer.register.submit') }}" id="register">
                        {{ csrf_field() }}
                        <div class="form-group">
                            {!! Form::label('Name Of Farmer', null, ['class' => 'col-sm-2 control-label required']) !!}
                            <div class="col-sm-4  {{ $errors->has('name') ? ' has-error' : '' }}">
                                {!! Form::text('name', null, ['class' => 'form-control','placeholder'=>'किसान का नाम','pattern'=>'^[^-\s][a-zA-Z_\s-]+$','maxlength'=>'40','minlength'=>'2','onkeypress'=>'return lettersOnly(event)']) !!}
                                <span id="name1"></span>
                            </div>
                            {!! Form::label('Father/Husband', null, ['class' => 'col-sm-2 control-label required']) !!}
                            <div class="col-sm-4 {{ $errors->has('father_name') ? ' has-error' : '' }}">
                                {!! Form::text('father_name', null, ['class' => 'form-control','placeholder'=>'पिता/पति का नाम','maxlength'=>'50','minlength'=>'2','onkeypress'=>'return lettersOnly(event)']) !!}
                                <span id="father_name1"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            {!! Form::label('Aadhaar No', null, ['class' => 'col-sm-2 control-label required']) !!}
                            <div class="col-sm-4 {{ $errors->has('aadhaar') ? ' has-error' : '' }}{{ $errors->has('aadhaarabc') ? ' has-error' : '' }}">
                                {!! Form::text('aadhaar', null, ['class' => 'form-control','placeholder'=>'अपना आधार नंबर डाले','maxlength'=>'12','minlength'=>'12','onkeypress'=>'return isNumber(event)','id'=>'aadhaar']) !!}
                                <span id="aadhaarabc1"></span>
                                <span  id="aadhaar1"></span>
                            </div>
                            {!! Form::label('Ration Card No.', null, ['class' => 'col-sm-2 control-label required']) !!}
                            <div class="col-sm-4 {{ $errors->has('rcno') ? ' has-error' : '' }}">
                                {!! Form::text('rcno', null, ['class' => 'form-control','placeholder'=>'अपना राशन कार्ड नंबर डाले','maxlength'=>'12','minlength'=>'12','onkeypress'=>'return isAlphaNumeric(event)','pattern'=>'^[a-zA-Z0-9_]*(?!\1+$)\d{11}$' ]) !!}
                                <!-- 'pattern'=>'^(?!.*([A-Za-z0-9_])\1{5})(?=.*[a-z])(?=.*\d)[A-Za-z0-9]+$' -->
                                <span id="rcno1"></span>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            {!! Form::label('Mobile No', null, ['class' => 'col-sm-2 control-label required']) !!}
                            <div class="col-sm-4 {{ $errors->has('mobile') ? ' has-error' : '' }} ">
                                {!! Form::text('mobile', null, ['class' => 'form-control','placeholder'=>'अपना मोबाइल नंबर डाले ','maxlength'=>'10','minlength'=>'10','onkeypress'=>'return isNumber(event)', 'pattern'=>'^[6789]\d{9}$','pattern'=>'^(\d)(?!\1+$)\d{9}$']) !!}
                                <span id="mobile1"></span>
                            </div>
                            {!! Form::label('Marital Status', null, ['class' => 'col-sm-2 control-label required']) !!}
                            <div class="col-sm-4 {{ $errors->has('marital_status') ? ' has-error' : '' }}">
                                {!! Form::select('marital_status', getMaritalStatus(),null, ['class' => 'form-control','id'=>'marital_status']) !!}
                                <span id="marital_status1"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            {!! Form::label('Gender', null, ['class' => 'col-sm-2 control-label required']) !!}
                            <div class="col-sm-4 {{ $errors->has('gender') ? ' has-error' : '' }}">
                                {!! Form::select('gender', getGender(),null, ['class' => 'form-control']) !!}
                                <span id="gender1"></span>
                            </div>
                            {!! Form::label('Caste Category', null, ['class' => 'col-sm-2 control-label required']) !!}
                            <div class="col-sm-4 {{ $errors->has('caste') ? ' has-error' : '' }}">
                                {!! Form::select('caste',getCasteCategory(), null, ['class' => 'form-control']) !!}
                                <span id="caste1"></span>
                            </div>
                        </div>
                        <legend>Land Details / ज़मीन का विवरण (In acres / एकड़ में )</legend>
                        <div class="form-group">
                            {!! Form::label('District', null, ['class' => 'col-sm-2 control-label required']) !!}
                            <div class="col-sm-4 {{ $errors->has('idDistrict') ? ' has-error' : '' }}">
<!--                                <select name="idDistrict" class="form-control" id="idDistrict">
                                    <option value="" selected="selected">--- अपना जिला चुने ---</option>
                                    @foreach ($districts as $key => $value)
                                    <option value="{{ $key }}">{{ $value }}</option>
                                    @endforeach
                                </select>-->
                                {!! Form::select('idDistrict',$districts, null, ['class' => 'form-control select2','id'=>'idDistrict']) !!}
                                <span id="idDistrict1"></span>
                            </div>
                            {!! Form::label('Village', null, ['class' => 'col-sm-2 control-label required']) !!}
                            <div class="col-sm-4 {{ $errors->has('idVillage') ? ' has-error' : '' }}">
                                <select name="idVillage" class="form-control select2" id="idVillage" >
                                    <option value="" selected="selected"></option>
                                </select>
                                <span  id="idVillage1"></span>
                            </div>
                            
                            
                        
                        </div>
                        <div class="form-group">
                            {!! Form::label('Subdivision', null, ['class' => 'col-sm-2 control-label required']) !!}
                                <div class="col-sm-4 {{ $errors->has('idSubdivision') ? ' has-error' : '' }}">
                                    <select name="idSubdivision" class="form-control select2" id="idSubdivision">--- Select Subdivision ---
                                    <option value="" selected="selected"></option></select>
                                    <span id="idSubdivision1"></span>
                                </div>                           
                            
                            {!! Form::label('Location Of Land', null, ['class' => 'col-sm-2 control-label required']) !!}
                                <div class="col-sm-4 {{ $errors->has('land_location') ? ' has-error' : '' }}">
                                    {!! Form::text('land_location', null, ['class' => 'form-control','placeholder'=>'जमीन का स्थान','minlength'=>'2','maxlength'=>'30','pattern'=>'^[a-zA-Z0-9 !@#$%^&*)(]{2,30}$']) !!}
                                    <span id="land_location1"></span>
                                </div>
                            
                            
                            
                        </div>
                        <div class="form-group">
                            {!! Form::label('Block', null, ['class' => 'col-sm-2 control-label required']) !!}
                            <div class="col-sm-4 {{ $errors->has('idBlock') ? ' has-error' : '' }}">
                                <select name="idBlock" class="form-control select2" id="idBlock">--- Select Block ---
                                    <option value="" selected="selected"></option></select>
                                <span id="idBlock1"></span>
                            </div>
                            {!! Form::label('Total Land', null, ['class' => 'col-sm-2 control-label required']) !!}
                                <div class="col-sm-4 {{ $errors->has('total_land') ? ' has-error' : '' }}">
                                    {!! Form::text('total_land', null, ['class' => 'form-control','placeholder'=>'कुल रकबा (in Hectares) ','maxlength'=>'12','minlength'=>'1','onkeypress'=>'return isNumber(event)','pattern'=>'^[1-9]\d*(\.\d+)?$']) !!}
                                    <span  id="total_land1"></span>
                                </div> 

                        </div>
                        
                        <fieldset>
                            <legend>Bank Details / बैंक विवरण</legend>
<!--                            <strong>Bank Details</strong>-->
                            <div class="form-group">
                                {!! Form::label('IFSC', null, ['class' => 'col-sm-2 control-label required']) !!}
                                <div class="col-sm-4 {{ $errors->has('ifsc_code') ? ' has-error' : '' }}">
                                   {!! Form::text('ifsc_code' ,null, ['class' => 'form-control ', 'placeholder'=>'अपना बैंक का IFSC Code डाले ','minlength'=>'11','maxlength'=>'11','onkeypress'=>'return isAlphaNumeric','pattern'=>'^[A-Za-z]{4}\d{7}$']) !!}
                                     <span  id="ifsc_code1"></span>
                                </div>
                                {!! Form::label('Bank Name', null, ['class' => 'col-sm-2 control-label required']) !!}
                                <div class="col-sm-4 {{ $errors->has('bank_name') ? ' has-error' : '' }}">
                                    {!! Form::text('bank_name', null, ['class' => 'form-control','placeholder'=>'बैंक का नाम','id'=>'bankname_1','pattern'=>'^[^-\s][a-zA-Z_\s-]+$','maxlength'=>'50','minlength'=>'3','onkeypress'=>'return lettersOnly(event)']) !!}
                                    <span  id="bank_name1"></span>
                                </div>
                            </div>
                            <div class="form-group">
                                {!! Form::label('Branch Details', null, ['class' => 'col-sm-2 control-label required']) !!}
                                <div class="col-sm-4 {{ $errors->has('bank_branch') ? ' has-error' : '' }}">
                                    {!! Form::text('bank_branch', null, ['class' => 'form-control','placeholder'=>'अपने बैंक शाखा का नाम डाले ','id'=>'branchname_1','maxlength'=>'40','minlength'=>'3']) !!}
                                    <span class="help-block" id="bank_branch1"></span>
                                </div>
                                {!! Form::label('Account No.', null, ['class' => 'col-sm-2 control-label required']) !!}
                                <div class="col-sm-4 {{ $errors->has('account_no1') ? ' has-error' : '' }}">
                                    {!! Form::text('account_no', null, ['class' => 'form-control','placeholder'=>'अपने बैंक खाता नंबर डाले ','maxlength'=>'16','minlength'=>'12','onkeypress'=>'return isNumber(event)','pattern'=>'^(\d)(?!\1+$)\d{15}$']) !!}
                                    <span  id="account_no1"></span>
                                </div>
                            </div>                            
                        </fieldset>
                        <legend>Disclaimer /अस्वीकरण</legend>
                        <div class="form-group">
                            <!-- <div class="col-sm-1"></div> -->
                            <div class="col-sm-12 checkbox-inline {{ $errors->has('check') ? ' has-error' : '' }}">
                            <center><input type="checkbox" name="check" id="check" >
                                <label style=" font-size:14px; letter-spacing: 1px; font-family:'DSDIGI' !important;">All The Above Information Is Correct According To Me | मेरे द्वारा दिए गए सभी प्राप्त जानकारी सही है .</label></center>
                            <center><span class="col-sm-5 help-block" id="check1"></span></center>
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
                    url: "{{url('/farmer/district/') }}"+'/' +districtID + "/subdivisions",
                    type: "GET",
                    dataType: "json",
                    success:function(data) {
                        $('select[name="idSubdivision"]').empty();
                        $.each(data, function(key, value) {
                            $('select[name="idSubdivision"]').append('<option value="'+ key +'">'+ value +'</option>');
                        });

                    }
                });
            }else{
                $('select[name="idBlock"]').empty();
            }
        });
        // var cur_dist = $( "#idDistrict option:selected" ).val();
        // if(cur_dist){
        //     $.ajax({
        //         url: "{{url('/farmer/district/') }}"+'/' +cur_dist + "/subdivisions",
        //         type: "GET",
        //         dataType: "json",
        //         success:function(data) {
        //             $('select[id="idSubdivision"]').empty();
        //             $.each(data, function(key, value) {
        //                 $('select[id="idSubdivision"]').append('<option value="'+ key +'">'+ value +'</option>');
        //             });
        //         }
        //     });
        //  }
         $('select[name="idSubdivision"]').on('change', function() {
            var subID = $(this).val();
            if(subID) {
                $.ajax({
                    url: "{{url('/farmer/subdivision/') }}"+'/' +subID + "/blocks",
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
                            $('select[name="idVillage"] ').append('<option value="'+ key +'">'+ value +'</option>');
                        });

                    }
                });
            }else{
                $('select[name="idVillage"]').empty();
            }
        });
        // var cur_block = $( "#idBlock option:selected" ).val();
        // if(cur_block){
        //     $.ajax({
        //         url: "{{url('/farmer/block/') }}"+'/' +cur_block + "/villages",
        //         type: "GET",
        //         dataType: "json",
        //         success:function(data) {
        //             $('select[id="idVillage"]').empty();
        //             $.each(data, function(key, value) {
        //                 $('select[id="idVillage"]').append('<option value="'+ key +'">'+ value +'</option>');
        //             });
        //         }
        //     });
        //  }
        
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
$('#register').on('submit',function(e){
        $.ajaxSetup({
        header:$('meta[name="_token"]').attr('content')
    });
    var formData = $(this).serialize();
        $.ajax({
            type:"POST",
            url: "{{url('farmer/register') }}",
            data:formData,
            dataType: 'json',
            success:function(data){
                if( data[Object.keys(data)[0]] === 'SUCCESS' ){     //True Case i.e. passed validation
                window.location = "{{url('farmer/successreg')}}";
                }
                else {                  //False Case: With error msg
                $("#msg").html(data);   //$msg is the id of empty msg
                }

            },

            error: function(data){
                       // e.preventDefault(e);
                        if( data.status === 422 ) {
                            var errors = data.responseJSON.errors;
                            // $.each( errors, function( key, value ) {
                               
                               if(errors['aadhaar']=== undefined){
                                        $( '#aadhaar1' ).empty();
                                    }else{
                                       errorname = '<span class="help-block"><strong>'+errors['aadhaar']+'</strong></span>';
                                       $( '#aadhaar1' ).html( errorname );
                                    }
                                   if(errors['idDistrict']=== undefined){
                                        $( '#idDistrict1' ).empty();
                                    }else{
                                       errorname = '<span class="help-block"><strong>'+errors['idDistrict']+'</strong></span>';
                                       $( '#idDistrict1' ).html( errorname );
                                    }
                                    if(errors['idBlock']=== undefined){
                                        $( '#idBlock1' ).empty();
                                    }else{
                                       errorname = '<span class="help-block"><strong>'+errors['idBlock']+'</strong></span>';
                                       $( '#idBlock1' ).html( errorname );
                                    }
                                    if(errors['idVillage']=== undefined){
                                        $( '#idVillage1' ).empty();
                                    }else{
                                       errorname = '<span class="help-block"><strong>'+errors['idVillage']+'</strong></span>';
                                       $( '#idVillage1' ).html( errorname );
                                    }
                                    if(errors['name']=== undefined){
                                        $( '#name1' ).empty();
                                    }else{
                                       errorname = '<span class="help-block"><strong>'+errors['name']+'</strong></span>';
                                       $( '#name1' ).html( errorname );
                                    }
                                    if(errors['father_name']=== undefined){
                                        $( '#father_name1' ).empty();
                                    }else{
                                       errorfname = '<span class="help-block"><strong>'+errors['father_name']+'</strong></span>';
                                       $( '#father_name1' ).html( errorfname );
                                    }
                                  if(errors['idSubdivision']=== undefined){
                                       $( '#idSubdivision1' ).empty();
                                   }else{
                                      erroraadhar = '<span class="help-block"><strong>'+errors['idSubdivision']+'</strong></span>';
                                      $( '#idSubdivision1' ).html( erroraadhar );
                                  }
                                   if(errors['aadhaarabc']=== undefined){
                                        $( '#aadhaarabc1' ).empty();
                                    }else{
                                       erroraadhar = '<span class="help-block"><strong>'+errors['aadhaarabc']+'</strong></span>';
                                       $( '#aadhaarabc1' ).html( erroraadhar );
                                   }
                                   if(errors['mobile']=== undefined){
                                        $( '#mobile1' ).empty();
                                    }else{
                                       errormob = '<span class="help-block"><strong>'+errors['mobile']+'</strong></span>';
                                       $( '#mobile1' ).html( errormob );
                                   }
                                   if(errors['rcno']=== undefined){
                                        $( '#rcno1' ).empty();
                                    }else{
                                       errorrc = '<span class="help-block"><strong>'+errors['rcno']+'</strong></span>';
                                       $( '#rcno1' ).html( errorrc );
                                   }
                                   if(errors['caste']=== undefined){
                                        $( '#caste1' ).empty();
                                    }else{
                                       errorcaste = '<span class="help-block"><strong>'+errors['caste']+'</strong></span>';
                                       $( '#caste1' ).html( errorcaste );
                                   }
                                   if(errors['land_location']=== undefined){
                                        $( '#land_location1' ).empty();
                                    }else{
                                       errorland = '<span class="help-block"><strong>'+errors['land_location']+'</strong></span>';
                                       $( '#land_location1' ).html( errorland );
                                   }
                                   if(errors['total_land']=== undefined){
                                        $( '#total_land1' ).empty();
                                    }else{
                                       errortot = '<span class="help-block"><strong>'+errors['total_land']+'</strong></span>';
                                       $( '#total_land1' ).html( errortot );
                                   }
                                   if(errors['gender']=== undefined){
                                        $( '#gender1' ).empty();
                                    }else{
                                       errorgen = '<span class="help-block"><strong>'+errors['gender']+'</strong></span>';
                                       $( '#gender1' ).html( errorgen );
                                   }
                                   if(errors['account_no']=== undefined){
                                        $( '#account_no1' ).empty();
                                    }else{
                                       errorland = '<span class="help-block"><strong>'+errors['account_no']+'</strong></span>';
                                       $( '#account_no1' ).html( errorland );
                                   }
                                   if(errors['bank_name']=== undefined){
                                        $( '#bank_name1' ).empty();
                                    }else{
                                       errortot = '<span class="help-block"><strong>'+errors['bank_name']+'</strong></span>';
                                       $( '#bank_name1' ).html( errortot );
                                   }
                                   if(errors['bank_branch']=== undefined){
                                        $( '#bank_branch1' ).empty();
                                    }else{
                                       errorgen = '<span class="help-block"><strong>'+errors['bank_branch']+'</strong></span>';
                                       $( '#bank_branch1' ).html( errorgen );
                                   }
                                   if(errors['marital_status']=== undefined){
                                        $( '#marital_status1' ).empty();
                                    }else{
                                       errorgen = '<span class="help-block"><strong>'+errors['marital_status']+'</strong></span>';
                                       $( '#marital_status1' ).html( errorgen );
                                   }
                                   if(errors['ifsc_code']=== undefined){
                                        $( '#ifsc_code1' ).empty();
                                    }else{
                                       errorgen = '<span class="help-block"><strong>'+errors['ifsc_code']+'</strong></span>';
                                       $( '#ifsc_code1' ).html( errorgen );
                                   }
                                   if(errors['check']=== undefined){
                                        $( '#check1' ).empty();
                                    }else{
                                       errorgen = '<span class="help-block"><strong>'+errors['check']+'</strong></span>';
                                       $( '#check1' ).html( errorgen );
                                   }
                                // });
                        }
                }
        });
        return false;
    });
			      
</script>
 </body>
</html>
