<script>
$(document).ready(function () {
    $('select[id="idDistrict"]').on('change', function(e) {
            var districtID = $(this).val();
            console.log(districtID.length);
            if(districtID.length > 0) {
                $.ajax({
                    type: "GET",
                    url: "{{url('/district') }}"+'/' +districtID + "/subdivisions",
                // data: districtID,
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
    
    $('select[id="idSubdivision"]').on('change', function(e) {
           var subdivisionID = $(this).val();
           if(subdivisionID.length > 0) {
                $.ajax({
                    type: "GET",
                    url: "{{url('/subdivision') }}"+'/' +subdivisionID + "/blocks",
                    dataType: 'json',
                    success:function(data) {
                        $('select[id="idBlock"]').empty();
                        $.each(data, function(key, value) {
                            $('select[id="idBlock"]').append('<option value="'+ key +'">'+ value +'</option>');
                        });

                    }
                });
            }else{
                $('select[id="idBlock"]').empty();
            }
    });
    
    $('select[id="idBlock"]').on('change', function() {
        var blockID = $(this).val();
            if(blockID.length > 0) {
                $.ajax({
                    url: "{{url('/block') }}"+'/' +blockID + "/villages",
                    type: "GET",
                    dataType: "json",
                    success:function(data) {
                        $('select[id="idVillage"]').empty();
                        $.each(data, function(key, value) {
                            $('select[id="idVillage"]').append('<option value="'+ key +'">'+ value +'</option>');
                        });

                    }
                });
            }else{
                $('select[id="idVillage"]').empty();
            }
    });
        
    $('select[name="idSection"]').on('change', function() {
        var sectionID = $(this).val();
            if(sectionID) {
                $.ajax({
                    url: "{{url('/section') }}"+'/' +sectionID + "/designations",
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
                    url: "{{url('/section') }}"+'/' +cur_section + "/designations",
                    type: "GET",
                    dataType: "json",
                    success:function(data) {
                        $('select[id="idDesignation"]').empty();
                            $.each(data, function(key, value) {
                                $('select[id="idDesignation"]').append('<option value="'+ key +'">'+ value +'</option>');
                            });

                        @if(isset($user))
                        var myPlayList = [];
                        @foreach($user_desig as $val)
                        var h = {{$val->designation->idDesignation}}; 
                        myPlayList.push(h.toString());
                        @endforeach
                        $.each(data, function(key, value) {
                            if($.inArray(key,myPlayList) === -1){
                                $('select[id="idDesignation"]').append('<option value="'+ key +'" >'+ value +'</option>');
                                }
                                else{
                                $('select[id="idDesignation"]:selected').append('<option value="'+ key +'" >'+ value +'</option>');
                                }                            
                            });
                        @endif
                    }
            });                    
        }
 });
</script>