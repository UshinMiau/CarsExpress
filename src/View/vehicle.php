<?php

    session_start();

    if(empty($_SESSION['data_vehicle'])) {
        header('location: ../../index.php');
    }
    else{
        $vehicle = $_SESSION['data_vehicle'];
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
    <link rel="icon" type="imagem/png" href="img/logo.png">
    <!-- font awesome -->
    <link rel="stylesheet" href="css/all.min.css">
    <link rel="stylesheet" href="css/fontawesome.min.css">
    <!-- fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com"><link rel="preconnect" href="https://fonts.gstatic.com" crossorigin><link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <!-- JQuery -->
    <script src="js/jQuery.js"></script>
    <!-- slick slider -->
    <link rel="stylesheet" href="css/slick.css">
    <script src="js/slick.js"></script>
    <!-- my scripts -->
    <script src="js/functions_main.js"></script>
    <script src="js/functions_vehicle.js"></script>
    <!-- my styles -->
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/style_main.css">
    <link rel="stylesheet" href="css/style_vehicle.css">
</head>
<body>
<div class="overlay">
        <?php
            if($login):
        ?>
            <section class="profile-data element-shadow">
                <i class="fas fa-times shadow-title close-modal-window-button"></i>

                <h1 class="shadow-title">Meu Perfil</h1>

                <img src="img_profile_picture/<?= $data_login['id'] ?>.png" alt="foto de perfil">

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

                <form action="../Controller/Vehicle.php?operation=sign_up" method="POST" enctype="multipart/form-data">
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

                    <form action="../Controller/Login.php?operation=sign_in" method="POST">
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

                    <form action="../Controller/Client.php?operation=sign_up" method="POST"  enctype="multipart/form-data">
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
                    <li><a href="../../index.php">Veículos</a></li>
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
            <li><a href="../../index.php">Veículos</a></li>
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

    <main class="vehicle-data">
        <section class="vehicle-data__images">
            <button type="button" class="slick-prev">
                <i class="fas fa-chevron-left"></i>
            </button>

            <article class="vehicle-data__slider">
                <img src="img_vehicle/example.png" alt="imagem do veículo">
                <img src="img_vehicle/example.png" alt="imagem do veículo">
                <img src="img_vehicle/example.png" alt="imagem do veículo">
                <img src="img_vehicle/example.png" alt="imagem do veículo">
                <img src="img_vehicle/example.png" alt="imagem do veículo">
            </article>
                
            <button type="button" class="slick-next">
                <i class="fas fa-chevron-right"></i>
            </button>
        </section>
    
        <div class="container">
            <section class="vehicle-data__description element-shadow">
                <h1 class="shadow-title">Modelo do Veículo</h1>

                <h2>R$:000.000</h2>

                <article class="vehicle-data__main-features">
                    <h2>Características Principais</h2>
                    
                    <table>
                        <tbody>
                            <tr>
                                <th>Ano</th>
                                <td>2020</td>
                            </tr>
                            <tr>
                                <th>Cor</th>
                                <td>Vermelho</td>
                            </tr>
                            <tr>
                                <th>Câmbio</th>
                                <td>Manual</td>
                            </tr>
                            <tr>
                                <th>Cilindrada do motor</th>
                                <td>1.6</td>
                            </tr>
                            <tr>
                                <th>Marca</th>
                                <td>Fiat</td>
                            </tr>
                            <tr>
                                <th>Direção</th>
                                <td>Hidráulica</td>
                            </tr>
                            <tr>
                                <th>Combustível</th>
                                <td>Gasolina e Álcool</td>
                            </tr>
                        </tbody>
                    </table>
                </article>

                <article class="vehicle-data__secondary-features">
                    <h2>Características Opcionais</h2>

                    <table>
                        <tbody>
                            <tr>
                                <th>Ar Condicionado</th>
                                <td>Sim</td>
                            </tr>
                            <tr>
                                <th>Ar Quente</th>
                                <td>Sim</td>
                            </tr>
                            <tr>
                                <th>Arbag</th>
                                <td>Sim</td>
                            </tr>
                            <tr>
                                <th>Alarme</th>
                                <td>Sim</td>
                            </tr>
                        </tbody>
                    </table>
                </article>
                
                <article class="vehicle-data__seller-description">
                    <h2>Descrição do Vendedor</h2>

                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Maxime suscipit ratione praesentium ab laboriosam odio, laborum dicta iste qui cupiditate repudiandae veritatis quam. Maiores at amet quis ipsam quam sint.
                        Vero odio voluptatibus rerum iure praesentium! Dolorum porro commodi excepturi labore cupiditate doloribus officiis maiores veniam! Quis provident eaque praesentium sint, eligendi soluta eos esse aliquam dignissimos ipsum. Vero, in?
                        Fugit corporis vel obcaecati eligendi, facere impedit nobis aspernatur eaque dignissimos ab odio nulla! Obcaecati blanditiis laudantium tempora laborum fugiat eius eligendi sed. Reprehenderit dicta ullam doloribus consequatur quia praesentium.</p>
                    </article>
                    
                    <article class="vehicle-data__contact-seller">
                        <button class="button-main">Contatar Vendedor</button>
                    </article>
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