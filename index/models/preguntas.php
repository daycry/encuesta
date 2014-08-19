<?php

class preguntas extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }
    
    function getPreguntas(){
		$this->db->select('preg.*');
		$this->db->from('enc_preguntas preg');
		$this->db->where("preg.activa", 1);
		$this->db->where("preg.grupal", "N");
		$query = $this->db->get();
		return $query->result();
	}
	
    function getPreguntasPadre(){
		$this->db->select('preg.*');
		$this->db->from('enc_preguntas preg');
		$this->db->where("preg.activa", 1);
		$this->db->where("preg.padre", 0);
		$query = $this->db->get();
		return $query->result();
	}
	
    function getPreguntasHijo( $id ){
		$this->db->select('preg.*');
		$this->db->from('enc_preguntas preg');
		$this->db->where("preg.activa", 1 );
		$this->db->where("preg.padre", $id );
		$query = $this->db->get();
		return $query->result();
	}
}
