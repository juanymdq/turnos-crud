<!DOCTYPE html>
 <html lang="es">
 <head>
 <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
 <style type="text/css">
     label{
     font-size: 16px;
     color: #333333;
     font-weight: bold;
     }
     input[type=text],input[type=password]{
     padding: 10px 6px;
     width: 400px;
     }
     input[type=submit]{
     padding: 5px 40px;
     background: #112233;
     color: #fff;
     text-decoration-color: white;
     }
     .contenedor{
         margin: 20px 0 0 200px;
         height: 200px;
         width: 600px;
         /*border: 1px solid #D0D0D0;*/
     }
 </style>
 </head>
 <body>
<?php
 $especialidad = array('name' => 'especialidad', 'placeholder' => 'Introduce la especialidad');
 $submit = array('name' => 'submit', 'value' => 'Agregar', 'title' => 'Agregar Especialidad');
 ?>
 <div class="contenedor">
     <h2>AGREGAR ESPECIALIDAD</h2>
     <?=form_open(base_url().'especialidad/add')?>
         <label for="nombre">Nombre:</label>
         <?=form_input($especialidad)?><p><?=form_error('especialidad')?></p>
         <?=form_submit($submit)?><?=anchor(base_url().'especialidad','VOLVER')?>
     <?=form_close()?>
 </div>
 </body>
