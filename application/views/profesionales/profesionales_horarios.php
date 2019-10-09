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
                width: 700px;
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
        </style>
    <script>
        function carga_horas(num){
            valdia = "dia" + num;
            if(document.getElementById(valdia).checked){
                horad = 'horad' + num;
                horas = 'horas' + num;
                document.getElementById(horad).disabled = false;
                document.getElementById(horas).disabled = false;
                for(i=0; i<=23 ; i++){
                    var xd = document.getElementById(horad);
                    var xs = document.getElementById(horas);
                    var option1 = document.createElement("option");
                    var option2 = document.createElement("option");
                    varh = '';
                    option1.text = i + ':00';
                    option2.text = i + ':00';
                    xs.add(option1);
                    xd.add(option2);
                }
            }else{
                horad = 'horad' + num;
                horas = 'horas' + num;
                document.getElementById(horad).disabled = true;
                document.getElementById(horas).disabled = true;
            }

        }
    </script>
    </head>
    <body>
        <div class="contenedor">      
            <h1>MODIFICACI&Oacute;N DE HORARIOS</h1>
            <br />
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
                        <?php $data = array('name'=>'mat','id'=>'matricula','value'=>$fila->matricula,'maxlength'=>'20','size'=>'10');?>
                        <label for="matricula">Matricula:</label>
                        <?=form_label($fila->matricula,'mat',$data)?><p><?=form_error('matricula')?>
                        <?php
                        $datam = array('name'=>'matricula','value' => $fila->matricula, 'type' => 'hidden');
                        ?>
                         <?=form_input($datam)?>
                        <label for="nombre">Profesional:</label>
                        <?=form_label($fila->apellido. ', ' .$fila->nombre,'profesional',$data)?><p><?=form_error('nombre')?>
                    <?php } ?>
                    <table id="tabla_horarios">
                        <label for="dia">SELECCIONAR DIA Y HORARIO</label>
                        <tr>
                            <td>LUNES</td>
                            <td>MARTES</td>
                            <td>MI&Eacute;RCOLES</td>
                            <td>JUEVES</td>
                            <td>VIERNES</td>
                            <td>S&Aacute;BADO</td>
                            <td>DOMINGO</td>
                        </tr>
                        <tr>
                            <td><?=form_checkbox('dias[]', 1, FALSE, 'id="dia1" onchange="carga_horas(1);"');?></td>
                            <td><?=form_checkbox('dias[]', 2, FALSE, 'id="dia2" onchange="carga_horas(2);"');?></td>
                            <td><?=form_checkbox('dias[]', 3, FALSE, 'id="dia3" onchange="carga_horas(3);"');?></td>
                            <td><?=form_checkbox('dias[]', 4, FALSE, 'id="dia4" onchange="carga_horas(4);"');?></td>
                            <td><?=form_checkbox('dias[]', 5, FALSE, 'id="dia5" onchange="carga_horas(5);"');?></td>
                            <td><?=form_checkbox('dias[]', 6, FALSE, 'id="dia6" onchange="carga_horas(6);"');?></td>
                            <td><?=form_checkbox('dias[]', 7, FALSE, 'id="dia7" onchange="carga_horas(7);"');?></td>
                        </tr>
                        <tr>
                            <td><?=form_dropdown('horad[]','','','id="horad1" disabled');?></td>
                            <td><?=form_dropdown('horad[]','','','id="horad2" disabled');?></td>
                            <td><?=form_dropdown('horad[]','','','id="horad3" disabled');?></td>
                            <td><?=form_dropdown('horad[]','','','id="horad4" disabled');?></td>
                            <td><?=form_dropdown('horad[]','','','id="horad5" disabled');?></td>
                            <td><?=form_dropdown('horad[]','','','id="horad6" disabled');?></td>
                            <td><?=form_dropdown('horad[]','','','id="horad7" disabled');?></td>
                        </tr>
                        <tr>
                            <td><?=form_dropdown('horas[]','','','id="horas1" disabled');?></td>
                            <td><?=form_dropdown('horas[]','','','id="horas2" disabled');?></td>
                            <td><?=form_dropdown('horas[]','','','id="horas3" disabled');?></td>
                            <td><?=form_dropdown('horas[]','','','id="horas4" disabled');?></td>
                            <td><?=form_dropdown('horas[]','','','id="horas5" disabled');?></td>
                            <td><?=form_dropdown('horas[]','','','id="horas6" disabled');?></td>
                            <td><?=form_dropdown('horas[]','','','id="horas7" disabled');?></td>
                        </tr>
                    </table>
                     <?=form_submit('submit','Guardar')?><a href="<?=base_url().'profesionales'?>">Volver</a>
               <?=form_close()?>
            </div>
        </div>
        <?php
            //CARGA LOS HORARIOS DE LOS PROFESIONALES EN SUS RESPECTIVOS DROPDOWN
            foreach ($horarios as $filah){
                echo "<script type='text/javascript'>
                    document.getElementById('dia'+".$filah->id_dia.").checked=false;
                    document.getElementById('dia'+".$filah->id_dia.").disabled=false;
                    </script>";
                    //TRAE LAS HORAS GUARDADAS DE LA BD
                echo "<script>
                    var aSelect = document.getElementById('horad'+".$filah->id_dia.");
                    var val_aSelect = aSelect.options[aSelect.selectedIndex].text='".$filah->hora_desde."';
                    aSelect.disabled=true;
                    </script>";
                echo "<script>
                    var aSelect = document.getElementById('horas'+".$filah->id_dia.");
                    var val_aSelect = aSelect.options[aSelect.selectedIndex].text='".$filah->hora_hasta."';
                    aSelect.disabled=true;
                    </script>";
            }
        ?>
    </body>
</html>