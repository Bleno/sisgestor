<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class DocenteModel extends CI_Model{

	public function insertDocente($dados = null){

		if($dados != null){
		
			$this->db->insert('tb_docente', $dados);

			$this->session->set_flashdata('cadastrook','Operação realizada com sucesso.');
			
			redirect('docente/cadastrar');
		}
	}

	public function updateDocente($dados = null, $condition = null){

		if($dados != null && $condition != null){

			$this->db->update('tb_docente', $dados, $condition);

			$this->session->set_flashdata('edicaook', 'Operação realizada com sucesso.');

			redirect(current_url());
		}
	}

	public function getDocentesAtivos(){

		$this->db->select(
			'tb_usuario.nome as usuario, tb_docente.id_usuario, tb_docente.id, tb_docente.nome, 
			 tb_escolaridade.escolaridade, tb_situacao.situacao, tb_eixo.eixo, tb_docente.email,
			 tb_docente.matricula, tb_docente.endereco, tb_docente.data_admissao, tb_docente.telefone,
			 tb_docente.celular, tb_docente.lotacao, tb_docente.hora_aula, tb_docente.graduacao,
			 tb_docente.observacao, tb_docente.ativo'
		);

		$this->db->from('tb_docente');

		$this->db->order_by('nome');

		$this->db->where('tb_docente.id_situacao', 1);
		$this->db->where('tb_docente.ativo', 1);

		$this->db->join('tb_usuario', 'tb_usuario.id = tb_docente.id_usuario', 'inner');
		$this->db->join('tb_escolaridade', 'tb_escolaridade.id = tb_docente.id_escolaridade', 'inner');
		$this->db->join('tb_situacao', 'tb_situacao.id = tb_docente.id_situacao', 'inner');
		$this->db->join('tb_eixo', 'tb_eixo.id = tb_docente.id_eixo', 'inner');

		return $this->db->get();
	}

	public function getDocentesFerias(){

		$this->db->select(
			'tb_usuario.nome as usuario, tb_docente.id_usuario, tb_docente.id, tb_docente.nome, 
			 tb_escolaridade.escolaridade, tb_situacao.situacao, tb_eixo.eixo, tb_docente.email,
			 tb_docente.matricula, tb_docente.endereco, tb_docente.data_admissao, tb_docente.telefone,
			 tb_docente.celular, tb_docente.lotacao, tb_docente.hora_aula, tb_docente.graduacao,
			 tb_docente.observacao, tb_docente.ativo'
		);

		$this->db->from('tb_docente');

		$this->db->order_by('nome');

		$this->db->where('tb_docente.id_situacao', 2);
		$this->db->where('tb_docente.ativo', 1);

		$this->db->join('tb_usuario', 'tb_usuario.id = tb_docente.id_usuario', 'inner');
		$this->db->join('tb_escolaridade', 'tb_escolaridade.id = tb_docente.id_escolaridade', 'inner');
		$this->db->join('tb_situacao', 'tb_situacao.id = tb_docente.id_situacao', 'inner');
		$this->db->join('tb_eixo', 'tb_eixo.id = tb_docente.id_eixo', 'inner');

		return $this->db->get();
	}

	public function getDocentesDemitidos(){

		$this->db->select(
			'tb_usuario.nome as usuario, tb_docente.id_usuario, tb_docente.id, tb_docente.nome, 
			 tb_escolaridade.escolaridade, tb_situacao.situacao, tb_eixo.eixo, tb_docente.email,
			 tb_docente.matricula, tb_docente.endereco, tb_docente.data_admissao, tb_docente.telefone,
			 tb_docente.celular, tb_docente.lotacao, tb_docente.hora_aula, tb_docente.graduacao,
			 tb_docente.observacao, tb_docente.ativo'
		);

		$this->db->from('tb_docente');

		$this->db->order_by('nome');

		$this->db->where('tb_docente.id_situacao', 3);
		$this->db->where('tb_docente.ativo', 1);

		$this->db->join('tb_usuario', 'tb_usuario.id = tb_docente.id_usuario', 'inner');
		$this->db->join('tb_escolaridade', 'tb_escolaridade.id = tb_docente.id_escolaridade', 'inner');
		$this->db->join('tb_situacao', 'tb_situacao.id = tb_docente.id_situacao', 'inner');
		$this->db->join('tb_eixo', 'tb_eixo.id = tb_docente.id_eixo', 'inner');

		return $this->db->get();
	}

	public function getDocentesEncostados(){

		$this->db->select(
			'tb_usuario.nome as usuario, tb_docente.id_usuario, tb_docente.id, tb_docente.nome, 
			 tb_escolaridade.escolaridade, tb_situacao.situacao, tb_eixo.eixo, tb_docente.email,
			 tb_docente.matricula, tb_docente.endereco, tb_docente.data_admissao, tb_docente.telefone,
			 tb_docente.celular, tb_docente.lotacao, tb_docente.hora_aula, tb_docente.graduacao,
			 tb_docente.observacao, tb_docente.ativo'
		);

		$this->db->from('tb_docente');

		$this->db->order_by('nome');

		$this->db->where('tb_docente.id_situacao', 4);
		$this->db->where('tb_docente.ativo', 1);

		$this->db->join('tb_usuario', 'tb_usuario.id = tb_docente.id_usuario', 'inner');
		$this->db->join('tb_escolaridade', 'tb_escolaridade.id = tb_docente.id_escolaridade', 'inner');
		$this->db->join('tb_situacao', 'tb_situacao.id = tb_docente.id_situacao', 'inner');
		$this->db->join('tb_eixo', 'tb_eixo.id = tb_docente.id_eixo', 'inner');

		return $this->db->get();
	}

	public function getEscolaridade(){

		$this->db->from('tb_escolaridade');

		$this->db->order_by('escolaridade');

		$result = $this->db->get();

		$return = array();

		if($result->num_rows()){

			$return[''] = 'Selecione';

			foreach($result->result_array() as $row){
				$return[$row['id']] = $row['escolaridade'];
			}
		}

		return $return;
	}

	public function getEixo(){

		$this->db->from('tb_eixo');

		$this->db->order_by('eixo');

		$result = $this->db->get();

		$return = array();

		if($result->num_rows()){

			$return[''] = 'Selecione';

			foreach($result->result_array() as $row){
				$return[$row['id']] = $row['eixo'];
			}
		}

		return $return;
	}

	public function getSituacao(){

		$this->db->from('tb_situacao');

		$this->db->order_by('situacao');

		$result = $this->db->get();

		$return = array();

		if($result->num_rows()){

			$return[''] = 'Selecione';

			foreach($result->result_array() as $row){
				$return[$row['id']] = $row['situacao'];
			}
		}

		return $return;
	}

	public function getDocente(){

		//Pega todos os registros
		$this->db->from('tb_docente');
		//Ordena pelo nome
		$this->db->order_by('nome');
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
				$return[$row['id']] = $row['nome'];
			}
		}

		//Retorna o array preenchido
		return $return;
	}

	public function getDocenteAtivos(){

		//Pega todos os registros
		$this->db->from('tb_docente');
		//Ordena pelo nome
		$this->db->order_by('nome');
		//Armazena os registro na variavel

		$this->db->where('id_situacao', 1);
		
		$result = $this->db->get();

		$return = array();

		//Verifica se a quantidade de registros e maior que 0
		if($result->num_rows > 0){

			//Varivavel $return com o primeiro indice 0 com o valor 'Selecione'
			$return[''] = 'Selecione';

			//Percore os valores 
			foreach($result->result_array() as $row){
				//O indice que será o id receberá o valor
				$return[$row['id']] = $row['nome'];
			}
		}

		//Retorna o array preenchido
		return $return;
	}

	public function getDocenteTodos(){

		//Pega todos os registros
		$this->db->from('tb_docente');
		//Ordena pelo nome
		$this->db->order_by('nome');
		//Armazena os registro na variavel
		$result = $this->db->get();

		$return = array();

		//Verifica se a quantidade de registros e maior que 0
		if($result->num_rows > 0){

			//Varivavel $return com o primeiro indice 0 com o valor 'Selecione'
			$return[''] = 'Todos';

			//Percore os valores 
			foreach($result->result_array() as $row){
				//O indice que será o id receberá o valor
				$return[$row['id']] = $row['nome'];
			}
		}

		//Retorna o array preenchido
		return $return;
	}

	public function getById($id = null){

		if($id != null){
			
			$this->db->where('id', $id);

			$this->db->limit(1);

			return $this->db->get('tb_docente');
		}
	}

	public function alterarSituacao($dados = null){

		if($dados != null){

			$situacao = array(
				'id_situacao' => $dados['id_situacao'],				
			);

			$condition = array(
				'id'  => $dados['id_docente']
			);

			$this->db->update('tb_docente', $situacao, $condition);

			$campos2 = array(
				'id_usuario' 	 => $dados['id_usuario'],
				'id_docente' 	 => $dados['id_docente'],
				'id_situacao'    => $dados['id_situacao'],
				'periodo_inicio' => $dados['periodoInicio'],
				'periodo_fim' 	 => $dados['periodoFim'],
				'observacao' 	 => $dados['observacao'],
				'data_demissao'  => $dados['data_demissao']
			);

			$this->db->insert('tb_situacao_docente', $campos2);

			$this->session->set_flashdata('alteadook','Operação realizada com sucesso.');

			if($dados['idSituacaoRedirect'] == 1){

				redirect('docente/docentesAtivos');
			}

			if($dados['idSituacaoRedirect'] == 2){

				redirect('docente/docentesFerias');
			}

			if($dados['idSituacaoRedirect'] == 3){

				redirect('docente/docentesDemitidos');
			}

			if($dados['idSituacaoRedirect'] == 4){

				redirect('docente/docentesEncostados');
			}
		}

	}



}