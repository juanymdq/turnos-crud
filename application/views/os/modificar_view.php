<!DOCTYPE HTML>
<html lang="es">
    <head>
        <meta charset="UTF-8" />
        <title>Modificar Profesional</title>
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
            input[type=text]{
                width: 230px;
            }
            .contenedor{
                margin: 20px 0 0 200px;
                height: 200px;
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
        <script>
             window.onload = function() {
                /*$('#idprov').append('<option value="0" selected="selected">-Seleccionar Provincia-</option>');*/
                var x = document.getElementById("idprov");
                carga_ciudades();
                var option = document.createElement("option");
                option.text = "-Seleccionar Provincia-";
                x.add(option);
                /*document.getElementById("idprov").selectedText = "-Seleccionar Provincia-";*/
                /*AGREGA POR PRIMERA VEZ LA OPCION SELECCIONAR CIUDAD*/
                var objOption = document.getElementById('idc');
                objOption.options[0] = new Option('- Seleccionar Ciudad -')
             };

            function carga_ciudades(){
                /*OBTIENE EL ID DE PROVINCIA*/
                xProv = document.getElementById('idprov').value;
                /*BORRA TODOS LOS ITEMS-------------*/
                var select = document.getElementById("idc");
                var length = select.options.length;
                for (i = 0; i < length; i++) {
                  select.options[i] = null;
                }
                /*OBTIENE LA CANTIDAD DE CIUDADES*/
                var num_c = document.getElementById('idciudad').length;
                /*CREA OBJETO PARA COLOCAR LAS CIUDADES OBTENIDAS*/
                var objOption = document.getElementById('idc');
                /*INICIA EL CONTADOR DE CIUDADES*/
                var x=1;
                /*ITERA POR EL COMBO OCULTO QUE CONTIENE TODAS LAS CIUDADES*/
                for(var i=0; i<num_c; i++){
                   /*ESTA PORCION DE CODIGO SEPARA EL ID DE PROVINCIA CON LA DESCRIPCION DE LA CIUDAD*/
                    var temptext = document.getElementById('idciudad').options[i].text
                    var texto = temptext.split('-');
                    var idp = texto[0];
                    var tCiudad = texto[1];
                    /*AGREGA LA OPCION PARA SELECCIONAR CIUDADES*/
                    objOption.options[0] = new Option('- Seleccionar Ciudad -')
                    /*----------------------------------------------------------------------*/
                    /*SELECCIONA SOLO LAS CIUDADES CON ID PROVINCIA IGUAL A LA SELECCIONADA*/
                    if(parseInt(xProv)==idp){
                        /*AGREGA LAS CIUDADES COINCIDENTES AL COMBO IDC*/
                        objOption.options[x] = new Option(tCiudad);
                        x++;
                    }
                }
                /*VISUALIZA SIEMPRE "-Seleccionar Ciudad-" CUANDO SE ELIGE LA PROVINCIA*/
                document.getElementById("idc").selectedIndex = "0";
            }

            function carga_id_ciudad(){
                /*OBTENGO EL NOMBRE DE LA CIUDAD SELECCIONADA*/
                tempnomc = document.getElementById('idc').value;

                /*OBTIENE LA CANTIDAD DE CIUDADES TOTALES DEL DROP OCULTO*/
                var num_c = document.getElementById('idciudad').length;

                /*INICIA EL CONTADOR DE CIUDADES*/
                var i=0;
                /*ITERA POR EL COMBO OCULTO QUE CONTIENE TODAS LAS CIUDADES*/
                var Encontro = false;
                while(i<=num_c && !Encontro){

                   nomc = document.getElementById('idciudad').options[i].text;
                   var texto = nomc.split('-');
                   var tCiudad = texto[1];
                   if(tCiudad==tempnomc){
                       //alert('encontro');
                       Encontro=true;
                   }
                   i++;
                }
                if(Encontro){

                    var idp = document.getElementById('idciudad').options[i-1].value;
                    document.getElementById('ciudad').value = idp;
                }
            }
        </script>
    </head>
    <body>
        <div class="contenedor">
            <div id="encabezado">
                <h1>MODIFICAR OBRA SOCIAL</h1>
            </div>
            <div id="cuerpo">
                <?=form_open(base_url().'obra_social/mod/'.$idmod)?>
                    <table id="t_datos">
                        <?php foreach ($mod as $fila){ ?>
                            <tr>
                                <?php $data = array('name'=>'id_os','id'=>'id_os','value'=>$fila->id_os,'maxlength'=>'10','size'=>'5','readonly'=>'true');?>
                                <td id="col1"><label for="id_os">ID:</label></td>
                                <td id="col2"> <?=form_input($data)?></td>
                            </tr>
                            <tr>
                                <?php $data = array('name'=>'os_nombre','id'=>'os_nombre','value'=>$fila->os_nombre,'maxlength'=>'20','size'=>'20');?>
                                <td id="col1"><label for="os_nombre">Nombre:</label></td>
                                <td id="col2"> <?=form_input($data)?></td>
                                <td id="col3" NOWRAP><?=form_error('os_nombre')?></td>
                            </tr>
                            <tr>
                                <?php $data = array('name'=>'direccion','id'=>'direccion','value'=>$fila->direccion,'maxlength'=>'20','size'=>'50');?>
                                <td id="col1"><label for="direccion">Direccion:</label></td>
                                <td id="col2"><?=form_input($data)?></td>
                                <td id="col3" NOWRAP><?=form_error('direccion')?></td>
                            </tr>
                            <tr>
                                <?php
                                   $js = 'id="idprov" onChange="carga_ciudades();"';
                                ?>
                                <td id="col1"><label for="provincia">Provincia:</label></td>
                                <td id="col2"><?=form_dropdown('provincia',$provincias,$fila->id_prov,$js);?></td>
                            </tr>
                            <tr>
                                <?php
                                //
                                 $opt = 'id = "idciudad" style="visibility:hidden"';
                                 $optc = 'id= "idc" onChange="carga_id_ciudad();"';
                                 ?>

                                <td id="col1"><label for="ciudad">Ciudad:</label></td>
                                <td id="col2"> <?=form_dropdown('idc','',$fila->id_ciudad,$optc);?></td>

                                <?=form_dropdown('id_ciudad', $ciudades,'', $opt);?>

                                <?php
                                //
                                 $data = array(
                                    'type'          => 'hidden',
                                    'name'          => 'ciudad',
                                    'id'            => 'ciudad',
                                    'value'         => 'id ciudad',
                                    'maxlength'     => '10',
                                    'size'          => '5'
                                    );?>
                                 <?=form_input($data)?>
                             </tr>
                            <tr>
                                <?php $data = array('name'=>'telefono','id'=>'telefono','value'=>$fila->telefono,'maxlength'=>'20','size'=>'50');?>
                                <td id="col1"><label for="telefono">Telefono:</label></td>
                                <td id="col2"><?=form_input($data)?></td>
                                <td id="col3" NOWRAP><?=form_error('telefono')?></td>
                            </tr>
                            <tr>
                                <?php $data = array('name'=>'portal','id'=>'portal','value'=>$fila->portal,'maxlength'=>'20','size'=>'50');?>
                                <td id="col1"><label for="portal">Portal:</label></td>
                                <td id="col2"><?=form_input($data)?></td>
                                <td id="col3" NOWRAP><?=form_error('portal')?></td>
                            </tr>
                            <tr>
                                <?php $data = array('name'=>'observaciones','id'=>'observaciones','value'=>$fila->observaciones,'maxlength'=>'20','size'=>'50');?>
                                <td id="col1"><label for="observaciones">Observaciones:</label></td>
                                <td id="col2"><?=form_textarea($data)?></td>
                                <td id="col3" NOWRAP><?=form_error('observaciones')?></td>
                            </tr>
                        <?php } ?>
                            <tr>
                                <td colspan="2"><?=form_submit('submit','Modificar')?><a href="<?=base_url().'obra_social'?>">Volver</a></td>
                            </tr>
                    </table>
                <?=form_close()?>
            </div>
        </div>
    </body>
</html>