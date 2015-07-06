<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Unidade extends CI_Controller{

	public function __construct(){
		parent::__construct();
		$this->load->model('UnidadeModel');
	}

	public function index(){

		$dados = array(
			'titulo'  => 'Unidade',
			'titulo1' => 'Unidade',
			'titulo2' => 'Unidade',
			'pasta'   => 'unidade',
			'view'    => 'index'
		);

		$this->load->view('indexx', $dados);
	}

	public function cadastrar(){

		$this->form_validation->set_rules('unidade', 'Unidade', 'trim|required|max_length[45]|ucwords');
		$this->form_validation->set_rules('endereco', 'Endereço', 'trim|required|max_length[45]|strtolower');

		if($this->form_validation->run()){

			$dados = elements(array('unidade', 'endereco'), $this->input->post());

			$dados['ativo'] = 1;

			$this->UnidadeModel->insertUnidade($dados);
		}

		$dados = array(
			'titulo'  => 'Cadastro de Unidade',
			'titulo1' => 'Unidade',
			'titulo2' => 'Cadastrar',
			'pasta'   => 'unidade',
			'view'    => 'cadastrar',
			'voltar'  => 'unidade/listagem'
		);

		$this->load->view('indexx', $dados);
	}

	public function listagem(){


		$dados = array(
			'titulo'   => 'Listagem de Unidade',
			'titulo1'  => 'Unidade',
			'titulo2'  => 'Listagem',
			'pasta'    => 'unidade',
			'view'     => 'listagem',
			'voltar'   => 'unidade/cadastrar',
			'unidades' => $this->UnidadeModel->getAllUnidade()->result()
		);

		$this->load->view('indexx', $dados);

	}

	public function editar(){

		$this->form_validation->set_rules('unidade', 'Unidade', 'trim|required|max_length[45]|ucwords');
		$this->form_validation->set_rules('endereco', 'Endereço', 'trim|required|max_length[45]|strtolower');

		if($this->form_validation->run()){

			$dados = elements(array('unidade', 'endereco'), $this->input->post());

			$this->UnidadeModel->updateUnidade($dados, array('id' => $this->input->post('idUnidade')));
		}

		$dados = array(
			'titulo'   => 'Editar Unidade',
			'titulo1'  => 'Unidade',
			'titulo2'  => 'Editar Unidade',
			'pasta'    => 'unidade',
			'view'     => 'editar',
			'voltar'   => 'unidade/listagem',
			'unidades' => $this->UnidadeModel->getAllUnidade()->result()
		);

		$this->load->view('indexx', $dados);
	}

	public function inativarUnidade(){
		if($this->uri->segment(3)){
			//Envia o id para o método de exclusão
			$this->UnidadeModel->inativarUnidade(array('id' => $this->uri->segment(3)));		
		}
	}

	public function ativarUnidade(){
		if($this->uri->segment(3)){
			//Envia o id para o método de exclusão
			$this->UnidadeModel->ativarUnidade(array('id' => $this->uri->segment(3)));		
		}
	}
}