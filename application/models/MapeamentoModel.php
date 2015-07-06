<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MapeamentoModel extends CI_Model{

	public function insertMapeamento($dados = null){

		if($dados != null){
			$this->db->insert('ta_mapeamento', $dados);

			$this->session->set_flashdata('cadastrook','Operação realizada com sucesso.');

			redirect('mapeamento/mapear');
		}
	}


	public function updateMapeamento($dados = null, $condition = null){

		if($dados != null && $condition != null){
			
			$this->db->update('ta_mapeamento', $dados, $condition);

			$this->session->set_flashdata('edicaook', 'Operação realizada com sucesso.');

			redirect(current_url());
		}
	}

	public function desabilitarMapeamento($condition){

		if($condition != null){

			$dados = array('ativo' => 0);

			$this->db->update('ta_mapeamento', $dados, $condition);

			$this->session->set_flashdata('inativadook', 'Operação realizada com sucesso.');

			redirect('mapeamento/listagem');
		}
	}

	public function confereDocente($conditions = null){

		if($conditions != null){

			$result = $this->getMapeamento($conditions)->result();

			return $result;
		}
	}


	public function getMapeamento($conditions = null){

		if($conditions != null){

			$this->db->select_max('domingo');
			$this->db->select_max('segunda');
			$this->db->select_max('terca');
			$this->db->select_max('quarta');
			$this->db->select_max('quinta');
			$this->db->select_max('sexta');
			$this->db->select_max('sabado');

			$where =
			"(id_docente = '{$conditions['idDocente']}'
				AND
					id_curso   = '{$conditions['idCurso']}'
				AND
					id_unidade = '{$conditions['idUnidade']}'
			)
				AND
					(
						(periodoInicio >= '{$conditions['periodoInicio']}' AND periodoFim <= '{$conditions['periodoFim']}') and (horarioInicio >=  '{$conditions['horarioInicio']}' and horarioFim <= '{$conditions['horarioFim']}')
					OR
						(periodoInicio >= '{$conditions['periodoInicio']}' AND periodoFim <= '{$conditions['periodoFim']}') and (horarioInicio <=  '{$conditions['horarioInicio']}' and horarioFim >= '{$conditions['horarioFim']}')
					)
			";

			$this->db->where($where);
			$this->db->group_by('id_docente');

			return $this->db->get('ta_mapeamento');
		
		}
	}

	public function getMapeamentoAll($dados = null){

			//Seleciona os campo necessarios
			$this->db->select(
				'
				 ta_mapeamento.id, ta_mapeamento.periodoInicio, ta_mapeamento.periodoFim,
				 ta_mapeamento.horarioInicio, ta_mapeamento.horarioFim, ta_mapeamento.domingo,
				 ta_mapeamento.segunda, ta_mapeamento.terca, ta_mapeamento.quarta, ta_mapeamento.quinta,
				 ta_mapeamento.sexta, ta_mapeamento.sabado, tb_docente.nome, tb_curso.curso, tb_unidade.unidade
				'
			);

			//Tabela a ser selecionada
			$this->db->from('ta_mapeamento');

			//Condição a ser atendida
			$this->db->where('ta_mapeamento.ativo', 1);

			$this->db->order_by('id');

			//E feito uma união entre as tabelas tb_banner e tb_banner_data
			$this->db->join('tb_docente', 'tb_docente.id = ta_mapeamento.id_docente', 'inner');
			$this->db->join('tb_curso', 'tb_curso.id = ta_mapeamento.id_curso', 'inner');
			$this->db->join('tb_unidade', 'tb_unidade.id = ta_mapeamento.id_unidade', 'inner');

			//Retorna o resultado
			return $this->db->get();
	}

	public function getCursoDocenteEixo($id = null){

		if($id != null){

			//Seleciona os campo necessarios
			$this->db->select('tb_curso.curso as cursos, tb_curso.id as idCurso');

			//Tabela a ser selecionada
			$this->db->from('tb_docente');

			//Condição a ser atendida
			$this->db->where('tb_docente.id', $id);
			$this->db->where('tb_curso.ativo', 1);

			//E feito uma união entre as tabelas tb_banner e tb_banner_data
			$this->db->join('tb_eixo', 'tb_eixo.id = tb_docente.id_eixo', 'inner');
			$this->db->join('tb_curso', 'tb_curso.id_eixo = tb_eixo.id', 'inner');

			$result = $this->db->get();

			$return = array();

			//Verifica se a quantidade de registros e maior que 0
			if($result->num_rows > 0){

				//Varivavel $return com o primeiro indice 0 com o valor 'Selecione'
				$return[''] = 'Selecione';

				//Percore os valores 
				foreach($result->result_array() as $row){
					//O indice que será o id receberá o valor
					$return[$row['idCurso']] = $row['cursos'];
				}
			}

			//Retorna o array preenchido
			return $return;
		}
	}

	public function getById($id = null){

		if($id != null){
			
			$this->db->where('id', $id);

			$this->db->limit(1);

			return $this->db->get('ta_mapeamento');
		}
	}

    public function getYear()
    {
       return $this->db->query('SELECT DISTINCT DATE_FORMAT(min(periodoInicio), "%Y") as ano_ini,
                        DATE_FORMAT(max(periodoFim), "%Y") as ano_fim  FROM ta_mapeamento
                        group by periodoFim, horarioInicio');
        
    }
	
}