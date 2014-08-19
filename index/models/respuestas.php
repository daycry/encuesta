<?php

class respuestas extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }
    
    function insert( $datos ){
		$this->db->insert('enc_respuestas', $datos); 
	}

	
	
}
