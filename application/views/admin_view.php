<!DOCTYPE html>
 <html lang="es">
 <head>
 <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
 <link rel="stylesheet" type="text/css" href="<?=base_url()?>css/960.css" media="screen" />
 <link rel="stylesheet" type="text/css" href="<?=base_url()?>css/text.css" media="screen" />
 <link rel="stylesheet" type="text/css" href="<?=base_url()?>css/reset.css" media="screen" />
 <style>
 #contenedor{
    border: 2px solid #112233;
    height: 400px;
    width: 1200px;
    
 }
 
 </style>
 </head>
 <body>
 <div class="container_12">
     <div class="grid_12">
         <h1 style="text-align: center">Bienvenido de nuevo <?=$this->session->userdata('perfil')?></h1>
         <?php
         foreach($us as $fila){
            echo 'USUARIO: '.$fila->nombre.' '.$fila->apellido;
         }
         ?>
         <br/>
         <div id="contenedor">
         
            <div></div>
         
         
         
         
         
         </div>
         <?=anchor(base_url().'login/logout_ci', 'Cerrar sesi&oacute;n')?>
         </div>
     </div> 
 </body>
</html>