<?php
include_once('../config.php');
include_once('../controllers/controllers.php');

$functions = new Functions($conexao);

$routes = [
    'GET' => [
        '/users' => [$functions, 'test'],
    ],
    'POST' => [
        '/users/create' => [$functions, 'createUser '],
        '/users/get' => [$functions, 'getUser '],
    ],
];

$requestMethod = $_SERVER['REQUEST_METHOD'];
$requestUri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

function matchRoute($requestMethod, $requestedUri, &$params) {
    global $routes;
    if (!isset($routes[$requestMethod])) return false;

    foreach ($routes[$requestMethod] as $route => $handler) {
        $pattern = preg_replace('#\{[a-zA-Z_]+\}#', '([a-zA-Z0-9-_]+)', $route);
        $pattern = '#^' . $pattern . '$#';

        if (preg_match($pattern, $requestedUri, $matches)) {
            array_shift($matches); // remove the full match
            $params = $matches;
            return $handler;
        }
    }
    return false;
}

$params = [];
$handler = matchRoute($requestMethod, $requestUri, $params);

if ($handler && is_callable($handler)) {
    // For POST, capture the body data
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $body = json_decode(file_get_contents('php://input'), true);
        if (json_last_error() !== JSON_ERROR_NONE) {
            http_response_code(400);
            echo json_encode(["error" => "Invalid JSON"]);
            exit;
        }
        $params = array_values($body);
    }

    $response = call_user_func_array($handler, $params);
    echo json_encode($response);
} else {
    http_response_code(404);
    echo json_encode(["error" => "Route not found"]);
}