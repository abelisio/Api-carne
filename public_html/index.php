<?php
header('Content-Type: application/json');

require_once '../vendor/autoload.php';

use App\Models\Carne;

date_default_timezone_set('America/Sao_Paulo');

if ($_GET['url']) {
    $url = explode('/', $_GET['url']);

    if ($url[0] === 'api') {
        array_shift($url);

        $controller = 'App\Controllers\\' . ucfirst($url[0]) . 'Controller';
        array_shift($url);

        $method = strtolower($_SERVER['REQUEST_METHOD']);

        try {
            $response = call_user_func_array(array(new $controller, $method), $url);

            http_response_code(200);
            echo json_encode(array('status' => 'Saída de dados do Carnê', 'Saída:' => $response));
            exit;
        } catch (\Exception $e) {
            http_response_code(404);
            echo json_encode(array('status' => 'error', 'Saída:' => $e->getMessage()), JSON_UNESCAPED_UNICODE);
            exit;
        }
    }
}