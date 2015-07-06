<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Curso extends CI_Controller{

	public function __construct(){
		parent::__construct();
		$this->load->model('CursoModel');
	}

	public function index(){

		$dados = array(
			'titulo'  => 'Curso',
			'titulo1' => 'Curso',
			'titulo2' => 'Curso',
			'pasta'   => 'Curso',
			'view'    => 'index'
		);

		$this->load->view('indexx', $dados);
	}

	public function cadastrar(){
		
		$this->form_validation->set_rules('curso', 'Curso', 'trim|required|max_length[45]|strtolower|ucwords');
		$this->form_validation->set_rules('id_eixo', 'Eixo', 'required');

		if($this->form_validation->run()){

			$dados = elements(array('curso', 'sigla', 'id_eixo'), $this->input->post());

			$dados['ativo'] = 1;

			$this->CursoModel->insertCurso($dados);
		}

		$dados = array(
			'titulo'  => 'Cadastro de Curso',
			'titulo1' => 'Curso',
			'titulo2' => 'Cadastro',
			'pasta'   => 'curso',
			'view'    => 'cadastrar',
			'voltar'   => 'curso/listagem',
			'eixos'   => $this->CursoModel->getEixo()
		);

		$this->load->view('indexx', $dados);

	}

	public function listagem(){

		$dados = array(
			'titulo'   => 'Lista de Cursos',
			'titulo1'  => 'Curso',
			'titulo2'  => 'Listagem',
			'pasta'    => 'curso',
			'view'     => 'listagem',
			'voltar'   => 'curso/cadastrar',
			'cursos'   => $this->CursoModel->getAllCurso()->result() 
		);

		$this->load->view('indexx', $dados);

	}

	public function editar(){

		$this->form_validation->set_rules('curso', 'Curso', 'trim|required|max_length[45]|strtolower|ucwords');
		$this->form_validation->set_rules('id_eixo', 'Eixo', 'required');

		if($this->form_validation->run()){

			$dados = elements(array('curso', 'sigla', 'id_eixo'), $this->input->post());

			$this->CursoModel->updateCurso($dados, array('id' => $this->input->post('idCurso')));
		}

		$dados = array(
			'titulo'   => 'Editar Cursos',
			'titulo1'  => 'Curso',
			'titulo2'  => 'Editar Cursos',
			'pasta'    => 'curso',
			'view'     => 'editar',
			'voltar'   => 'curso/listagem',
			'eixos'   => $this->CursoModel->getEixo(),
			'cursos'   => $this->CursoModel->getAllCurso()->result()
		);

		$this->load->view('indexx', $dados);

	}

	public function inativarCurso(){
		if($this->uri->segment(3)){
			//Envia o id para o método de exclusão
			$this->CursoModel->inativarCurso(array('id' => $this->uri->segment(3)));		
		}
	}

	public function ativarCurso(){
		if($this->uri->segment(3)){
			//Envia o id para o método de exclusão
			$this->CursoModel->ativarCurso(array('id' => $this->uri->segment(3)));		
		}
	}
	
}