<!DOCTYPE HTML>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <title>Modificar Ciudad</title>
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
    <h2>MODIFICAR CIUDAD</h2>
    <?=form_open(base_url().'ciudad/mod/'.$idmod)?>
    <table id="t_datos">
        <?php foreach ($mod as $fila){ ?>
            <tr>
                <td id="col1"><label for="provincia">Provincia:</label></td>
                <td id="col2"><?=form_dropdown('provincia',$provincias,$fila->id_prov);?></td>
            </tr>
            <?php
            $data = array(
                'name'        => 'c_nombre',
                'id'          => 'c_nombre',
                'value'       => $fila->c_nombre,
                'maxlength'   => '100',
                'size'        => '50'
            );
            ?>
            <tr>
                <td id="col1"><label for="c_nombre">Ciudad:</label></td>
                <td id="col2"><?=form_input($data)?></td>
                <td id="col3"><?=form_error('c_nombre')?></td>
            </tr>
        <?php } ?>
        <tr>
            <td colspan="2"><?=form_submit('submit','Modificar')?><a href="<?=base_url().'ciudad'?>">Volver</a></td>
        </tr>
    </table>
    <?=form_close()?>
</div>
</body>
</html>