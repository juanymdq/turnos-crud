<!DOCTYPE HTML>
<html lang="es">
    <head>
        <meta charset="utf-8"/>
        <title>CIUDADES</title>
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
                margin: 0 0 0 0px;
                padding-left: 150px;
                height: 400px;
                width: 750px;
                /* border: 1px solid #D0D0D0;*/
            }
            .encabezado{

            }
            .cuerpo{
                height: 300px;
                overflow: scroll;
                margin: 0 0 0 120px;
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
                var answer = confirm("Esta seguro de querer eliminar la ciudad: " + nombre + "?");
                if (answer)
                {
                    location.href = "ciudad/eliminar/" + id;
                }
            }
        </script>
    </head>
    <body>
        <div class="contenedor">
            <div class="encabezado">
                <h1>CIUDADES</h1>
                <center><?=anchor(base_url().'ciudad/add','NUEVA CIUDAD')?></center>
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
                    <th>ID</th>
                    <th>NOMBRE DE PROVINCIA</th>
                    <th>NOMBRE DE CIUDAD</th>
                    <th colspan="2">ACCIONES</th>
                    <?php
                    foreach($ver as $fila){
                    ?>
                        <tr>
                            <td>
                                <?=$fila->id_ciudad;?>
                            </td>
                            <td>
                                <?=$fila->prov_nombre;?>
                            </td>
                            <td>
                                <?=$fila->c_nombre;?>
                            </td>
                            <td>
                                <a href="<?=base_url("ciudad/mod/$fila->id_ciudad")?>">Modificar</a>
                            </td>
                            <td class="acciones">
                                <input type="button" name="enviar" id="enviar" value="Eliminar" class="enlace" onclick="Eliminar(<?php echo $fila->id_ciudad; ?>,'<?php echo $fila->c_nombre;?>');" />
                            </td>
                        </tr>
                    <?php } ?>
                </table>
            </div>
        </div>
    </body>
</html>