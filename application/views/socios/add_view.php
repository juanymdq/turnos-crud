<!DOCTYPE html>
 <html lang="es">
 <head>
     <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
     <style type="text/css">
         label{
             font-size: 11px;
             color: #333333;
             font-weight: bold;
             margin-right: 10px;
         }
         input[type=submit]{
             padding: 5px 40px;
             background: #112233;
             color: #fff;
             text-decoration-color: white;
         }
         input[type=text]{
             width: 200px;
         }

         .contenedor{
             margin: 20px 0 0 200px;
             height: 200px;
             width: 300px;
             /*border: 1px solid #D0D0D0;*/
         }
         #t_datos{
             /* border: 1px solid #D0D0D0;*/
         }
         #t_datos td{
             padding: 15px 0 0 0;
             text-align: left;
             /*border: 1px solid #D0D0D0;*/
         }
         #col1{
             width: 80px;
         }
         #col2{
             width: 200px;
         }
         #col3{
             text-align: left;
             color: #ff0000;
         }
     </style>
 </head>
 <body>
    <?php
        $dni = array('name' => 'dni', 'placeholder' => 'introduce el DNI');
        $nombre = array('name' => 'nombre', 'placeholder' => 'introduce el nombre');
        $apellido = array('name' => 'apellido', 'placeholder' => 'introduce el apellido');
        $id_os = array('name' => 'id_os', 'placeholder' => 'selecciona la obra social');
        $telefono = array('name' => 'telefono', 'placeholder' => 'introduce el telefono');
        $email = array('name' => 'email', 'placeholder' => 'introduce el email');
        $submit = array('name' => 'submit', 'value' => 'Agregar', 'title' => 'Agregar Socio');
    ?>
     <div class="contenedor">
         <h1>AGREGAR Socio</h1>
         <?=form_open(base_url().'socio/add')?>
         <table id="t_datos">
             <tr>
                 <td id="col1"><label for="dni">DNI:</label></td>
                 <td id="col2"><?=form_input($dni)?></td>
                 <td id="col4"><label>*</label></td>
                 <td id="col3" NOWRAP><?=form_error('dni')?></td>
             </tr>
             <tr>
                 <td id="col1"><label for="nombre">Nombre:</label></td>
                 <td id="col2"><?=form_input($nombre)?></td>
                 <td id="col4"><label for="a">*</label></td>
                 <td id="col3" NOWRAP><?=form_error('nombre')?></td>
             </tr>
             <tr>
                 <td id="col1"><label for="apellido">Apellido:</label></td>
                 <td id="col2"><?=form_input($apellido)?></td>
                 <td id="col4"><label for="a">*</label></td>
                 <td id="col3" NOWRAP><?=form_error('apellido')?></td>
             </tr>
             <tr>
                 <td id="col1"><label for="id_os">Obra Social:</label></td>
                 <td id="col2"><?=form_dropdown('id_os', $os);?></td>
             </tr>
             <tr>
                 <td id="col1"><label for="telefono">Telefono:</label></td>
                 <td id="col2"><?=form_input($telefono)?></td>
                 <td id="col3" NOWRAP><?=form_error('telefono')?></td>
             </tr>
             <tr>
                 <td id="col1"><label for="email">Email:</label></td>
                 <td id="col2"><?=form_input($email)?></td>
                 <td id="col3" NOWRAP><?=form_error('email')?></td>
             </tr>
             <tr>
                 <td colspan="2"><?=form_submit($submit)?><?=anchor(base_url().'socio','VOLVER')?></td>
             </tr>
         </table>
         <?=form_close()?>
     </div>
 </body>
