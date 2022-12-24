<?php

    namespace APP\Model;

    use PDO;
    use PDOException;

    class Connection {
        private static PDO $connection;
        
        public static function getConnection() {
            if(empty(self::$connection)) {
                try {
                    self::$connection = new PDO(DNS, USER, PASSWORD);
                }
                catch(PDOException) {
                    Uteis::redirect(message: "Erro ao estabelecer conexão com banco de dados.", session_name: "msg_error");
                    die;
                }
            }

            return self::$connection;
        }
    }

?>