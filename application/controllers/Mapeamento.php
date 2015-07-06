<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mapeamento extends CI_Controller{

	public function __construct(){
		parent::__construct();
		$this->load->model('MapeamentoModel');
		$this->load->model('DocenteModel');
		$this->load->model('CursoModel');
		$this->load->model('UnidadeModel');			
	}

	public function index(){

		$dados = array(
			'titulo'  => 'Mapeamento',
			'titulo1' => 'Mapeamento',
			'titulo2' => 'Mapeamento',
			'pasta'   => 'Mapeamento',
			'view'    => 'index'
		);

		$this->load->view('indexx', $dados);
	}

	public function mapear(){

		$this->form_validation->set_rules('id_docente', 'Docente', 'required');
		$this->form_validation->set_rules('id_curso', 'Curso', 'required');
		$this->form_validation->set_rules('id_unidade', 'Unidade', 'required');
		$this->form_validation->set_rules('periodoInicio', 'Periodo Inicial', 'required');
		$this->form_validation->set_rules('periodoFim', 'Periodo Final', 'required');
		$this->form_validation->set_rules('horarioInicio', 'Curso', 'required');
		$this->form_validation->set_rules('horarioFim', 'Curso', 'required');

		if($this->form_validation->run()){

			$dados =
				elements(
					array(
						'id_docente',
						'id_curso', 
						'id_unidade', 
						'periodoInicio', 
						'periodoFim',
						'horarioInicio',
						'horarioFim',
						'domingo',
						'segunda',
						'terca',
						'quarta',
						'quinta',
						'sexta',
						'sabado'
					), $this->input->post()
				)
			;

			if($dados['domingo'] == 'domingo'){
				$dados['domingo'] = 1;
			}

			if($dados['segunda'] == 'segunda'){
				$dados['segunda'] = 1;
			}

			if($dados['terca'] == 'terca'){
				$dados['terca'] = 1;
			}

			if($dados['quarta'] == 'quarta'){
				$dados['quarta'] = 1;
			}

			if($dados['quinta'] == 'quinta'){
				$dados['quinta'] = 1;
			}

			if($dados['sexta'] == 'sexta'){
				$dados['sexta'] = 1;
			}

			if($dados['sabado'] == 'sabado'){
				$dados['sabado'] = 1;
			}

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

		    $dados['ativo'] = 1;

			$this->MapeamentoModel->insertMapeamento($dados);

		}

		$dados = array(
			'titulo'   => 'Mapear Docente',
			'titulo1'  => 'Mapeamento',
			'titulo2'  => 'Mapear',
			'pasta'    => 'mapeamento',
			'view'     => 'mapear',
			'voltar'   => 'mapeamento/listagem',
			'docentes' => $this->DocenteModel->getDocenteAtivos(),
			'cursos'   => $this->CursoModel->getCurso(),
			'unidades' => $this->UnidadeModel->getUnidadeAtivo()
		);

		$this->load->view('indexx', $dados);
	}

	public function confereDocente(){

		$dados = 
			elements(
				array(
					'idDocente',
					'idCurso',
					'idUnidade',
					'periodoInicio', 
					'periodoFim', 
					'horarioInicio', 
					'horarioFim'
				), $this->input->post()
			)
		;

		//var_dump($dados);
		//die();
		
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

		if($this->MapeamentoModel->confereDocente($dados)){
			echo json_encode($this->MapeamentoModel->confereDocente($dados));
		}else{
			$array = array('resp' => false);

			echo json_encode($array);
		}
	}

	public function listagem(){

		$dados = array(
			'titulo'     => 'Lista de Mapementos',
			'titulo1'    => 'Mapeamento',
			'titulo2'    => 'Listagem',
			'pasta'      => 'mapeamento',
			'view'       => 'listagem',
			'voltar'     => 'mapeamento/mapear',
			'mapeamento' => $this->MapeamentoModel->getMapeamentoAll()->result()
		);

		$this->load->view('indexx', $dados);

	}

	public function editar(){

		$this->form_validation->set_rules('id_curso', 'Curso', 'required');
		$this->form_validation->set_rules('id_unidade', 'Unidade', 'required');
		$this->form_validation->set_rules('periodoInicio', 'Periodo Inicial', 'required');
		$this->form_validation->set_rules('periodoFim', 'Periodo Final', 'required');
		$this->form_validation->set_rules('horarioInicio', 'Curso', 'required');
		$this->form_validation->set_rules('horarioFim', 'Curso', 'required');

		if($this->form_validation->run()){

			$dados =
				elements(
					array(
						'id_curso', 
						'id_unidade', 
						'periodoInicio', 
						'periodoFim',
						'horarioInicio',
						'horarioFim',
						'domingo',
						'segunda',
						'terca',
						'quarta',
						'quinta',
						'sexta',
						'sabado'
					), $this->input->post()
				)
			;

			$condition = array('id' => $this->input->post('idMapeamento'));

			if($dados['domingo'] == 'domingo'){
				$dados['domingo'] = 1;
			}

			if($dados['segunda'] == 'segunda'){
				$dados['segunda'] = 1;
			}

			if($dados['terca'] == 'terca'){
				$dados['terca'] = 1;
			}

			if($dados['quarta'] == 'quarta'){
				$dados['quarta'] = 1;
			}

			if($dados['quinta'] == 'quinta'){
				$dados['quinta'] = 1;
			}

			if($dados['sexta'] == 'sexta'){
				$dados['sexta'] = 1;
			}

			if($dados['sabado'] == 'sabado'){
				$dados['sabado'] = 1;
			}

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

			$this->MapeamentoModel->updateMapeamento($dados, $condition);
		}

		$dados = array(
			'titulo'   => 'Editar Mapementos',
			'titulo1'  => 'Mapeamento',
			'titulo2'  => 'Editar',
			'pasta'    => 'mapeamento',
			'view'     => 'editar',
			'voltar'   => 'mapeamento/listagem',
			'docentes' => $this->DocenteModel->getDocente(),
			'cursos'   => $this->CursoModel->getCurso(),
			'unidades' => $this->UnidadeModel->getUnidadeAtivo()
		);

		$this->load->view('indexx', $dados);
	}

	public function cursoAjax(){

		if($this->input->post('id_docente')){

			$id_docente = $this->input->post('id_docente');

			$dados = array(
				'cursos' => $this->MapeamentoModel->getCursoDocenteEixo($id_docente)
			);

			$this->load->view('mapeamento/cursoAjax', $dados);

		}elseif($this->input->post('id_docenteE')){

			$id_docente = $this->input->post('id_docenteE');

			$dados = array(
				'cursos' 	 => $this->MapeamentoModel->getCursoDocenteEixo($id_docente),
				'id_docente' => $id_docente
			);

			$this->load->view('mapeamento/cursoAjaxEditar', $dados);
		}
	}	

	public function detalhesMapeamento(){

		$id_mapeamento = $this->input->post('id_mapeamento');

		$dados = array(
			'detalhes' => $this->MapeamentoModel->getById($id_mapeamento)->result()
		);

		$this->load->view('mapeamento/detalhesMapeamento', $dados);
	}

	public function desabilitarMapeamento(){
		if($this->uri->segment(3)){
			//Envia o id para o método de exclusão
			$this->MapeamentoModel->desabilitarMapeamento(array('id' => $this->uri->segment(3)));		
		}
	}


}