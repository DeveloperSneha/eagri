<script>
$(document).ready(function () {
    $('.select-all').on('click', function () {
        var checkAll = this.checked;
        var totalCount = $('input:checkbox').length;
        
        var tf = parseFloat($("#area-fund #aaaaa:first-child input").val());
        var ta = parseFloat($("#area-fund #aaaaa:nth-child(2) input").val());
        var assistance = parseFloat($("#area-fund #aaaaa:last-child input").val());
        $('input[type=checkbox]').each(function () {
            
            this.checked = checkAll;
            var area ='#areablock'+ this.value;
            var amt = '#amtblock'+ this.value;
            var hiddenarea = '#hiddenarea'+this.value;
            var hiddenamount = '#hiddenamount'+this.value;

            $(area).val((parseFloat(ta)/parseFloat(totalCount)).toFixed(0));
            $(amt).val((((parseFloat(ta)/parseFloat(totalCount)).toFixed(0))* parseFloat(assistance)).toFixed(0));
            $(hiddenarea).val((parseFloat(ta)/parseFloat(totalCount)).toFixed(0));
            $(hiddenamount).val((((parseFloat(ta)/parseFloat(totalCount)).toFixed(0))* parseFloat(assistance)).toFixed(0));
        });
        $("#area-fund #aaaaa:first-child input").val(parseFloat(tf) - (((((parseFloat(ta)/parseFloat(totalCount)).toFixed(0))* parseFloat(assistance)).toFixed(0))*parseFloat(totalCount)));
        $("#area-fund #aaaaa:nth-child(2) input").val(parseFloat(ta) - ((parseFloat(ta)/parseFloat(totalCount)).toFixed(0)* parseFloat(totalCount)));
        
        if($("#area-fund #aaaaa:first-child input").val() <=0){
           var errors = 'Financial Target Of This Block Exceeded the limit';
            errorHtml='<div class="alert alert-danger"><ul>';
                            errorHtml += '<li>' + errors + '</li>';
                            errorHtml += '</ul></div>';
                          $( '#formerrors' ).html( errorHtml );
        }else if($("#area-fund #aaaaa:nth-child(2) input").val() <=0){
            var errors = 'Physical Target Of This Block Exceeded the limit';
            errorHtml='<div class="alert alert-danger"><ul>';
                            errorHtml += '<li>' + errors + '</li>';
                            errorHtml += '</ul></div>';
                          $( '#formerrors' ).html( errorHtml );
        }else{
            var errors = '';
            errorHtml ='';
            $( '#formerrors' ).html( errorHtml );
        }
    });

    $('select[name="idSchemeActivation"]').on('change', function () {
        var schemeActivationID = $(this).val();
        if (schemeActivationID) {
            $.ajax({
                url: "{{url('/authority/schemedistrict') }}" + '/' + schemeActivationID,
                type: "GET",
                dataType: "json",
                success:function(data) {
                    $('#area-fund').empty();
                    $.each(data, function(key, value) {
                       $('#area-fund').append('<div id ="aaaaa"><label class="col-sm-2 control-label">'+ key +'</label><div class="col-sm-2"><input type="text" value="'+ value +'" readonly></div></div>');
                    });
                }
            });
        } else {
                $('#area-fund').empty();
                }
        });

    $('#blockdistribution').on('submit', function (e) {
    $.ajaxSetup({
    header: $('meta[name="_token"]').attr('content')
    })

    var formData = $(this).serialize();
        $.ajax({
        type: "POST",
                url: "{{url('/authority/blockwisescheme/') }}",
                data: formData,
                dataType: 'json',
                success: function (data) {
                if (data[Object.keys(data)[0]] === 'SUCCESS') {//True Case i.e. passed validation
                window.location = "{{url('authority/blockwisescheme')}}";
                } else {					//False Case: With error msg
                        $("#msg").html(data); //$msg is the id of empty msg
                    }
                },
                error: function(data){
                       // e.preventDefault(e);
                        if( data.status === 422 ) {
                            var errors = data.responseJSON.errors;
                            errorHtml='<div class="alert alert-danger">';
                            $.each( errors, function( key, value ) {
                                 if (key.split(".")[1] + '.amountBlock'==key.split(".")[1] + '.' +key.split(".")[2])
                                 {
                                    erroramt = '<p>' + value + '</p>';
                                    $( '#erroramt'+key.split(".")[1] ).html( erroramt );
                                 }
                                 else if(key.split(".")[1] + '.areaBlock'==key.split(".")[1] + '.' +key.split(".")[2])
                                 {
                                     erroraa = '<p>' + value + '</p>';
                                     $( '#errorarea'+key.split(".")[1] ).html( erroraa );
                                 }else if(key.split(".")[1] + '.idBlock'==key.split(".")[1] + '.' +key.split(".")[2])
                                 {
                                     errordist = '<p>' + value + '</p>';
                                     $( '#errorblock'+key.split(".")[1] ).html( errordist );
                                 }
                                 else{
                                     errorHtml='<div class="alert alert-danger"><ul>';
                                     errorHtml += '<p>' + value + '</p>';
                                     errorHtml += '</div>';
                                     $( '#formerrors' ).html( errorHtml );
                                 }
                            });
                     }
                     
                }
        });
    return false;
    //e.preventDefault(e);
    });
});

function getArea($key){
        var tf = parseFloat($("#area-fund #aaaaa:first-child input").val());
        var ta = parseFloat($("#area-fund #aaaaa:nth-child(2) input").val());
        var area ='#areablock'+ $key;
        var amt = '#amtblock'+ $key;
        var hiddenarea = '#hiddenarea'+$key;
        var hiddenamount = '#hiddenamount'+$key;

  if( $('#selectall').prop('checked')){
      if($(area).val()<=0){
             $(area).css('border-color', 'red');
              $(area).tooltip();
              $(area).attr('title', 'Negative Value Not Allowed !!');
            // alert('Negative Value Not Allowed !!');
            return;
        }
        
        var amount = $("#area-fund #aaaaa:last-child input").val() * $(area).val();
                     $(amt).val(amount);
        
        var tf = parseFloat($("#area-fund #aaaaa:first-child input").val());
        var total_fund = parseFloat(tf) + parseFloat($(hiddenamount).val()) ;
            total_fund = parseFloat(total_fund) - amount;

            $("#area-fund #aaaaa:first-child input").val(total_fund);
            var hiddenamount =  $(hiddenamount).val(amount);
            if(total_fund <=0){
               var errors = 'Financial Target Of This Block Exceeded the limit';
                errorHtml='<div class="alert alert-danger"><ul>';
                                errorHtml += '<li>' + errors + '</li>';
                                errorHtml += '</ul></div>';
                              $( '#formerrors' ).html( errorHtml );
            }else{
                var errors = '';
                errorHtml ='';
                $( '#formerrors' ).html( errorHtml );
            }
        var ta = parseFloat($("#area-fund #aaaaa:nth-child(2) input").val());
        var total_area = parseFloat(ta) + parseFloat($(hiddenarea).val()) ;
            total_area = parseFloat(total_area) - $(area).val();

            $("#area-fund #aaaaa:nth-child(2) input").val(total_area);
          var hiddenarea =  $(hiddenarea).val($(area).val());
          if(total_area <=0){
                var errors = 'Physical Target OF This Block Exceeded the limit';
                errorHtml='<div class="alert alert-danger"><ul>';
                                errorHtml += '<li>' + errors + '</li>';
                                errorHtml += '</ul></div>';
                              $( '#formerrors' ).html( errorHtml );
            }else{
                var errors = '';
                errorHtml ='';
                $( '#formerrors' ).html( errorHtml );
            }
  
  }else{
      if($(area).val()<=0){
             $(area).css('border-color', 'red');
              $(area).tooltip();
              $(area).attr('title', 'Negative Value Not Allowed !!');
            // alert('Negative Value Not Allowed !!');
            return;
        }
        var amount = $("#area-fund #aaaaa:last-child input").val() * $(area).val();
                     $(amt).val(amount);

        var tf = parseFloat($("#area-fund #aaaaa:first-child input").val());

        if($(hiddenamount).val()==""){

            var total_fund = tf +  $(hiddenamount).val();
                total_fund = parseFloat(total_fund) - amount;
            $("#area-fund #aaaaa:first-child input").val(total_fund);
            var hiddenamount =  $(hiddenamount).val(amount);
            if(total_fund <=0){
                $(area).css('border-color', 'red');
                $("#area-fund #aaaaa:first-child input").css('border-color', 'red');
                var errors = 'Financial Target Of This Block Exceeded the limit';
                errorHtml='<div class="alert alert-danger"><ul>';
                                errorHtml += '<li>' + errors + '</li>';
                                errorHtml += '</ul></div>';
                              $( '#formerrors' ).html( errorHtml );


            }else{
                var errors = '';
                errorHtml ='';
                $( '#formerrors' ).html( errorHtml );
            }
       }else{
            var total_fund = parseFloat(tf) + parseFloat($(hiddenamount).val()) ;
            total_fund = parseFloat(total_fund) - amount;

            $("#area-fund #aaaaa:first-child input").val(total_fund);
            var hiddenamount =  $(hiddenamount).val(amount);
            if(total_fund <=0){
               var errors = 'Financial Target Of This Block Exceeded the limit';
                errorHtml='<div class="alert alert-danger"><ul>';
                                errorHtml += '<li>' + errors + '</li>';
                                errorHtml += '</ul></div>';
                              $( '#formerrors' ).html( errorHtml );
            }else{
                var errors = '';
                errorHtml ='';
                $( '#formerrors' ).html( errorHtml );
            }
       }




       if($(hiddenarea).val()==""){

            var total_area = ta +  $(hiddenarea).val();
                total_area = parseFloat(total_area) - $(area).val();
            $("#area-fund #aaaaa:nth-child(2) input").val(total_area);
            var hiddenarea =  $(hiddenarea).val($(area).val());
            if(total_area <=0){
                var errors = 'Physical Target OF This Block Exceeded the limit';
                errorHtml='<div class="alert alert-danger"><ul>';
                                errorHtml += '<li>' + errors + '</li>';
                                errorHtml += '</ul></div>';
                              $( '#formerrors' ).html( errorHtml );
            }else{
                var errors = '';
                errorHtml ='';
                $( '#formerrors' ).html( errorHtml );
            }
       }else{
            var total_area = parseFloat(ta) + parseFloat($(hiddenarea).val()) ;
            total_area = parseFloat(total_area) - $(area).val();

            $("#area-fund #aaaaa:nth-child(2) input").val(total_area);
          var hiddenarea =  $(hiddenarea).val($(area).val());
          if(total_area <=0){
                var errors = 'Physical Target OF This Block Exceeded the limit';
                errorHtml='<div class="alert alert-danger"><ul>';
                                errorHtml += '<li>' + errors + '</li>';
                                errorHtml += '</ul></div>';
                              $( '#formerrors' ).html( errorHtml );
            }else{
                var errors = '';
                errorHtml ='';
                $( '#formerrors' ).html( errorHtml );
            }
       }
   }
}
</script>