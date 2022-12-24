<?php

    namespace APP\Model\DAO;

    use APP\Model\Connection;
    use APP\Model\Client;
    use PDO;

    class ClientDAO {
        private static PDO $connection;

        public static function sign_up(Client $client) {
            self::$connection = Connection::getConnection();

            $statement = self::$connection->prepare("insert into client values(null, ?, ?, ?, ?)");
            
            $statement->bindParam(1, $client->name, PDO::PARAM_STR);
            $statement->bindParam(2, $client->birth_date, PDO::PARAM_STR);
            $statement->bindParam(3, $client->email, PDO::PARAM_STR);
            $statement->bindParam(4, $client->password, PDO::PARAM_STR);

            return $statement->execute();
        }

        public static function findClient(string $email) {
            self::$connection = Connection::getConnection();
            
            $statement = self::$connection->query("select * from client where email = '$email'");

            return $statement->fetch(PDO::FETCH_ASSOC);
        }

    }

?>