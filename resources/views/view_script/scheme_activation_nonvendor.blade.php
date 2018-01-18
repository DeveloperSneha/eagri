<script>
    $('select[name="idSection"]').on('change', function() {
            var sectionID = $(this).val();
            if(sectionID) {
                $.ajax({
                    url: "{{url('/section') }}"+'/' +sectionID + "/schemes",
                    type: "GET",
                    dataType: "json",
                    success:function(data) {
                        $('select[name="idScheme"]').empty();
                        $('select[name="idScheme"]').append('<option val>---Select Scheme--</option>');
                        $.each(data, function(key, value) {
                            $('select[name="idScheme"]').append('<option value="'+ key +'">'+ value +'</option>');
                        });

                    }
                });
            }else{
                $('select[name="idScheme"]').empty();
            }
    });
    var cur_section = $( "#section option:selected" ).val();
    if(cur_section){
        $.ajax({
                url: "{{url('/section') }}"+'/' +cur_section + "/schemes",
                type: "GET",
                dataType: "json",
                success:function(data) {
                    $('select[name="idScheme"]').empty();
                    $('select[name="idScheme"]').append('<option val>---Select Scheme--</option>');
                    $.each(data, function(key, value) {
                        $('select[name="idScheme"]').append('<option value="'+ key +'">'+ value +'</option>');
                    });

                }
            });                    
    }
    
    
        
    $('select[name="idSection"]').on('change', function() {
        var sectionID = $(this).val();
        if(sectionID) {
            $.ajax({
                url: "{{url('/section') }}"+'/' +sectionID + "/workflows",
                type: "GET",
                dataType: "json",
                success:function(data) {
                    $('select[name="idWorkflow"]').empty();
                    $('select[name="idWorkflow"]').append('<option val>---Select Workflow--</option>');
                    $.each(data, function(key, value) {
                        $('select[name="idWorkflow"]').append('<option value="'+ key +'">'+ value +'</option>');
                    });

                }
            });
        }else{
            $('select[name="idScheme"]').empty();
        }
    });
    
    var cur_section1 = $( "#section option:selected" ).val();
    if(cur_section1){
        $.ajax({
                url: "{{url('/section') }}"+'/' +cur_section1 + "/workflows",
                type: "GET",
                dataType: "json",
                success:function(data) {
                    @if(isset($sch))
                        var myPlayList = [];
                        @if(isset($sch_workflow))
                            @foreach($sch_workflow as $val=>$key)
                                var h = {{$val}};
                                myPlayList.push(h.toString());
                            @endforeach
                        @endif
                        $.each(data, function(key, value) {
                            console.log($.inArray(key,myPlayList));
                            if($.inArray(key,myPlayList) === -1){
                                    $('select[name="idWorkflow"]').append('<option value="'+ key +'" >'+ value +'</option>');
                                }else{
                                   $('select[name="idWorkflow"] option:selected').append('<option value="'+ key +'" >'+ value +'</option>');
                                }                            
                            });
                    @endif
//                    $('select[name="idWorkflow"]').empty();
//                    $('select[name="idWorkflow"]').append('<option val>---Select Workflow--</option>');
//                    $.each(data, function(key, value) {
//                        $('select[name="idWorkflow"]').append('<option value="'+ key +'">'+ value +'</option>');
//                    });

                }
            });                  
    }
    
    $('select[name="idScheme"]').on('change', function() {
        var schemeID = $(this).val();
        if(schemeID) {
            $.ajax({
                url: "{{url('/schemes') }}"+'/' +schemeID + "/programs",
                type: "GET",
                dataType: "json",
                success:function(data) {
                    $('select[name="idProgram"]').empty();
                    $('select[name="idProgram"]').append('<option val>---Select Program--</option>');
                    $.each(data, function(key, value) {
                        $('select[name="idProgram"]').append('<option value="'+ key +'">'+ value +'</option>');
                    });
                    
                }
            });
        }else{
            $('select[name="idProgram"]').empty();
        }
    });
    $('#idProgram').click(function(){
        //console.log('here');
        var cur_scheme = $( "#idScheme option:selected" ).val();
        if(cur_scheme){
            $.ajax({
                    url: "{{url('/schemes') }}"+'/' +cur_scheme + "/programs",
                    type: "GET",
                    dataType: "json",
                    success:function(data) {
                        $('select[name="idProgram"]').empty();
                        $.each(data, function(key, value) {
                            $('select[name="idProgram"]').append('<option value="'+ key +'">'+ value +'</option>');
                        });

                    }
                });                    
        }
    });
    $('select[name="idWorkflow"]').on('change', function() {
        var workflowID = $(this).val();
        if(workflowID) {
            $.ajax({
                url: "{{url('/workflow') }}"+'/' +workflowID + "/designations",
                type: "GET",
                dataType: "json",
                success:function(data) {
                    $('#desig').empty();
                    $.each(data, function(key, value) {
                        $('#desig').append('<label >'+ key +'</label>,<br>');
                    });

                }
            });
        }else{
            $('#desig').empty();
        }
    });
    var cur_workflow = $( "#workflow option:selected" ).val();
    if(cur_workflow){
        $.ajax({
                url: "{{url('/workflow') }}"+'/' +cur_workflow + "/designations",
                type: "GET",
                dataType: "json",
                success:function(data) {
                    $('#desig').empty();
                    $.each(data, function(key, value) {
                        $('#desig').append('<label >'+ key +'</label>,<br>');
                    });

                }
            });
                       
    }
//    
//    $('#schemeactivation').on('submit',function(e){
//        $.ajaxSetup({
//        header:$('meta[name="_token"]').attr('content')
//    });
//    var formData = $(this).serialize();
//        $.ajax({
//            type:"POST",
//            url: "{{url('/schemeactivations/nv/') }}",
//            data:formData,
//            dataType: 'json',
//            success:function(data){
//                if( data[Object.keys(data)[0]] === 'SUCCESS' ){		//True Case i.e. passed validation
//                window.location = "{{url('schemeactivations/nv')}}";
//                }
//                else {					//False Case: With error msg
//                $("#msg").html(data);	//$msg is the id of empty msg
//                }
//
//            },
//
//            error: function(data){
//                        if( data.status === 422 ) {
//                            var errors = data.responseJSON.errors;
//                            var errorHtml = '<div class="alert alert-danger"><ul>';
//                            $.each( errors, function( key, value ) {    
//                               errorHtml += '<li>' + value + '</li>'; 
//                            });
//                            errorHtml += '</ul></div>';
//                            $('#formerrors').html(errorHtml);
//                           
//                     }
//                }
//        });
//        return false;
//    });
</script>
