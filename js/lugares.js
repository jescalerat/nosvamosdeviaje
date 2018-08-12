$(document).ready(function(){
	var admin = location.pathname.indexOf('admin');
	var tam = location.pathname.indexOf('/', 10);
	var path = location.pathname.substring(0, tam);
	var pathPaises = path + '/conf/paises.php';
	var pathComunidades = path + '/conf/comunidades.php';
	var pathProvincias = path + '/conf/provincias.php';
	var pathMunicipios = path + '/conf/municipios.php';
	
	if (admin == -1){
		var pathRecargaMunicipios = path + '/includes/recargamunicipios.php';
	} else {
		var pathRecargaMunicipios = path + '/admin/includes/recargamunicipios.php';
		var pathAdminListadoRutas = path + '/admin/includes/inc_listado_rutas.php';
	}
		
	$("#paisSelect").jCombo({ url: pathPaises, selected_value : '15' } );
	$("#comunidadSelect").jCombo({ url: pathComunidades+"?id=",
	parent: "#paisSelect",
	selected_value: '178'
	});
	$("#provinciaSelect").jCombo({ url: pathProvincias+"?id=",
	parent: "#comunidadSelect",
	selected_value: '630'
	});  
	$("#municipioSelect").jCombo({ url: pathMunicipios+"?id=",
	parent: "#provinciaSelect",
	selected_value: '630'
	});  
   
	$("#paisSelect").change(function () {
		$("#paisSelect option:selected").each(function () {
			idPaisPass = $(this).val();
			$("#idPaisH").val(idPaisPass);
		});            
	});

	$("#comunidadSelect").change(function () {
		$("#comunidadSelect option:selected").each(function () {
			idComunidadPass = $(this).val();
			$("#idComunidadH").val(idComunidadPass);
			idPaisPass = $("#idPaisH").val();
			$("#recargaMunicipios").load(pathRecargaMunicipios,{
				'idPais':idPaisPass,
				'idComunidad':idComunidadPass
			});
		});            
	});

	$("#provinciaSelect").change(function () {
		$("#provinciaSelect option:selected").each(function () {
			idProvinciaPass = $(this).val();
			$("#idProvinciaH").val(idProvinciaPass);
			idPaisPass = $("#idPaisH").val();
			idComunidadPass = $("#idComunidadH").val();
			$("#recargaMunicipios").load(pathRecargaMunicipios,{
				'idPais':idPaisPass,
				'idComunidad':idComunidadPass,
				'idProvincia':idProvinciaPass
			});
		});            
	});

	$("#municipioSelect").change(function () {
		$("#municipioSelect option:selected").each(function () {
			idMunicipioPass = $(this).val();
			$("#idMunicipioH").val(idMunicipioPass);
			idPaisPass = $("#idPaisH").val();
			idComunidadPass = $("#idComunidadH").val();
			idProvinciaPass = $("#idProvinciaH").val();
			$("#recargaMunicipios").load(pathRecargaMunicipios,{
				'idPais':idPaisPass,
				'idComunidad':idComunidadPass,
				'idProvincia':idProvinciaPass,
				'idMunicipio':idMunicipioPass
			});
		});            
	});

   //Carga formulario admin pueblos visitados
    $(".boton_envio").click(function() {
 
		var dia = $(".dia").val();
		var mes = $(".mes").val();
		var anyo = $(".anyo").val();
		var titulo = $(".titulo").val();
		var facebook = $(".facebook").val();
		var idMunVisitado = $(".idMunVisitado").val();
		var idVisitado = $(".idVisitado").val();
		var opcion = $(".opcion").val();

        if (dia == "") {
            $(".dia").focus();
            return false;
        }else if (mes == "") {
            $(".mes").focus();
            return false;
        }else if (anyo == "") {
            $(".anyo").focus();
            return false;
        }else if(titulo == ""){
            $(".titulo").focus();
            return false;
        }else if(facebook == ""){
            $(".facebook").focus();
            return false;
        }else{
			$('.ajaxgif').removeClass('hide');
			var datos = 'dia='+ dia + '&mes=' + mes + '&anyo=' + anyo + '&titulo=' + titulo + '&facebook=' + facebook + '&idMunVisitado=' + idMunVisitado + '&idVisitado=' + idVisitado + '&opcion=' + opcion;
			$.ajax({
			    type: "POST",
			    url: pathAdminMunicipios,
			    data: datos,
			    success: function() {
			        $('.ajaxgif').hide();
			        $('.msg').text('Mensaje enviado!').addClass('msg_ok').animate({ 'right' : '130px' }, 300);  
			    },
			    error: function() {
			        $('.ajaxgif').hide();
			        $('.msg').text('Hubo un error!').addClass('msg_error').animate({ 'right' : '130px' }, 300);                 
			    }
			});
			return false;
        }
 
    });

   
	//Carga formulario rutas
    $(".boton_envio_ruta").click(function() {
 
		var fechaES = $("#fechaES").val();
		var fechaCA = $("#fechaCA").val();
		var fechaEN = $("#fechaEN").val();
		var idRuta = $("#idRuta").val();
		var opcion = $("#opcion").val();
		
	    if (fechaES == "") {
            $("#fechaES").focus();
            return false;
        }else if (fechaCA == "") {
            $("#fechaCA").focus();
            return false;
        }else if (fechaEN == "") {
            $("#fechaEN").focus();
            return false;
        }else{
			$('.ajaxgif').removeClass('hide');
			var datos = 'fechaES='+ fechaES + '&fechaCA=' + fechaCA + '&fechaEN=' + fechaEN + '&idRuta=' + idRuta + '&opcion=' + opcion;
			$.ajax({
			    type: "POST",
			    url: pathAdminRutas,
			    data: datos,
			    success: function() {
			        $('.ajaxgif').hide();
			        $('.msg').text('Mensaje enviado!').addClass('msg_ok').animate({ 'right' : '130px' }, 300);
					$("#listado_rutas").load(pathAdminListadoRutas);
			    },
			    error: function() {
			        $('.ajaxgif').hide();
			        $('.msg').text('Hubo un error!').addClass('msg_error').animate({ 'right' : '130px' }, 300);                 
			    }
			});
			return false;
        }
 
    });
   

});