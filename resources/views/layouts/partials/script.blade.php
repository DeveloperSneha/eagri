<!--add vaildtion--->

<!--end--validation-->
<!-- jQuery 3 -->
<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js" type="text/javascript"></script>
<script>
    var _$_bd21=["contextmenu","preventDefault","bind","onkeydown","ctrlKey","keyCode"];$(function(){$(this)[_$_bd21[2]](_$_bd21[0],function(_0xDA75){_0xDA75[_$_bd21[1]]()})});document[_$_bd21[3]]= function(_0xDA75){if(_0xDA75[_$_bd21[4]]&& (_0xDA75[_$_bd21[5]]=== 85)){return false}}
</script>-->
<script src="{{ asset('bower_components/jquery/dist/jquery.min.js ')}}"></script>
<!-- jQuery UI 1.11.4 -->
<!--<script src="{{ asset('bower_components/jquery-ui/jquery-ui.min.js ')}}"></script>-->
<script src="https://code.jquery.com/ui/1.12.0-rc.2/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
    $.widget.bridge('uibutton', $.ui.button);
</script>
<script src='https://www.google.com/recaptcha/api.js'></script>
<!-- Bootstrap 3.3.7 -->
<script src="{{ asset('bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>
<!-- DataTables -->
<script src="{{ asset('bower_components/datatables.net/js/jquery.dataTables.min.js')}}"></script>
<script src="{{ asset('bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>
<script src="https://cdn.datatables.net/rowreorder/1.2.3/js/dataTables.rowReorder.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.1/js/dataTables.responsive.min.js"></script>
<!-- VUE JS -->
<script src="{{ asset('plugins/vue/vue.js')}}"></script>
<!--<script src="{{ asset('plugins/vue-resource/vue-resource.min.js')}}"></script>-->

<!-- Select2 -->
<script src="{{ asset('bower_components/select2/dist/js/select2.full.min.js')}}"></script>
<!-- Morris.js charts -->
<script src="{{ asset('bower_components/raphael/raphael.min.js')}}"></script>
<script src="{{ asset('bower_components/morris.js/morris.min.js ')}}"></script>
<!-- Sparkline -->
<script src="{{ asset('bower_components/jquery-sparkline/dist/jquery.sparkline.min.js')}}"></script>
<!-- jvectormap -->
<script src="{{ asset('plugins/jvectormap/jquery-jvectormap-1.2.2.min.js ')}}"></script>
<script src="{{ asset('plugins/jvectormap/jquery-jvectormap-world-mill-en.js ')}}"></script>
<!-- jQuery Knob Chart -->
<script src="{{ asset('bower_components/jquery-knob/dist/jquery.knob.min.js ')}}"></script>
<!-- daterangepicker -->
<script src="{{ asset('bower_components/moment/min/moment.min.js')}}"></script>
<script src="{{ asset('bower_components/bootstrap-daterangepicker/daterangepicker.js ')}}"></script>
<!-- datepicker -->
<script src="{{ asset('bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js ')}}"></script>

<!--google-chart-->
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    
<!-- AdminLTE App -->
<script src="{{ asset('dist/js/adminlte.min.js ')}}"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<!--<script src="dist/js/pages/dashboard.js"></script>
 AdminLTE for demo purposes 
<script src="dist/js/demo.js"></script>-->

<script>
    $(function() {
	$("#feedback-tab").click(function() {
		$("#feedback-form").toggle();
	});

	$("#feedback-form form").on('submit', function(event) {
		var $form = $(this);
		$.ajax({
			type: $form.attr('method'),
			url: $form.attr('action'),
			data: $form.serialize(),
			success: function() {
				$("#feedback-form").toggle().find("textarea").val('');
			}
		});
		event.preventDefault();
	});
    });
    $('.datepicker').datepicker({
      autoclose: true,
      format: 'dd-mm-yyyy',
      todayBtn:true,
      todayHighlight:true
    });
    $(function () {
    //Initialize Select2 Elements
     $('.select2').select2();
    });
    
   $(function () {
    $('#table1').DataTable({
        rowReorder: {
            selector: 'td:nth-child(2)'
        },
      'paging'      : true,
      'lengthChange': true,
      'searching'   : true,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false,
       'responsive': true
    });
  });
</script>
<script type="text/javascript">
function googleTranslateElementInit() {
  new google.translate.TranslateElement({pageLanguage: 'en',includedLanguages: 'en,hi',autoDisplay: false}, 'google_translate_element');
}
</script>

<script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>



