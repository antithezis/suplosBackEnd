<?php
require_once("./db.php");
?>

<body>
  <video src="img/video.mp4" id="vidFondo"></video>
  <div class="contenedor">
    <div class="card rowTitulo">
      <h1>Bienes Intelcost</h1>
    </div>

    <?php
    include("./filtros.php");
    ?>

    <div id="tabs" style="width: 75%;">
      <ul>
        <li><a href="#tabs-1">Bienes disponibles</a></li>
        <li><a href="#tabs-2">Mis bienes</a></li>
        <li><a href="#tabs-3">Reportes</a></li>
      </ul>
      <div id="tabs-1">
        <?php
        include('./resultadosBusqueda.php')
        ?>
      </div>

      <div id="tabs-2">
      <?php
        include('./bienesGuardados.php')
        ?>
      </div>

      <div id="tabs-3">
      <?php
        include('./reporte.php')
        ?>
      </div>
    </div>

    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>

    <script type="text/javascript" src="js/ion.rangeSlider.min.js"></script>
    <script type="text/javascript" src="js/materialize.min.js"></script>
    <script type="text/javascript" src="js/index.js"></script>
    <script type="text/javascript" src="js/buscador.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script type="text/javascript">
      $(document).ready(function() {
        $("#tabs").tabs();
      });
    </script>
</body>