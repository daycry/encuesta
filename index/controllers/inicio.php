<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Inicio extends CI_Controller {

	public function index($id)
	{
		//if($id == null){
		//	show_404();
		//}else{
		//	$existe = $this->tickets->getTicketById((int)$id);
		//	if( count($existe) > 0 ){
		//		$this->load->view('confirm/confirm');
		//	}else{
				//$data['id'] = $id;
				$data['preguntas'] = $this->preguntas->getPreguntas();
				$data['preguntasPadre'] = $this->preguntas->getPreguntasPadre();
				$this->load->view('inicio/index', $data);
		//	}
		//}
	}
	
	public function buscar(){
		
		$this->form_validation->set_rules('email', 'email', 'trim|required|email|xss_clean');

		$preguntas = $this->preguntas->getPreguntas();
		
		foreach($preguntas as $pr){
			$this->form_validation->set_rules('optionsPreg'.$pr->id, 'optionsPreg'.$pr->id, 'trim|required|xss_clean');
			$this->form_validation->set_message('required','La pregunta %s es obligatorio rellenarla');
		}
		
		if ($this->form_validation->run() == FALSE){
			$data['id'] = $ticket;
			$data['preguntas'] = $this->preguntas->getPreguntas();
			$data['preguntasPadre'] = $this->preguntas->getPreguntasPadre();
			$this->load->view('inicio/index', $data);
		}else{
			
			$email = $this->input->post('email');
			$patron1= "optionsPreg";
			$patron2="textarea";
			
			$respuestas = array();
			$comentarios = array();

			foreach($preguntas as $pr){
				$comentario = null;
				$respuesta = null;
				foreach($_POST as $key=>$value){
					if($patron1.$pr->id == $key){
						$respuestas[$pr->id] = $value;
					}
					if($patron2.$pr->id == $key){
						$comentarios[$pr->id] = $value;
					}
				}
			}
			$validador = $this->generateRandomString(35);

			$datos = array(
				   'email' => $email,
				   'fecha' => date('Y-m-d g:i:s',time()),
				   	'validador' => $validador
			);
			$id_cliente = $this->clientes->insert($datos);
			
			$datos = null;

			$datos = array(
				'id_cliente' => $id_cliente,
				'respuestas' => json_encode($respuestas),
				'comentarios'=> json_encode($comentarios)
			);
			$this->respuestas->insert($datos);
			

			$config['charset'] = 'utf-8';
			$config['mailtype'] = 'html';

			$this->email->initialize($config);

			$this->email->from('encuestas@gmail.es', 'Encuesta');
			$this->email->to($email); 
			$this->email->bcc('daycry9@gmail.com'); 

			$this->email->subject('Encuesta de satisfacción');
			$this->email->message('<p>, agradecemos la confianza que ha puesto en nosotros.</p>
				<p>Por ello nos gustaría que para poder validar la encuesta realiza, accediera al siguiente link:</p>
				<p><a href="http://http://host.es/index.php/inicio/validar/'.$validador.'">http://host.es/index.php/inicio/validar/'.$validador.'</a></p>
				<br><br><p>Equipo<p>http://host.es</p>');	

			$this->email->send();


			$this->load->view('confirm/confirm');
		}
	}

	public function validar($string){
		$confirmado = $this->clientes->validar($string);
		if( $confirmado > 0 ){

			$config['charset'] = 'utf-8';
			$config['mailtype'] = 'html';

			$this->email->initialize($config);

			$this->email->from('encuestas@gmail.es', 'Mas la Torre');
			$this->email->to($email); 

			$this->email->subject('Encuesta de satisfacción');
			$this->email->message('<p>agradecemos la confianza que ha puesto en nosotros.</p>
				<p>Hemos confirmado su encuesta correctamente.</p><br><p>Equipo<p>http://host.es</p>');	

			$this->email->send();

			redirect('http://blog.maslatorredemontral.es');
		}else{
			$errores = array('message' => 'Se ha producido un error en la validaci&oacute;n del email, compruebe si la direcci&oacute;n que le indicaba el correo electr&oacute;nico es la misma que ha introducido en el navegador, sino p&oacute;ngase en contacto con Nosotros.');
			show_error($errores);
		}
	}

	private function generateRandomString($length = 10) {
	    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	    $randomString = '';
	    for ($i = 0; $i < $length; $i++) {
	        $randomString .= $characters[rand(0, strlen($characters) - 1)];
	    }
	    return $randomString;
	}
}

