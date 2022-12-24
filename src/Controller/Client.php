<?php

    namespace APP\Controller;

    require_once '../../vendor/autoload.php';

    use APP\Model\Client;
    use APP\Model\DAO\ClientDAO;
    use APP\Model\Uteis;
    use APP\Model\Validation;
    
    session_start();

    if(empty($_POST) && empty($_GET)) {
        Uteis::redirect(message: 'Requisição inválida!');
    }

    if(empty($_GET['operation'])) {
        Uteis::redirect(message: 'Operação não informada. Por favor, informá-la!');
    }

    switch ($_GET['operation']) {
        case 'sign_up':
            signUpClient();
            break;
        default:
            Uteis::redirect(message: 'Operação informada inválida. Por favor, informar uma operação válida!');
    }

    function signUpClient() {
        $name = $_POST['name_sign-up'];
        $birth_date = $_POST['birth-date_sign-up'];
        $email = $_POST['email_sign-up'];
        $password = $_POST['password_sign-up'];

        $_FILES['profile-picture_sign-up']['name'] = $name . '.png';
        $profile_picture = $_FILES['profile-picture_sign-up'];

        $check = ClientDAO::findClient($email);

        if($check) {
            Uteis::redirect(message: ['Já existe um cadastro com esse e-mail!!'], session_name: 'msg_error_validation');
        }
    
        $error = array();

        if(!Validation::validateImage($profile_picture)) {
            array_push($error, "Arquivo inválido! Envie um arquivo em formato de imagem!");
        }

        if (!Validation::validateName($name)) {
            array_push($error, "Nome inválido!");
        }

        if (!Validation::validateDate($birth_date)) {
            array_push($error, "Data de nascimento inválida!");
        }
    
        if (!Validation::validateEmail($email)) {
            array_push($error, "E-mail inválido!");
        }
    
        if (!Validation::validatePassword($password)) {
            array_push($error, "Senha inválida!");
        }
        
        if($error) {
            Uteis::redirect(message: $error, session_name: 'msg_error_validation');
        }

        $password = password_hash($password, PASSWORD_DEFAULT);

        $client = new Client(
            name: $name,
            birth_date: $birth_date,
            email: $email,
            password: $password
        );

        $result = ClientDAO::sign_up($client);

        if($result) {
            $login = ClientDAO::findClient($email);

            if($login) {
                $data_login_array = [
                    "name" => $login['name'], 
                    "birth_date" => explode('-', $result['birth_date'])[2] . "/" . explode('-', $result['birth_date'])[1] . "/" . explode('-', $result['birth_date'])[0], 
                    "email" => $login['email'], 
                    "id" => $login['id']
                ];
            }

            $_FILES['profile-picture_sign-up']['name'] = $data_login_array['id'] . '.png';
            $dir_profile_picture = '../View/img_profile_picture/' . $_FILES['profile-picture_sign-up']['name'];
            move_uploaded_file($profile_picture['tmp_name'], $dir_profile_picture);

            Uteis::redirect(message: serialize($data_login_array), session_name: 'data_login', url: '../../index.php');
        }
        else {
            Uteis::redirect(message: 'Lamento não foi possível cadastrar a conta!!');
        }

    }

?>