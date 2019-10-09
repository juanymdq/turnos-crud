<!DOCTYPE html>
 <html lang="es">
 <head>
 <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
 <style type="text/css">
 h1{
 font-size: 22px;
 text-align: center;
 margin: 20px 0px;
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

 p{
 color: #f00;
 font-weight: bold;
 }
 body{
     background: #ffffff;
 }
 .form_loguin{

     width: 500px;
     height: 300px;
     margin: 50px 0 0 450px;
     /* border: 1px solid #D0D0D0;*/
 }
.contenedor{

}
 </style>
 </head>
 <body>
 <?php
 $username = array('name' => 'username', 'placeholder' => 'nombre de usuario');
 $password = array('name' => 'password', 'placeholder' => 'introduce tu password');
 $submit = array('name' => 'submit', 'value' => 'Iniciar sesion', 'title' => 'Iniciar sesi&oacute;n');
 ?>
 <div class="contenedor">
     <h1>ACCESO A SISTEMA INTELIGENTE DE TURNOS</h1>
     <div class="form_loguin">

         <?=form_open(base_url().'login/new_user')?>

             <label for="username">Nombre de usuario:</label>
             <?=form_input($username)?><p><?=form_error('username')?></p>

             <label for="password">Introduce tu password:</label>
             <?=form_password($password)?><p><?=form_error('password')?></p>

             <?=form_submit($submit)?>
         <?=form_close()?>
         </br>
         <?=anchor(base_url().'usuarios', 'Nuevo Usuario')?>

         <?php
         if($this->session->flashdata('usuario_incorrecto'))
         {
         ?>
         <p><?=$this->session->flashdata('usuario_incorrecto')?></p>
         <?php
         }
         ?>
     </div>
 </div>
 </body>
</html>