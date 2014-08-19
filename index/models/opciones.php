<?php

class opciones extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }
    
	function getOpcionById($id){
		$this->db->select('op.*');
		$this->db->from('enc_opciones op');
		$this->db->where("op.id_pregunta", $id);
		$this->db->where("op.activa", '1');
		$query = $this->db->get();
		return $query->result();
	}

	
	
}
