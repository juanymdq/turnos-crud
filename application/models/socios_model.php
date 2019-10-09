<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * MODELO DE SOCIOS
 * CREADO 06/07/2018
 */
class Socios_model extends CI_Model {
 
     public function __construct() {
        parent::__construct();
        //cargamos la base de datos
        $this->load->database();
     }
     
      //VISUALIZAR TODOS LOS SOCIOS
     public function ver_socios(){
        //Hacemos una consulta
        $consulta=$this->db->query("SELECT * FROM socio as s,obra_social as o WHERE s.id_os=o.id_os");         
        //Devolvemos el resultado de la consulta
        return $consulta->result();       
     }
     
     //verifica que no existan dni repetidos
     public function verifica_dni($dnu){        
        $consulta=$this->db->query("SELECT * FROM socio WHERE dni=$dnu");
        if($consulta->num_rows()==0){
            return false;//SI NO EXISTE EL DNI
        }else{
            return true;//SI EXISTE EL DNI
        }
     }

    //obtiene todos los socios para colocarlos en un dropdown
    function get_socios(){
        // armamos la consulta
        $query = $this->db->query("SELECT * FROM socio as s,obra_social as o WHERE s.id_os=o.id_os");
        // si hay resultados
        if ($query->num_rows() > 0) {
            // almacenamos en una matriz bidimensional
            //$arrDatos[0] = '- Seleccionar Especialidad -';
            foreach($query->result() as $row)

                $arrDatos[htmlspecialchars($row->dni, ENT_QUOTES)] = htmlspecialchars($row->nombre, ENT_QUOTES).';'.htmlspecialchars($row->apellido, ENT_QUOTES).';'.htmlspecialchars($row->os_nombre, ENT_QUOTES).';'.$row->email;

            $query->free_result();
            return $arrDatos;
        }
    }



     //AGREGAR UN SOCIO
    public function add($dnu,$nom,$apel,$id_os,$tel,$email){
        //$consulta=$this->db->query("SELECT id_socio FROM socio WHERE id_socio='$id'");
        //if($consulta->num_rows()==0){
            $consulta=$this->db->query("INSERT INTO socio VALUES('','$dnu','$nom','$apel','$id_os','$tel','$email');");
            if($consulta==true){
              return true;
            }else{
                return false;
            }
        //}else{
        //    return false;
        //}
    }
     //MODIFICAR UN SOCIO
    public function mod($id,$modificar="NULL",$dnu="NULL",$nom="NULL",$apel="NULL",$id_os="NULL",$tel="NULL",$email="NULL"){
        if($modificar=="NULL"){
            $consulta=$this->db->query("SELECT * FROM socio as s,obra_social as o WHERE s.id_socio=$id and s.id_os=o.id_os");
            return $consulta->result();
        }else{
          $consulta=$this->db->query("UPDATE socio SET dni=$dnu,nombre='$nom',apellido='$apel',id_os=$id_os,telefono='$tel',email='$email' WHERE id_socio=$id");
          if($consulta==true){
              return true;
          }else{
              return false;
          }
        }
    }
    
     //ELIMINA UN SOCIO
     public function eliminar($id){
       $consulta=$this->db->query("DELETE FROM socio WHERE id_socio=$id");
       if($consulta==true){
           return true;
       }else{
           return false;
       }
    }
     
     
 }//fin clase
