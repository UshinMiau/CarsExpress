<?php

    namespace APP\Model;

    class Vehicle {
        private int $id_vehicle;
        private int $id_who_posted;
        private string $name_who_posted;
        private string $email_who_posted;
        private string $name;
        private float $price;
        private float $mileage;
        private int $year;
        private string $color;
        private float $engine_displacement;
        private string $brand;
        private string $exchange;
        private string $direction;
        private string $fuel;
        private string $description;
        private bool $airbag;
        private bool $air_conditioning;
        private bool $hot_air;
        private bool $alarm;
        
        public function __construct(int $id_who_posted, string $name_who_posted, string $email_who_posted, string $name, float $price, float $mileage, int $year, string $color, float $engine_displacement, string $brand, string $exchange, string $direction, string $fuel, string $description, bool $airbag, bool $air_conditioning, bool $hot_air, bool $alarm, int $id_vehicle = 0) {
            $this->id_who_posted = $id_who_posted;
            $this->name_who_posted = $name_who_posted;
            $this->email_who_posted = $email_who_posted;
            $this->name = $name;
            $this->price = $price;
            $this->mileage = $mileage;
            $this->year = $year;
            $this->color = $color;
            $this->engine_displacement = $engine_displacement;
            $this->brand = $brand;
            $this->exchange = $exchange;
            $this->direction = $direction;
            $this->fuel = $fuel;
            $this->description = $description;
            $this->airbag = $airbag;
            $this->air_conditioning = $air_conditioning;
            $this->hot_air = $hot_air;
            $this->alarm = $alarm;
            $this->id_vehicle = $id_vehicle;
        }
        
        public function __get($attribute) {
            return $this->$attribute;
        }
    }

?>