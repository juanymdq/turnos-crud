<!DOCTYPE html>
 <html lang="es">
 <head>
 <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
 <link rel="stylesheet" type="text/css" href="<?=base_url()?>css/960.css" media="screen" />
 <link rel="stylesheet" type="text/css" href="<?=base_url()?>css/text.css" media="screen" />
 <link rel="stylesheet" type="text/css" href="<?=base_url()?>css/reset.css" media="screen" />
 <style type="text/css">
 h1{
 font-size: 22px;
 text-align: center;
 margin: 20px 0px;
 }
 #login{
 background: #fefefe;
 min-height: 500px;
 }
 #formulario_login{
 font-size: 14px;
 border: 8px solid #112233; 
 }
 label{
 display: block;
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
 #campos_login{
 margin: 50px 0px;
 }
 p{
 color: #f00;
 font-weight: bold;
 }
 </style>
 </head>
 <body>
<?php
 $nombre = array('name' => 'nombre', 'placeholder' => 'introduce tu nombre');
 $apellido = array('apellido' => 'apellido', 'placeholder' => 'introduce tu apellido');
 $username = array('name' => 'username', 'placeholder' => 'nombre de usuario');
 $password = array('name' => 'password', 'placeholder' => 'introduce tu password');
 $submit = array('name' => 'submit', 'value' => 'Guardar', 'title' => 'Guardar Usuario');
 ?>
 <div class="container_12">
 <h1>Formulario de registro de usuario</h1>
 <div class="grid_12" id="login">
 <div class="grid_8 push_2" id="formulario_login">
 <div class="grid_6 push_1" id="campos_login">
     <?=form_open(base_url().'usuarios/registro_usuario')?>
     <label for="nombre">Nombre:</label>
     <?=form_input($nombre)?><p><?=form_error('nombre')?></p>
     <label for="apellido">Apellido:</label>
     <?=form_input($apellido)?><p><?=form_error('apellido')?></p>
     <label for="username">Nombre de usuario:</label>
     <?=form_input($username)?><p><?=form_error('username')?></p>
     <label for="password">Introduce tu password:</label>
     <?=form_password($password)?><p><?=form_error('password')?></p>
     <?=form_submit($submit)?>
     <?=form_close()?> 
 
 </div>
 </div>
 </div>
 </div>
 </body>
</html>