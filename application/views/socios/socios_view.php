<!DOCTYPE HTML>
<html lang="es">
    <head>
        <meta charset="utf-8"/>
        <title>SOCIOS</title>        
        <style>
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
                /*border: 1px solid #D0D0D0;*/
                width: 800px;
                margin: 0 0 0 100px;
            }
            .cuerpo{
                height: 325px;
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
            function Eliminar(id,nombre,apellido){
                var answer = confirm("Esta seguro de querer eliminar el Socio: " + nombre + " " + apellido + "?");
                if (answer)
                {
                    location.href = "socio/eliminar/" + id;
                }
            }
        </script>
    </head>
    <body>
        <div class="contenedor">
            <div class="encabezado">
            <h2>SOCIOS</h2>
                <center><?=anchor(base_url().'socio/add','NUEVO SOCIO')?></center>
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
                    <th>DNI</th>
                    <th>NOMBRE</th>
                    <th>APELLIDO</th>
                    <th>OBRA SOCIAL</th>
                    <th>TELEFONO</th>
                    <th>EMAIL</th>
                    <th colspan="2">ACCIONES</th>
                    <?php
                    foreach($ver as $fila){
                    ?>
                        <tr>
                            <td>
                                <?=$fila->dni;?>
                            </td>
                            <td>
                                <?=$fila->nombre;?>
                            </td>
                            <td>
                                <?=$fila->apellido;?>
                            </td>
                            <td>
                                <?=$fila->os_nombre;?>
                            </td>
                            <td>
                                <?=$fila->telefono;?>
                            </td>
                            <td>
                                <?=$fila->email;?>
                            </td>
                            <td class="acciones">
                                <a href="<?=base_url("socio/mod/$fila->id_socio")?>">Modificar</a>
                            </td>
                            <td class="acciones">
                                <input type="button" name="enviar" id="enviar" value="Eliminar" class="enlace" onclick="Eliminar(<?php echo $fila->dni; ?>,'<?php echo $fila->nombre;?>','<?php echo $fila->apellido;?>');" />
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