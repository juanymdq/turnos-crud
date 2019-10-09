<!DOCTYPE HTML>
<html lang="es">
    <head>
        <meta charset="UTF-8" />
        <title>Modificar Socio</title>
        <style>
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
        <div class="contenedor">
            <h1>MODIFICAR SOCIO</h1>
            <?=form_open(base_url().'socio/mod/'.$idmod)?>
                <table id="t_datos">
                    <?php foreach ($mod as $fila){ ?>
                        <tr>
                        <?php $data = array('name'=>'dni','id'=>'dni','value'=>$fila->dni,'maxlength'=>'20','size'=>'10');?>
                            <td id="col1"><label for="dni">DNI:</label></td>
                            <td id="col2"><?=form_input($data)?></td>
                            <td id="col4"><label>*</label></td>
                            <td id="col3" NOWRAP><?=form_error('dni')?></td>
                        </tr>
                        <tr>
                        <?php $data = array('name'=>'nombre','id'=>'nombre','value'=>$fila->nombre,'maxlength'=>'30','size'=>'30');?>
                            <td id="col1"><label for="nombre">Nombre:</label></td>
                            <td id="col2"><?=form_input($data)?></td>
                            <td id="col4"><label for="a">*</label></td>
                            <td id="col3" NOWRAP><?=form_error('nombre')?></td>

                        </tr>
                        <tr>
                        <?php $data = array('name'=>'apellido','id'=>'apellido','value'=>$fila->apellido,'maxlength'=>'30','size'=>'30');?>
                            <td id="col1"> <label for="apellido">Apellido:</label></td>
                            <td id="col2"><?=form_input($data)?></td>
                            <td id="col4"><label for="a">*</label></td>
                            <td id="col3" NOWRAP><?=form_error('apellido')?></td>
                        </tr>
                        <tr>
                            <td id="col1"><label for="id_os">Obra Social:</label></td>
                            <td><?=form_dropdown('id_os', $os, $fila->id_os);?></td>
                        </tr>
                        <tr>
                        <?php $data = array('name'=>'telefono','id'=>'telefono','value'=>$fila->telefono,'maxlength'=>'30','size'=>'30');?>
                            <td id="col1"><label for="telefono">Telefono:</label></td>
                            <td id="col2"><?=form_input($data)?></td>
                            <td id="col3" NOWRAP><?=form_error('telefono')?></td>
                        </tr>
                        <tr>
                        <?php $data = array('name'=>'email','id'=>'email','value'=>$fila->email,'maxlength'=>'30','size'=>'30');?>
                            <td id="col1"><label for="email">Email:</label></td>
                            <td id="col2"><?=form_input($data)?></td>
                            <td id="col3" NOWRAP><?=form_error('email')?></td>
                        </tr>
                    <?php } ?>
                        <tr>
                            <td colspan="2"><?=form_submit('submit','Modificar')?><a href="<?=base_url().'socio'?>">Volver</a></td>
                        </tr>
                </table>
            <?=form_close()?>
        </div>

    </body>
</html>