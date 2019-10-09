<!DOCTYPE HTML>
<html lang="es">
<head>
    <meta charset="utf-8"/>
    <title>HORARIOS</title>
    <style>
        label{
            font-size: 14px;
            color: #333333;
            font-weight: bold;
            margin-right: 10px;
        }
        .contenedor{
            margin: 10px 0 0 200px;
            height: 400px;
            width: 1000px;
            text-align: center;
            /*border: 1px solid #D0D0D0;*/
        }
        #tabla_horarios{
            border: solid 1px black;
            border-collapse: collapse;
            margin: 5px 0 20px 20px;
        }
        #tabla_horarios td{
            border: solid 1px black;
            border-collapse: collapse;
            padding: 5px 5px 5px 5px;
        }
        .mensajes{
            text-align: center;
            /* border: 1px solid #D0D0D0;*/
        }
        input[type=submit]{
            padding: 5px 40px;
            background: #112233;
            color: #fff;
            text-decoration-color: white;
        }
        .t_profesional{
            text-align: left;
        }
        .div_horas{
            height: 235px;
            /*overflow: scroll;*/
            margin: 10px 0 0 0;
        }
        #t_dias1{
            float: left;
            width: 230px;
            height: 230px;
            margin: 0 0 0 10px;
        }
        #t_dias2{
            float: left;
            width: 230px;
            height: 230px;
            margin: 0 0 0 10px;
        }
        #t_dias3{
            float: left;
            width: 230px;
            height: 230px;
            margin: 0 0 0 10px;
        }
        #t_dias4{
            float: left;
            width: 230px;
            height: 230px;
            margin: 0 0 0 10px;
        }
        .hora{
            width: 3em;
        }
       </style>
    <script>
        function carga_horas(num){
            valdia = "chkdia" + num;
            if(document.getElementById(valdia).checked){
                document.getElementById('horad'+num).disabled = false;
                document.getElementById('horah'+num).disabled = false;
                for(i=0; i<=23 ; i++){
                    var xd = document.getElementById('horad'+num);
                    var xs = document.getElementById('horah'+num);
                    var option1 = document.createElement("option");
                    var option2 = document.createElement("option");
                    varh = '';
                    option1.text = i + ':00';
                    option2.text = i + ':00';
                    xs.add(option1);
                    xd.add(option2);
                }
            }else{
                document.getElementById('horad'+num).disabled = true;
                document.getElementById('horah'+num).disabled = true;
            }

        }
        function carga_dias_mes(){
            var Vmes = document.getElementById('mes').value;
            var fecha = new Date();
            var xyear = fecha. getFullYear();
            switch(parseInt(Vmes)){
                case 1: xdias = 31;
                        xmes = 1;
                        break;
                case 2: if(xyear % 4==0){
                            xdias = 29;
                        }else{
                            xdias = 28;
                        }
                        xmes = 2;
                        break;
                case 3: xdias = 31;
                    xmes = 3;
                    break;
                case 4: xdias = 30;
                    xmes = 4;
                    break;
                case 5: xdias = 31;
                    xmes = 5;
                    break;
                case 6: xdias = 30;
                    xmes = 6;
                    break;
                case 7: xdias = 31;
                    xmes = 7;
                    break;
                case 8: xdias = 31;
                    xmes = 8;
                    break;
                case 9: xdias = 30;
                    xmes = 9;
                    break;
                case 10: xdias = 31;
                    xmes = 10;
                    break;
                case 11: xdias = 30;
                    xmes = 11;
                    break;
                case 12: xdias = 31;
                    xmes = 12;
                    break;
            }
            cont = 1;
            i=1;
            while(i<=xdias){
                j=1;
                var tabla = "";
                tabla+="<table border=\"0\">";
                while(j!=9 && i<=xdias){
                    var n_dia = new Date(xmes+' '+i+', '+xyear+' 12:00:00');
                    tabla+="<tr>";
                    tabla+="<td>"+ i + "</td>";
                    tabla+="<td>"+ obtieneDiadelaSemana(n_dia) + "</td>";
                    tabla+="<td>"+ "<input type='checkbox' name ='chkdia[]' id='chkdia"+ i +"' value='"+ i +"' onclick='carga_horas("+ i +");'>" + "</td>";
                    tabla+="<td>"+ "<select class='hora' style='width: 60px;' size='1' name='horad[]' id='horad"+ i +"' disabled><option>00:00</option></select>" + "</td>";
                    tabla+="<td>"+ "<select class='hora' style='width: 60px;' size='1' name='horas[]' id='horah"+ i +"' disabled><option>00:00</option></select>" + "</td>";
                    tabla+="</tr>";
                    i+=1;
                    j+=1;
                }
                tabla+="</table>";
                document.getElementById("t_dias" + cont).innerHTML=tabla;
                cont += 1;
            }
            var fch = new Date();
            document.getElementById('anio').value = fch.getFullYear();
            document.getElementById('aniobis').value = fch.getFullYear();
            /***SI EXISTEN DATOS YA CARGADOS DE HORARIOS LOS CARGA*****************************/
            var select = document.getElementById( 'drphorario');//PASA EL OBJETO DROPDOWN A LA VARIABLE SELECT
            for ( var j = 0; j < select.options.length; j++ ) //RECORRE EL DROP
            {
                texto = select.options[j].text; /*le pasa el texto del drop a la variable texto*/
                Temptexto = texto.split('-'); /*separa el texto cuando encuentre '-'*/
                Vdia = Temptexto[3];//dia
                if(Temptexto[2]==Vmes){     //verifica si el mes seleccionado se encuentra en el drop
                    document.getElementById('chkdia' + Vdia).checked = true;    //tilda el checkbox
                    carga_horas(Vdia);
                    var aSelect = document.getElementById('horad' + Vdia);                      //selecicona la hora desde en base a la guardada
                    aSelect.options[aSelect.selectedIndex].text=Temptexto[4].slice(0,-3);       //recorta la hora para que quede con formato 12:00
                    var aSelect = document.getElementById('horah' + Vdia);
                    aSelect.options[aSelect.selectedIndex].text=Temptexto[5].slice(0,-3);   //selecicona la hora hasta en base a la guardada
                }
            }
            /***************************************************************************************/
        }
        //FUNCION QUE TOMA LA FECHA Y DEVUELVE EL DIA DE LA SEMANA
        function obtieneDiadelaSemana(fecha){
            var dias=["domingo", "lunes", "martes", "miercoles", "jueves", "viernes", "sabado"];
            var dt = fecha;
            return dias[dt.getUTCDay()];

        }
    </script>
</head>
<body>
    <div class="contenedor">
        <h1>MODIFICACI&Oacute;N DE HORARIOS</h1>

        <div class="mensajes">
            <?php
            //Si existen las sesiones flasdata que se muestren
            if($this->session->flashdata('correcto'))
                echo $this->session->flashdata('correcto');

            if($this->session->flashdata('incorrecto'))
                echo $this->session->flashdata('incorrecto');

            $optc = 'id= "id_prof" onChange="carga_id_profesional();"';
            ?>
            <?=form_open(base_url().'profesionales/modifica_horarios/0');?>
                <?php foreach ($profesional as $fila){ ?>
                    <table class="t_profesional">
                        <tr>

                            <?php $data = array('name'=>'mat','id'=>'matricula','value'=>$fila->matricula);
                                  $optHorario = 'id="drphorario" ';
                            ?>
                            <td><label for="matricula">Matricula:</label></td>
                            <td><?=form_label($fila->matricula,'mat',$data)?></td>
                            <?php $datam = array('name'=>'matricula','value' => $fila->matricula, 'type' => 'hidden');?>
                            <td><?=form_input($datam)?></td>
                            <td><?=form_dropdown('drphorario',$horarios,'',$optHorario)?></td>
                        </tr>
                        <tr>
                            <td><label for="nombre">Profesional:</label></td>
                            <td><?=form_label($fila->apellido. ', ' .$fila->nombre,'profesional')?></td>
                            <td></td>
                            <td><label>Especialidad:</label></td>
                            <td><?=form_label($fila->desc_especialidad)?></td>
                        </tr>
                    </table>
                <?php } ?>
                <table>
                    <tr>
                        <td><label for="mes">Mes:</label></td>
                        <?php
                            $options = array(
                                '0'  => 'Seleccionar Mes',
                                '1'  => 'Enero',
                                '2'  => 'Febrero',
                                '3'  => 'Marzo',
                                '4'  => 'Abril',
                                '5'  => 'Mayo',
                                '6'  => 'Junio',
                                '7'  => 'Julio',
                                '8'  => 'Agosto',
                                '9'  => 'Septiembre',
                                '10' => 'Octubre',
                                '11' => 'Noviembre',
                                '12' => 'Diciembre'
                            );
                        $opt = 'id="mes" onChange="carga_dias_mes();"';
                        ?>
                        <td><?=form_dropdown('mes',$options,'',$opt);?></td>
                        <td><label>Año:</label></td>
                        <td><input type="text" id="anio" style="width: 60px" disabled><input type="hidden" name="anio" id="aniobis"></td>
                    </tr>
                </table>
                <div class="div_horas">
                    <div id="t_dias1"></div>
                    <div id="t_dias2"></div>
                    <div id="t_dias3"></div>
                    <div id="t_dias4"></div>
                </div>
                <?=form_submit('submit','Guardar')?><a href="<?=base_url().'profesionales'?>">Volver</a>
            <?=form_close()?>
        </div>
    </div>
</body>
</html>