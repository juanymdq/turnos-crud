<!DOCTYPE HTML>
<html lang="es">
    <head>
        <meta charset="utf-8"/>
        <title>USUARIOS</title>
    </head>
    <body>
        <?php
        $nombre = array('name' => 'nombre', 'placeholder' => 'ingrese su nombre');
        $apellido = array('name' => 'apellido', 'placeholder' => 'ingrese su apellido');
        $username = array('name' => 'username', 'placeholder' => 'nombre de usuario');
        $password = array('name' => 'password', 'placeholder' => 'introduce tu password');
        $perfil = array('name' => 'perfil', 'placeholder' => 'ingrese su perfil');
        $submit = array('name' => 'submit', 'value' => 'Agregar', 'title' => 'Agregar Usuario');
        ?>
        <h2>USUARIOS</h2><a href="<?=base_url("login")?>">Volver a Loguin</a>
        <?php
        //Si existen las sesiones flasdata que se muestren
            if($this->session->flashdata('correcto'))
                echo $this->session->flashdata('correcto');
             
            if($this->session->flashdata('incorrecto')) 
                echo $this->session->flashdata('incorrecto');
        ?>
        
<table border="1">
    <tr>
    <td>id</td>
    <td>Nombre</td>
    <td>Apellido</td>
    <td>Username</td>
    <td>Password</td>
    <td>Perfil</td>
    <td>ACCIONES</td>
    </tr>
    <tr>
        <?=form_open(base_url().'usuarios/add')?>        
            <td></td>
            <td>
                
                <?=form_input($nombre)?><p><?=form_error('nombre')?></p>
              
            </td>
            <td>
                <?=form_input($apellido)?><p><?=form_error('apellido')?></p>
                
            </td>
            <td>
                <?=form_input($username)?><p><?=form_error('username')?></p>
              
            </td>
            <td>
                <?=form_input($password)?><p><?=form_error('password')?></p>
             
            </td>
            <td>
                <?php $options = array(
                'administrador' => 'Administrador',
                'editor' => 'Editor',
                'suscriptor' => 'Suscriptor'            
                );
                ?>
                <?=form_dropdown('perfil', $options);?>                
             
            </td>              
            <td>
                <?=form_submit($submit)?> 
            </td>
    <?=form_close()?>
    </tr>
<?php

foreach($ver as $fila){
?>
    <tr>
        <td>
            <?=$fila->id;?>
        </td>
        <td>
            <?=$fila->nombre;?>
        </td>
        <td>
            <?=$fila->apellido;?>
        </td>
        <td>
            <?=$fila->username;?>
        </td>
        <td>
           <!--SE OCULTA LA PASS <?=$fila->password;?> -->
        </td> 
        <td>            
            <?=$fila->perfil;?>
        </td>        
        <td>
            <a href="<?=base_url("usuarios/mod/$fila->id")?>">Modificar</a>
            <a href="<?=base_url("usuarios/eliminar/$fila->id")?>">Eliminar</a>
        </td>
    </tr>
<?php
    
}
?>
</table>
    </body>
</html>