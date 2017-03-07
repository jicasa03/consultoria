




function reload(){

	$("#cont_sistema").empty().html('<center style="margin-top: 150px;"> <h1><i class="fa fa-spin fa-spinner"></i></h1> </center>');
}

function reload_url(modulo,padre){
	$(".principal").removeClass("active");$(".cobrarmovil").removeClass("active");$(".seguridad").removeClass("active");
	$(".administracion_caja").removeClass("active");$(".prestamos").removeClass("active");
	$("."+modulo).addClass("active"); $("."+padre).addClass("active"); reload();
	$.get(base_url+modulo,function(data){
		$("#cont_sistema").empty().html(data);
	});
}

function reload_otra_url(modulo,padre){
	$(".principal").removeClass("active");$(".cobrarmovil").removeClass("active");$(".seguridad").removeClass("active");
	$(".administracion_caja").removeClass("active");$(".prestamos").removeClass("active");
	$("."+modulo).addClass("active"); $("."+padre).addClass("active"); reload();
	var new_url = modulo.split("-");
	modulo = new_url[0]+'/'+new_url[1];
	$.get(base_url+modulo,function(data){
		$("#cont_sistema").empty().html(data);
	});
}

