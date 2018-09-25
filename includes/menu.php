<div class="navbar-fixed">
    <nav>
        <div class="nav-wrapper">
      
            <ul id="nav-mobile" class="left hide-on-med-and-down">
                <li><a href="index.php"><?= cambiarAcentos(_MENUINICIO) ?></a></li>
                <li><a href="#" onclick="llamada_prototype('paginas/rutas.php','principal');"><?= cambiarAcentos(_MENURUTAS) ?></a></li>
                <li><a href="#" onclick="llamada_prototype('paginas/municipios.php','principal');"><?= cambiarAcentos(_MENUMUNICIPIOS) ?></a></li>
                <li><a href=""><?= cambiarAcentos(_MENUCONTACTA) ?></a></li>
            </ul>
        </div>
    </nav>
</div>

<a href="#" onclick="llamada_prototype('paginas/municipios.php','principal');"><?= cambiarAcentos(_MENUMUNICIPIOS) ?></a>