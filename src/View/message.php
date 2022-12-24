<?php

    session_start();
    
?>

<html>
<section class="message__text">
    <?php
        if(!empty($_SESSION['msg_error_validation'])) :
    ?>
        <article class="message__error-validation">
            <h1>Erro de validação:</h1>
            <ul>
                <?php
                    foreach ($_SESSION['msg_error_validation'] as $msg) :
                ?>
                    <li>
                        <?= $msg; ?>
                    </li>
                <?php endforeach; ?>
            </ul>
        </article>
    <?php
        endif;
        unset($_SESSION['msg_error_validation']);
    ?>

    <?php
        if(!empty($_SESSION['msg_error'])) :
    ?>
        <article class="message__error_or_confirm">
            <h1>
                <?= $_SESSION['msg_error']; ?>
            </h1>
        </article>
    <?php
        endif;
        unset($_SESSION['msg_error']);
    ?>

    <?php
        if (!empty($_SESSION['msg_confirm'])) :
    ?>
        <article class="message__error_or_confirm">
            <h1>
                <?= $_SESSION['msg_confirm']; ?>
            </h1>
        </article>
    <?php
        endif;
        unset($_SESSION['msg_confirm']);
    ?>
</section>
</html>