<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class UnidadeModel extends CI_Model{

	public function insertUnidade($dados = null){

		if($dados != null){

			$this->db->insert('tb_unidade', $dados);

			$this->session->set_flashdata('cadastrook','Operação realizada com sucesso.');

			redirect('unidade/cadastrar');
		}
	}

	
	public function updateUnidade($dados = null, $condition = null){

		if($dados != null && $condition != null){

			$this->db->update('tb_unidade', $dados, $condition);

			$this->session->set_flashdata('edicaook', 'Operação realizada com sucesso.');

			redirect(current_url());
		}
	}

	public function getUnidade(){

		//Pega todos os registros
		$this->db->from('tb_unidade');
		//Ordena pelo nome
		$this->db->order_by('unidade');
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
				$return[$row['id']] = $row['unidade'];
			}
		}

		//Retorna o array preenchido
		return $return;
	}

	public function getUnidadeAtivo(){

		//Pega todos os registros
		$this->db->from('tb_unidade');
		//Ordena pelo nome
		$this->db->order_by('unidade');
		//Armazena os registro na variavel

		$this->db->where('ativo', 1);
		
		$result = $this->db->get();

		$return = array();

		//Verifica se a quantidade de registros e maior que 0
		if($result->num_rows > 0){

			//Varivavel $return com o primeiro indice 0 com o valor 'Selecione'
			$return[''] = 'Selecione';

			//Percore os valores 
			foreach($result->result_array() as $row){
				//O indice que será o id receberá o valor
				$return[$row['id']] = $row['unidade'];
			}
		}

		//Retorna o array preenchido
		return $return;
	}

	

	public function getAllUnidade(){

		return $this->db->get('tb_unidade');
	}

	public function getById($id = null){

		if($id != null){
			
			$this->db->where('id', $id);

			$this->db->limit(1);

			return $this->db->get('tb_unidade');
		}
	}

	public function inativarUnidade( $condition = null){

		if($condition != null){

			$dados = array('ativo' => 0);

			$this->db->update('tb_unidade', $dados, $condition);

			$this->session->set_flashdata('inativadook', 'Operação realizada com sucesso.');

			redirect('unidade/listagem');
		}
	}

	public function ativarUnidade( $condition = null){

		if($condition != null){

			$dados = array('ativo' => 1);

			$this->db->update('tb_unidade', $dados, $condition);

			$this->session->set_flashdata('inativadook', 'Operação realizada com sucesso.');

			redirect('unidade/listagem');
		}
	}
}