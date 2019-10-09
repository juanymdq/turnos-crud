<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * MODELO DE OBRA SOCIAL
 * CREADO 09/07/2018
 */
class Obra_social_model extends CI_Model {
 
     public function __construct() {
        parent::__construct();
        //cargamos la base de datos
        $this->load->database();
     }
     
      //VISUALIZAR TODOS LAS OS
     public function ver_os(){
        //Hacemos una consulta
        $consulta=$this->db->query("SELECT * FROM obra_social as o,distrito as d,provincia as p
        WHERE d.id_prov=p.id_prov and o.id_ciudad=d.id_ciudad");         
        //Devolvemos el resultado de la consulta
        return $consulta->result();       
     }
     
     //obtiene todas las obras sociales para colocarlas en un dropdown
     function get_os(){ 
        // armamos la consulta        
         $query = $this->db->query("SELECT * FROM obra_social"); 
        // si hay resultados 
        if ($query->num_rows() > 0) { 
            // almacenamos en una matriz bidimensional
            foreach($query->result() as $row) 
            $arrDatos[htmlspecialchars($row->id_os, ENT_QUOTES)] = htmlspecialchars($row->os_nombre, ENT_QUOTES);
            
            $query->free_result(); 
            return $arrDatos; 
        }
     }
     
     
     //AGREGAR UNA OS
    public function add($nom,$dire,$tel,$port,$obs,$id_c){
        $consulta=$this->db->query("INSERT INTO obra_social VALUES('','$nom','$dire','$tel','$port','$obs','$id_c');");
        if($consulta==true){
          return true;
        }else{
            return false;
        }        
    }
     //MODIFICAR UNA OS
    public function mod($id,$modificar="NULL",$nom="NULL",$dire="NULL",$tel="NULL",$port="NULL",$obs="NULL",$id_c="NULL"){
        if($modificar=="NULL"){
            $consulta=$this->db->query("SELECT * FROM obra_social as o,provincia as p,distrito as t WHERE o.id_os=$id and o.id_ciudad=t.id_ciudad and t.id_prov=p.id_prov ");
            return $consulta->result();
        }else{
          $consulta=$this->db->query("
              UPDATE obra_social SET os_nombre='$nom',direccion='$dire',telefono='$tel',portal='$port',observaciones='$obs',id_ciudad='$id_c' WHERE id_os=$id;");
          if($consulta==true){
              return true;
          }else{
              return false;
          }
        }
    }
    
     //ELIMINA UNA OS
     public function eliminar($id){
       $consulta=$this->db->query("DELETE FROM obra_social WHERE id_os=$id");
       if($consulta==true){
           return true;
       }else{
           return false;
       }
    }
     
     
 }//fin clase
