<?php
/**
 * Test routing directly
 */

// Simula uma requisição
$_SERVER['REQUEST_URI'] = '/';
$_SERVER['REQUEST_METHOD'] = 'GET';
$_SERVER['SCRIPT_NAME'] = '/WadeClub/WadeClub/index.php';
$_SERVER['PHP_SELF'] = '/WadeClub/WadeClub/index.php';

define('BASE_PATH', __DIR__);

echo "=== ROUTING TEST ===\n\n";
echo "REQUEST_URI: " . $_SERVER['REQUEST_URI'] . "\n";
echo "SCRIPT_NAME: " . $_SERVER['SCRIPT_NAME'] . "\n";
echo "BASE_PATH: " . BASE_PATH . "\n\n";

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
    echo "✓ Total routes: " . count($router->routes) . "\n\n";
    
    // Parse path like index.php does
    $requestUri = $_SERVER['REQUEST_URI'] ?? '/';
    $path = parse_url($requestUri, PHP_URL_PATH);
    $scriptDir = dirname($_SERVER['SCRIPT_NAME']);
    
    echo "Script dir: " . $scriptDir . "\n";
    
    if ($scriptDir !== '/' && strpos($path, $scriptDir) === 0) {
        $path = substr($path, strlen($scriptDir));
    }
    
    $path = '/' . ltrim($path, '/');
    
    if (!$path || $path === '') {
        $path = '/';
    }
    
    $method = $_SERVER['REQUEST_METHOD'] ?? 'GET';
    
    echo "Final path: " . $path . "\n";
    echo "Method: " . $method . "\n\n";
    
    // Check if route exists
    echo "=== CHECKING ROUTE ===\n\n";
    
    if (isset($router->routes[$method][$path])) {
        echo "✓ Route found in " . $method . "\n";
        $handler = $router->routes[$method][$path];
        echo "Handler: " . (is_string($handler) ? $handler : 'Closure') . "\n";
    } elseif (isset($router->routes['ANY'][$path])) {
        echo "✓ Route found in ANY\n";
        $handler = $router->routes['ANY'][$path];
        echo "Handler: " . (is_string($handler) ? $handler : 'Closure') . "\n";
    } else {
        echo "✗ Route NOT found\n";
        echo "\n=== AVAILABLE ROUTES ===\n\n";
        
        foreach ($router->routes as $m => $routes) {
            echo "Method: $m\n";
            foreach (array_slice($routes, 0, 5) as $p => $h) {
                echo "  - $p\n";
            }
            if (count($routes) > 5) {
                echo "  ... and " . (count($routes) - 5) . " more\n";
            }
        }
    }
    
} catch (Exception $e) {
    echo "ERROR: " . $e->getMessage() . "\n";
    echo "File: " . $e->getFile() . ":" . $e->getLine() . "\n";
    echo "\nTrace:\n" . $e->getTraceAsString() . "\n";
}

?>
