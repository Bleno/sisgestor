<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Usuario extends CI_Controller{

	public function __construct(){
		parent::__construct();
		$this->load->model('UsuarioModel');
	}

	public function index(){

		$dados = array(
			'titulo'  => 'Usuario',
			'titulo1' => 'Usuario',
			'titulo2' => 'Usuario',
			'pasta'   => 'usuario',
			'view'    => 'index'
		);

		$this->load->view('indexx', $dados);
	}

	public function cadastrar(){

		$login = elements(array('login'), $this->input->post());
		$email = elements(array('email'), $this->input->post());
		
		$this->form_validation->set_rules('nome', 'Nome', 'trim|required|max_length[45]|strtolower|ucwords');
		$this->form_validation->set_message('is_unique', "O email ". $email['email'] ." já existe.");
		$this->form_validation->set_rules('email', 'Email', 'trim|required|max_length[45]|strtolower|is_unique[tb_usuario.email]');
		$this->form_validation->set_message('is_unique', "O login ". $login['login'] ." já existe.");
		$this->form_validation->set_rules('login', 'Login', 'trim|required|max_length[45]|strtolower|is_unique[tb_usuario.login]');
		$this->form_validation->set_rules('id_perfil', 'required');
		//$this->form_validation->set_rules('senha','Senha','trim|required|strtolower');
		//$this->form_validation->set_rules('confirmiSenha','Repita a Senha','trim|required|strtolower|matches[senha]');


		if($this->form_validation->run()){

			$dados = elements(array('nome', 'email', 'login', 'id_perfil'), $this->input->post());

			$dados['senha'] = sha1($dados['login']);
			$dados['ativo'] = 1;
            $dados['primeiro_acesso'] = 1;

			$this->UsuarioModel->insertUsuario($dados);
		}else{
			$this->session->set_flashdata('erro', 'Campo(s) obrigatório(s) não preenchido(s)');
		}

		$dados = array(
			'titulo'  => 'Cadastro de Usuário',
			'titulo1' => 'Usuario',
			'titulo2' => 'Cadastrar',
			'pasta'   => 'usuario',
			'view'    => 'cadastrar',
			'voltar'   => 'usuario/listagem',
			'perfil'  => $this->UsuarioModel->getPerfil()
		);

		$this->load->view('indexx', $dados);

	}

	public function listagem(){

		$dados = array(
			'titulo'   => 'Lista de Usuário',
			'titulo1'  => 'Usuario',
			'titulo2'  => 'Listagem',
			'pasta'    => 'usuario',
			'view'     => 'listagem',
			'voltar'   => 'usuario/cadastrar',
			'usuarios' => $this->UsuarioModel->getAllUsuario()->result() 
		);

		$this->load->view('indexx', $dados);

	}

	public function editar(){

		$this->form_validation->set_rules('nome', 'Nome', 'trim|required|ucwords');
		$this->form_validation->set_rules('email', 'Email', 'trim|required');
		$this->form_validation->set_rules('id_perfil', 'required');

		if($this->form_validation->run()){

			$dados = elements(array('nome', 'email','primeiro_acesso', 'id_perfil'), $this->input->post());
            //forcar mudanca de senha
            if($dados['primeiro_acesso'] == 1){
                $query = $this->UsuarioModel->getById($this->input->post('idusuario'))->row();
                $dados['senha'] = sha1($query->login);
            }

			$this->UsuarioModel->updateUsuario($dados, array('id' => $this->input->post('idusuario')));
		}

		$dados = array(
			'titulo'   => 'Editar Usuário',
			'titulo1'  => 'Usuario',
			'titulo2'  => 'Editar',
			'pasta'    => 'usuario',
			'view'     => 'editar',
			'voltar'   => 'usuario/listagem',
			'forcar'    => 'Forçar troca de senha:',
			'perfil'   => $this->UsuarioModel->getPerfil()
		);

		$this->load->view('indexx', $dados);
	}

	public function inativarUsuario(){
		
		if($this->session->userdata('id_perfil') == 1){
			if($this->uri->segment(3)){
				//Envia o id para o método de exclusão
				$this->UsuarioModel->inativarUsuario(array('id' => $this->uri->segment(3)));		
			}
		}else{
			redirect('indexx/index');
		}

	}

}