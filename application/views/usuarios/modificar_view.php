<!DOCTYPE HTML>
<html lang="es">
    <head>
        <meta charset="UTF-8" />
        <title>Modificar usuarios</title>
    </head>
    <body>
        <h2>Modificar usuario</h2>
        <?=form_open(base_url().'usuarios/mod/'.$idmod)?> 
        
            <?php foreach ($mod as $fila){ ?>
            <?=form_input('nombre',$fila->nombre)?><p><?=form_error('nombre')?></p>
            <?=form_input('apellido',$fila->apellido)?><p><?=form_error('apellido')?></p>            
            <?=form_input('username',$fila->username)?><p><?=form_error('username')?></p>
            <?=form_password('password',$fila->password)?><p><?=form_error('password')?></p>
            <?=form_input('perfil',$fila->perfil)?><p><?=form_error('perfil')?></p>
            
             
            
            <?php } ?>
             <?=form_submit('submit','Modificar')?>
        <?=form_close()?>
        <a href="<?=base_url().'usuarios'?>">Volver</a>
    </body>
</html>