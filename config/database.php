<?php
function envValue($key, $default = '') {
    static $env = null;

    if ($env === null) {
        $env = [];
        $envPath = dirname(__DIR__) . '/.env';

        if (is_readable($envPath)) {
            foreach (file($envPath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES) as $line) {
                $line = trim($line);

                if ($line === '' || str_starts_with($line, '#') || !str_contains($line, '=')) {
                    continue;
                }

                [$name, $value] = array_map('trim', explode('=', $line, 2));
                $env[$name] = trim($value, "\"'");
            }
        }
    }

    return $env[$key] ?? getenv($key) ?: $default;
}

// Database Configuration
define('DB_HOST', envValue('DB_HOST', 'localhost'));
define('DB_USER', envValue('DB_USER', 'root'));
define('DB_PASS', envValue('DB_PASS', ''));
define('DB_NAME', envValue('DB_NAME', 'portfolio_db'));

// URL and contact configuration
define('SITE_URL', rtrim(envValue('SITE_URL', 'http://localhost/new-portfolio/'), '/') . '/');
define('APP_BASE_PATH', rtrim(parse_url(SITE_URL, PHP_URL_PATH) ?: '', '/'));
define('BASE_URL', (APP_BASE_PATH === '' ? '/' : APP_BASE_PATH . '/'));

// Asset URLs
define('ASSETS_URL', BASE_URL . 'assets/');
define('IMAGES_URL', ASSETS_URL . 'images/');
define('PROJECTS_ASSETS_URL', ASSETS_URL . 'projects/');
define('RESUME_ASSETS_URL', ASSETS_URL . 'resume/');
define('TECHNOLOGIES_ASSETS_URL', ASSETS_URL . 'technologies/');
define('WORKS_ASSETS_URL', ASSETS_URL . 'works/');
define('PUBLIC_URL', BASE_URL . 'public/');
define('PUBLIC_IMAGES_URL', PUBLIC_URL . 'images/');
define('PUBLIC_JS_URL', PUBLIC_URL . 'js/');
define('PUBLIC_UPLOADS_URL', PUBLIC_URL . 'uploads/');

// Asset paths
define('ROOT_PATH', dirname(__DIR__) . '/');
define('ASSETS_PATH', ROOT_PATH . 'assets/');
define('IMAGES_PATH', ASSETS_PATH . 'images/');
define('PROJECTS_ASSETS_PATH', ASSETS_PATH . 'projects/');
define('RESUME_ASSETS_PATH', ASSETS_PATH . 'resume/');
define('TECHNOLOGIES_ASSETS_PATH', ASSETS_PATH . 'technologies/');
define('WORKS_ASSETS_PATH', ASSETS_PATH . 'works/');
define('PUBLIC_PATH', ROOT_PATH . 'public/');
define('PUBLIC_IMAGES_PATH', PUBLIC_PATH . 'images/');
define('PUBLIC_JS_PATH', PUBLIC_PATH . 'js/');
define('PUBLIC_UPLOADS_PATH', PUBLIC_PATH . 'uploads/');

define('SITE_NAME', envValue('SITE_NAME', '@synoize - Portfolio'));
define('SITE_DESCRIPTION', envValue('SITE_DESCRIPTION', 'Web & Android Developer from Bihar, India'));
define('DEVELOPER_EMAIL', envValue('DEVELOPER_EMAIL', 'shivamsingh.dev0@gmail.com'));
define('DEVELOPER_PHONE', envValue('DEVELOPER_PHONE', '+91 6205163577'));
define('WHATSAPP_LINK', envValue('WHATSAPP_LINK', 'https://wa.me/916205163577'));
define('LINKEDIN_LINK', envValue('LINKEDIN_LINK', 'https://linkedin.com/in/synoize'));
define('GITHUB_LINK', envValue('GITHUB_LINK', 'https://github.com/synoize'));
define('TWITTER_LINK', envValue('TWITTER_LINK', 'https://twitter.com/synoize'));
define('RESUME_URL', envValue('RESUME_URL', ));

class Database {
    private $connection;
    
    public function __construct() {
        try {
            $this->connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
            
            if ($this->connection->connect_error) {
                die("Connection failed: " . $this->connection->connect_error);
            }
            
            $this->connection->set_charset("utf8mb4");
        } catch (Exception $e) {
            die("Database Error: " . $e->getMessage());
        }
    }
    
    public function getConnection() {
        return $this->connection;
    }
    
    public function query($sql) {
        return $this->connection->query($sql);
    }
    
    public function prepare($sql) {
        return $this->connection->prepare($sql);
    }

    public function real_escape_string($value) {
        return $this->connection->real_escape_string($value);
    }
    
    public function close() {
        $this->connection->close();
    }
}

// Create database connection
$db = new Database();
?>
