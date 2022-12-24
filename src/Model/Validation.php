<?php

    namespace APP\Model;

    class Validation {

        public static function validateName($name) {
            return strlen($name) >= 2 && ctype_alpha(str_replace(' ', '', $name));
        }

        public static function validateEmail($email): bool {
            return filter_var($email, FILTER_VALIDATE_EMAIL);
        }

        public static function validatePassword($password) {
            return preg_match("/^(?=.*\d)(?=.*[#$@!%&*?\.\/])[A-Za-z\d#$@!%&*?\.\/]{8,}$/", $password);
        }

        public static function validateDate($date) {
            $date = explode("-", $date);
        
            return checkdate($date[1], $date[2], $date[0]);
        }

        public static function validateDescription($description) {
            return strlen($description) < 65535;
        }

        public static function validateImage($image) {
            if(explode('/', (($image['type'])[0] === "image"))) {
                return true;
            }
            else {
                return false;
            }
        }

    }

?>