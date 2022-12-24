<?php

    namespace APP\Model;

    class Uteis {
        public static function redirect($message, $session_name = 'msg_error', $url = '../View/message.php') {
            $_SESSION[$session_name] = $message;
            header("location: $url");
            die;
        }
    }

?>