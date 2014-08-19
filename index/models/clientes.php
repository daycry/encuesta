<?php

class clientes extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }
    
    function insert($datos){
		$this->db->insert('enc_clientes', $datos);
		if( $this->db->affected_rows() > 0 ){
			return $this->db->insert_id();
		}else{
			return 0;
		}
	}

	function validar($string){
		$query = $this->db->get_where('enc_clientes', array('validador' => $string, 'confirmado' => 0));
		$result = $query->row();
		if( $result->id > 0 ){
			$this->db->where('id', $result->id);
			$this->db->update('enc_clientes', array('confirmado' => 1, 'validador' => ''));
			return $result->id;
		}else{
			return 0;	
		}
		
	}
}
