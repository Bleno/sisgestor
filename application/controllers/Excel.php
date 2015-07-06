<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Excel extends CI_Controller{

    
        public function __construct(){
                parent::__construct();

                $this->load->model('MapeamentoModel');
        }
    
    

	public function index(){

		//Array que enviará o titulo para a pagina
		$dados = array(
			'titulo' => 'Excel'
		);

		//Solicita a tela de login e envia o array para a view
		$this->load->view('excel/excel', $dados);
	}
        
        public function excelGeral(){

        $dados = array(
                'titulo'  => 'Excel Geral',
                'titulo1' => 'Excel',
                'titulo2' => 'Excel Geral',
                'pasta'   => 'excel',
                'view'    => 'excel',
                'voltar'  => '',
                'ano' => $this->MapeamentoModel->getYear()->result()
        );

        $this->load->view('indexx', $dados);
        
        }
        
        public function excelpy()
        {
            $dados = array(
                'titulo'  => 'Excel Geral',
                'titulo1' => 'Excel',
                'titulo2' => 'Excel Geral',
                'pasta'   => 'excel',
                'view'    => 'excel.py',
                'voltar'  => '',
                );
            $this->load->view('excel', $dados);
        }

}