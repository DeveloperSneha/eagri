<script>
$(document).ready(function () {
    $('select[id="idDistrict"]').on('change', function(e) {
            var districtID = $(this).val();
            if(districtID.length > 0) {
                $.ajax({
                    type: "GET",
                    url: "{{url('/district') }}"+'/' +districtID + "/subdivisions",
                    dataType: 'json',
                    success:function(data) {
                        $('select[id="idSubdivision"]').empty();
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
                  
                    @if(isset($user))
                        var myPlayList = [];
                        @if(isset($user_subdivision))
                            @foreach($user_subdivision as $val)
                                var h = {{$val->subdivision->idSubdivision}}; 
                                myPlayList.push(h.toString());
                            @endforeach
                        @endif
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
    $('select[name="idSection"]').on('change', function() {
        var sectionID = $(this).val();
        if(sectionID) {
            $.ajax({
                url: "{{url('/usersubdivision') }}"+'/' +sectionID + "/designations",
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
                url: "{{url('/usersubdivision') }}"+'/' +cur_section + "/designations",
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
                           $('#userdet').append('<label class="col-sm-2 control-label">'+ key +'</label><div class="col-sm-10"><p class="form-control-static">'+value+'</p></div>');
                        });

                    }
                });
            }
        });
    
    });
</script>