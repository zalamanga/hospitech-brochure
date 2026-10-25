<?php
declare(strict_types=1);

require dirname(__DIR__) . '/src/view.php';
$catalog = require dirname(__DIR__) . '/src/catalog.php';
$method = $_SERVER['REQUEST_METHOD'] ?? 'GET';
$path = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH);
$route = resolve_route($method, $_GET, $catalog['products'], is_string($path) ? $path : '');
$context = $catalog + ['route' => $route];
try {
    $content = render_template($route['page'], $context);
    $document = render_template('layout', $context + ['content' => $content]);
} catch (Throwable $failure) {
    error_log('Hospitech brochure rendering failed.');
    $route['status'] = 500;
    $document = '<!doctype html><html lang="en"><meta charset="utf-8"><title>Brochure unavailable</title><h1>Brochure unavailable.</h1><p>Please try again later.</p></html>';
}
http_response_code($route['status']);
foreach (response_headers() as $name => $value) {
    header($name . ': ' . $value);
}
if ($route['status'] === 405) {
    header('Allow: GET, HEAD');
}
if ($method !== 'HEAD') {
    echo $document;
}
