<?php					
	require_once("includes/cabecera.php");
?>
	<div class="row">
		<div class="col s3" id="menu">
<?php					
			require_once("includes/menu.php");
?>
		</div>
		<div class="col s9" id="principal">
            <select name="list1" id="list1" class="browser-default"></select>
            <select name="list2" id="list2" class="browser-default"></select>
            <select name="list3" id="list3" class="browser-default"></select>
		</div>
	</div>

	<div class="row">
		<div class="col s12" id="pie">
<?php					
			require_once("includes/pie.php");
?>
<script>
$("#list1").jCombo({ url: "getEstados.php", selected_value : '15' } );
$("#list2").jCombo({ url: "getMunicipios.php?id=",
parent: "#list1",
selected_value: '178'
});
$("#list3").jCombo({ url: "getParroquias.php?id=",
parent: "#list2",
selected_value: '630'
});
</script>
		</div>
	</div>

