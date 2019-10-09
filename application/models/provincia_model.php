<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**MODELO PROVINCIA
 * CREADO EL 10/07/2018
 */
class Provincia_model extends CI_Model {
 
     public function __construct() {
        parent::__construct();
        //cargamos la base de datos
        $this->load->database();
     }
     
      //VISUALIZAR TODAS LAS PROVINCIAS
     public function ver_provincia(){
        //Hacemos una consulta
        $consulta=$this->db->query("SELECT * FROM provincia");         
        //Devolvemos el resultado de la consulta
        return $consulta->result();       
     }
     
     //obtiene todas las provincias para colocarlas en un dropdown
     function get_provincias(){ 
        // armamos la consulta        
         $query = $this->db->query("SELECT * FROM provincia ORDER BY prov_nombre ASC ");
        // si hay resultados 
        if ($query->num_rows() > 0) { 
            // almacenamos en una matriz bidimensional
            $arrDatos[0] = '- Seleccionar Provicnia -';
            foreach($query->result() as $row) 
            $arrDatos[htmlspecialchars($row->id_prov, ENT_QUOTES)] = htmlspecialchars($row->prov_nombre, ENT_QUOTES);
            
            $query->free_result(); 
            return $arrDatos; 
        }
     }
    
    //devuelve la descripcion de la provincia segun id
    function get_nombre_provincia($id){
        
        // armamos la consulta        
         $query = $this->db->query("SELECT * FROM provincia WHERE id_prov=$id"); 
        // si hay resultados 
        if ($query->num_rows() > 0) { 
            
            return $query->result();            
            $query->free_result();                
        }        
    }
     
          
     //AGREGAR UNA PROVINCIA
    public function add($nombre){       
            $consulta=$this->db->query("INSERT INTO provincia VALUES('','$nombre');");
            if($consulta==true){
              return true;
            }else{
                return false;
            }       
    }
     //MODIFICAR UNA PROVINCIA
    public function mod($id,$modificar="NULL",$nombre="NULL"){
        if($modificar=="NULL"){
            $consulta=$this->db->query("SELECT * FROM provincia WHERE id_prov=$id");
            return $consulta->result();
        }else{
          $consulta=$this->db->query("UPDATE provincia SET prov_nombre='$nombre' WHERE id_prov=$id;");
          if($consulta==true){
              return true;
          }else{
              return false;
          }
        }
    }
    
     //ELIMINA UNA PROVINCIA
     public function eliminar($id){
       $consulta=$this->db->query("DELETE FROM provincia WHERE id_prov=$id");
       if($consulta==true){
           return true;
       }else{
           return false;
       }
    }
     
     
 }//fin clase
?>