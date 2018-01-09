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
//                       $('#userdet').empty();
//                        $.each(data, function(key, value) {
//                          //  console.log(value['user_district']);
//                            if(value['user_district'].length >0){
//                                $('#userdistrict').append('<h4>District User</h4>');
//                                    
//                                $.each(value['user_district'], function(key1, value1) {
//                                    $.each(value1['district'], function(key2, value2) {
//                                        $('#userdistrict').append('<strong>'+value2+'</strong>-');  
//                                    });
//                                    $.each(value1['designation'], function(key3, value3) {
//                                        $('#userdistrict').append('<strong>'+value3+'</strong>,');  
//                                    });
//                                });
//                            }
//                            if(value['user_subdivision'].length >0){
//                                $('#usersubdivision').append('<h4>Subdivision User</h4>');
//                                    
//                                $.each(value['user_subdivision'], function(key1, value1) {
//                                    $.each(value1['subdivision'], function(key2, value2) {
//                                        $('#usersubdivision').append('<strong>'+value2+'</strong>-');  
//                                    });
//                                    $.each(value1['designation'], function(key3, value3) {
//                                        $('#usersubdivision').append('<strong>'+value3+'</strong>,');  
//                                    });
//                                });
//                            }
//                            if(value['user_block'].length >0){
//                                $('#userblock').append('<h4>Block User</h4>');
//                                    
//                                $.each(value['user_block'], function(key1, value1) {
//                                    $.each(value1['block'], function(key2, value2) {
//                                        $('#userblock').append('<strong>'+value2+'</strong>-');  
//                                    });
//                                    $.each(value1['designation'], function(key3, value3) {
//                                        $('#userblock').append('<strong>'+value3+'</strong>,');  
//                                    });
//                                });
//                            }
//                            if(value['user_village'].length >0){
//                                $('#uservillage').append('<h4>Village User</h4>');
//                                    
//                                $.each(value['user_village'], function(key1, value1) {
//                                    $.each(value1['village'], function(key2, value2) {
//                                        $('#uservillage').append('<strong>'+value2+'</strong>-');  
//                                    });
//                                    $.each(value1['designation'], function(key3, value3) {
//                                        $('#uservillage').append('<strong>'+value3+'</strong>,');  
//                                    });
//                                });
//                            }
//                        });

                    }
                });
            }
        });
    });
</script>