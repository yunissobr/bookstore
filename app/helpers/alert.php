
<?php

function show_alert($showAlert = false,
    $text = '',
    $class = 'danger',
    $icon = 'ri-alert-line') {

    if ($showAlert) {
        setcookie('alert', $text, time() + 5);
        setcookie('alert-class', $class, time() + 5);
        setcookie('alert-icon', $icon, time() + 5);
    } else {
        if (isset($_COOKIE['alert'])) {
            setcookie('alert', '-', 1);
            setcookie('alert-class', '-', 1);
            setcookie('alert-icon', '-', 1);

            echo '<div class="alert bg-white alert-' . $_COOKIE['alert-class'] . '" role="alert">
              <div class="iq-alert-icon">
              <i class="' . $_COOKIE['alert-icon'] . '"></i>
              </div>
              <div class="iq-alert-text">' . $_COOKIE['alert'] . '</div>
              </div>';
        }
    }

}
