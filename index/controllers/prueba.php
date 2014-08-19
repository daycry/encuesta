<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Prueba extends CI_Controller {

	public function index()
	{
		//show_404();
		$tickets = $this->preguntas->getTickets();
		print_r($tickets);	
	}
}

