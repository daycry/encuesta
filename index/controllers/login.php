<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

	public function index()
	{		
		if($this->session->userdata('logged_in')){
			$session_data = $this->session->userdata('logged_in');
			$datos['datos_ses'] = $session_data;
			$datos['username'] = $session_data['username'];
			$datos['titulo'] = "ENQUESTA DE SATISFACCIÓ";
			
			$acceso = $this->config->item('gestor');
			redirect('gestor/index');
		}else{
			$this->load->view('login/login');
		}
	}
	
	public function doLogin()
	{
		
		$this->form_validation->set_rules('username', 'Username', 'trim|required|xss_clean');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean|callback_ldap_login');
		$this->form_validation->set_message('required','El camp %s es obligatori');
		$this->form_validation->set_message('required','El camp %s es obligatori');
		
		if ($this->form_validation->run() == FALSE){
			$this->load->view('login/login');
		}else{
			$username = $this->input->post("username", TRUE);
			$sesion = array(
				'username'  => $username,
				'logged_in' => TRUE
				);
			$this->session->set_userdata('logged_in', $sesion);
			
		
			redirect('gestor/index');
			
		}
	}
	
	public function ldap_login($password){
		
		//Field validation succeeded.&nbsp; Validate against database
		$username = $this->input->post('username');

		//query the database
		$result = $this->user->login($username, $password);

		if($result){
			$sess_array = array();
			foreach($result as $row){
				$sess_array = array(
					'id' => $row->id,
					'username' => $row->username
				);
				$this->session->set_userdata('logged_in', $sess_array);
			}
			return true;
		
		}else{
			$this->form_validation->set_message('check_database', 'Invalid username or password');
			return false;
		}
	}
	
	function logout(){

		$this->session->unset_userdata('logged_in');
		//session_destroy();
		$this->session->sess_destroy();
		redirect('inicio/index', 'refresh');

	}
	
}

