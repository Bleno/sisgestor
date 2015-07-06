<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pdf extends CI_Controller{

	public function __construct(){
		parent::__construct();
		$this->load->model('UnidadeModel');		
		$this->load->model('DocenteModel');
		$this->load->model('CursoModel');
		$this->load->model('PdfModel');		
	}

	public function index(){

		$dados = array(
			'titulo'  => 'Pdf',
			'titulo1' => 'Pdf',
			'titulo2' => 'Pdf',
			'pasta'   => 'Pdf',
			'view'    => 'index'
		);

		$this->load->view('indexx', $dados);
	}

	public function calcula_hora($inicio, $fim){
		
		if(!is_array($inicio)){ $inicio = explode(":", $inicio); }
		if(!is_array($fim)){ $fim = explode(":", $fim); }

		$time_inicio = (($inicio[0]*60)*60) + ($inicio[1]*60) + $inicio[2];
		$time_fim    = (($fim[0]*60)*60) + ($fim[1]*60) + $fim[2] ;

		$t[0] = floor(($time_fim - $time_inicio) / 60);
		$t[1] = floor((($time_fim - $time_inicio) / 60) / 60);
		$t[2] = $time_fim - $time_inicio;
		$h = $t[1];
		$m = $t[0] - ($t[1] * 60);

		if($m < 10){
			$m = "0$m";
		} 

		$s = $t[2] - (($h * 60) + $m) * 60;
		
		if($s < 10){
			$s = "0$s";
		}

		$t[3] =  "$h:$m:$s";

		return $t[3];
	}

	public function pdfGeral(){

		$dados = array(
			'titulo'  => 'Pdf Geral',
			'titulo1' => 'PDF',
			'titulo2' => 'Pdf Geral',
			'pasta'   => 'pdf',
			'view'    => 'pdfGeral',
			'voltar'  => '',
			'docentes' => $this->DocenteModel->getDocenteTodos()
		);

		$this->load->view('indexx', $dados);

		$this->load->library('fpdf/fpdf');

		if($_POST){

			if(empty($_POST['idd'])){
				$condition = "";
			}else{
				$condition = " WHERE ta_mapeamento.id_docente = ".$_POST['idd'];
			}
		
			$sql = "SELECT ta_mapeamento.id, nome, curso, unidade, periodoInicio, periodoFim,
					horarioInicio, horarioFim, tb_docente.id as idd, tb_curso.id as idc,
					tb_unidade.id as idu
					FROM ta_mapeamento 
					INNER JOIN tb_docente ON ( ta_mapeamento.id_docente = tb_docente.id )
					INNER JOIN tb_curso ON ( ta_mapeamento.id_curso = tb_curso.id )
					INNER JOIN tb_unidade ON ( ta_mapeamento.id_unidade = tb_unidade.id ) $condition";

			$result = mysql_query($sql) or die('Erro ao selecionar: '.mysql_error());

			if($_POST['folha'] == 'a3'){

				$folha = 'a3';
			}else{
				$folha = 'a4';
			}
		
			$pdf = new FPDF('P','pt',"$folha");//Instancia a clase FPDF
			$pdf->AddPage();//Adiciona um pagina
			$pdf->SetFont('Arial','B',10);//Define a fonte

			//Define cor de preenchimento, cor de texto e espessura da linha
			$pdf->SetFillColor(130,80,70);
			$pdf->SetTextColor(255);
			$pdf->SetLineWidth(1);

			//Adiciona celulas
			$pdf->Cell(150, 20, 'Docente', 1, 0, 'C',true);
			$pdf->cell(200, 20, 'Curso', 1, 0, 'C', true);
			$pdf->cell(100, 20, 'Unidade', 1, 0, 'C', true);
			$pdf->cell(80, 20, 'Periodo Inicial', 1, 0, 'C', true);
			$pdf->cell(80, 20, 'Periodo Final', 1, 0, 'C', true);
			$pdf->cell(80, 20, 'Horario Inicial', 1, 0, 'C', true);
			$pdf->cell(80, 20, 'Horario Final', 1, 0, 'C', true);
			//$pdf->cell(80, 20, 'Total de Horas', 1, 0, 'C', true);

			//Quebra celulas
			$pdf->Ln();

			//Define cores de fundo, do texto e fonte dos dados
			$pdf->SetFillColor(200, 200, 200);
			$pdf->SetTextColor(0);
			$pdf->SetFont('Arial', '',8);

			$colore 	 = false;

			while($row = mysql_fetch_array($result)){

				$total_horas = $this->calcula_hora($row['horarioInicio'], $row['horarioFim']);

				$dateI = explode('-', $row['periodoInicio']);
				$dateF = explode('-', $row['periodoFim']);

			    $diaI = $dateI[0];
			    $mesI = $dateI[1];
			    $anoI = $dateI[2];

			    $diaF = $dateF[0];
			    $mesF = $dateF[1];
			    $anoF = $dateF[2];
			
			    $row['periodoInicio'] = $anoI.'/'.$mesI.'/'.$diaI;
			    $row['periodoFim']    = $anoF.'/'.$mesF.'/'.$diaF;
				
				$pdf->Cell(150, 14, utf8_decode($row['nome']),  'LR', 0, 'C', $colore);
				$pdf->Cell(200, 14, utf8_decode($row['curso']), 'LR', 0, 'C', $colore);
				$pdf->Cell(100, 14, utf8_decode($row['unidade']), 'LR', 0, 'C', $colore);
				$pdf->Cell(80, 14, $row['periodoInicio'], 'LR', 0, 'C', $colore);
				$pdf->Cell(80, 14, $row['periodoFim'], 'LR', 0, 'C', $colore);
				$pdf->Cell(80, 14, $row['horarioInicio'], 'LR', 0, 'C', $colore);
				$pdf->Cell(80, 14, $row['horarioFim'], 'LR', 0, 'C', $colore);
				//$pdf->Cell(80, 14, $total_horas, 'LR', 0, 'C', $colore);
				
				//Quebra de linha
				$pdf->ln();
				//Inverte cor de fundo
				$colore = !$colore;
			}

			//Desenha a linha final
			$pdf->SetFillColor(255, 255, 255);
			$pdf->Cell(770, 20, '','T',0,'L',true);

			//Salva o PDF em arquivo
			$pdf->Output();				
		}	
	}

	public function dif_horario($horarioInicio, $horarioFim){

		$horarioInicio = strtotime("1/1/1980 $horarioInicio");
		$horarioFim    = strtotime("1/1/1980 $horarioFim");

		if($horarioFim < $horarioInicio){

			$horarioFim = $horarioFim + 86400;

		}

		return ($horarioFim + $horarioInicio) / 3600;

	}

	public function pdfFiltro(){

			

		/*	

		$dados = elements(array('colunas'), $this->input->post());

		//Colocar a condição minima de colunas
		if(!empty($dados['colunas']) && count($dados['colunas']) <= 5){

			$select    = array();
			$ordenacao = '';
			$filtro    = array();

			foreach($dados['colunas'] as $coluna){

				$select[] = "{$coluna} as \"{$coluna}\"";

			}

			//$colunas = implode(',', $select);

			$this->PdfModel->gerarPdf($select, $ordenacao, $filtro);

		}else{
			$this->session->set_flashdata('erroPdf','Selecione no minimo 3 colunas e no maximo 5 colunas');
		}
		*/

		$dados = array(
			'titulo'   => 'Pdf Filtro',
			'titulo1'  => 'PDF',
			'titulo2'  => 'Mapeamento Geral',
			'pasta'    => 'pdf',
			'view'     => 'pdfFiltro',
			'voltar'   => '',	
			'docentes' => $this->DocenteModel->getDocente(),
			'cursos'   => $this->CursoModel->getCurso(),
			'unidades' => $this->UnidadeModel->getUnidade()
		);

		$this->load->view('indexx', $dados);

		$this->load->library('fpdf/fpdf');

		$label = array();
		$label['ta_mapeamento.id'] = 'Id';
		$label['nome'] 			   = 'Docenter';
		$label['curso'] 	       = 'Curso';
		$label['unidade'] 		   = 'Unidade';
		$label['periodoInicio']    = 'Periodo/Inicio';
		$label['periodoFim'] 	   = 'Periodo/Fim';
		$label['horarioInicio']    = 'Horario/Inicial';
		$label['horarioFim'] 	   = 'Horario/Final';

		//Define o alinhamento das colunas
		$align = array();
		$align['ta_mapeamento.id'] 	= 'C';
		$align['nome']   		    = 'C';
		$align['curso'] 	        = 'C';
		$align['unidade'] 		    = 'C';
		$align['periodoInicio']     = 'C';
		$align['periodoFim'] 	    = 'C';
		$align['horarioInicio']     = 'C';
		$align['horarioFim'] 	    = 'C';

		//Define as larguras das colunas
		$width = array();
		$width['ta_mapeamento.id'] = 28;
		$width['nome']   		   = 150;
		$width['curso'] 	       = 180;
		$width['unidade'] 		   = 100;
		$width['periodoInicio']    = 71;
		$width['periodoFim'] 	   = 65;
		$width['horarioInicio']    = 80;
		$width['horarioFim'] 	   = 80;

		if($_POST){
		//Forma as colunas para o SELECT
		$select = array();
		if(isset($_POST['colunas']) && count($_POST['colunas']) <= 8){
			
			foreach($_POST['colunas'] as $coluna){
				$select[] = "{$coluna} as \"{$coluna}\"";	
			}

		}else{
			//echo "<script type='text/javascript'>alert('Selecione pelomenos uma coluna e no maximo 5.');window.location='pdfFiltro';</script>";
			//return false;
		}
		
		$sql = 'SELECT '.implode(',', $select).  '
				,tb_docente.id as idd, tb_curso.id as idc, tb_unidade.id as idu
				FROM ta_mapeamento 
				INNER JOIN tb_docente ON ( ta_mapeamento.id_docente = tb_docente.id )
				INNER JOIN tb_curso ON ( ta_mapeamento.id_curso = tb_curso.id )
				INNER JOIN tb_unidade ON ( ta_mapeamento.id_unidade = tb_unidade.id ) ';

		//echo $sql;
		//die();

		//Define a consulta SQL
		//.id as idm, tb_docente.id as idd, tb_curso.id as idc, tb_unidade.id as idu FROM ta_mapeamento LEFT JOIN tb_docente on (ta_mapeamento.id_docente = tb_docente.id) LEFT JOIN tb_curso on (ta_mapeamento.id_curso = tb_curso.id) LEFT JOIN tb_unidade on (ta_mapeamento.id_unidade = tb_unidade.id
		
		//Detecta filtro por descrição do produto
		
		if(!empty($_POST['id_docente'])){
			if(empty($_POST['idc']) && empty($_POST['idu'])){
				$id_docente = $_POST['id_docente'];
				$sql .= " WHERE ta_mapeamento.id_docente =  $id_docente";
			}
		}

		//Detecta filtro por nome do fabricante
		if(!empty($_POST['idc'])){
			if(empty($_POST['id_docente']) && empty($_POST['idu'])){
				$id_curso = $_POST['idc'];
				$sql .= " WHERE ta_mapeamento.id_curso = $id_curso";
			}
		}

		//Detecta filtro por estoque máximo
		if(!empty($_POST['idu'])){
			if(empty($_POST['id_docente']) && empty($_POST['idc'])){
				$id_unidade = $_POST['idu'];
				$sql .= " WHERE ta_mapeamento.id_unidade = $id_unidade";
			}
		}

		if(!empty($_POST['id_docente']) && !empty($_POST['idc'])){
			if(empty($_POST['idu'])){
				$id_docente = $_POST['id_docente'];
				$id_curso   = $_POST['idc'];
				$sql .= " WHERE ta_mapeamento.id_docente =  $id_docente AND ta_mapeamento.id_curso = $id_curso ";
			}
		}

		if(!empty($_POST['id_docente']) && !empty($_POST['idu'])){
			if(empty($_POST['idc'])){
				$id_docente = $_POST['id_docente'];
				$id_unidade = $_POST['idu'];
				$sql .= " WHERE ta_mapeamento.id_docente =  $id_docente AND ta_mapeamento.id_unidade = $id_unidade ";
			}
		}

		if(!empty($_POST['idc']) && !empty($_POST['idu'])){
			if(empty($_POST['id_docente'])){
				$id_curso 	= $_POST['idc'];
				$id_unidade = $_POST['idu'];
				$sql .= " WHERE ta_mapeamento.id_curso = $id_curso AND ta_mapeamento.id_unidade = $id_unidade ";
			}
		}

		if(!empty($_POST['id_docente']) && !empty($_POST['idc']) && !empty($_POST['idu'])){
			$id_docente = $_POST['id_docente'];
			$id_curso 	= $_POST['idc'];
			$id_unidade = $_POST['idu'];
			$sql .= " WHERE ta_mapeamento.id_docente = $id_docente AND ta_mapeamento.id_curso = $id_curso AND ta_mapeamento.id_unidade = $id_unidade ";
		}

		if(!empty($_POST['ordem'])){
			$sql .= " ORDER BY ". $_POST['ordem'];
		}

		//Executa a instrução SQL
		$result = mysql_query($sql) or die('Erro ao selecionar: '.mysql_error());
		
		if($_POST['folha'] == 'a3'){

			$folha = 'a3';
		}else{
			$folha = 'a4';
		}
		
		$pdf = new FPDF('P','pt',"$folha");//Instancia a clase FPDF
		$pdf->AddPage();//Adiciona um pagina
		$pdf->SetFont('Arial','B',10);//Define a fonte

		//Define cor de preenchimento, cor de texto e espessura da linha
		$pdf->SetFillColor(130,80,70);
		$pdf->SetTextColor(255);
		$pdf->SetLineWidth(1);

		$largura_total = 0;
		//Adiciona celulas de titulo das colunas
		foreach($_POST['colunas'] as $coluna){
			
			$titulo 	 = $label[$coluna];
			$largura 	 = $width[$coluna];
			$alinhamento = $align[$coluna];
			$pdf->Cell($largura, 20, $titulo, 1, 0, $alinhamento, true);
			
			$largura_total += $largura;	
		}

		$pdf->Ln();

		//Define a cor de funda, do texto e fonte dos dados
		$pdf->SetFillColor(200, 200, 200);
		$pdf->SetTextColor(0);
		$pdf->SetFont('Arial', '', 8);

		$colore = FALSE;

		//Inicializa variaveis de controle e totalização
		//foreach($result as $row){
		while($row = mysql_fetch_array($result)){
			
			//Adiciona as celulas contendo os dados do relatório
			foreach($_POST['colunas'] as $coluna){		
				
				$dado		 = utf8_decode($row[$coluna]);
				$largura 	 = $width[$coluna];
				$alinhamento = $align[$coluna];
				
				$pdf->Cell($largura, 14, $dado, 'LR', 0, $alinhamento, $colore);	
				
			}	
			
			$pdf->ln();
			$colore = !$colore;//Inverte cor de fundo 
		}

		//Desenha a linha final
		$pdf->SetFillColor(255, 255, 255);
		$pdf->Cell($largura_total, 20, '','T',0,'L',true);

		//Salva o PDF em arquivo
		//$pdf->Output('output1.pdf','F');
		$pdf->Output();
				
		}	
	}
}