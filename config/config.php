    <?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    // Definir uma url BASE
    define('BASE_URL', 'http://localhost/sistema-ladolce/public/');

    // Definições de caminho
    define('BASE_PATH', realpath(__DIR__ . '/..'));
    define('APP_PATH', BASE_PATH . '/app');
    define('VIEWS_PATH', APP_PATH . '/views/');
    define('CONTROLLERS_PATH', APP_PATH . '/controllers/');
    define('MODELS_PATH', APP_PATH . '/models/');
    define('PHPMAILER_PATH', BASE_PATH . '/PHPMailer/src/'); // Novo caminho para PHPMailer

    // Configuração do banco de dados
    define('DB_HOST','smpsistema.com.br');
    define('DB_NAME','u283879542_omuratec');
    define('DB_USER','u283879542_omuratec');
    define('DB_PASS','@OmuraTi26');

    // Configuração de Email - CORRIGIDO
    define('EMAIL_HOST','smtp.hostinger.com');
    define('EMAIL_PORT','465');
    define('EMAIL_USER','ti26@smpsistema.com.br'); // Corrigido o email
    define('EMAIL_PASS','Senac@ti26'); // Adicionada a senha



    //Sistema de autoload das class
    spl_autoload_register(function($class){

        if(file_exists('../app/controllers/' . $class . '.php')){
            require_once('../app/controllers/'.$class.'.php');
        //var_dump($class);
        }

        if (file_exists('../app/models/'.$class.'.php')){
            require_once('../app/models/'.$class.'.php');
            //var_dump($class);
        }

        if(file_exists('../rotas/'.$class.'.php')){
            require_once('../rotas/'.$class.'.php');
            //var_dump($class);
        }

    });


