<?php

    namespace APP\Controller;

    require_once '../../vendor/autoload.php';

    use APP\Model\Vehicle;
    use APP\Model\DAO\VehicleDAO;
    use APP\Model\Uteis;

    session_start();

    if(empty($_POST) && empty($_GET)) {
        Uteis::redirect(message: 'Requisição inválida!');
    }

    if(empty($_GET['operation'])) {
        Uteis::redirect(message: 'Operação não informada. Por favor, informá-la!');
    }

    switch ($_GET['operation']) {
        case 'sign_up':
            signUpVehicle();
            break;

        case 'list_of_vehicles':
            findAllVehicles();
            break;

        case 'find_vehicle_id':
            findVehicleId();
            break;

        default:
            Uteis::redirect(message: 'Operação informada inválida. Por favor, informar uma operação válida!');
    }

    function signUpVehicle() {
        $id_who_posted = $_POST['id_who_posted_vehicle'];
        $name_who_posted = $_POST['name_who_posted_vehicle'];
        $email_who_posted = $_POST['email_who_posted_vehicle'];

        $name = $_POST['name_vehicle'];
        $price = $_POST['price_vehicle'];
        $mileage = $_POST['mileage_vehicle'];
        $year = $_POST['year_vehicle'];
        $color = $_POST['color_vehicle'];
        $engine_displacement = $_POST['engine_displacement_vehicle'];
        $brand = $_POST['brand_vehicle'];
        $exchange = $_POST['exchange_vehicle'];
        $direction = $_POST['direction_vehicle'];
        $fuel = $_POST['fuel_vehicle'];
        $description = $_POST['description_vehicle'];

        if(!isset($_POST['air_conditioning_vehicle'])) {
            $air_conditioning = false;
        }
        else {
            $air_conditioning = true;
        }

        if(!isset($_POST['hot_air_vehicle'])) {
            $hot_air = false;
        }
        else {
            $hot_air = true;
        }

        if(!isset($_POST['airbag_vehicle'])) {
            $airbag = false;
        }
        else {
            $airbag = true;
        }

        if(!isset($_POST['alarm_vehicle'])) {
            $alarm = false;
        }
        else {
            $alarm = true;
        }

        $vehicle = new Vehicle(
            id_who_posted: $id_who_posted,
            name_who_posted: $name_who_posted,
            email_who_posted: $email_who_posted,
            name: $name,
            price: $price,
            mileage: $mileage,
            year: $year,
            color: $color,
            engine_displacement: $engine_displacement,
            brand: $brand,
            exchange: $exchange,
            direction: $direction,
            fuel: $fuel,
            description: $description,
            airbag: $airbag,
            air_conditioning: $air_conditioning,
            hot_air: $hot_air,
            alarm: $alarm
        );

        $result = VehicleDAO::sign_up($vehicle);

        if($result) {
            $id_vehicle = VehicleDAO::findIdVehicle($vehicle);
            var_dump($id_vehicle);

            mkdir('../View/img_vehicle/' . $id_who_posted . '_' . $name, 0777, true);

            $count_files = count($_FILES['images_vehicle']['name']);

            for($i = 0; $i < $count_files; $i++){
                $_FILES['images_vehicle']['name'][$i] = explode('.', $_FILES['images_vehicle']['name'][$i])[0] . '.png';

                $filename = $_FILES['images_vehicle']['name'][$i];
                $dir_image_vehicle = '../View/img_vehicle/' . $id_who_posted . '_' . $name . '/' . $filename;

                move_uploaded_file($_FILES['images_vehicle']['tmp_name'][$i], $dir_image_vehicle);
            }

            Uteis::redirect(message: 'Veículo cadastrado com sucesso!', session_name: 'msg_confirm', url:'../../index.php');
        }
        else {
            Uteis::redirect(message: 'Lamento não foi possível cadastrar o veículo!!');
        }
    }

    function findAllVehicles() {
        $vehicles = VehicleDAO::findAllVehicles();

        if($vehicles) {
            Uteis::redirect(message: $vehicles, session_name: "list_of_vehicles", url: "../../index.php");
        }
        else {
            Uteis::redirect(message: "Nenhum livro cadastrado no momento!!");
        }
    }

    function findVehicleId() {
        if(empty($_GET['id_vehicle'])) {
            Uteis::redirect("Código do veículo não informado!!");
        }

        $vehicle = VehicleDAO::findVehicleId($_GET['id_vehicle']);

        if($vehicle) {
            Uteis::redirect(message: $vehicle, session_name: "data_vehicle", url: '../View/vehicle.php');
        }
        else {
            Uteis::redirect("Veículo não localizado!!");
        }
    }
?>