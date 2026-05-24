<?php
session_start();

// Include configuration and router
require_once __DIR__ . '/config/database.php';
require_once __DIR__ . '/src/Router.php';
require_once __DIR__ . '/src/helpers.php';

ensureAdminSetup();

// Helper function to check active route
function isActive($path) {
    $currentPath = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    $currentPath = stripBasePath($currentPath);
    return trim($currentPath, '/') === trim($path, '/');
}

// Initialize router
$router = new Router();

// Load routes
require_once __DIR__ . '/routes/web.php';

// Get the request method and path
$method = $_SERVER['REQUEST_METHOD'];
$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$path = stripBasePath($path);

// Dispatch the route
$result = $router->dispatch($method, $path);

// Handle the result
if ($result === '404') {
    http_response_code(404);
    $currentPage = '404';
    $pageTitle = '404 - Page Not Found';
    $pageDescription = 'The page you are looking for does not exist.';
} else {
    $currentPage = $result;
    // Set page titles and descriptions
    $pageData = [
        'landing' => ['Shivam Singh - Portfolio', 'Professional portfolio of Shivam Singh, Web & Android Developer from Bihar, India'],
        'about' => ['About - Shivam Singh', 'Learn more about Shivam Singh, his experience, and skills'],
        'services' => ['Services - Shivam Singh', 'Professional web development, Android development, and cybersecurity services'],
        'my-work' => ['My Work - Shivam Singh', 'Portfolio of completed projects showcasing expertise'],
        'projects' => ['Projects - Shivam Singh', 'Open-source and personal projects'],
        'contact' => ['Contact - Shivam Singh', 'Get in touch to discuss your project'],
        'admin/login' => ['Admin Login', 'Admin login'],
        'admin/dashboard' => ['Admin Dashboard', 'Manage portfolio website content'],
        'admin/projects' => ['Manage Projects', 'Manage portfolio projects'],
        'admin/services' => ['Manage Services', 'Manage website services'],
        'admin/works' => ['Manage Works', 'Manage completed works'],
        'admin/skills' => ['Manage Skills', 'Manage skills'],
        'admin/messages' => ['Messages', 'Manage contact messages'],
    ];
    
    if (isset($pageData[$result])) {
        $pageTitle = $pageData[$result][0];
        $pageDescription = $pageData[$result][1];
    }
}

// Include the appropriate layout
$isAdminLayout = str_starts_with($currentPage ?? '', 'admin/')
    || str_starts_with($path ?? '', '/admin');

$layout = $isAdminLayout
    ? __DIR__ . '/views/layouts/admin.php'
    : __DIR__ . '/views/layouts/app.php';

require_once $layout;

// Close database connection
$db->close();
?>
