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
                width: 230px;
            }

            .contenedor{
                margin: 20px 0 0 200px;
                height: 350px;
                width: 700px;
                /*border: 1px solid #D0D0D0;*/

            }
            #encabezado{}
            #cuerpo{
                overflow: scroll;
                height: 350px;
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
             $prov_nombre = array('name' => 'prov_nombre', 'placeholder' => 'introduce la provincia');
             $submit = array('name' => 'submit', 'value' => 'Agregar', 'title' => 'Agregar Provincia');
        ?>
         <div class="contenedor">
             <h1>AGREGAR PROVINCIA</h1>
             <?=form_open(base_url().'provincia/add')?>
                 <table id="t_datos">
                     <tr>
                         <td id="col1"><label for="prov_nombre">Provincia:</label></td>
                         <td id="col2"><?=form_input($prov_nombre)?></td>
                         <td id="col3"><?=form_error('prov_nombre')?></td>
                     </tr>
                     <tr>
                         <td colspan="2"><?=form_submit($submit)?><?=anchor(base_url().'provincia','VOLVER')?></td>
                     </tr>
                 </table>
             <?=form_close()?>
         </div>
    </body>
</html>