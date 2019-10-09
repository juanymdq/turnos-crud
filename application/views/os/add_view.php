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
        <script>
            window.onload = function() {
                //AGREGA POR PRIMERA VEZ LA OPCION SELECCIONAR CIUDAD
                var objOption = document.getElementById('idc');
                objOption.options[0] = new Option('- Seleccionar Ciudad -')
            };
            function carga_ciudades(){

                //OBTIENE EL ID DE PROVINCIA
                xProv = document.getElementById('idprov').value;
                //BORRA TODOS LOS ITEMS-------------
                var select = document.getElementById("idc");
                var length = select.options.length;
                for (i = 0; i < length; i++) {
                  select.options[i] = null;
                }
                //OBTIENE LA CANTIDAD DE CIUDADES
                var num_c = document.getElementById('idciudad').length;
                //CREA OBJETO PARA COLOCAR LAS CIUDADES OBTENIDAS
                var objOption = document.getElementById('idc');
                //INICIA EL CONTADOR DE CIUDADES
                var x=1;
                //ITERA POR EL COMBO OCULTO QUE CONTIENE TODAS LAS CIUDADES
                for(var i=0; i<num_c; i++){
                   //ESTA PORCION DE CODIGO SEPARA EL ID DE PROVINCIA CON LA DESCRIPCION DE LA CIUDAD
                    var temptext = document.getElementById('idciudad').options[i].text
                    var texto = temptext.split('-');
                    var idp = texto[0];
                    var tCiudad = texto[1];
                    //AGREGA LA OPCION PARA SELECCIONAR CIUDADES
                    objOption.options[0] = new Option('- Seleccionar Ciudad -')
                    //*************************************************
                    //SELECCIONA SOLO LAS CIUDADES CON ID PROVINCIA IGUAL A LA SELECCIONADA
                    if(parseInt(xProv)==idp){
                        //AGREGA LAS CIUDADES COINCIDENTES AL COMBO IDC
                        objOption.options[x] = new Option(tCiudad);
                        x++;
                    }
                }
                //VISUALIZA SIEMPRE "-Seleccionar Ciudad-" CUANDO SE ELIGE LA PROVINCIA
                document.getElementById("idc").selectedIndex = "0";
            }
            function carga_id_ciudad(){
                //OBTENGO EL NOMBRE DE LA CIUDAD SELECCIONADA
                tempnomc = document.getElementById('idc').value;

                //OBTIENE LA CANTIDAD DE CIUDADES TOTALES DEL DROP OCULTO
                var num_c = document.getElementById('idciudad').length;

                //INICIA EL CONTADOR DE CIUDADES
                var i=0;
                //ITERA POR EL COMBO OCULTO QUE CONTIENE TODAS LAS CIUDADES
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
         <?php
             $os_nombre = array('name' => 'os_nombre', 'placeholder' => 'introduce el nombre de la obra social');
             $direccion = array('name' => 'direccion', 'placeholder' => 'introduce la direccion');
             $telefono = array('name' => 'telefono', 'placeholder' => 'introduce el telefono');
             $portal = array('name' => 'portal', 'placeholder' => 'introduce el portal');
             $observaciones = array('name' => 'observaciones', 'placeholder' => 'Introduce observaciones');
             $ciudad = array('name' => 'ciudad', 'placeholder' => 'id ciudad');
             $submit = array('name' => 'submit', 'value' => 'Guardar', 'title' => 'Guardar Obra Social');
         ?>
         <div class="contenedor">
             <div id="encabezado">
                <h1>Formulario de registro de Obra Social</h1>
             </div>
             <div id="cuerpo">
                 <?=form_open(base_url().'obra_social/add')?>
                 <table id="t_datos">
                     <tr>
                         <td id="col1"><label for="os_nombre">Nombre:</label></td>
                         <td id="col2"><?=form_input($os_nombre)?></td>
                         <td id="col3" NOWRAP><?=form_error('os_nombre')?></td>
                     </tr>
                     <tr>
                         <td id="col1"><label for="direccion">Direccion:</label>
                         <td id="col2"><?=form_input($direccion)?></td>
                         <td id="col3" NOWRAP><?=form_error('direccion')?></td>
                     </tr>
                     <tr>
                     <?php
                       $js = 'id="idprov" onChange="carga_ciudades();"';
                     ?>
                         <td id="col1"> <label for="id_prov">Provincia:</label></td>
                         <td id="col2"><?=form_dropdown('provincia', $provincias, '-Seleccionar Provincia-', $js);?></td>
                     </tr>
                     <tr>
                     <?php
                     $opt = 'id = "idciudad" style="visibility:hidden"';
                     $optc = 'id= "idc" onChange="carga_id_ciudad();"';
                     ?>
                         <td id="col1"><label for="id_ciudad">Ciudad:</label></td>
                         <td id="col2"><?=form_dropdown('id_city','','',$optc);?></td>
                     <?=form_dropdown('id_ciudad', $ciudades,'', $opt);?>
                     <?php
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
                         <td id="col1"><label for="telefono">Telefono:</label></td>
                         <td id="col2"><?=form_input($telefono)?></td>
                         <td id="col3" NOWRAP><?=form_error('telefono')?></td>
                     </tr>
                     <tr>
                         <td id="col1"><label for="portal">Portal:</label></td>
                         <td id="col2"><?=form_input($portal)?></td>
                         <td id="col3" NOWRAP><?=form_error('portal')?></td>
                     </tr>
                     <tr>
                         <td id="col1"><label for="observaciones">Observaciones:</label></td>
                         <td id="col2"><?=form_textarea($observaciones)?></td>
                         <td id="col3" NOWRAP><?=form_error('observaciones')?></td>
                     </tr>
                     <tr>
                     <td colspan="2"><?=form_submit($submit)?><a href="<?=base_url().'obra_social'?>">Volver</a></td>
                     </tr>
                 </table>
                 <?=form_close()?>
             </div>
         </div>
     </body>
</html>