<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Indexx extends CI_Controller{

	public function index(){

		$dados = array(
			'titulo'  => 'Sisgestor',
			'titulo1' => 'Sisgestor',
			'titulo2' => 'Inicio',
			'pasta'   => 'inicio',
			'view'    => 'inicio',
			'voltar'  => ''
		);

		$this->load->view('indexx', $dados);
	}
}