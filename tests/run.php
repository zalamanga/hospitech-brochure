<?php
declare(strict_types=1);

require dirname(__DIR__) . '/src/view.php';
$catalog = require dirname(__DIR__) . '/src/catalog.php';
$products = $catalog['products'];
$checks = 0;
function check(bool $condition, string $label): void
{
    global $checks;
    if (!$condition) {
        throw new RuntimeException('FAIL: ' . $label);
    }
    $checks++;
}

$expected = ['eurotronik' => 5, 'intercall' => 15, 'rondish' => 5, 'medicare' => 4];
check(array_keys($products) === array_keys($expected), 'four original brands in source order');
check(array_sum(array_map(fn (array $item): int => count($item['features']), $products)) === 29, '29 original feature rows');
foreach ($expected as $slug => $count) {
    $route = resolve_route('GET', ['page' => $slug], $products);
    check($route['status'] === 200 && $route['page'] === 'product' && $route['product'] === $products[$slug], $slug . ' resolves to its own original record');
    check(count($route['product']['features']) === $count, $slug . ' original feature count');
    $html = render_template('product', $catalog + ['route' => $route]);
    foreach ($products[$slug]['features'] as $feature) {
        check(str_contains($html, e($feature[0])) && str_contains($html, e($feature[1])), $slug . ' renders full feature content');
    }
    foreach ($products[$slug]['summary'] as $paragraph) {
        check(str_contains($html, e($paragraph)), $slug . ' renders source summary');
    }
    check(str_contains($html, 'value="' . $slug . '" selected'), $slug . ' enquiry context is selected');
    check(str_contains($html, e(brochure_title($products[$slug]))), $slug . ' preserves reference brochure title');
    check(str_contains($html, 'No brochure file is supplied'), $slug . ' has truthful brochure state');
    check(!str_contains($html, '>ONLINE<') && !str_contains($html, '>LIVE<'), $slug . ' has no fake live status');
}
check(resolve_route('GET', [], $products)['page'] === 'home', 'default route');
check(resolve_route('GET', ['page' => 'home'], $products)['page'] === 'home', 'explicit home route');
check(resolve_route('HEAD', ['page' => 'contact'], $products)['status'] === 200, 'HEAD accepted');
check(resolve_route('GET', [], $products, '/index.php')['status'] === 200, 'explicit front-controller path');
foreach (['/missing', '/nested/path', '/index.php/extra'] as $path) {
    check(resolve_route('GET', [], $products, $path)['status'] === 404, 'unknown path returns404');
}
foreach (['missing', '', '../../src/catalog.php', '<script>alert(1)</script>'] as $page) {
    $route = resolve_route('GET', ['page' => $page], $products);
    check($route['status'] === 404 && $route['page'] === 'error', 'unknown scalar page returns404');
    check(!str_contains(implode(' ', $route), $page) || $page === '', 'unknown page value is not reflected');
}
foreach ([[], ['home'], null, 123, true] as $page) {
    check(resolve_route('GET', ['page' => $page], $products)['status'] === 400, 'non-string route returns400');
}
foreach (['POST', 'PUT', 'DELETE', 'PATCH'] as $method) {
    check(resolve_route($method, ['page' => 'contact'], $products)['status'] === 405, 'unsupported method returns405');
}
check(e('<img src=x onerror=alert(1)>"\'&') === '&lt;img src=x onerror=alert(1)&gt;&quot;&#039;&amp;', 'HTML and quote escaping');
check(str_contains(e("bad\xFFtext"), "\u{FFFD}"), 'invalid UTF8 is replaced without leaking raw bytes');
$error = render_template('error', ['route' => ['heading' => '<script>sample</script>', 'message' => '"sample" & text']]);
check(!str_contains($error, '<script>') && str_contains($error, '&lt;script&gt;'), 'error view escapes data');
$level = ob_get_level();
try {
    render_template('../src/catalog', []);
    throw new RuntimeException('Unknown template was accepted.');
} catch (InvalidArgumentException $expectedFailure) {
    check(ob_get_level() === $level, 'template allowlist rejects traversal without buffer leak');
}
$contact = render_template('contact', $catalog + ['route' => resolve_route('GET', ['page' => 'contact'], $products)]);
foreach ($catalog['contact'] as $value) {
    check(str_contains($contact, e($value)), 'reference contact content retained');
}
$homeRoute = resolve_route('GET', [], $products);
$home = render_template('home', $catalog + ['route' => $homeRoute]);
foreach ($products as $product) {
    check(str_contains($home, e($product['title'])) && str_contains($home, e($product['subtitle'])), 'home renders original family content');
}
foreach ([$home, $contact] as $content) {
    $html = render_template('layout', $catalog + ['route' => $homeRoute, 'content' => $content]);
    check(!preg_match('/(?:href|src)="(?:https?:|mailto:|tel:|\/\/)/i', $html), 'rendered brochure has only local resource/navigation URLs');
    check(str_contains($html, '<details') && str_contains($html, '<summary'), 'native product disclosure');
    check(str_contains($html, 'assets/site.css') && str_contains($html, 'assets/site.js'), 'local assets loaded');
}
check(str_contains($contact, '<fieldset disabled>'), 'form remains inactive until local handler is installed');
check(!str_contains($contact, 'type="submit">Send'), 'no fake send control');
check(str_contains($contact, 'data-draft-preview') && str_contains($contact, 'download="hospitech-enquiry-demo.txt"'), 'local draft review/download controls');
check(str_contains(response_headers()['Content-Security-Policy'], "connect-src 'none'; form-action 'none'"), 'network/submission blocked by response policy');

foreach (['public', 'src', 'templates', 'tests'] as $directory) {
    $iterator = new RecursiveIteratorIterator(new RecursiveDirectoryIterator(dirname(__DIR__) . '/' . $directory, FilesystemIterator::SKIP_DOTS));
    foreach ($iterator as $file) {
        if ($file->getExtension() === 'php') {
            token_get_all((string) file_get_contents($file->getPathname()), TOKEN_PARSE);
            check(true, 'PHP parses: ' . $file->getFilename());
        }
    }
}
echo json_encode(['passed' => true, 'checks' => $checks, 'php' => PHP_VERSION], JSON_PRETTY_PRINT | JSON_THROW_ON_ERROR) . PHP_EOL;
