<?php
/**
 * Test file to debug the application
 */

error_reporting(E_ALL);
ini_set('display_errors', 1);

echo "=== WadeClub Debug Test ===" . PHP_EOL;
echo "PHP Version: " . PHP_VERSION . PHP_EOL;
echo "Current Directory: " . getcwd() . PHP_EOL;

try {
    // Try to load bootstrap
    $bootstrapFile = __DIR__ . '/bootstrap/init.php';
    echo "Bootstrap file path: $bootstrapFile" . PHP_EOL;
    echo "Bootstrap file exists: " . (file_exists($bootstrapFile) ? 'YES' : 'NO') . PHP_EOL;
    
    require $bootstrapFile;
    
    echo "Bootstrap loaded successfully!" . PHP_EOL;
    echo "BASE_PATH defined: " . (defined('BASE_PATH') ? 'YES' : 'NO') . PHP_EOL;
    echo "BASE_PATH value: " . (defined('BASE_PATH') ? BASE_PATH : 'N/A') . PHP_EOL;
    
    // Check if router class exists
    echo "Router class exists: " . (class_exists('App\Support\Router') ? 'YES' : 'NO') . PHP_EOL;
    
    // Try to load routes
    echo "Loading routes..." . PHP_EOL;
    $router = new \App\Support\Router();
    require BASE_PATH . '/routes/web.php';
    echo "Routes loaded successfully!" . PHP_EOL;
    
    // Check registered routes
    echo "Total routes registered: " . count($router->routes) . PHP_EOL;
    
} catch (Exception $e) {
    echo "ERROR: " . $e->getMessage() . PHP_EOL;
    echo "File: " . $e->getFile() . " (Line " . $e->getLine() . ")" . PHP_EOL;
    echo "Trace: " . $e->getTraceAsString() . PHP_EOL;
} catch (Error $e) {
    echo "FATAL ERROR: " . $e->getMessage() . PHP_EOL;
    echo "File: " . $e->getFile() . " (Line " . $e->getLine() . ")" . PHP_EOL;
}

?>
