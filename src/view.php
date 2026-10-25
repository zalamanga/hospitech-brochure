<?php
declare(strict_types=1);

function e(string $value): string
{
    return htmlspecialchars($value, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}

function resolve_route(string $method, array $query, array $products, string $path = '/'): array
{
    if (!in_array($method, ['GET', 'HEAD'], true)) {
        return ['status' => 405, 'page' => 'error', 'heading' => 'This brochure is read-only.',
            'message' => 'Enquiry drafts are created in your browser. Return to the brochure to continue.'];
    }
    if (!in_array($path, ['/', '/index.php'], true)) {
        return ['status' => 404, 'page' => 'error', 'heading' => 'Page not found.',
            'message' => 'Choose a page from the brochure navigation to continue.'];
    }
    $page = array_key_exists('page', $query) ? $query['page'] : 'home';
    if (!is_string($page)) {
        return ['status' => 400, 'page' => 'error', 'heading' => 'That page request is not valid.',
            'message' => 'Choose a page from the navigation to continue.'];
    }
    if ($page === 'home' || $page === 'contact') {
        return ['status' => 200, 'page' => $page];
    }
    if (isset($products[$page])) {
        return ['status' => 200, 'page' => 'product', 'slug' => $page, 'product' => $products[$page]];
    }
    return ['status' => 404, 'page' => 'error', 'heading' => 'Page not found.',
        'message' => 'Browse the four product families or prepare a local enquiry draft.'];
}

function render_template(string $name, array $context): string
{
    if (!in_array($name, ['layout', 'home', 'product', 'contact', 'form', 'illustration', 'error'], true)) {
        throw new InvalidArgumentException('Unknown template.');
    }
    extract($context, EXTR_SKIP);
    ob_start();
    try {
        require dirname(__DIR__) . '/templates/' . $name . '.php';
        return (string) ob_get_clean();
    } catch (Throwable $failure) {
        ob_end_clean();
        throw $failure;
    }
}

function brochure_title(array $product): string
{
    return (string) preg_replace('/^Download\s+/', '', $product['brochure']);
}

function response_headers(): array
{
    return [
        'Content-Type' => 'text/html; charset=UTF-8',
        'Content-Security-Policy' => "default-src 'self'; script-src 'self'; style-src 'self'; img-src 'self'; connect-src 'none'; form-action 'none'; object-src 'none'; base-uri 'none'; frame-ancestors 'none'",
        'Referrer-Policy' => 'no-referrer',
        'X-Content-Type-Options' => 'nosniff',
        'Cache-Control' => 'no-store',
    ];
}
