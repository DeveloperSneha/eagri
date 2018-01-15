<script>
$(document).ready(function () {
    $('select[id="idDistrict"]').on('change', function(e) {
            var districtID = $(this).val();
            console.log(districtID.length);
            if(districtID.length > 0) {
                $.ajax({
                    type: "GET",
                    url: "{{url('/district') }}"+'/' +districtID + "/subdivisions",
                
                    dataType: 'json',
                    success:function(data) {
                        $('select[id="idSubdivision"]').empty();
                        $('select[id="idSubdivision"]').append('<option value="">Select Subdivision</option>');
                        $.each(data, function(key, value) {
                            $('select[id="idSubdivision"]').append('<option value="'+ key +'">'+ value +'</option>');
                        });
                    }
                });
            }else{
                $('select[id="idSubdivision"]').empty();
            }
    });
   var cur_district = $( "#idDistrict option:selected" ).val();
        if(cur_district){
            $.ajax({
                url: "{{url('/district') }}"+'/' +cur_district + "/subdivisions",
                type: "GET",
                dataType: "json",
                success:function(data) {
                  
                    @if(isset($userdesig))
                        var myPlayList = [];
                       
                                var h = {{$userdesig->idSubdivision}}; 
                                myPlayList.push(h.toString());
                         
                        $.each(data, function(key, value) {
                            if($.inArray(key,myPlayList) === -1){
                                    $('select[id="idSubdivision"]').append('<option value="'+ key +'" >'+ value +'</option>');
                                }else{
                                   $('select[id="idSubdivision"] option:selected').append('<option value="'+ key +'" >'+ value +'</option>');
                                }                            
                            });
                    @endif
                }

              });  
         }
    $('select[id="idSubdivision"]').on('change', function(e) {
           var subdivisionID = $(this).val();
           if(subdivisionID.length > 0) {
                $.ajax({
                    type: "GET",
                    url: "{{url('/usersubdivision') }}"+'/' +subdivisionID + "/blocks",
                    dataType: 'json',
                    success:function(data) {
                        $('select[id="idBlock"]').empty();
                       // $('select[id="idBlock"]').append('<option value="">Select Block</option>');
                        $.each(data, function(key, value) {
                            $('select[id="idBlock"]').append('<option value="'+ key +'">'+ value +'</option>');
                        });
                    }
                });
            }else{
                $('select[id="idBlock"]').empty();
            }
    });
    var cur_subdiv = $( "#idSubdivision option:selected" ).val();
        if(cur_subdiv){
            $.ajax({
                url: "{{url('/usersubdivision') }}"+'/' +cur_subdiv + "/blocks",
                type: "GET",
                dataType: "json",
                success:function(data) {
                    @if(isset($userdesig))
                        var myPlayList = [];
                        
                                var h = {{$userdesig->idBlock}}; 
                                myPlayList.push(h.toString());
                         
                        $.each(data, function(key, value) {
                            if($.inArray(key,myPlayList) === -1){
                                    $('select[id="idBlock"]').append('<option value="'+ key +'" >'+ value +'</option>');
                                }else{
                                   $('select[id="idBlock"] option:selected').append('<option value="'+ key +'" >'+ value +'</option>');
                                }                            
                            });
                    @endif
                }
            });
         }
    $('select[name="idSection"]').on('change', function() {
        var sectionID = $(this).val();
        if(sectionID) {
            $.ajax({
                url: "{{url('/userblock') }}"+'/' +sectionID + "/designations",
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
                url: "{{url('/userblock') }}"+'/' +cur_section + "/designations",
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
</script>