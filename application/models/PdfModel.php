<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class PdfModel extends CI_Model{

	public function gerarPdf($colunas = null, $ordenacao = null, $filtro = null){

		$this->load->library('fpdf/fpdf');

		if($colunas != null){

			$campos = implode(',', $colunas);

			$this->db->select($campos);

			$this->db->from('ta_mapeamento');

			$this->db->join('tb_docente', 'tb_docente.id = ta_mapeamento.id_docente', 'inner');
			$this->db->join('tb_curso',   'tb_curso.id   = ta_mapeamento.id_curso', 'inner');
			$this->db->join('tb_unidade', 'tb_unidade.id = ta_mapeamento.id_unidade', 'inner');

			$result = $this->db->get()->result();

			//Define os rotulos das colunas
			$label = array();
			$label['id'] 	       	= 'Id';
			$label['id_docente'] 	= 'Docenter';
			$label['id_curso'] 	    = 'Curso';
			$label['id_unidade'] 	= 'Unidade';
			$label['periodoInicio'] = 'Inicio do Periodo';
			$label['periodoFim'] 	= 'Fim do do Periodo';
			$label['horarioInicio'] = 'Horario Inicial';
			$label['horarioFim'] 	= 'Horario Final';

			//Define o alinhamento das colunas
			$align = array();
			$align['id'] 		    = 'L';
			$align['id_docente']    = 'L';
			$align['id_curso'] 	    = 'R';
			$align['id_unidade'] 	= 'C';
			$align['periodoInicio'] = 'L';
			$align['periodoFim'] 	= 'R';
			$align['horarioInicio'] = 'L';
			$align['horarioFim'] 	= 'L';

			//Define as larguras das colunas
			$width = array();
			$width['id'] 		  	= 40;
			$width['id_docente']    = 240;
			$width['id_curso'] 	    = 80;
			$width['id_unidade'] 	= 50;
			$width['periodoInicio'] = 50;
			$width['periodoFim'] 	= 80;
			$width['horarioInicio'] = 40;
			$width['horarioFim'] 	= 100;
			
			$pdf = new FPDF('P','pt','A4');//Instancia a clase FPDF
			$pdf->AddPage();//Adiciona um pagina
			$pdf->SetFont('Arial','B',10);//Define a fonte

			//Define cor de preenchimento, cor de texto e espessura da linha
			$pdf->SetFillColor(130,80,70);
			$pdf->SetTextColor(255);
			$pdf->SetLineWidth(1);

			$largura_total = 0;
			//Adiciona celulas de titulo das colunas
			foreach($colunas as $coluna){

				$titulo 	 = $label[$coluna];

				var_dump($titulo);
				die();
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
			while($row = $result){
				
				//Adiciona as celulas contendo os dados do relatório
				foreach($colunas as $coluna){		
					
					$dado		 = $row[$coluna];
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