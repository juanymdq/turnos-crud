<!DOCTYPE HTML>
<html lang="es">
    <head>
        <meta charset="utf-8"/>
        <title>ESPECIALIDADES</title>        
    <style>
    .tabla_datos{        
        font-size: 11px;
        margin: 10px 0 10px 40px;
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
        margin: 0 0 0 300px;
        height: 450px;
        width: 600px;
       /* border: 1px solid #D0D0D0;*/
    }
    .encabezado{

    }
    .cuerpo{
        height: 325px;
        width: 600px;
        overflow: scroll;
    }
    h2{
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

            var answer = confirm("Esta seguro de querer eliminar la Especialidad: " + nombre + "?");
            if (answer)
            {
                location.href = "especialidad/eliminar/" + id;
            }
        }
    </script>
    </head>
    <body>
        <div class="contenedor">
            <div class="encabezado">
                <h2>ESPECIALIDADES</h2>
                <center><?=anchor(base_url().'especialidad/add','NUEVA ESPECIALIDAD')?></center>
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
                    <th>ESCPECIALIDAD</th>
                    <th colspan="2">ACCIONES</th>
                <?php
                foreach($ver as $fila){
                ?>
                    <tr>
                        <td>
                            <?=$fila->id_especialidad;?>
                        </td>
                        <td>
                            <?=$fila->desc_especialidad;?>
                        </td>
                        <td>
                            <a href="<?=base_url("especialidad/mod/$fila->id_especialidad")?>">Modificar</a>
                        </td>
                        <td class="acciones">
                            <input type="button" name="enviar" id="enviar" value="Eliminar" class="enlace" onclick="Eliminar(<?php echo $fila->id_especialidad; ?>,'<?php echo $fila->desc_especialidad;?>');" />
                        </td>
                    </tr>
                <?php

                }
                ?>
                </table>
            </div>
        </div>
    </body>
</html>