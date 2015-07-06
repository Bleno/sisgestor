<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Docente extends CI_Controller{

	public function __construct(){
		parent::__construct();
		//$this->load->model('UsuarioModel');
		$this->load->model('DocenteModel');
	}

	public function index(){

		$dados = array(
			'titulo'  => 'Docente',
			'titulo1' => 'Docente',
			'titulo2' => 'Docente',
			'pasta'   => 'docente',
			'view'    => 'index'
		);

		$this->load->view('indexx', $dados);
	}

	public function cadastrar(){
	
		$this->form_validation->set_rules('nome', 'Nome', 'trim|required|max_length[45]|ucwords');
		$this->form_validation->set_rules('matricula','Matricula', 'trim|required|max_length[6]');
		$this->form_validation->set_rules('email', 'Email', 'trim|required|max_length[45]|strtolower|is_unique[tb_usuario.email]');
		$this->form_validation->set_rules('telefone','Telefone', 'trim|required|max_length[45]');
		$this->form_validation->set_rules('celular','Celular', 'trim|required|max_length[45]');
		$this->form_validation->set_rules('endereco', 'Endereço', 'required|max_length[45]');
		$this->form_validation->set_rules('id_escolaridade', 'Escolaridade', 'required');
		$this->form_validation->set_rules('id_eixo', 'Eixo', 'required');
		$this->form_validation->set_rules('hora_aula','Hora Aula', 'required');
		$this->form_validation->set_rules('graduacao','Graduacao', 'required');
		$this->form_validation->set_rules('data_admissao','Data Admissao', 'required');
		$this->form_validation->set_rules('id_usuario','ID Usuario', 'required'); 

		if($this->form_validation->run()){


			$dados = elements(
						array(
							'nome',
							'matricula',
							'email',
							'telefone',
							'celular',
							'endereco',
							'lotacao',
							'id_escolaridade',
							'id_eixo',
							'hora_aula',
							'graduacao',
							'data_admissao',
							'observacao',
							'id_usuario'
						), $this->input->post()
			);

			$dados['id_situacao'] = 1;

			$date = explode('/', $dados['data_admissao']);

		    $dia = $date[0];
		    $mes = $date[1];
		    $ano = $date[2];

		    $dados['data_admissao'] = $ano.'-'.$mes.'-'.$dia;

			$dados['ativo'] = 1;

			$this->DocenteModel->insertDocente($dados);		

		}

		$dados = array(
			'titulo'  	   => 'Cadastro de Docente',
			'titulo1' 	   => 'Docente',
			'titulo2'	   => 'Cadastro',
			'pasta'   	   => 'docente',
			'view'    	   => 'cadastrar',
			'voltar'   	   => 'docente/docentesAtivos',
			'escolaridade' => $this->DocenteModel->getEscolaridade(),
			'eixo'    	   => $this->DocenteModel->getEixo(),
			'situacao' 	   => $this->DocenteModel->getSituacao(),
		);

		$this->load->view('indexx', $dados);
	}

	public function docentesAtivos(){

		$dados = array(
			'titulo'  	   => 'Lista de Docentes Ativos',
			'titulo1' 	   => 'Docente',
			'titulo2'	   => 'Docentes Ativos',
			'pasta'   	   => 'docente',
			'view'    	   => 'docentesAtivos',
			'voltar'   	   => 'docente/cadastrar',
			'docentes' 	   => $this->DocenteModel->getDocentesAtivos()->result()
		);

		$this->load->view('indexx', $dados);
	}

	public function docentesFerias(){

		$dados = array(
			'titulo'  	   => 'Lista de Docente de Ferias',
			'titulo1' 	   => 'Docente',
			'titulo2'	   => 'Docentes de Ferias',
			'pasta'   	   => 'docente',
			'view'    	   => 'docentesFerias',
			'voltar'   	   => 'docente/cadastrar',
			'docentes' 	   => $this->DocenteModel->getDocentesFerias()->result()
		);

		$this->load->view('indexx', $dados);
	}

		public function docentesDemitidos(){

		$dados = array(
			'titulo'  	   => 'Lista de Docente Demitidos',
			'titulo1' 	   => 'Docente',
			'titulo2'	   => 'Docentes Demitidos',
			'pasta'   	   => 'docente',
			'view'    	   => 'docentesDemitidos',
			'voltar'   	   => 'docente/cadastrar',
			'docentes' 	   => $this->DocenteModel->getDocentesDemitidos()->result()
		);

		$this->load->view('indexx', $dados);
	}

	public function docentesEncostados(){

		$dados = array(
			'titulo'  	   => 'Lista de Docente Encostados',
			'titulo1' 	   => 'Docente',
			'titulo2'	   => 'Docentes Encostados',
			'pasta'   	   => 'docente',
			'view'    	   => 'docentesEncostados',
			'voltar'   	   => 'docente/cadastrar',
			'docentes' 	   => $this->DocenteModel->getDocentesEncostados()->result()
		);

		$this->load->view('indexx', $dados);
	}

	public function editar(){

		$this->form_validation->set_rules('nome', 'Nome', 'trim|required|max_length[45]|ucwords');
		$this->form_validation->set_rules('matricula','Matricula', 'trim|required|max_length[6]');
		$this->form_validation->set_rules('email', 'Email', 'trim|required|max_length[45]|strtolower');
		$this->form_validation->set_rules('telefone','Telefone', 'trim|required|max_length[45]');
		$this->form_validation->set_rules('celular','Celular', 'trim|required|max_length[45]');
		$this->form_validation->set_rules('endereco', 'Endereço', 'required|max_length[45]');
		$this->form_validation->set_rules('id_escolaridade', 'Escolaridade', 'required');
		$this->form_validation->set_rules('id_eixo', 'Eixo', 'required');
		$this->form_validation->set_rules('hora_aula','Hora Aula', 'required');
		$this->form_validation->set_rules('graduacao','Graduacao', 'required');
		$this->form_validation->set_rules('data_admissao','Data Admissao', 'required');

		if($this->form_validation->run()){



			$dados = elements(
						array(
							'nome',
							'matricula',
							'email',
							'telefone',
							'celular',
							'endereco',
							'lotacao',
							'id_escolaridade',
							'id_eixo',
							'hora_aula',
							'graduacao',
							'data_admissao',
							'observacao'
						), $this->input->post()
			);

			//var_dump($dados);
			//die();
			
			$date = explode('/', $dados['data_admissao']);

		    $dia = $date[0];
		    $mes = $date[1];
		    $ano = $date[2];

		    $dados['data_admissao'] = $ano.'-'.$mes.'-'.$dia;
			

			//var_dump($dados);
			///die();


			$this->DocenteModel->updateDocente($dados, array('id' => $this->uri->segment(3)));
		}

		$dados = array(
			'titulo'       => 'Editar Docente',
			'titulo1'      => 'Docente',
			'titulo2'      => 'Editar Docente',
			'pasta'    	   => 'docente',
			'view'     	   => 'editar',
			'voltar'   	   => 'docente/listagem',
			'escolaridade' => $this->DocenteModel->getEscolaridade(),
			'eixo'    	   => $this->DocenteModel->getEixo(),
			'situacao' 	   => $this->DocenteModel->getSituacao()
		);

		$this->load->view('indexx', $dados);
	}

	public function alterarSituacao(){

		$this->form_validation->set_rules('id_situacao', 'Id Situacão', 'required');

		if($this->form_validation->run()){

			$dados = elements(array('id_situacao', 'id_docente', 'periodoInicio', 'periodoFim','observacao', 'idSituacaoRedirect'), $this->input->post());

			if($dados['periodoInicio'] != '' && $dados['periodoFim'] != ''){

				$dateI = explode('/', $dados['periodoInicio']);
				$dateF = explode('/', $dados['periodoFim']);

			    $diaI = $dateI[0];
			    $mesI = $dateI[1];
			    $anoI = $dateI[2];

			    $diaF = $dateF[0];
			    $mesF = $dateF[1];
			    $anoF = $dateF[2];

			    $dados['periodoInicio'] = $anoI.'-'.$mesI.'-'.$diaI;
			    $dados['periodoFim']    = $anoF.'-'.$mesF.'-'.$diaF;

		    }else{

		    	$dados['periodoInicio'] = null;
			    $dados['periodoFim']    = null;
		    }

			$dados['id_usuario'] = $this->session->userdata('id');

			if($dados['id_situacao'] == 3){

				$dados['data_demissao'] = date('Y-m-d');
			}else{
				$dados['data_demissao'] = null;
			}

			$this->DocenteModel->alterarSituacao($dados);
		}

		$id_docente = $this->uri->segment(3);

		$dados = array(
			'titulo'   => 'Alterar Situaçao',
			'titulo1'  => 'Docente',
			'titulo2'  => 'Alterar Situaçao',
			'pasta'    => 'docente',
			'view'     => 'alterarSituacao',
			'voltar'   => 'docente/listagem',
			'docente'  => $this->DocenteModel->getById($id_docente)->row(),
			'situacao' => $this->DocenteModel->getSituacao()
		);

		$this->load->view('indexx', $dados);
	}

 	public function periodoFerias(){

		$this->load->view('docente/periodoFerias');
 	}

 	public function detalhesDocente(){

 		$id_docente = $this->input->post('id_docente');

 		$dados = array(
 			'docente' => $this->DocenteModel->getById($id_docente)->row()
 		);

 		$this->load->view('docente/detalhesDocente', $dados);
 	}


}