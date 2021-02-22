<?php
  // Load Config
  require_once 'config/config.php';
  require_once 'helpers/redirect.php';
  require_once 'helpers/alert.php';
  require_once 'helpers/id_generator.php';
  require_once 'helpers/random_str.php';
  require_once 'helpers/send_mail.php';
  require_once 'helpers/session_info.php';
  require_once 'helpers/upload_file.php';

  // Autoload Core Libraries
  spl_autoload_register(function($className){
    require_once 'libraries/' . $className . '.php';
  });
  
