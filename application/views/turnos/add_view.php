<!DOCTYPE html>
<html lang="es">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
        <link rel="stylesheet" type="text/css" href="<?=base_url();?>assets/css/tcal.css" />
        <script type="text/javascript" src="<?=base_url();?>assets/js/tcal.js"></script>
        <script type="text/javascript" src="<?=base_url();?>assets/js/jquery.js"></script>
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
                width: 130px;
            }

            .contenedor{
                margin: 5px 0 0 200px;
                height: 450px;
                width: 800px;
                /*border: 1px solid #D0D0D0;*/

            }
            #encabezado{
                margin: 0 0 1px 0;
            }
            #cuerpo{
                margin: 1px 0 0 0;
                overflow: scroll;
                height: 350px;
            }
            #t_datos{
                /* border: 1px solid #D0D0D0;*/
            }
            #t_datos td{
                padding: 10px 0 0 0;
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
            #col4{
                width: 200px;
            }
            #div1{
                color: #ff0000;
              /*  border: 1px solid #D0D0D0;*/
                text-align: center;
            }
            #divSocio{
                color: #ff0000;
                /*  border: 1px solid #D0D0D0;*/
                /*text-align: center;*/
            }
        </style>
        <script>
             window.onload = function() {

                var objOption = document.getElementById('id_prof');
                objOption.options[0] = new Option('- Seleccionar Profesional -')

                var objOptionH = document.getElementById('horariovisible');
                objOptionH.options[0] = new Option('- Seleccionar Horario -')
            };
            function carga_profesionales(){

                //OBTIENE EL ID DE LA ESPECIALIDAD
                xEspe = document.getElementById('id_especialidad').value;
                /*******BORRA TODOS LOS PROFESIONALES-------------*/
                var select = document.getElementById("id_prof");
                var length = select.options.length;
                for (i = 0; i < length; i++) {
                  select.options[i] = null;
                }
                /******************************************************/
                /****BORRA TODOS LOS HORARIOS DEL COMBO VISIBLE-------------*/
                var select = document.getElementById("horariovisible");
                for(i = select.options.length - 1 ; i > 0 ; i--){
                    select.remove(i);
                }
                /*********************************************************/
                //OBTIENE LA CANTIDAD DE PROFESIONALES
                var num_c = document.getElementById('idprof').length;
                //CREA OBJETO PARA COLOCAR LOS PROFESIONALES OBTENIDOS
                var objOption = document.getElementById('id_prof');
                //INICIA EL CONTADOR DE PROFESIONALES
                var x=1;
                //ITERA POR EL COMBO OCULTO QUE CONTIENE TODOS LOS PROFESIONALES
                for(var i=0; i<num_c; i++){
                   //ESTA PORCION DE CODIGO SEPARA EL ID ESPECIALIDAD DEL NOMBRE DEL PROFESIONAL
                    var temptext = document.getElementById('idprof').options[i].text
                    var texto = temptext.split('-');
                    var idp = texto[0];
                    var tProf = texto[1];
                    //AGREGA LA OPCION PARA SELECCIONAR PROFESIONALES
                    objOption.options[0] = new Option('- Seleccionar Profesional -')
                    //*************************************************
                    //SELECCIONA SOLO LOS PROFESIONALES CON ESPECIALIDAD IGUAL A LA SELECCIONADA
                    if(parseInt(xEspe)==idp){
                        //AGREGA LOS PROFESIONALES COINCIDENTES AL COMBO IPROF
                        objOption.options[x] = new Option(tProf);
                        x++;
                    }
                }
                //VISUALIZA SIEMPRE "-Seleccionar Ciudad-" CUANDO SE ELIGE LA PROVINCIA
                document.getElementById("id_prof").selectedIndex = "0";
            }

            function carga_id_profesional(){
                //OBTENGO EL NOMBRE DEL PROFESIONAL SELECCIONADO
                tempnomc = document.getElementById('id_prof').value;

                //OBTIENE LA CANTIDAD DE PROFESIONALES TOTALES DEL DROP OCULTO
                var num_c = document.getElementById('idprof').length;

                //INICIA EL CONTADOR DE PROFESIONALES
                var i=0;
                //ITERA POR EL COMBO OCULTO QUE CONTIENE TODOS LOS PREOFESIONALES
                var Encontro = false;
                while(i<=num_c && !Encontro){
                   nomc = document.getElementById('idprof').options[i].text;
                   var texto = nomc.split('-');
                   var tProf = texto[1];
                   if(tProf==tempnomc){
                       Encontro=true;
                   }
                   i++;
                }
                if(Encontro){
                    var idp = document.getElementById('idprof').options[i-1].value;
                    document.getElementById('id_p').value = idp;

                    //***********************************************************************************************
                    //funcion para cargar los horarios segun la matricula del profesional
                    //***********************************************************************************************
                    /****BORRA TODOS LOS HORARIOS DEL COMBO VISIBLE-------------*/
                    var select = document.getElementById("horariovisible");
                    for(i = select.options.length - 1 ; i >= 0 ; i--){
                        select.remove(i);
                    }
                    /*********************************************************/
                    //OBTIENE LA CANTIDAD DE HORARIOS
                    var num_h = document.getElementById('horaoculto').length;
                    //CREA OBJETO PARA COLOCAR LOS HORARIOS OBTENIDOS
                    var objOption = document.getElementById('horariovisible');
                    objOption.options[0] = new Option('- Seleccionar Horario -')
                    //INICIA EL CONTADOR DE HORARIOS
                    var x=1;
                    //ITERA POR EL COMBO OCULTO QUE CONTIENE TODOS LOS HORARIOS
                    for(var i=0; i<num_h; i++){
                       //ESTA PORCION DE CODIGO SEPARA LA MATRICULA, EL DIA Y LAS HORAS DESDE Y HASTA
                        //id_horario[0]-id_profesional[1]-prof_anio[2]-prof_mes[3]-id_dia[4]-hora_desde[5]-hora_hasta[6]
                        var temptext = document.getElementById('horaoculto').options[i].text;
                        var texto = temptext.split('-');
                        var mat = texto[0];//matricula
                        var anio =texto[1];//año
                        var mes = texto[2];//mes
                        var dia = texto[3];//dia
                        /******ARRAYS PARA OBTENER EL DIA DE LA SEMANA***************************/
                        var meses = new Array ("January","February","March","April","May","June","July","August","September","October","November","December");
                        var dias = new Array('domingo','lunes','martes','miercoles','juev es','viernes','sabado')
                        /**********************************/
                        var fecha = meses[mes-1]+' '+dia+', '+anio;//formato para DATE 'December 25, 1995'
                        var d = new Date(fecha);

                        var fechaDrop = dia+'/'+mes+'/'+anio;
                        var diaNombre = dias[d.getDay()];//obtiene el dia de la semana
                        //*************************************************
                        //SELECCIONA SOLO LOS HORARIOS CON MATRICULA IGUAL A LA SELECCIONADA
                        if(parseInt(idp)==mat){
                            var vTurnos = genera_turnos(texto[4],texto[5]);//trae la cantidad de turnos de 1 dia en base a las horas desde y hasta
                            var dd = texto[4].split(':');//separa la hora en HORAS y MINUTOS
                            var sumaHora = dd[0];//HORA
                            var sumaMinuto = dd[1];    //MINUTOS
                            /**
                             * RESTA LA HORA DESDE - HASTA Y EN Vturnos coloca la diferencia
                             * Itera por esa cantidad de horas y por cada hora le va agregando 15 minutos
                             * Cada 15 minutos va agregando al dropdown
                             * **/
                            for(j=1;j<=vTurnos;j++){
                                sumaMinuto = '00';
                                for(m=1;m<=4;m++){
                                    var hdesde = sumaHora+':'+sumaMinuto+':00';
                                    var varDrop = diaNombre+ ' ' +fechaDrop+ ' ' +hdesde;
                                    var x = document.getElementById("horariovisible");
                                    var option = document.createElement("option");
                                    option.value = document.getElementById('horaoculto').options[i].value;
                                    option.text = varDrop;
                                    x.add(option);
                                    x++;
                                    var sumaMinuto = parseInt(sumaMinuto) + 15;
                                }
                                var sumaHora = parseInt(sumaHora) + 1;

                            }
                        }
                    }
                }
                //VISUALIZA SIEMPRE "-Seleccionar Horarios-" CUANDO SE ELIGE EL PROFESIONAL
                document.getElementById("horariovisible").selectedIndex = "0";
            }

            /**hace la diferencia de las horas**/
            function genera_turnos(desde,hasta){
                var vDesde = desde.split(':');
                var vHasta = hasta.split(':');
                var res = parseInt(vHasta[0]) - parseInt(vDesde[0]);
                return res;
            }
            /***Coloca el ID del horario en un campo oculto*/
            function carga_id_horarios(){
                var id = document.getElementById("horariovisible");
                var pro = id.options[id.selectedIndex].text;
                document.getElementById('id_dia').value = pro;

            }
             //*****************************************************************************************
             //FUNCION QUE CARGA LOS DATOS DEL SOCIO LUEGO DE INGRESAR UN DNI VALIDO
            function datos_socio(){
                //BORRO EL DIV ANTES DE CARGARLO
                document.getElementById("divSocio").innerHTML = "";
                //OBTIENE EL DNI INGRESADO
                var varDni = document.getElementById('socio').value;
                //OBTIENE LA CANTIDAD DE SOCIOS TOTALES DEL DROP OCULTO
                var num_s = document.getElementById('dtSocios').length;
                //INICIA EL CONTADOR DE SOCIOS
                var i=0;
                //ITERA POR EL COMBO OCULTO QUE CONTIENE TODOS LOS SOCIOS
                var Encontro = false;
                while(i<=num_s - 1 && !Encontro){
                    var cboDni = document.getElementById('dtSocios').options[i].value;
                    if(cboDni == varDni){
                        Encontro = true;
                    }else{
                        i++;
                    }
                }
                if (!Encontro) {
                    document.getElementById("divSocio").innerHTML = "NO SE ENCONTRO EL DNI INGRESADO"
                } else {
                    varTemp = document.getElementById('dtSocios').options[i].text;
                    varS = varTemp.split(';');
                    nombreSocio = varS[1] + ', ' + varS[0];
                    //CREO UNA ETIQUETA <P>
                    newDiv = document.createElement("p");
                    //LE AGREGO LOS DATOS DE HORARIOS
                    newDiv.innerHTML = 'NOMBRE: ' + nombreSocio + '  --------  O.S.: ' + varS[2];
                    //AGREGO LOS HORARIOS AL DIV SOCIO
                    document.getElementById("divSocio").appendChild(newDiv);
                    //CARGA EL EMAIL EN INPUT "MAIL"
                    document.getElementById('mail').innerHTML = varS[3];
                }

            }
        </script>
    </head>
    <body>

        <div class="contenedor">
            <div id="encabezado">
                <h1>Formulario de Turnos</h1>
            </div>
            <div id="cuerpo">
                <?=form_open(base_url().'turnos/add', 'id="form_datos"')?>
                    <table id="t_datos">
                        <!----------------------SOCIO------------------------------------>
                        <?php
                            $opt = 'id ="dtSocios"  style="visibility:hidden"';
                            $jss = 'onBlur="datos_socio()"';
                            $socio = array(
                                'id'          => 'socio',
                                'name'        => 'socio',
                                'placeholder' => 'Indique su dni',
                                'maxlength'   => '8'
                        ); ?>
                        <tr>
                            <td id="col1"><label for="socio">DNI Socio:</label></td>
                            <td id="col2"><?=form_input($socio,'',$jss)?></td>
                            <td id="col3"><?=form_error('socio')?></td>
                            <td id="col4"><?=form_dropdown('dni', $socios,'', $opt);?></td>
                        </tr>
                        <tr>
                            <td colspan="2"><div id="divSocio"></div></td>
                        </tr>
                        <!----------------------FIN SOCIO------------------------------------>

                        <!----------------------ESPECIALIDAD------------------------------------>
                         <?php
                           $js = 'id="id_especialidad" onChange="carga_profesionales();"';
                         ?>
                        <tr>
                            <td id="col1"><label for="id_Especialidades">Especialidades:</label></td>
                            <td id="col2"><?=form_dropdown('especialidades', $especialidades,'', $js);?></td>
                        </tr>
                        <!----------------------FIN ESPECIALIDAD------------------------------------>

                        <!----------------------PROFESIONAL------------------------------------>
                         <?php
                         $opt = 'id = "idprof" style="visibility:hidden"';
                         $optc = 'id= "id_prof" onChange="carga_id_profesional();"';
                         ?>
                        <tr>
                            <td id="col1"><label for="id_prof">Profesional:</label></td>
                            <td id="col2"><?=form_dropdown('id_prof','','',$optc);?></td>
                             <?=form_dropdown('id_prof', $profesionales,'', $opt);?>
                             <?php
                             $data = 'id="id_p" name="id_p" onChange="trae_horarios_profesional();" size="5" style="visibility:hidden" ';
                             ?>
                             <!-- MATRICULA -->
                             <?=form_input('','',$data)?>
                            <td id="col3"><?=form_error('profesional')?></td>
                        </tr>
                        <!----------------------FIN PROFESIONAL------------------------------------>

                        <!----------------------HORARIOS------------------------------------>
                        <?php
                         $opth = 'id = "horaoculto" style="visibility:hidden"';
                         $opthc = 'id= "horariovisible" onChange="carga_id_horarios();" ';
                         ?>
                        <tr>
                            <td id="col1"><label for="id_hor">Horarios de Atencion:</label></td>
                            <td id="col2"><?=form_dropdown('','','',$opthc);?></td>
                            <?php
                                 $data = 'id="id_dia" name="turno" size="5" style="visibility:hidden"';
                            ?>
                             <!-- ID DIA -->
                             <?=form_input('','',$data)?>
                            <td id="col3"><?=form_dropdown('', $horarios,'', $opth);?></td>
                        </tr>
                        <!----------------------FIN HORARIO------------------------------------>
                        <!----------------------OBESRVACIONES------------------------------------>
                        <?php
                            $datam = 'id="mail"';
                            $observaciones = array('name' => 'observaciones', 'placeholder' => 'Indique sus sintomas');
                        ?>
                        <tr>
                            <td id="col1"><label for="observaciones">Observaciones:</label></td>
                            <td id="col2"><?=form_textarea($observaciones)?></td>
                            <td id="col3"><?=form_error('observaciones')?></td>
                            <td id="col4"><label id="mail" style="visibility: hidden"></label></td>
                        </tr>

                        <!----------------------FIN OBSERVACIONES------------------------------------>
                        <?php
                            $submit = array('name' => 'submit', 'value' => 'Agregar', 'title' => 'Aceptar Turno');
                        ?>
                        <tr>
                            <td colspan="2"><?=form_submit($submit)?><a href="<?=base_url().'turnos'?>">Volver</a></td>
                        </tr>
                    </table>
                <?=form_close()?>
            </div>
        </div>
     </body>
</html>