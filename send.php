<?php
// Разрешаем запросы с любого источника (для корректной работы fetch)
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");
header("Content-Type: application/json; charset=UTF-8");

// Если это предзапрос OPTIONS, просто возвращаем успех
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit;
}

// Проверяем, что запрос именно POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Получаем данные из формы
    $name = isset($_POST['name']) ? trim($_POST['name']) : '';
    $phone = isset($_POST['phone']) ? trim($_POST['phone']) : '';
    $service = isset($_POST['service']) ? trim($_POST['service']) : '';
    $message = isset($_POST['message']) ? trim($_POST['message']) : '';

    // Простая валидация
    if (empty($name) || empty($phone)) {
        echo json_encode(["status" => "error", "message" => "Имя и телефон обязательны"]);
        exit;
    }

    // === ЗДЕСЬ МОЖНО ДОБАВИТЬ ОТПРАВКУ НА ПОЧТУ ===
    // $to = "vash_email@example.com";
    // $subject = "Новая заявка с сайта Магнесия";
    // $body = "Имя: $name\nТелефон: $phone\nУслуга: $service\nСообщение: $message";
    // mail($to, $subject, $body);

    // Возвращаем успешный ответ для вашего JavaScript
    echo json_encode(["status" => "success"]);
    exit;
}

// Если запрос не POST
http_response_code(405);
echo json_encode(["status" => "error", "message" => "Метод не разрешен"]);
?>
