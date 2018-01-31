<script>
$(document).ready(function () {
    $('select[name="idSection"]').on('change', function() {
        var sectionID = $(this).val();
        if(sectionID) {
            $.ajax({
                url: "{{url('/userdistrict') }}"+'/' +sectionID + "/designations",
                type: "GET",
                dataType: "json",
                success:function(data) {
                    $('select[id="idDesignation"]').empty();
                    $.each(data, function(key, value) {
                        $('select[id="idDesignation"]').append('<option value="'+ key +'">'+ value +'</option>');
                    });

                }
            });
        }else{
            $('select[id="idDesignation"]').empty();
        }
    });
        
    var cur_section = $( "#section option:selected" ).val();
        if(cur_section){
            $.ajax({
                url: "{{url('/userdistrict') }}"+'/' +cur_section + "/designations",
                type: "GET",
                dataType: "json",
                success:function(data) {
                    $('select[id="idDesignation"]').empty();
                    $.each(data, function(key, value) {
                        $('select[id="idDesignation"]').append('<option value="'+ key +'">'+ value +'</option>');
                    });
                }
            });
         }
        $('select[name="idUser"]').on('change', function() {
            var userID = $(this).val();
            if(userID) {
                $.ajax({
                    url: "{{url('/userdistrict') }}"+'/' +userID,
                    type: "GET",
                    dataType: "json",
                    success:function(data) {
                         $('#userdet').empty();
                            $.each(data, function(key, value) {
                            if(value['villageName']===null && value['blockName']===null && value['subDivisionName']===null){
                                $('#userdet').append('<div class="col-sm-12"><p class="form-control-static"><strong>District - </strong> '+value['districtName']+',  <strong>Section -</strong>'+value['sectionName']+',  <strong>Designation -</strong>'+value['designationName']+'</p></div>');
                            }else if(value['villageName']===null && value['blockName']===null){
                                $('#userdet').append('<div class="col-sm-12"><p class="form-control-static"><strong> Subdivision - </strong>'+value['subDivisionName']+',  <strong>Section -</strong>'+value['sectionName']+', <strong>Designation -</strong>'+value['designationName']+'</p></div>');
                            }else if(value['villageName']===null){
                                $('#userdet').append('<div class="col-sm-12"><p class="form-control-static"><strong> Block - </strong>'+value['blockName']+' ,  <strong>Section -</strong>'+value['sectionName']+', <strong>Designation -</strong>'+value['designationName']+'</p></div>');
                            }else{
                                $('#userdet').append('<div class="col-sm-12"><p class="form-control-static"><strong> Village - </strong>'+value['villageName']+' ,  <strong>Section -</strong>'+value['sectionName']+', <strong>Designation -</strong>'+value['designationName']+'</p></div>');
                            }
//                            $.each(value, function(key1, value1) {
//                                $('#userdet').append('<label class="col-sm-4 control-label">'+ key1 +'</label><div class="col-sm-8"><p class="form-control-static">'+value1+'</p></div>');
//                            });
                        });


                    }
                });
            }
        });
    });
    $('#userdistrict').on('submit',function(e){
        $.ajaxSetup({
        header:$('meta[name="_token"]').attr('content')
    });
    var formData = $(this).serialize();
        $.ajax({
            type:"POST",
            url: "{{url('/userdistrict/') }}",
            data:formData,
            dataType: 'json',
            success:function(data){
                if( data[Object.keys(data)[0]] === 'SUCCESS' ){		//True Case i.e. passed validation
                window.location = "{{url('userdistrict')}}";
                }
                else {					//False Case: With error msg
                $("#msg").html(data);	//$msg is the id of empty msg
                }

            },

            error: function(data){
                       // e.preventDefault(e);
                        if( data.status === 422 ) {
                            var errors = data.responseJSON.errors;
                            $.each( errors, function( key, value ) {                                
                               var errors = data.responseJSON.errors;
                            var errorHtml = '<div class="alert alert-danger"><ul>';
                            $.each( errors, function( key, value ) {    
                               errorHtml += '<li>' + value + '</li>'; 
                            });
                            errorHtml += '</ul></div>';
                             $('#formerrors').html(errorHtml);
                            });
                           
                     }
                }
        });
        return false;
    });
</script>