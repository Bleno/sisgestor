<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class CursoModel extends CI_Model{

	public function insertCurso($dados = null){
		if($dados != null){
		
			$this->db->insert('tb_curso', $dados);
		
			$this->session->set_flashdata('cadastrook','Operação realizada com sucesso.');

			redirect('curso/cadastrar');
		}
	}

	public function updateCurso($dados = null, $condition = null){

		if($dados != null && $condition != null){

			$this->db->update('tb_curso', $dados, $condition);

			$this->session->set_flashdata('edicaook', 'Operação realizada com sucesso.');

			redirect(current_url());
		}
	}

	public function getEixo(){

		//Pega todos os registros
		$this->db->from('tb_eixo');
		//Ordena pelo nome
		$this->db->order_by('eixo');
		//Armazena os registro na variavel
		$result = $this->db->get();

		$return = array();

		//Verifica se a quantidade de registros e maior que 0
		if($result->num_rows > 0){

			//Varivavel $return com o primeiro indice 0 com o valor 'Selecione'
			$return[''] = 'Selecione';

			//Percore os valores 
			foreach($result->result_array() as $row){
				//O indice que será o id receberá o valor
				$return[$row['id']] = $row['eixo'];
			}
		}

		//Retorna o array preenchido
		return $return;
	}

	public function getAllCurso(){

		$this->db->select(
			'tb_curso.id, tb_curso.curso, tb_curso.ativo, tb_curso.id_eixo, tb_eixo.eixo'
		);

		$this->db->from('tb_curso');

		$this->db->order_by('curso');

		$this->db->join('tb_eixo', 'tb_eixo.id = tb_curso.id_eixo', 'inner');

		return $this->db->get();
	}

	public function getCurso(){

		//Pega todos os registros
		$this->db->from('tb_curso');
		//Ordena pelo nome
		$this->db->order_by('curso');

		$this->db->where('ativo', 1);
		//Armazena os registro na variavel
		$result = $this->db->get();

		$return = array();

		//Verifica se a quantidade de registros e maior que 0
		if($result->num_rows > 0){

			//Varivavel $return com o primeiro indice 0 com o valor 'Selecione'
			$return[''] = 'Selecione';

			//Percore os valores 
			foreach($result->result_array() as $row){
				//O indice que será o id receberá o valor
				$return[$row['id']] = $row['curso'];
			}
		}

		//Retorna o array preenchido
		return $return;
	}

	public function getById($id = null){

		if($id != null){
			
			$this->db->where('id', $id);

			$this->db->limit(1);

			return $this->db->get('tb_curso');
		}
	}

	public function inativarCurso( $condition = null){

		if($condition != null){

			$dados = array('ativo' => 0);

			$this->db->update('tb_curso', $dados, $condition);

			$this->session->set_flashdata('inativadook', 'Operação realizada com sucesso.');

			redirect('curso/listagem');
		}
	}

	public function ativarCurso( $condition = null){

		if($condition != null){

			$dados = array('ativo' => 1);

			$this->db->update('tb_curso', $dados, $condition);

			$this->session->set_flashdata('inativadook', 'Operação realizada com sucesso.');

			redirect('curso/listagem');
		}
	}
	
}