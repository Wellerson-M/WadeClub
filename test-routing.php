<?php
/**
 * Simple test to verify routing works
 */

define('BASE_PATH', __DIR__);

echo "\n=== WadeClub Routing Test ===" . PHP_EOL;

try {
    // Load bootstrap
    require BASE_PATH . '/bootstrap/init.php';
    echo "✓ Bootstrap loaded\n";
    
    // Create router
    $router = new \App\Support\Router();
    echo "✓ Router created\n";
    
    // Load routes
    require BASE_PATH . '/routes/web.php';
    echo "✓ Routes loaded\n";
    
    // Count routes
    $routeCount = count($router->routes ?? []);
    echo "✓ Routes registered: " . $routeCount . "\n";
    
    // Test dispatch
    $_SERVER['REQUEST_URI'] = '/';
    $_SERVER['REQUEST_METHOD'] = 'GET';
    
    echo "\n=== Testing GET / ===" . PHP_EOL;
    echo "Request URI: " . $_SERVER['REQUEST_URI'] . "\n";
    echo "Request Method: " . $_SERVER['REQUEST_METHOD'] . "\n";
    
    // Find route
    $method = 'GET';
    $path = '/';
    
    $route = null;
    foreach ($router->routes as $registeredRoute) {
        if (($registeredRoute['method'] == $method || $registeredRoute['method'] == 'ANY') &&
            ($registeredRoute['pattern'] == $path || $registeredRoute['pattern'] == '/' . ltrim($path, '/'))) {
            $route = $registeredRoute;
            break;
        }
    }
    
    if ($route) {
        echo "✓ Route found!\n";
        echo "  Pattern: " . $route['pattern'] . "\n";
        echo "  Handler: " . (is_string($route['handler']) ? $route['handler'] : 'Closure') . "\n";
    } else {
        echo "✗ Route NOT found\n";
        echo "\nAvailable routes:\n";
        foreach (array_slice($router->routes ?? [], 0, 10) as $r) {
            echo "  - " . $r['method'] . " " . $r['pattern'] . "\n";
        }
    }
    
    echo "\n✓ Test completed successfully\n\n";
    
} catch (Exception $e) {
    echo "✗ ERROR: " . $e->getMessage() . "\n";
    echo "  File: " . $e->getFile() . " (Line " . $e->getLine() . ")\n";
}

?>
