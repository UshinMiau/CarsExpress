<?php

    namespace APP\Model;

    class Client {
        private int $id_client;
        private string $name;
        private string $birth_date;
        private string $email;
        private string $password;
        
        public function __construct(string $name, string $birth_date, string $email, string $password, int $id_client = 0) {
            $this->name = $name;
            $this->birth_date = $birth_date;
            $this->email = $email;
            $this->password = $password;
            $this->id_client = $id_client;
        }
        
        public function __get($attribute) {
            return $this->$attribute;
        }
    }

?>