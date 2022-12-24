<?php
    namespace APP\Model\DAO;

    use APP\Model\Connection;
    use APP\Model\Vehicle;
    use PDO;

    class VehicleDAO {
        private static PDO $connection;

        public static function sign_up(Vehicle $vehicle) {
            self::$connection = Connection::getConnection();

            $statement  = self::$connection->prepare("insert into vehicle values(null, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

            $statement->bindParam(1, $vehicle->id_who_posted, PDO::PARAM_INT);
            $statement->bindParam(2, $vehicle->name_who_posted, PDO::PARAM_STR);
            $statement->bindParam(3, $vehicle->email_who_posted, PDO::PARAM_STR);
            $statement->bindParam(4, $vehicle->name, PDO::PARAM_STR);
            $statement->bindParam(5, $vehicle->price, PDO::PARAM_STR);
            $statement->bindParam(6, $vehicle->mileage, PDO::PARAM_STR);
            $statement->bindParam(7, $vehicle->year, PDO::PARAM_INT);
            $statement->bindParam(8, $vehicle->color, PDO::PARAM_STR);
            $statement->bindParam(9, $vehicle->engine_displacement, PDO::PARAM_STR);
            $statement->bindParam(10, $vehicle->brand, PDO::PARAM_STR);
            $statement->bindParam(11, $vehicle->exchange, PDO::PARAM_STR);
            $statement->bindParam(12, $vehicle->direction, PDO::PARAM_STR);
            $statement->bindParam(13, $vehicle->fuel, PDO::PARAM_STR);
            $statement->bindParam(14, $vehicle->description, PDO::PARAM_STR);
            $statement->bindParam(15, $vehicle->airbag, PDO::PARAM_BOOL);
            $statement->bindParam(16, $vehicle->air_conditioning, PDO::PARAM_BOOL);
            $statement->bindParam(17, $vehicle->hot_air, PDO::PARAM_BOOL);
            $statement->bindParam(18, $vehicle->alarm, PDO::PARAM_BOOL);

            return $statement->execute();
        }

        public static function findVehicleId(int $id_vehicle) {
            self::$connection = Connection::getConnection();

            $statement = self::$connection->query("select * from vehicle where id = $id_vehicle");

            return $statement->fetch(PDO::FETCH_ASSOC);
        }

        public static function findAllVehicles(): array {
            self::$connection = Connection::getConnection();

            $statement = self::$connection->query("select * from vehicle");

            return $statement->fetchAll(PDO::FETCH_ASSOC);
        }

        public static function findIdVehicle(Vehicle $vehicle) {
            self::$connection = Connection::getConnection();

            $sql = "select * from vehicle where id_who_posted = $vehicle->id_who_posted and name_who_posted = '$vehicle->name_who_posted' and email_who_posted = '$vehicle->email_who_posted' and name = '$vehicle->name'";

            $statement = self::$connection->query($sql);

            return $statement->fetch(PDO::FETCH_ASSOC);
        }
    }
?>