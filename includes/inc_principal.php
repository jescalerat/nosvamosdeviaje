<?php 
    //session_start();
    unset($_SESSION["pagina"]);
    $_SESSION["pagina"]=1;
?>

<div class="row">    
	<div class="col-3">
		&nbsp;
	</div>
	<div class="col-6">
		<div id="map" style="width: 600px; height: 400px;"></div>
	</div>
	<div class="col-3">
		&nbsp;
	</div>
</div>

<?php
        if (!isset($_SESSION["admin_web"]))
        {
            //Query para insertar los valores en la base de datos
            $query="insert into paginasvistas (IP,Hora,Fecha,Pagina,Observaciones) values (\"".getRealIP()."\",\"".date("H:i:s")."\",\"".date("Y-m-d")."\",".$_SESSION["pagina"].",\"\")";
            mysqli_query($link, $query);
        }

        $query="select * ";
        $query.="from municipios mun, visitados vis ";
        $query.="where mun.IdMunicipio=vis.IdMunicipio ";
        $query.="and mun.CoordenadaX is not null";

        $municipios=mysqli_query ($link, $query);

        $marcas = "";
        while($municipio=mysqli_fetch_array($municipios, MYSQLI_BOTH))
		{
		    $municipioText = str_replace("'", "\'", $municipio['Municipio']);
		    $marcas .= "L.marker([".$municipio['CoordenadaX'].", ".$municipio['CoordenadaY']."]).bindPopup('".$municipioText."').addTo(cities),";
		}
		
        $marcas = substr($marcas, 0, strlen($marcas) - 1);
        $marcas .= ";";
?>    


<script src="js/leaflet.js"></script>
<script>
    var cities = L.layerGroup();

    <?= $marcas ?>    
    
    var mbAttr = 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, ' +
    		'<a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, ' +
    		'Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
     		mbUrl = 'https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw';
    
    var grayscale   = L.tileLayer(mbUrl, {id: 'mapbox.light', attribution: mbAttr}),
    	   streets  = L.tileLayer(mbUrl, {id: 'mapbox.streets',   attribution: mbAttr});
    
    var map = L.map('map', {
    	center: [40.0000, 0.000],
    	zoom: 5,
    	layers: [streets, cities]
    });
    
    var baseLayers = {
    	"Grayscale": grayscale,
    	"Streets": streets
    };
    
    var overlays = {
    	"Cities": cities
    };
    
    L.control.layers(baseLayers, overlays).addTo(map);
</script>
