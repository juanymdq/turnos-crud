<!DOCTYPE HTML>
<html lang="es">
    <head>
        <meta charset="utf-8"/>
        <title>OBRA SOCIAL</title>
        <style>
            .tabla_datos{
                font-size: 11px;
                margin: 10px 0 10px 0px;
            }
            .tabla_datos td{
                padding: 0 25px 0 0;
                border: blue 1px solid;
                border-collapse: separate;
            }
            .tabla_datos th{
                padding: 0 25px 0 0;
                border: blue 1px solid;
                border-collapse: separate;
            }
            .contenedor{
                margin: 0 0 0 150px;
                height: 450px;
                width: 1100px;
                /* border: 1px solid #D0D0D0;*/
            }
            .encabezado{

            }
            .cuerpo{
                height: 325px;
                overflow: scroll;
            }
            h1{
                text-align: center;
            }
            .mensajes{
                text-align: center;
            }
            input.enlace{border:0; background-color:#fff; text-decoration:underline; color:#7260D7; cursor:pointer;}
        </style>
        <script>
            //FUNCION QUE PREGUNTA POR LA ELIMINACION DEL REGISTRO
            function Eliminar(id,nombre){
                var answer = confirm("Esta seguro de querer eliminar la OS: " + nombre + "?");
                if (answer)
                {
                    location.href = "obra_social/eliminar/" + id;
                }
            }
        </script>
    </head>
    <body>
        <div class="contenedor">
            <div class="encabezado">
                <h1>TURNOS</h1>
                <center><?=anchor(base_url().'turnos/add','NUEVO TURNO')?></center>
                <br />
                <div class="mensajes">
                    <?php
                        //Si existen las sesiones flasdata que se muestren
                        if($this->session->flashdata('correcto'))
                            echo $this->session->flashdata('correcto');

                        if($this->session->flashdata('incorrecto'))
                            echo $this->session->flashdata('incorrecto');
                    ?>
                </div>
            </div>
        <div class="cuerpo">
            <table class="tabla_datos">
                <th>Id</th>
                <th>Turno</th>
                <th>Profesional</th>
                <th>Especialidad</th>
                <th>socio</th>
                <th>S&iacute;ntomas</th>
                <th colspan="2">ACCIONES</th>
            <?php
            foreach($turnos as $fila){
            ?>
                <tr>
                    <td>
                        <?=$fila->id_turno;?>
                    </td>
                    <td>
                        <?=$fila->turno?>
                    </td>
                    <td>
                        <?=$fila->profesional;?>
                    </td>
                    <td>
                        <?=$fila->especialidad;?>
                    </td>
                    <td>
                        <?=$fila->socio;?>
                    </td>
                    <td>
                        <?=$fila->observaciones;?>
                    </td>
                    <td class="acciones">       
                        <a href="<?=base_url("turnos/mod/$fila->id_turno")?>">Modificar</a>                        
                    </td>
                    <td class="acciones">
                        <a href="<?=base_url("turnos/eliminar/$fila->id_turno")?>">Eliminar</a>
                    </td>
                </tr>
                <?php } ?>
            </table>
            </div>
        </div>
    </body>
</html>