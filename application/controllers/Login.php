<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller{

	public function __construct(){
		parent::__construct();
		$this->load->model('LoginModel');
	}

	//Medoto inicial do sistema
	public function index(){

		//Array que enviará o titulo para a pagina
		$dados = array(
			'titulo' => 'Login'
		);

		//Solicita a tela de login e envia o array para a view
		$this->load->view('login/login', $dados);
	}

	//Método responsavel por pegar as informações vinda da tela de login
	public function logar(){

		//Setando as regras de validação de cada input a ser preenchida.
		$this->form_validation->set_rules('login','Login', 'trim|required|max_length[20]');
		$this->form_validation->set_rules('senha', 'Senha', 'trim|required|strtolower');

		//Verifica se os campo foi preenchido corretamente e retorna true para a validação
		if($this->form_validation->run()){

			//Pega os valores que esta no post e transforma em array
			$dados = elements(array('login', 'senha'), $this->input->post());

			//Verifica se os dados estão validos enviando os valores para a model
			if($this->LoginModel->doValidate($dados)){

				//Retorna todas as informações do usuario
				$dados = $this->LoginModel->getUsuario($dados);
				
                                if($dados[0]['primeiro_acesso'] == 0){
                                    //Dados de sessão do usuario
                                    $session = array(
                                            'id' 		   => $dados[0]['id'],
                                            'id_perfil'    => $dados[0]['id_perfil'],
                                            'nome' 		   => $dados[0]['nome'],
                                            'login' 	   => $dados[0]['login'],
                                            'is_logged_in' => true
                                    );

                                    //Enviar os dados para a view
                                    $this->session->set_userdata($session);

                                    //Redireciona para a pagina principal
                                    redirect('Indexx');
                                }
                                else{
                                    $session = array(
                                            'id'            => $dados[0]['id'],
                                            'id_perfil'     => $dados[0]['id_perfil'],
                                            'nome'          => $dados[0]['nome'],
                                            'login'         => $dados[0]['login'],
                                            'is_logged_in'  => false
                                    );

                                    //Enviar os dados para a view
                                    $this->session->set_userdata($session);
                                    redirect('Login/changePassword');
                                }

                    }else{
                            //Redireciona para a tela de login				
                            $this->session->set_flashdata('loginInvalido', 'Usuário ou Senha invalidos.');
                            redirect('Login');
                    }
		}else{
			//Redireciona para a tela de login			
			$this->session->set_flashdata('loginVazio', 'Campo(s) obrigatório(s) não preenchido(s).');
			redirect('Login');
		}
	}
        
    public function changePassword(){
            
        $this->form_validation->set_rules('idusuario','idusuario','trim|required|integer');
        $this->form_validation->set_rules('senha','Senha','trim|required|strtolower');
        $this->form_validation->set_rules('confirmiSenha','Repita a Senha','trim|required|strtolower|matches[senha]');
        
        if($this->form_validation->run()){
            $postRecebido = elements(array('senha'), $this->input->post());
            //criptografa senha sha1
            $postRecebido['senha'] = sha1($postRecebido['senha']);
            
            //Retorna todas as informações do usuario, passando o id recebido no post como parametro
            $getUser = $this->LoginModel->getUserById($this->input->post('idusuario'));
//            var_dump($getUser);
//                            exit();
                       
            if($getUser[0]['primeiro_acesso'] == 0){
                $this->LoginModel->updatePassword($postRecebido, array('id' => $this->input->post('idusuario')));
            }
            //caso o primeiro acesso seja verdadeiro
            else{
               //muda para acesso normal
              $postRecebido['primeiro_acesso'] = 0;
//              var_dump($postRecebido);
//                            exit();
                             //Cria um array com o dados da sessao
                $session = array(
                        'id'                    => $getUser[0]['id'],
                        'id_perfil'             => $getUser[0]['id_perfil'],
                        'nome'                  => $getUser[0]['nome'],
                        'login'                 => $getUser[0]['login'],
                        'is_logged_in'          => true
                );
                //Inicializa a sessao
                $this->session->set_userdata($session);
                $this->LoginModel->updatePassword($postRecebido, array('id' => $this->input->post('idusuario')));
            }
            
        }
            
            //Array que enviará o titulo para a pagina
		$dados = array(
			'titulo' => 'Mudar Senha'
		);

		//Solicita a tela de login e envia o array para a view
		$this->load->view('login/mudar_senha', $dados);
    }

	//Método responsavel por fazer o logout do sistema
	public function logout(){

		//Verifica se a sessão existi 
		if($this->session->userdata('is_logged_in')){
                    //Destroy a session do usuario
                    $session = array(
                        'id' 		   => '',
                        'id_perfil'	   => '', 
                        'nome' 		   => '',
                        'login' 	   => '',
                        'is_logged_in' => false
                    );

                    $this->session->unset_userdata($session);
                    $this->session->sess_destroy();
                    //Redireciona para a url padrão "raiz"
                    redirect(base_url());
		}
	}
}
