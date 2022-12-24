<?php

    namespace APP\Controller;

    require_once '../../vendor/autoload.php';

    use APP\Model\DAO\ClientDAO;
    use APP\Model\Uteis;

    session_start();

    if(empty($_POST) && empty($_GET)) {
        Uteis::redirect(message: 'Requisição inválida!');
    }

    if(empty($_GET['operation'])) {
        Uteis::redirect(message: 'Operação não informada. Por favor, informá-la!');
    }

    switch ($_GET['operation']) {
        case 'sign_in':
            signIn();
            break;
        
        case 'sign_out':
            signOut();
            break;
        
        default:
            Uteis::redirect(message: 'Operação não informada. Por favor, informá-la!');
    }

    function signIn() {
        $email = $_POST['email_sign-in'];
        $password = $_POST['password_sign-in'];

        $result = ClientDAO::findClient($email);
            
        if(!$result) {
            Uteis::redirect(message: 'Cadastro inexistente!');
        }
        else {
            if(matchPassword($password, $result['password'])) {
                $data_login_array = [
                    "name" => $result['name'], 
                    "birth_date" => explode('-', $result['birth_date'])[2] . "/" . explode('-', $result['birth_date'])[1] . "/" . explode('-', $result['birth_date'])[0], 
                    "email" => $result['email'], 
                    "id" => $result['id']
                ];

                Uteis::redirect(message: serialize($data_login_array), session_name: 'data_login', url: '../../index.php');
            }
            else {
                Uteis::redirect(message: ['Senha incorreta!'], session_name: 'msg_error_validation');
            }
        }
    }

    function signOut() {
        session_destroy();
        header('location: ../../index.php');
    }

    function matchPassword($password, $result) {
        return password_verify($password, $result);
    }
?>