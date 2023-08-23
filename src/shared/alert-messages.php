<?php
     // Alerts

     if(!isset($additional)) {
        $additional = '';
     }

    if (isset($_SESSION['success_message'])) {
        echo '<div class="alert alert-primary" role="alert"> ' .
            $_SESSION['success_message'] .$additional. '</div>'; //$additional used for extra text or html 
        unset($_SESSION['success_message']);
    } elseif (isset($_SESSION['error_message'])) {
        echo '<div class="alert alert-danger" role="alert">' . $_SESSION['error_message'] . '</div>';
        unset($_SESSION['error_message']);
    }
    ?>