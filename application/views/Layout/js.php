<script type="text/javascript" src="<?php echo base_url()?>public/assets/js/plugins/loaders/pace.min.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>public/assets/js/core/libraries/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>public/assets/js/core/libraries/bootstrap.min.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>public/assets/js/plugins/loaders/blockui.min.js"></script>

<!-- /core JS files -->

<script type="text/javascript" src="<?php echo base_url()?>public/jquery-ui.js"></script>
 <script type="text/javascript" src="<?php echo base_url()?>public/assets/js/plugins/uploaders/fileinput.min.js"></script>
<!-- Theme JS files -->
<script type="text/javascript" src="<?php echo base_url()?>public/assets/js/plugins/visualization/d3/d3.min.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>public/assets/js/plugins/visualization/d3/d3_tooltip.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>public/assets/js/plugins/forms/styling/switchery.min.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>public/assets/js/plugins/forms/styling/uniform.min.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>public/assets/js/plugins/forms/selects/bootstrap_multiselect.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>public/assets/js/plugins/notifications/sweet_alert.min.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>public/assets/js/plugins/forms/selects/select2.min.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>public/assets/js/pages/animations_css3.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>public/assets/js/jquery.validate.min.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>public/assets/js/plugins/ui/nicescroll.min.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>public/assets/js/pages/layout_fixed_custom.js"></script>
	<script type="text/javascript" src="<?php echo base_url()?>public/assets/js/plugins/pickers/pickadate/picker.date.js"></script>
	<script type="text/javascript" src="<?php echo base_url()?>public/assets/js/plugins/pickers/pickadate/picker.time.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>public/assets/js/plugins/ui/moment/moment.min.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>public/assets/js/plugins/ui/moment/moment_locales.min.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>public/assets/js/plugins/ui/fullcalendar/fullcalendar.min.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>public/assets/js/plugins/ui/fullcalendar/lang/es.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>public/assets/js/plugins/pickers/daterangepicker.js"></script>
	<script type="text/javascript" src="<?php echo base_url()?>public/assets/js/plugins/pickers/anytime.min.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>public/assets/js/core/app.js"></script>
<!--<script type="text/javascript" src="<?php echo base_url()?>public/assets/js/pages/dashboard.js"></script>-->
<script type="text/javascript"  src="<?php echo base_url()?>public/assets/js/plugins/ui/dragula.min.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>public/assets/js/plugins/ui/ripple.min.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>public/assets/bootstrap-datetimepicker.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>public/toastr.js"></script>
<!--<script type="text/javascript" src="<?php echo base_url()?>public/assets/js/pages/datatables_api.js"></script>-->
<!--<script type="text/javascript" src="<?php echo base_url()?>public/assets/js/pages/datatables_basic.js"></script>-->
<!--<script type="text/javascript" src="<?php echo base_url()?>public/assets/js/pages/datatables_data_sources.js"></script>-->
<script type="text/javascript" src="<?php echo base_url()?>public/assets/js/plugins/tables/datatables/datatables.min.js"></script>


<script>





  function alerta(nombre){
  	toastr.options = {
  "closeButton": true,
  "debug": false,
  "newestOnTop": false,
  "progressBar": false,
  "positionClass": "toast-bottom-right",
  "preventDuplicates": false,
  "onclick": null,
  "showDuration": "3000",
  "hideDuration": "3000",
  "timeOut": "3000",
  "extendedTimeOut": "3000",
  "showEasing": "swing",
  "hideEasing": "linear",
  "showMethod": "fadeIn",
  "hideMethod": "fadeOut"
}
toastr.info('Desea realizar una ficha de enfoque',nombre);
  } 
	var base_url = "<?php echo base_url();?>";
	var empresa = "consultoria";
	var int=0;



function playSound() {

  var audio = new Audio(base_url+"/public/notificacion1.mp3");
                audio.play();
} 


setInterval(function(){ 
	var data1=$("#notificacion").html(); 
	var numero=$("#notican").html();
   
	$.post(base_url+'Ficha_enfoque/notificacion',  function(data, textStatus, xhr) {
		
	if(numero!=data.cantidad){
		  //  alert(int+" "+data.maximo);
		     if(int!=0 && int<data.maximo){
		     	  
                  int=data.maximo;
	      $('#notificacion').empty();
          $('#notificacion').append(data.datos);
          $('#notican').empty();
          $('#notican').append(data.cantidad);
           alerta(data.nombre);
           playSound();
		     }
		     else{
          int=data.maximo;
	      $('#notificacion').empty();
          $('#notificacion').append(data.datos);
          $('#notican').empty();
          $('#notican').append(data.cantidad);
          }
    }
     
	},"json");
}, 500);
</script>

<script type="text/javascript" src="<?php echo base_url();?>public/modulos/base.js"></script>