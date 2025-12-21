<?php
/**
 * Debug page to see what's happening
 */
error_reporting(E_ALL);
ini_set('display_errors', 1);

echo "<pre style='background: #f5f5f5; padding: 20px; font-family: monospace;'>";

echo "=== REQUEST DEBUG ===\n\n";
echo "REQUEST_URI: " . ($_SERVER['REQUEST_URI'] ?? 'NOT SET') . "\n";
echo "SCRIPT_NAME: " . ($_SERVER['SCRIPT_NAME'] ?? 'NOT SET') . "\n";
echo "PHP_SELF: " . ($_SERVER['PHP_SELF'] ?? 'NOT SET') . "\n";
echo "QUERY_STRING: " . ($_SERVER['QUERY_STRING'] ?? 'NOT SET') . "\n";
echo "REQUEST_METHOD: " . ($_SERVER['REQUEST_METHOD'] ?? 'NOT SET') . "\n";
echo "DOCUMENT_ROOT: " . ($_SERVER['DOCUMENT_ROOT'] ?? 'NOT SET') . "\n";

echo "\n=== FILE PATHS ===\n\n";
echo "__FILE__: " . __FILE__ . "\n";
echo "__DIR__: " . __DIR__ . "\n";
echo "realpath(.): " . realpath('.') . "\n";
echo "getcwd(): " . getcwd() . "\n";

echo "\n=== CHECKING BOOTSTRAP ===\n\n";

$bootstrapPath = __DIR__ . '/bootstrap/init.php';
echo "Bootstrap path: $bootstrapPath\n";
echo "Bootstrap exists: " . (file_exists($bootstrapPath) ? 'YES' : 'NO') . "\n";

if (file_exists($bootstrapPath)) {
    try {
        require $bootstrapPath;
        echo "Bootstrap loaded: YES\n";
        echo "BASE_PATH: " . (defined('BASE_PATH') ? BASE_PATH : 'NOT DEFINED') . "\n";
        echo "APP_BOOTSTRAPPED: " . (defined('APP_BOOTSTRAPPED') ? 'YES' : 'NO') . "\n";
        
        echo "\n=== CHECKING ROUTER ===\n\n";
        echo "Router class exists: " . (class_exists('App\Support\Router') ? 'YES' : 'NO') . "\n";
        
        if (class_exists('App\Support\Router')) {
            $router = new \App\Support\Router();
            echo "Router instance created: YES\n";
            
            // Load routes
            require BASE_PATH . '/routes/web.php';
            echo "Routes loaded: YES\n";
            echo "Total routes: " . count($router->routes) . "\n";
            
            echo "\n=== FIRST 5 ROUTES ===\n\n";
            foreach (array_slice($router->routes, 0, 5) as $idx => $route) {
                echo "Route " . ($idx + 1) . ":\n";
                echo "  Method: " . $route['method'] . "\n";
                echo "  Pattern: " . $route['pattern'] . "\n";
                echo "  Handler: " . (is_string($route['handler']) ? $route['handler'] : 'Closure') . "\n";
            }
        }
    } catch (Exception $e) {
        echo "Bootstrap ERROR: " . $e->getMessage() . "\n";
        echo "File: " . $e->getFile() . ":" . $e->getLine() . "\n";
    } catch (Throwable $e) {
        echo "Bootstrap FATAL ERROR: " . $e->getMessage() . "\n";
        echo "File: " . $e->getFile() . ":" . $e->getLine() . "\n";
    }
} else {
    echo "Bootstrap file NOT FOUND!\n";
}

echo "\n=== FILE STRUCTURE ===\n\n";
$files = scandir(__DIR__);
echo "Files in " . __DIR__ . ":\n";
foreach (array_slice($files, 0, 15) as $file) {
    if ($file !== '.' && $file !== '..') {
        $isDir = is_dir(__DIR__ . '/' . $file) ? '/' : '';
        echo "  - $file$isDir\n";
    }
}

echo "</pre>";
?>
