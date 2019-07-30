<?php

require_once 'app/core/Core.php';

require_once 'lib/database/Connection.php';

require_once 'app/controller/HomeController.php';
require_once 'app/controller/ErroController.php';
require_once 'app/controller/PostController.php';
require_once 'app/controller/SobreController.php';
require_once 'app/controller/AdminController.php';

require_once 'app/model/Postagem.php';
require_once 'app/model/Comentario.php';

require_once 'vendor/autoload.php';

$template = file_get_contents('app/template/estrutura.html');

ob_start();
    $core = new Core();
    $core->Start($_GET);

    $saida = ob_get_contents();
ob_end_clean();

$templatePronto = str_ireplace('{{area_dinamica}}',$saida, $template);

echo $templatePronto;