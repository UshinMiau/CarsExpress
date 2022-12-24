<?php

    session_start();

    if(empty($_SESSION['list_of_vehicles'])) {
        header('location: src/Controller/Vehicle.php?operation=list_of_vehicles');
    }

    if(!empty($_SESSION['data_login'])) {
        $login = true;
        $data_login = unserialize($_SESSION['data_login']);
    }
    else {
        $login = false;
    }

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <title>Cars Express</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <meta name="description" content="Site para comprar e vender veículos online">
    <meta name="keywords" content="veículos, usados, comprar, vender">
    <meta name="author" content="Oliver Azazel Castro dos Santos">
    <link rel="icon" type="imagem/png" href="src/View/img/logo.png">
    <!-- font awesome -->
    <link rel="stylesheet" href="src/View/css/all.min.css">
    <link rel="stylesheet" href="src/View/css/fontawesome.min.css">
    <!-- fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com"><link rel="preconnect" href="https://fonts.gstatic.com" crossorigin><link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <!-- JQuery -->
    <script src="src/View/js/jQuery.js"></script>
    <!-- my scripts -->
    <script src="src/View/js/functions_main.js"></script>
    <script src="src/View/js/functions_index.js"></script>
    <!-- my styles -->
    <link rel="stylesheet" href="src/View/css/reset.css">
    <link rel="stylesheet" href="src/View/css/style_main.css">
    <link rel="stylesheet" href="src/View/css/style_index.css">
</head>
<body>
    <div class="overlay">
        <?php
            if($login):
        ?>
            <section class="profile-data element-shadow">
                <i class="fas fa-times shadow-title close-modal-window-button"></i>

                <h1 class="shadow-title">Meu Perfil</h1>

                <img src="src/View/img_profile_picture/<?= $data_login['id'] ?>.png" alt="foto de perfil">

                <article class="profile-data__data-list">
                    <ul>
                        <li><b>Nome Completo:</b> <?= $data_login['name'] ?></li>
                        <li><b>Data de Nascimento:</b> <?= $data_login['birth_date'] ?></li>
                        <li><b>E-Mail:</b> <?= $data_login['email'] ?></li>
                    </ul>
                </article>

                <a href="#" id="profile-data__add-vehicle">
                    <button class="profile-data__add-vehicle button-main">Adicionar Veículo</button>
                </a>
            </section>

            <section class="add-vehicle element-shadow">
                <i class="fas fa-times shadow-title close-modal-window-button"></i>

                <h1 class="shadow-title">Cadastrar veículo</h1>

                <form action="src/Controller/Vehicle.php?operation=sign_up" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="id_who_posted_vehicle" id="id_who_posted_vehicle"  value="<?= $data_login['id'] ?>" required>
                    
                    <input type="hidden" name="name_who_posted_vehicle" id="name_who_posted_vehicle"  value="<?= $data_login['name'] ?>" required>
                    
                    <input type="hidden" name="email_who_posted_vehicle" id="email_who_posted_vehicle"  value="<?= $data_login['email'] ?>" required>

                    <div class="form-input-wrap">
                        <label for="name_vehicle">Nome do veículo</label>
                        <input type="text" name="name_vehicle" id="name_vehicle" required>
                    </div>

                    <div class="form-input-wrap">
                        <label for="images_vehicle">Imagens do veículo</label>
                        <input type="file" accept="image/*" name="images_vehicle[]" id="images_vehicle" required multiple="multiple">
                    </div>

                    <div class="form-input-wrap">
                        <label for="price_vehicle">Preço</label>
                        <input type="tel" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" name="price_vehicle" id="price_vehicle" required>
                    </div>

                    <div class="form-input-wrap">
                        <label for="mileage_vehicle">Quilometragem</label>
                        <input type="tel" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" name="mileage_vehicle" id="mileage_vehicle" required>
                    </div>

                    <div class="form-input-wrap">
                        <label for="year_vehicle">Ano</label>
                        <input type="number" name="year_vehicle" id="year_vehicle" min="1900" max="2099" required>
                    </div>

                    <div class="form-input-wrap">
                        <label for="color_vehicle">Cor</label>
                        <select name="color_vehicle" id="color_vehicle" required>
                            <option selected hidden disabled>Selecione</option>
                            <option value="vermelho">Vermelho</option>
                            <option value="azul">Azul</option>
                            <option value="branco">Branco</option>
                            <option value="cinza">Cinza</option>
                            <option value="preto">Preto</option>
                        </select>
                    </div>

                    <div class="form-input-wrap">
                        <label for="engine_displacement_vehicle">Cilindrada do motor</label>
                        <select name="engine_displacement_vehicle" id="engine_displacement_vehicle" required>
                            <option selected hidden disabled>Selecione</option>
                            <option value="1.0">1.0</option>
                            <option value="1.4">1.4</option>
                            <option value="1.6">1.6</option>
                            <option value="1.8">1.8</option>
                            <option value="2.0">2.0</option>
                        </select>
                    </div>

                    <div class="form-input-wrap">
                        <label for="brand_vehicle">Marca</label>
                        <select name="brand_vehicle" id="brand_vehicle" required>
                            <option selected hidden disabled>Selecione</option>
                            <option value="fiat">Fiat</option>
                            <option value="ford">Ford</option>
                            <option value="chevrolet">Chevrolet</option>
                            <option value="honda">Honda</option>
                            <option value="renault">Renault</option>
                            <option value="toyota">Toyota</option>
                        </select>
                    </div>

                    <div class="form-input-wrap">
                        <label for="exchange_vehicle">Câmbio</label>
                        <select name="exchange_vehicle" id="exchange_vehicle" required>
                            <option selected hidden disabled>Selecione</option>
                            <option value="automático">Automático</option>
                            <option value="automático sequencial">Automático Sequencial</option>
                            <option value="automatizado">Automatizado</option>
                            <option value="automatizado DCT">Automatizado DCT</option>
                            <option value="CVT">CVT</option>
                            <option value="manual">Manual</option>
                            <option value="semi automático">Semi Automático</option>
                        </select>
                    </div>

                    <div class="form-input-wrap">
                        <label for="direction_vehicle">Direção</label>
                        <select name="direction_vehicle" id="direction_vehicle" required>
                            <option selected hidden disabled>Selecione</option>
                            <option value="mecânica">Mecânica</option>
                            <option value="hidráulica">Hidráulica</option>
                            <option value="elétrica">Elétrica</option>
                            <option value="eletro hidráulica">Eletro Hidráulica</option>
                        </select>
                    </div>

                    <div class="form-input-wrap">
                        <label for="fuel_vehicle">Combustível</label>
                        <select name="fuel_vehicle" id="fuel_vehicle" required>
                            <option selected hidden disabled>Selecione</option>
                            <option value="álcool">Álcool</option>
                            <option value="álcool e gás natural">Álcool e Gás Natural</option>
                            <option value="gás natural">Gás Natural</option>
                            <option value="diesel">Diesel</option>
                            <option value="gasolina">Gasolina</option>
                            <option value="gasolina e álcool">Gasolina e Álcool</option>
                        </select>
                    </div>

                    <div class="form-input-wrap">
                        <label>Opcionais</label>
                        
                        <div>
                            <input type="checkbox" name="air_conditioning_vehicle" id="air_conditioning_vehicle" value="true">
                            <span>Ar Condicionado</span>
                        </div>

                        <div>
                            <input type="checkbox" name="hot_air_vehicle" id="hot_air_vehicle" value="true">
                            <span>Ar Quente</span>
                        </div>

                        <div>
                            <input type="checkbox" name="airbag_vehicle" id="airbag_vehicle" value="true">
                            <span>Airbag</span>
                        </div>
                        
                        <div>
                            <input type="checkbox" name="alarm_vehicle" id="alarm_vehicle" value="true">
                            <span>Alarme</span>
                        </div>
                    </div>

                    <div class="form-input-wrap">
                        <label for="description_vehicle">Descrição do veículo</label>
                        <textarea name="description_vehicle" id="description_vehicle" required></textarea>
                    </div>

                    <input class="button-main" type="submit" value="Cadastrar">
                </form>

            </section>
        <?php
            else:
        ?>
            <section class="form-login element-shadow">
                <i class="fas fa-times shadow-title close-modal-window-button"></i>

                <article class="form-login__sign-in">
                    <h1 class="shadow-title">Entrar na sua conta</h1>

                    <form action="src/Controller/Login.php?operation=sign_in" method="POST">
                        <div class="form-input-wrap">
                            <label for="email_sign-in">E-Mail</label>
                            <input type="email" name="email_sign-in" id="email_sign-in" required>
                        </div>
                            
                        <div class="form-input-wrap">
                            <label for="password_sign-in">Senha</label>
                            <input type="password" name="password_sign-in" id="password_sign-in" required>
                        </div>

                        <input class="button-main" type="submit" value="Entrar">
                    </form>

                    <p>Não tem uma conta? <a href="#" id="sign_up">Crie aqui!</a></p>
                </article>

                <article class="form-login__sign-up">
                    <h1 class="shadow-title">Cadastrar sua conta</h1>

                    <form action="src/Controller/Client.php?operation=sign_up" method="POST"  enctype="multipart/form-data">
                        <div class="form-input-wrap">
                            <label for="profile-picture_sign-up">Foto de Perfil</label>
                            <input type="file" accept="image/*" name="profile-picture_sign-up" id="profile-picture_sign-up" required>
                        </div>

                        <div class="form-input-wrap">
                            <label for="name_sign-up">Nome Completo</label>
                            <input type="text" name="name_sign-up" id="name_sign-up" required>
                        </div>

                        <div class="form-input-wrap">
                            <label for="birth-date_sign-up">Data de Nascimento</label>
                            <input type="date" name="birth-date_sign-up" id="birth-date_sign-up" required>
                        </div>

                        <div class="form-input-wrap">
                            <label for="email_sign-up">E-Mail</label>
                            <input type="email" name="email_sign-up" id="email_sign-up" required>
                        </div>

                        <div class="form-input-wrap">
                            <label for="password_sign-up">Senha</label>
                            <input type="password" name="password_sign-up" id="password_sign-up" required>
                        </div>

                        <input class="button-main" type="submit" value="Cadastrar">
                    </form>

                    <p>Já tem uma conta? <a href="#" id="sign_in">Entre aqui!</a></p>
                </article>
            </section>
        <?php
            endif;
        ?>
    </div>

    <header class="menu">
        <div class="container">
            <a href="index.php">
                <article class="menu__logo">

                </article>
            </a>

            <article class="menu__mobile-navigation-icon">
                <i class="fas fa-bars"></i>
            </article>

            <nav>
                <ul>
                    <li><a href="index.php">Veículos</a></li>
                    <?php
                        if($login):
                    ?>
                        <li><a id="profile" href="#"><i class="fas fa-user-circle"></i>Perfil</a></li>
                    <?php
                        else:
                    ?>
                        <li><a id="login" href="#">Entrar</a></li>
                    <?php
                        endif;
                    ?>
                </ul>
            </nav>
        </div>
    </header>

    <nav class="menu-mobile">
        <ul>
            <li><a href="index.php">Veículos</a></li>
            <?php
                if($login):
            ?>
                <li><a id="profile" href="#"><i class="fas fa-user-circle"></i>Perfil</a></li>
            <?php
                else:
            ?>
                <li><a id="login" href="#">Entrar</a></li>
            <?php
                endif;
            ?>
        </ul>
    </nav>

    <main class="vehicle-showcase">
        <div class="container">
            <aside class="vehicle-showcase__filters element-shadow">
                <h1 class="shadow-title"><i class="fas fa-chevron-down"></i> Filtros</h1>

                <form action="src/Controller/ ?operation=filter" METHOD="post">
                    <article class="vehicle-showcase__filter-wrap">
                        <h3>Preço</h3>
                        
                        <div class="vehicle-showcase__input-wrap vehicle-showcase__input-wrap--input-number">
                            <label for="minimum-price">De:</label>                    
                            <input type="number" name="minimum-price" id="minimum-price" min="0">
                        </div>
                        
                        <div class="vehicle-showcase__input-wrap vehicle-showcase__input-wrap--input-number">
                            <label for="maximum-price">Até:</label>
                            <input type="number" name="maximum-price" id="maximum-price" min="0">
                        </div>
                    </article>

                    <article class="vehicle-showcase__filter-wrap">
                        <h3>Ano</h3>
                        
                        <div class="vehicle-showcase__input-wrap vehicle-showcase__input-wrap--input-number">
                            <label for="minimum-year">De:</label>                    
                            <input type="number" name="minimum-year" id="minimum-year" min="0">
                        </div>
                        
                        <div class="vehicle-showcase__input-wrap vehicle-showcase__input-wrap--input-number">
                            <label for="maximum-year">Até:</label>
                            <input type="number" name="maximum-year" id="maximum-year" min="0">
                        </div>
                    </article>

                    <article class="vehicle-showcase__filter-wrap">
                        <h3>Quilometragem</h3>
                        
                        <div class="vehicle-showcase__input-wrap vehicle-showcase__input-wrap--input-number">
                            <label for="minimum-mileage">De:</label>                    
                            <input type="number" name="minimum-mileage" id="minimum-mileage" min="0">
                        </div>
                        
                        <div class="vehicle-showcase__input-wrap vehicle-showcase__input-wrap--input-number">
                            <label for="maximum-mileage">Até:</label>
                            <input type="number" name="maximum-mileage" id="maximum-mileage" min="0">
                        </div>
                    </article>

                    <article class="vehicle-showcase__filter-wrap">
                        <h3>Cores</h3>

                        <div class="vehicle-showcase__input-wrap">
                            <input type="checkbox" name="colors" id="black" value="black">
                            <label for="black">Preto</label>
                        </div>
                        
                        <div class="vehicle-showcase__input-wrap">
                            <input type="checkbox" name="colors" id="red" value="red">
                            <label for="red">Vermelho</label>                    
                        </div>
                        
                        <div class="vehicle-showcase__input-wrap">
                            <input type="checkbox" name="colors" id="grey" value="grey">
                            <label for="grey">Cinza</label>                    
                        </div>
                        
                        <div class="vehicle-showcase__input-wrap">
                            <input type="checkbox" name="colors" id="blue" value="blue">
                            <label for="blue">Azul</label>                    
                        </div>
                        
                        <div class="vehicle-showcase__input-wrap">
                            <input type="checkbox" name="colors" id="white" value="white">
                            <label for="white">Branco</label>                    
                        </div>
                    </article>
                    
                    <article class="vehicle-showcase__filter-wrap">
                        <h3>Cilindrada do motor</h3>

                        <div class="vehicle-showcase__input-wrap">
                            <input type="checkbox" name="engine_displacement" id="1.0" value="1.0">
                            <label for="1.0">1.0</label>
                        </div>
                        
                        <div class="vehicle-showcase__input-wrap">
                            <input type="checkbox" name="engine_displacement" id="1.4" value="1.4">
                            <label for="1.4">1.4</label>
                        </div>
                        
                        <div class="vehicle-showcase__input-wrap">
                            <input type="checkbox" name="engine_displacement" id="1.6" value="1.6">
                            <label for="1.6">1.6</label>
                        </div>
                        
                        <div class="vehicle-showcase__input-wrap">
                            <input type="checkbox" name="engine_displacement" id="1.8" value="1.8">
                            <label for="1.8">1.8</label>
                        </div>
                        
                        <div class="vehicle-showcase__input-wrap">
                            <input type="checkbox" name="engine_displacement" id="2.0" value="2.0">
                            <label for="2.0">2.0</label>
                        </div>
                    </article>

                    <article class="vehicle-showcase__filter-wrap">
                        <h3>Marcas</h3>

                        <div class="vehicle-showcase__input-wrap">
                            <input type="checkbox" name="brands" id="chevrolet" value="chevrolet">
                            <label for="chevrolet">Chevrolet</label>                    
                        </div>

                        <div class="vehicle-showcase__input-wrap">
                            <input type="checkbox" name="brands" id="fiat" value="fiat">
                            <label for="fiat">Fiat</label>                    
                        </div>

                        <div class="vehicle-showcase__input-wrap">
                            <input type="checkbox" name="brands" id="ford" value="ford">
                            <label for="ford">Ford</label>                    
                        </div>

                        <div class="vehicle-showcase__input-wrap">
                            <input type="checkbox" name="brands" id="honda" value="honda">
                            <label for="honda">Honda</label>                    
                        </div>

                        <div class="vehicle-showcase__input-wrap">
                            <input type="checkbox" name="brands" id="renault" value="renault">
                            <label for="renault">Renault</label>                    
                        </div>

                        <div class="vehicle-showcase__input-wrap">
                            <input type="checkbox" name="brands" id="toyota" value="toyota">
                            <label for="toyota">Toyota</label>                    
                        </div>
                    </article>

                    <article class="vehicle-showcase__filter-wrap">
                        <h3>Câmbio</h3>

                        <div class="vehicle-showcase__input-wrap">
                            <input type="checkbox" name="exchange" id="automatic" value="automatic">
                            <label for="automatic">Automático</label>                    
                        </div>

                        <div class="vehicle-showcase__input-wrap">
                            <input type="checkbox" name="exchange" id="automatic_sequential" value="automatic_sequential">
                            <label for="automatic_sequential">Automático Sequencial</label>                    
                        </div>

                        <div class="vehicle-showcase__input-wrap">
                            <input type="checkbox" name="exchange" id="automated" value="automated">
                            <label for="automated">Automatizado</label>                    
                        </div>

                        <div class="vehicle-showcase__input-wrap">
                            <input type="checkbox" name="exchange" id="automated_DCT" value="automated_DCT">
                            <label for="automated_DCT">Automatizado DCT</label>                    
                        </div>

                        <div class="vehicle-showcase__input-wrap">
                            <input type="checkbox" name="exchange" id="CVT" value="CVT">
                            <label for="CVT">CVT</label>                    
                        </div>

                        <div class="vehicle-showcase__input-wrap">
                            <input type="checkbox" name="exchange" id="manual" value="manual">
                            <label for="manual">Manual</label>                    
                        </div>

                        <div class="vehicle-showcase__input-wrap">
                            <input type="checkbox" name="exchange" id="semi_automatic" value="semi_automatic">
                            <label for="semi_automatic">Semi Automático</label>                    
                        </div>
                    </article>

                    <article class="vehicle-showcase__filter-wrap">
                        <h3>Direção</h3>

                        <div class="vehicle-showcase__input-wrap">
                            <input type="checkbox" name="direction" id="mechanics" value="mechanics">
                            <label for="mechanics">Mecânica</label>                    
                        </div>
                        
                        <div class="vehicle-showcase__input-wrap">
                            <input type="checkbox" name="direction" id="hydraulics" value="hydraulics">
                            <label for="hydraulics">Hidráulica</label>                    
                        </div>
                        
                        <div class="vehicle-showcase__input-wrap">
                            <input type="checkbox" name="direction" id="electric" value="electric">
                            <label for="electric">Elétrica</label>                    
                        </div>
                        
                        <div class="vehicle-showcase__input-wrap">
                            <input type="checkbox" name="direction" id="electro_hydraulics" value="electro_hydraulics">
                            <label for="electro_hydraulics">Eletro Hidráulica</label>                    
                        </div>
                    </article>

                    <article class="vehicle-showcase__filter-wrap">
                        <h3>Combustível</h3>

                        <div class="vehicle-showcase__input-wrap">
                            <input type="checkbox" name="fuel" id="alcohol" value="alcohol">
                            <label for="alcohol">Álcool</label>                    
                        </div>

                        <div class="vehicle-showcase__input-wrap">
                            <input type="checkbox" name="fuel" id="alcohol_and_natural_gas" value="alcohol_and_natural_gas">
                            <label for="alcohol_and_natural_gas">Álcool e Gás Natural</label>                    
                        </div>

                        <div class="vehicle-showcase__input-wrap">
                            <input type="checkbox" name="fuel" id="natural_gas" value="natural_gas">
                            <label for="natural_gas">Gás Natural</label>                     
                        </div>

                        <div class="vehicle-showcase__input-wrap">
                            <input type="checkbox" name="fuel" id="diesel" value="diesel">
                            <label for="diesel">Diesel</label>                    
                        </div>

                        <div class="vehicle-showcase__input-wrap">
                            <input type="checkbox" name="fuel" id="gasoline" value="gasoline">
                            <label for="gasoline">Gasolina</label>                    
                        </div>

                        <div class="vehicle-showcase__input-wrap">
                            <input type="checkbox" name="fuel" id="gasoline_and_alcohol" value="gasoline_and_alcohol">
                            <label for="gasoline_and_alcohol">Gasolina e Álcool</label>                    
                        </div>
                    </article>

                    <article class="vehicle-showcase__filter-wrap">
                        <h3>Opcionais</h3>
                        
                        <div class="vehicle-showcase__input-wrap">
                            <input type="checkbox" name="optional" id="air_conditioning" value="air_conditioning">
                            <label for="air_conditioning">Ar Condicionado</label>                    
                        </div>
                        
                        <div class="vehicle-showcase__input-wrap">
                            <input type="checkbox" name="optional" id="hot_air" value="hot_air">
                            <label for="hot_air">Ar Quente</label>                    
                        </div>
                        
                        <div class="vehicle-showcase__input-wrap">
                            <input type="checkbox" name="optional" id="airbag" value="airbag">
                            <label for="airbag">Airbag</label>                    
                        </div>
                        
                        <div class="vehicle-showcase__input-wrap">
                            <input type="checkbox" name="optional" id="alarm" value="alarm">
                            <label for="alarm">Alarme</label>                    
                        </div>
                    </article>
                    
                </form>
            </aside>

            <section class="vehicle-showcase__vehicles">
<!--
                <?php
                    //foreach ($_SESSION['list_of_vehicles'] as $vehicle):
                        // $dir_images_vehicle = 'src/View/img_vehicle/' . $vehicle['id_who_posted'] . '_' . $vehicle['name'] . '/';
                        
                        // $images_vehicle = scandir($dir_images_vehicle);

                        // $images_vehicle = array_diff($images_vehicle, array('.', '..'));

                        // $images_vehicle = array_values($images_vehicle);

                        // $dir_vehicle_cover_image = $dir_images_vehicle . $images_vehicle[0];
                ?>
                    <div class="vehicle-showcase__container-vehicle-single">
                        <article class="vehicle-showcase__vehicle-single element-shadow">
                            <header>
                                <div style="background-image: url(<?//= $dir_vehicle_cover_image ?>)"></div>
                            </header>
                            
                            <main>
                                <h3><?//= $vehicle['name'] ?></h3>
                                <ul>
                                    <li>
                                        <span><?//= $vehicle['year'] ?></span>
                                    </li>
                                    <li>
                                        <span><?//= $vehicle['engine_displacement'] ?></span>
                                    </li>
                                    <li>
                                        <span><?//= $vehicle['fuel'] ?></span>
                                    </li>
                                    <li>
                                        <span><?//= $vehicle['exchange'] ?></span>
                                    </li>
                                </ul>
                            </main>
                            
                            <footer>
                                <p>R$:<?//= $vehicle['price'] ?></p>
                                <a href="src/Controller/Vehicle.php?operation=find_vehicle_id&&id_vehicle=<?//= $vehicle['id'] ?>" class="vehicle-showcase__read-more-button button-main">Ler mais</a>
                            </footer>
                        </article>
                    </div>
                <?php
                    // endforeach;
                    // unset($_SESSION['list_of_vehicles']);
                ?>
-->

                <div class="vehicle-showcase__container-vehicle-single">
                    <article class="vehicle-showcase__vehicle-single element-shadow">
                        <header>
                            <div style="background-image: url(src/View/img_vehicle/example.png)"></div>
                        </header>
                        
                        <main>
                            <h3>Nome do veículo</h3>
                            <ul>
                                <li>
                                    <span>Ano</span>
                                </li>
                                <li>
                                    <span>Cilindrada do motor</span>
                                </li>
                                <li>
                                    <span>Combustível</span>
                                </li>
                                <li>
                                    <span>Câmbio</span>
                                </li>
                            </ul>
                        </main>
                        
                        <footer>
                            <p>R$:00.000</p>
                            <a href="src/View/vehicle.php" class="vehicle-showcase__read-more-button button-main">Ler mais</a>
                        </footer>
                    </article>
                </div>

                <div class="vehicle-showcase__container-vehicle-single">
                    <article class="vehicle-showcase__vehicle-single element-shadow">
                        <header>
                            <div style="background-image: url(src/View/img_vehicle/example.png)"></div>
                        </header>
                        
                        <main>
                            <h3>Nome do veículo</h3>
                            <ul>
                                <li>
                                    <span>Ano</span>
                                </li>
                                <li>
                                    <span>Cilindrada do motor</span>
                                </li>
                                <li>
                                    <span>Combustível</span>
                                </li>
                                <li>
                                    <span>Câmbio</span>
                                </li>
                            </ul>
                        </main>
                        
                        <footer>
                            <p>R$:00.000</p>
                            <a href="src/View/vehicle.php" class="vehicle-showcase__read-more-button button-main">Ler mais</a>
                        </footer>
                    </article>
                </div>

                <div class="vehicle-showcase__container-vehicle-single">
                    <article class="vehicle-showcase__vehicle-single element-shadow">
                        <header>
                            <div style="background-image: url(src/View/img_vehicle/example.png)"></div>
                        </header>
                        
                        <main>
                            <h3>Nome do veículo</h3>
                            <ul>
                                <li>
                                    <span>Ano</span>
                                </li>
                                <li>
                                    <span>Cilindrada do motor</span>
                                </li>
                                <li>
                                    <span>Combustível</span>
                                </li>
                                <li>
                                    <span>Câmbio</span>
                                </li>
                            </ul>
                        </main>
                        
                        <footer>
                            <p>R$:00.000</p>
                            <a href="src/View/vehicle.php" class="vehicle-showcase__read-more-button button-main">Ler mais</a>
                        </footer>
                    </article>
                </div>

                <div class="vehicle-showcase__container-vehicle-single">
                    <article class="vehicle-showcase__vehicle-single element-shadow">
                        <header>
                            <div style="background-image: url(src/View/img_vehicle/example.png)"></div>
                        </header>
                        
                        <main>
                            <h3>Nome do veículo</h3>
                            <ul>
                                <li>
                                    <span>Ano</span>
                                </li>
                                <li>
                                    <span>Cilindrada do motor</span>
                                </li>
                                <li>
                                    <span>Combustível</span>
                                </li>
                                <li>
                                    <span>Câmbio</span>
                                </li>
                            </ul>
                        </main>
                        
                        <footer>
                            <p>R$:00.000</p>
                            <a href="src/View/vehicle.php" class="vehicle-showcase__read-more-button button-main">Ler mais</a>
                        </footer>
                    </article>
                </div>

                <div class="vehicle-showcase__container-vehicle-single">
                    <article class="vehicle-showcase__vehicle-single element-shadow">
                        <header>
                            <div style="background-image: url(src/View/img_vehicle/example.png)"></div>
                        </header>
                        
                        <main>
                            <h3>Nome do veículo</h3>
                            <ul>
                                <li>
                                    <span>Ano</span>
                                </li>
                                <li>
                                    <span>Cilindrada do motor</span>
                                </li>
                                <li>
                                    <span>Combustível</span>
                                </li>
                                <li>
                                    <span>Câmbio</span>
                                </li>
                            </ul>
                        </main>
                        
                        <footer>
                            <p>R$:00.000</p>
                            <a href="src/View/vehicle.php" class="vehicle-showcase__read-more-button button-main">Ler mais</a>
                        </footer>
                    </article>
                </div>

                <div class="vehicle-showcase__container-vehicle-single">
                    <article class="vehicle-showcase__vehicle-single element-shadow">
                        <header>
                            <div style="background-image: url(src/View/img_vehicle/example.png)"></div>
                        </header>
                        
                        <main>
                            <h3>Nome do veículo</h3>
                            <ul>
                                <li>
                                    <span>Ano</span>
                                </li>
                                <li>
                                    <span>Cilindrada do motor</span>
                                </li>
                                <li>
                                    <span>Combustível</span>
                                </li>
                                <li>
                                    <span>Câmbio</span>
                                </li>
                            </ul>
                        </main>
                        
                        <footer>
                            <p>R$:00.000</p>
                            <a href="src/View/vehicle.php" class="vehicle-showcase__read-more-button button-main">Ler mais</a>
                        </footer>
                    </article>
                </div>

                <div class="vehicle-showcase__container-vehicle-single">
                    <article class="vehicle-showcase__vehicle-single element-shadow">
                        <header>
                            <div style="background-image: url(src/View/img_vehicle/example.png)"></div>
                        </header>
                        
                        <main>
                            <h3>Nome do veículo</h3>
                            <ul>
                                <li>
                                    <span>Ano</span>
                                </li>
                                <li>
                                    <span>Cilindrada do motor</span>
                                </li>
                                <li>
                                    <span>Combustível</span>
                                </li>
                                <li>
                                    <span>Câmbio</span>
                                </li>
                            </ul>
                        </main>
                        
                        <footer>
                            <p>R$:00.000</p>
                            <a href="src/View/vehicle.php" class="vehicle-showcase__read-more-button button-main">Ler mais</a>
                        </footer>
                    </article>
                </div>

                <div class="vehicle-showcase__container-vehicle-single">
                    <article class="vehicle-showcase__vehicle-single element-shadow">
                        <header>
                            <div style="background-image: url(src/View/img_vehicle/example.png)"></div>
                        </header>
                        
                        <main>
                            <h3>Nome do veículo</h3>
                            <ul>
                                <li>
                                    <span>Ano</span>
                                </li>
                                <li>
                                    <span>Cilindrada do motor</span>
                                </li>
                                <li>
                                    <span>Combustível</span>
                                </li>
                                <li>
                                    <span>Câmbio</span>
                                </li>
                            </ul>
                        </main>
                        
                        <footer>
                            <p>R$:00.000</p>
                            <a href="src/View/vehicle.php" class="vehicle-showcase__read-more-button button-main">Ler mais</a>
                        </footer>
                    </article>
                </div>
            </section>
        </div>
    </main>

    <footer class="site-end">
        <div class="container">
            <p>©Todos os direitos reservados.</p>
        </div>
    </footer>
</body>
</html>