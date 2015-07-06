<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class loginmodel extends CI_Model{

	//Método responsavel pela verificação do login e senha no banco de dados
	public function doValidate($dados = null){

		if($dados != null){

			//Monta a consulta com a seguintes condições
			$this->db->where('login', $dados['login']);
			$this->db->where('senha', sha1($dados['senha']));
			$this->db->where('ativo', 1);

			//Armazena os registro na variavel query
			$query = $this->db->get('tb_usuario');

			//Verifica se foi encontrado um registro com os dados igual a das condições
			if($query->num_rows == 1){
				return true;
			}
		}
	}

	//Pega o usuario que tenha o login e a senha cadastrada no banco de dados
	public function getUsuario($dados = null){

		if($dados != null){

			//Monta a consulta com a seguintes condições
			$this->db->where('login', $dados['login']);
			$this->db->where('senha', sha1($dados['senha']));
			$this->db->where('ativo', 1);

			//Armazena os registro na variavel query
			$query = $this->db->get('tb_usuario');

			//Verifica se foi encontrado um registro com os dados igual a das condições
			if($query->num_rows){	
				//Retorna o registro com os dados semelhantes ao aos dados que foram informados		
				return $query->result_array();
			}
		}
	}
        
        public function updatePassword($dados = null, $condition = null){
            
            if($dados != null && $condition != null){

			$this->db->update('tb_usuario', $dados, $condition);

			$this->session->set_flashdata('edicaook', 'Operação realizada com sucesso.');

			//redirect('usuario/editar');
			redirect('indexx');
            }
        }
        
        public function getUserById($id = null){
            
            if($id != null){
		//Armazena os registro na variavel query
		$this->db->where('id', $id);
                $query = $this->db->get('tb_usuario');
                //Verifica se foi encontrado um registro com os dados igual a das condições
                if($query->num_rows){	
                        //Retorna o registro com os dados semelhantes ao aos dados que foram informados		
                        return $query->result_array();
                }
            }
        }
}
