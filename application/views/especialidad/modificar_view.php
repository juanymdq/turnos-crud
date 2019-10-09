<!DOCTYPE HTML>
<html lang="es">
    <head>
        <meta charset="UTF-8" />
        <title>Modificar especialidad</title>
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
        <div class="contenedor">
                <h2>MODIFICAR ESPECIALIDAD</h2>
                <?=form_open(base_url().'especialidad/mod/'.$idmod)?>

                    <?php foreach ($mod as $fila){ ?>
                    <?php
                        $data = array(
                          'name'        => 'descripcion',
                          'id'          => 'descripcion',
                          'value'       => $fila->desc_especialidad,
                          'maxlength'   => '100',
                          'size'        => '50'
                        );
                    ?>
                    <label for="descripcion">Descripcion:</label>
                    <?=form_input($data)?><p><?=form_error('descripcion')?></p>
                    <?php } ?>
                     <?=form_submit('submit','Modificar')?><a href="<?=base_url().'especialidad'?>">Volver</a>
                <?=form_close()?>
          </div>
    </body>
</html>