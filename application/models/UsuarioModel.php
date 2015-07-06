<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class UsuarioModel extends CI_Model{

	public function insertUsuario($dados = null){

		if($dados != null){

			$this->db->insert('tb_usuario', $dados);

			$this->session->set_flashdata('cadastrook','Operação realizada com sucesso.');
			
			redirect('usuario/cadastrar');
		}
	}

	public function updateUsuario($dados = null, $condition = null){

		if($dados != null && $condition != null){

			$this->db->update('tb_usuario', $dados, $condition);

			$this->session->set_flashdata('edicaook', 'Operação realizada com sucesso.');

			//redirect('usuario/editar');
			redirect(current_url());
		}
	}

	public function getAllUsuario(){

		$this->db->from('tb_usuario');

		$this->db->order_by('id');

		$this->db->where('ativo', 1);

		return $this->db->get();
	}

	public function getById($id = null){

		if($id != null){
			
			$this->db->where('id', $id);

			$this->db->limit(1);

			return $this->db->get('tb_usuario');
		}
	}

	

	public function getPerfil(){

		//Pega todos os registros
		$this->db->from('tb_perfil');
		//Ordena pelo nome
		$this->db->order_by('perfil');
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
				$return[$row['id']] = $row['perfil'];
			}
		}

		//Retorna o array preenchido
		return $return;
	}

	public function inativarUsuario($condition = null){

		if($condition != null){

			$dados = array('ativo' => 0);

			$this->db->update('tb_usuario', $dados, $condition);

			$this->session->set_flashdata('inativadook', 'Operação realizada com sucesso.');

			redirect('usuario/listagem');
		}
	}

}