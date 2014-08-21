<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Gestor extends CI_Controller {

	public function index()
	{
		if($this->session->userdata('logged_in')){
			$session_data = $this->session->userdata('logged_in');
			$data['username'] = $session_data['username'];
			
			$categoriasNum = array('1','2','3','4','5','6','7','8','9','10','N/A');
			
			$respuestas_json = $this->respuestas->getRespuestas();
			if( count($respuestas_json) > 0){
				foreach( $respuestas_json as $resp){
					$respuestas = json_decode($resp->respuestas, true);
					//key es el id de la pregunta
					// value la opcion que se ha escogido
					foreach( $respuestas as $key => $value){
						$resultadosTotales[$key][$value]++;
					}
				}
			}
			$data['preguntasTotal'] = $this->preguntas->getPreguntas();
			$data['preguntas'] = $this->preguntas->getPreguntasPadre();
			
			foreach( $data['preguntas'] as $preg ){
				
				$pregHijo = $this->preguntas->getPreguntasHijo($preg->id);
				
				if(count($pregHijo) > 0){
					foreach($pregHijo as $hij){
						//las categorias son los numeros del 1 al 10
						$categorias[$hij->id] = $categoriasNum;
						$resultados[$hij->id] = array();
						foreach ($categoriasNum as $categ){
							array_push($resultados[$hij->id] , $resultadosTotales[$hij->id][$categ]);
						}
					}
				}else{
					$opciones = $this->opciones->getOpcionById($preg->id);
					$categorias[$preg->id] = array();
					$resultados[$preg->id] = array();
						if( count($opciones) > 0){
							foreach($opciones as $opt){
								array_push($categorias[$preg->id] , $opt->opcion);
								array_push($resultados[$preg->id] , $resultadosTotales[$preg->id][$opt->valor]);
							}
						}
				}
			}
			//datos que envio a la vista
			$data['categorias'] = $categorias;
			$data['resultados'] = $resultados;
			$this->load->view('gestor/index', $data);
			
		}else{
			redirect('login/index');
		}
	}
}

