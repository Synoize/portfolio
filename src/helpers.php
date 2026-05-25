<?php
/**
 * Portfolio Helper Functions
 * 
 * Utility functions for portfolio management and display
 */

function appUrl($path = '') {
    $base = defined('APP_BASE_PATH') ? APP_BASE_PATH : '';
    $path = '/' . ltrim($path, '/');
    return rtrim($base, '/') . ($path === '/' ? '/' : $path);
}

// Default admin-manageable asset subdirectory under public/
function assetSubdir() {
    return defined('ASSET_SUBDIR') ? ASSET_SUBDIR : 'uploads';
}

function stripBasePath($path) {
    $base = defined('APP_BASE_PATH') ? APP_BASE_PATH : '';
    $path = '/' . ltrim((string) $path, '/');

    if ($base !== '' && str_starts_with($path, $base)) {
        $path = substr($path, strlen($base)) ?: '/';
    }

    return '/' . ltrim($path, '/');
}

function contactEmail() {
    return defined('DEVELOPER_EMAIL') ? DEVELOPER_EMAIL : '';
}

function contactPhone() {
    return defined('DEVELOPER_PHONE') ? DEVELOPER_PHONE : '';
}

function emailUrl($email = null) {
    return 'mailto:' . ($email ?: contactEmail());
}

function phoneUrl($phone = null) {
    return 'tel:' . preg_replace('/[^+\d]/', '', $phone ?: contactPhone());
}

function socialUrl($name) {
    $links = [
        'whatsapp' => defined('WHATSAPP_LINK') ? WHATSAPP_LINK : '',
        'linkedin' => defined('LINKEDIN_LINK') ? LINKEDIN_LINK : '',
        'github' => defined('GITHUB_LINK') ? GITHUB_LINK : '',
        'twitter' => defined('TWITTER_LINK') ? TWITTER_LINK : '',
    ];

    return $links[strtolower($name)] ?? '#';
}

function resumeUrl() {
    $uploadedResume = getSiteSetting('resume_url');
    if ($uploadedResume !== '') {
        return $uploadedResume;
    }

    return defined('RESUME_URL') ? RESUME_URL : '';
}

function resumeDownloadUrl() {
    return resumeUrl() !== '' ? appUrl('/resume-download') : '#';
}

function localPublicFileFromUrl($url) {
    $url = (string) $url;
    if ($url === '') {
        return null;
    }

    $path = parse_url($url, PHP_URL_PATH);
    if (!$path) {
        return null;
    }

    $base = defined('BASE_URL') ? BASE_URL : '/';
    if ($base !== '/' && str_starts_with($path, $base)) {
        $path = substr($path, strlen($base));
    } else {
        $path = ltrim($path, '/');
    }

    $path = str_replace('\\', '/', $path);
    if (!str_starts_with($path, 'public/')) {
        return null;
    }

    $relative = substr($path, strlen('public/'));
    $relative = ltrim($relative, '/');
    if ($relative === '' || str_contains($relative, '..')) {
        return null;
    }

    $file = PUBLIC_PATH . $relative;
    return is_file($file) ? $file : null;
}

function downloadResume() {
    $resume = resumeUrl();
    if ($resume === '') {
        http_response_code(404);
        echo 'Resume not found.';
        exit;
    }

    $localFile = localPublicFileFromUrl($resume);
    if ($localFile) {
        header('Content-Type: application/pdf');
        header('Content-Disposition: attachment; filename="resume.pdf"');
        header('Content-Length: ' . filesize($localFile));
        header('Cache-Control: private, max-age=0, must-revalidate');
        readfile($localFile);
        exit;
    }

    header('Location: ' . $resume);
    exit;
}

function ensureAdminSetup() {
    global $db;
    $db->query("CREATE TABLE IF NOT EXISTS admin_users (
        id INT PRIMARY KEY AUTO_INCREMENT,
        username VARCHAR(100) NOT NULL UNIQUE,
        password_hash VARCHAR(255) NOT NULL,
        name VARCHAR(255) NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        last_login_at TIMESTAMP NULL
    )");

    $defaultHash = '$2y$10$BnQQof/8OGnjNAfs5/JncOTaOYFibdtqwY.N6TFelkem6LKNLKSuS';
    $stmt = $db->prepare("INSERT INTO admin_users (username, password_hash, name) VALUES ('admin', ?, 'Website Admin') ON DUPLICATE KEY UPDATE username = username");
    $stmt->bind_param("s", $defaultHash);
    $stmt->execute();
    $stmt->close();

    ensureColumnExists('projects', 'category', "VARCHAR(100) NOT NULL DEFAULT 'Web' AFTER title");
    ensureColumnExists('services', 'category', "VARCHAR(100) NOT NULL DEFAULT 'Web' AFTER title");
    ensureColumnExists('services', 'image_url', "VARCHAR(500) NULL AFTER description");
    ensureColumnExists('works', 'category', "VARCHAR(100) NOT NULL DEFAULT 'Web' AFTER title");
    ensureSiteSettings();
}

function ensureSiteSettings() {
    global $db;
    $db->query("CREATE TABLE IF NOT EXISTS site_settings (
        setting_key VARCHAR(100) PRIMARY KEY,
        setting_value LONGTEXT NULL,
        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    )");

    $defaults = array_fill_keys([
        'site_owner_name',
        'site_name',
        'site_description',
        'footer_copyright',
        'hero_greeting',
        'hero_title',
        'hero_description',
        'hero_profile_image_url',
        'primary_cta_label',
        'github_username',
        'projects_eyebrow',
        'projects_title',
        'projects_description',
        'works_eyebrow',
        'works_title',
        'services_eyebrow',
        'services_title',
        'services_description',
        'contact_eyebrow',
        'contact_title',
        'contact_description',
        'about_eyebrow',
        'about_title',
        'about_image_url',
        'about_experience_years',
        'about_happy_clients',
        'about_technologies',
        'about_body',
        'resume_url',
    ], '');

    foreach ($defaults as $key => $value) {
        $stmt = $db->prepare("INSERT INTO site_settings (setting_key, setting_value) VALUES (?, ?) ON DUPLICATE KEY UPDATE setting_key = setting_key");
        $stmt->bind_param("ss", $key, $value);
        $stmt->execute();
        $stmt->close();
    }
}

function ensureColumnExists($table, $column, $definition) {
    global $db;
    $table = preg_replace('/[^a-z_]/', '', $table);
    $column = preg_replace('/[^a-z_]/', '', $column);
    $result = $db->query("SHOW COLUMNS FROM {$table} LIKE '{$column}'");

    if ($result && $result->num_rows === 0) {
        $db->query("ALTER TABLE {$table} ADD COLUMN {$column} {$definition}");
    }
}

function redirectTo($path) {
    header('Location: ' . appUrl($path));
    exit;
}

function setFlash($type, $message) {
    $_SESSION[$type] = $message;
}

function csrfToken() {
    if (empty($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf_token'];
}

function verifyCsrfToken() {
    $token = $_POST['_token'] ?? '';
    if (empty($_SESSION['csrf_token']) || !hash_equals($_SESSION['csrf_token'], $token)) {
        setFlash('error', 'Security token expired. Please try again.');
        redirectTo('/admin/login');
    }
}

function isAdminLoggedIn() {
    return !empty($_SESSION['admin_user']);
}

function requireAdmin() {
    if (!isAdminLoggedIn()) {
        redirectTo('/admin/login');
    }
}

function getAdminByUsername($username) {
    global $db;
    $stmt = $db->prepare("SELECT * FROM admin_users WHERE username = ? LIMIT 1");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $admin = $result->fetch_assoc();
    $stmt->close();
    return $admin;
}

function adminAllowedTable($table) {
    return in_array($table, ['projects', 'services', 'works', 'skills', 'messages'], true);
}

function getAdminRows($table) {
    global $db;
    if (!adminAllowedTable($table)) {
        return [];
    }

    $orders = [
        'projects' => 'featured DESC, created_at DESC',
        'services' => 'order_by ASC, created_at DESC',
        'works' => 'featured DESC, created_at DESC',
        'skills' => 'category ASC, order_by ASC',
        'messages' => 'created_at DESC',
    ];

    return $db->query("SELECT * FROM {$table} ORDER BY {$orders[$table]}")->fetch_all(MYSQLI_ASSOC);
}

function getAdminRecord($table, $id) {
    global $db;
    if (!adminAllowedTable($table)) {
        return null;
    }

    $id = intval($id);
    $result = $db->query("SELECT * FROM {$table} WHERE id = {$id} LIMIT 1");
    return $result ? $result->fetch_assoc() : null;
}

function deleteAdminRecord($table, $id) {
    global $db;
    if (!adminAllowedTable($table)) {
        return false;
    }

    $id = intval($id);
    return $db->query("DELETE FROM {$table} WHERE id = {$id}");
}

function boolFromPost($name) {
    return isset($_POST[$name]) ? 1 : 0;
}

function getSiteSetting($key, $default = '') {
    global $db;
    $stmt = $db->prepare("SELECT setting_value FROM site_settings WHERE setting_key = ? LIMIT 1");
    if (!$stmt) {
        return $default;
    }

    $stmt->bind_param("s", $key);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result ? $result->fetch_assoc() : null;
    $stmt->close();

    return $row && $row['setting_value'] !== null ? $row['setting_value'] : $default;
}

function getSiteSettings($keys) {
    $settings = [];
    foreach ($keys as $key => $default) {
        $settings[$key] = getSiteSetting($key, $default);
    }
    return $settings;
}

function saveSiteSetting($key, $value) {
    global $db;
    $stmt = $db->prepare("INSERT INTO site_settings (setting_key, setting_value) VALUES (?, ?) ON DUPLICATE KEY UPDATE setting_value = VALUES(setting_value)");
    $stmt->bind_param("ss", $key, $value);
    $saved = $stmt->execute();
    $stmt->close();
    return $saved;
}

function aboutSettings() {
    return getSiteSettings([
        'site_owner_name' => '',
        'hero_profile_image_url' => '',
        'primary_cta_label' => '',
        'github_username' => '',
        'about_eyebrow' => '',
        'about_title' => '',
        'about_image_url' => '',
        'about_experience_years' => '',
        'about_happy_clients' => '',
        'about_technologies' => '',
        'about_body' => '',
        'resume_url' => resumeUrl(),
    ]);
}

function contentSettings() {
    return getSiteSettings([
        'site_owner_name' => '',
        'site_name' => '',
        'site_description' => '',
        'footer_copyright' => '',
        'hero_greeting' => '',
        'hero_title' => '',
        'hero_description' => '',
        'hero_profile_image_url' => '',
        'primary_cta_label' => '',
        'github_username' => '',
        'projects_eyebrow' => '',
        'projects_title' => '',
        'projects_description' => '',
        'works_eyebrow' => '',
        'works_title' => '',
        'services_eyebrow' => '',
        'services_title' => '',
        'services_description' => '',
        'contact_eyebrow' => '',
        'contact_title' => '',
        'contact_description' => '',
    ]);
}

function settingParagraphs($text) {
    return array_filter(array_map('trim', preg_split("/\R{2,}/", (string) $text)));
}

function handleAdminResumeUpload($field, $currentValue = '') {
    if (empty($_FILES[$field]) || $_FILES[$field]['error'] === UPLOAD_ERR_NO_FILE) {
        return $currentValue;
    }

    if ($_FILES[$field]['error'] !== UPLOAD_ERR_OK) {
        setFlash('error', 'Resume upload failed. Please try again.');
        return false;
    }

    if ($_FILES[$field]['size'] > 10 * 1024 * 1024) {
        setFlash('error', 'Resume PDF must be 10MB or smaller.');
        return false;
    }

    $tmpPath = $_FILES[$field]['tmp_name'];
    $mime = function_exists('mime_content_type') ? mime_content_type($tmpPath) : '';
    $ext = strtolower(pathinfo($_FILES[$field]['name'] ?? '', PATHINFO_EXTENSION));

    $allowedPdfMimes = ['', 'application/pdf', 'application/x-pdf', 'application/octet-stream'];
    if ($ext !== 'pdf' || !in_array($mime, $allowedPdfMimes, true)) {
        setFlash('error', 'Only PDF resume uploads are allowed.');
        return false;
    }

    $uploadDir = PUBLIC_UPLOADS_PATH . 'resume';
    if (!is_dir($uploadDir) && !mkdir($uploadDir, 0755, true)) {
        setFlash('error', 'Resume upload folder could not be created.');
        return false;
    }

    $filename = 'resume-' . date('YmdHis') . '-' . bin2hex(random_bytes(6)) . '.pdf';
    $destination = $uploadDir . '/' . $filename;

    if (!move_uploaded_file($tmpPath, $destination)) {
        setFlash('error', 'Uploaded resume could not be saved.');
        return false;
    }

    return PUBLIC_UPLOADS_URL . 'resume/' . $filename;
}

function uploadSubdirPath($subdir = '') {
    $subdir = trim((string) $subdir, "/\\");
    $subdir = preg_replace('/[^a-zA-Z0-9_\/-]/', '', $subdir);
    $subdir = trim($subdir, "/\\");
    return $subdir === '' ? '' : $subdir . '/';
}

function handleAdminImageUpload($field, $currentValue = '', $subdir = '') {
    if (empty($_FILES[$field]) || $_FILES[$field]['error'] === UPLOAD_ERR_NO_FILE) {
        return $currentValue;
    }

    if ($_FILES[$field]['error'] !== UPLOAD_ERR_OK) {
        setFlash('error', 'Image upload failed. Please try again.');
        return false;
    }

    if ($_FILES[$field]['size'] > 5 * 1024 * 1024) {
        setFlash('error', 'Image must be 5MB or smaller.');
        return false;
    }

    $tmpPath = $_FILES[$field]['tmp_name'];
    $mime = function_exists('mime_content_type') ? mime_content_type($tmpPath) : '';
    $extensions = [
        'image/jpeg' => 'jpg',
        'image/png' => 'png',
        'image/gif' => 'gif',
        'image/webp' => 'webp',
    ];

    if (!isset($extensions[$mime])) {
        setFlash('error', 'Only JPG, PNG, GIF, and WebP images are allowed.');
        return false;
    }

    $subdirPath = uploadSubdirPath($subdir);
    $uploadDir = PUBLIC_UPLOADS_PATH . $subdirPath;
    if (!is_dir($uploadDir) && !mkdir($uploadDir, 0755, true)) {
        setFlash('error', 'Upload folder could not be created.');
        return false;
    }

    $filename = date('YmdHis') . '-' . bin2hex(random_bytes(8)) . '.' . $extensions[$mime];
    $destination = $uploadDir . '/' . $filename;

    if (!move_uploaded_file($tmpPath, $destination)) {
        setFlash('error', 'Uploaded image could not be saved.');
        return false;
    }

    return PUBLIC_UPLOADS_URL . $subdirPath . $filename;
}

// Generic asset upload for admin (accepts any file type)
function handleAdminAssetUpload($field, $currentValue = '', $subdir = null, $namespace = null) {
    $subdir = $subdir ?: assetSubdir();
    if (empty($_FILES[$field]) || $_FILES[$field]['error'] === UPLOAD_ERR_NO_FILE) {
        return $currentValue;
    }

    if ($_FILES[$field]['error'] !== UPLOAD_ERR_OK) {
        setFlash('error', 'File upload failed. Please try again.');
        return false;
    }

    if ($_FILES[$field]['size'] > 10 * 1024 * 1024) {
        setFlash('error', 'File must be 10MB or smaller.');
        return false;
    }

    $tmpPath = $_FILES[$field]['tmp_name'];
    $origName = $_FILES[$field]['name'] ?? '';
    $ext = strtolower(pathinfo($origName, PATHINFO_EXTENSION));
    $ext = preg_replace('/[^a-z0-9]/', '', $ext);

    if ($ext === '') {
        setFlash('error', 'Uploaded file has no valid extension.');
        return false;
    }

    $uploadDir = PUBLIC_PATH . trim($subdir, '/');
    $publicPathPrefix = trim($subdir, '/');
    if (!is_dir($uploadDir) && !mkdir($uploadDir, 0755, true)) {
        setFlash('error', 'Upload folder could not be created.');
        return false;
    }

    $filename = date('YmdHis') . '-' . bin2hex(random_bytes(8)) . '.' . $ext;
    $destination = $uploadDir . '/' . $filename;

    if (!move_uploaded_file($tmpPath, $destination)) {
        setFlash('error', 'Uploaded file could not be saved.');
        return false;
    }

    return PUBLIC_URL . $publicPathPrefix . '/' . $filename;
}

// List files in public subdirectory (e.g., uploads)
function listAdminAssets($subdir = null, $namespace = null) {
    $subdir = $subdir ?: assetSubdir();
    $dir = PUBLIC_PATH . trim($subdir, '/');
    $urlPrefix = trim($subdir, '/');
    $files = [];

    if (!is_dir($dir)) {
        return $files;
    }

    foreach (scandir($dir) as $f) {
        if ($f === '.' || $f === '..') continue;
        $files[] = [
            'name' => $f,
            'url' => PUBLIC_URL . $urlPrefix . '/' . $f,
            'path' => $dir . '/' . $f,
        ];
    }

    return $files;
}

// Delete an asset file from public folder by relative path (e.g., uploads/filename.jpg)
function deleteAdminAsset($relativePath, $subdir = null, $namespace = null) {
    $subdir = $subdir ?: assetSubdir();
    $relativePath = ltrim((string) $relativePath, '/');

    if (strpos($relativePath, '/') === false) {
        $file = PUBLIC_PATH . trim($subdir, '/') . '/' . $relativePath;
    } else {
        $file = PUBLIC_PATH . $relativePath;
    }

    if (!file_exists($file) || !is_file($file)) {
        return false;
    }

    return @unlink($file);
}

function saveAdminProject() {
    global $db;
    $id = intval($_POST['id'] ?? 0);
    $existing = $id > 0 ? getAdminRecord('projects', $id) : null;
    $title = trim($_POST['title'] ?? '');
    $category = trim($_POST['category'] ?? 'Web');
    $description = trim($_POST['description'] ?? '');
    $image_url = $existing['image_url'] ?? '';
    $image_url = handleAdminImageUpload('image_file', $image_url, 'projects');
    if ($image_url === false) {
        return false;
    }
    $url = trim($_POST['url'] ?? '');
    $github_url = trim($_POST['github_url'] ?? '');
    $technologies = trim($_POST['technologies'] ?? '');
    $status = trim($_POST['status'] ?? 'active');
    $featured = boolFromPost('featured');

    if ($id > 0) {
        $stmt = $db->prepare("UPDATE projects SET title = ?, category = ?, description = ?, image_url = ?, url = ?, github_url = ?, technologies = ?, status = ?, featured = ? WHERE id = ?");
        $stmt->bind_param("ssssssssii", $title, $category, $description, $image_url, $url, $github_url, $technologies, $status, $featured, $id);
    } else {
        $stmt = $db->prepare("INSERT INTO projects (title, category, description, image_url, url, github_url, technologies, status, featured) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssssssi", $title, $category, $description, $image_url, $url, $github_url, $technologies, $status, $featured);
    }

    $saved = $stmt->execute();
    $stmt->close();
    return $saved;
}

function saveAdminService() {
    global $db;
    $id = intval($_POST['id'] ?? 0);
    $existing = $id > 0 ? getAdminRecord('services', $id) : null;
    $title = trim($_POST['title'] ?? '');
    $category = trim($_POST['category'] ?? 'Web');
    $description = trim($_POST['description'] ?? '');
    $image_url = $existing['image_url'] ?? '';
    $image_url = handleAdminImageUpload('image_file', $image_url, 'services');
    if ($image_url === false) {
        return false;
    }
    $icon = trim($_POST['icon'] ?? '');
    $order_by = intval($_POST['order_by'] ?? 0);

    if ($id > 0) {
        $stmt = $db->prepare("UPDATE services SET title = ?, category = ?, description = ?, image_url = ?, icon = ?, order_by = ? WHERE id = ?");
        $stmt->bind_param("sssssii", $title, $category, $description, $image_url, $icon, $order_by, $id);
    } else {
        $stmt = $db->prepare("INSERT INTO services (title, category, description, image_url, icon, order_by) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssssi", $title, $category, $description, $image_url, $icon, $order_by);
    }

    $saved = $stmt->execute();
    $stmt->close();
    return $saved;
}

function saveAdminWork() {
    global $db;
    $id = intval($_POST['id'] ?? 0);
    $existing = $id > 0 ? getAdminRecord('works', $id) : null;
    $title = trim($_POST['title'] ?? '');
    $category = trim($_POST['category'] ?? 'Web');
    $description = trim($_POST['description'] ?? '');
    $image_url = $existing['image_url'] ?? '';
    $image_url = handleAdminImageUpload('image_file', $image_url, 'works');
    if ($image_url === false) {
        return false;
    }
    $technologies = trim($_POST['technologies'] ?? '');
    $url = trim($_POST['url'] ?? '');
    $case_study = trim($_POST['case_study'] ?? '');
    $featured = boolFromPost('featured');

    if ($id > 0) {
        $stmt = $db->prepare("UPDATE works SET title = ?, category = ?, description = ?, image_url = ?, technologies = ?, url = ?, case_study = ?, featured = ? WHERE id = ?");
        $stmt->bind_param("sssssssii", $title, $category, $description, $image_url, $technologies, $url, $case_study, $featured, $id);
    } else {
        $stmt = $db->prepare("INSERT INTO works (title, category, description, image_url, technologies, url, case_study, featured) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssssssi", $title, $category, $description, $image_url, $technologies, $url, $case_study, $featured);
    }

    $saved = $stmt->execute();
    $stmt->close();
    return $saved;
}

function saveAdminSkill() {
    global $db;
    $id = intval($_POST['id'] ?? 0);
    $name = trim($_POST['name'] ?? '');
    $category = trim($_POST['category'] ?? '');
    $proficiency = intval($_POST['proficiency'] ?? 80);
    $order_by = intval($_POST['order_by'] ?? 0);

    if ($id > 0) {
        $stmt = $db->prepare("UPDATE skills SET name = ?, category = ?, proficiency = ?, order_by = ? WHERE id = ?");
        $stmt->bind_param("ssiii", $name, $category, $proficiency, $order_by, $id);
    } else {
        $stmt = $db->prepare("INSERT INTO skills (name, category, proficiency, order_by) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssii", $name, $category, $proficiency, $order_by);
    }

    $saved = $stmt->execute();
    $stmt->close();
    return $saved;
}

function saveAdminAboutSettings() {
    $settings = [
        'site_owner_name' => trim($_POST['site_owner_name'] ?? ''),
        'site_name' => trim($_POST['site_name'] ?? ''),
        'site_description' => trim($_POST['site_description'] ?? ''),
        'footer_copyright' => trim($_POST['footer_copyright'] ?? ''),
        'hero_greeting' => trim($_POST['hero_greeting'] ?? ''),
        'hero_title' => trim($_POST['hero_title'] ?? ''),
        'hero_description' => trim($_POST['hero_description'] ?? ''),
        'primary_cta_label' => trim($_POST['primary_cta_label'] ?? ''),
        'github_username' => trim($_POST['github_username'] ?? ''),
        'projects_eyebrow' => trim($_POST['projects_eyebrow'] ?? ''),
        'projects_title' => trim($_POST['projects_title'] ?? ''),
        'projects_description' => trim($_POST['projects_description'] ?? ''),
        'works_eyebrow' => trim($_POST['works_eyebrow'] ?? ''),
        'works_title' => trim($_POST['works_title'] ?? ''),
        'services_eyebrow' => trim($_POST['services_eyebrow'] ?? ''),
        'services_title' => trim($_POST['services_title'] ?? ''),
        'services_description' => trim($_POST['services_description'] ?? ''),
        'contact_eyebrow' => trim($_POST['contact_eyebrow'] ?? ''),
        'contact_title' => trim($_POST['contact_title'] ?? ''),
        'contact_description' => trim($_POST['contact_description'] ?? ''),
        'about_eyebrow' => trim($_POST['about_eyebrow'] ?? ''),
        'about_title' => trim($_POST['about_title'] ?? ''),
        'about_experience_years' => trim($_POST['about_experience_years'] ?? ''),
        'about_happy_clients' => trim($_POST['about_happy_clients'] ?? ''),
        'about_technologies' => trim($_POST['about_technologies'] ?? ''),
        'about_body' => trim($_POST['about_body'] ?? ''),
    ];

    $imageUrl = handleAdminImageUpload('about_image_file', getSiteSetting('about_image_url'), 'about');
    if ($imageUrl === false) {
        return false;
    }
    $settings['about_image_url'] = $imageUrl;

    $profileImageUrl = handleAdminImageUpload('hero_profile_image_file', getSiteSetting('hero_profile_image_url'), 'profile');
    if ($profileImageUrl === false) {
        return false;
    }
    $settings['hero_profile_image_url'] = $profileImageUrl;

    $resumeUrl = handleAdminResumeUpload('resume_file', getSiteSetting('resume_url'));
    if ($resumeUrl === false) {
        return false;
    }
    $manualResumeUrl = trim($_POST['resume_url'] ?? '');
    $settings['resume_url'] = $manualResumeUrl !== '' ? $manualResumeUrl : $resumeUrl;

    foreach ($settings as $key => $value) {
        if (!saveSiteSetting($key, $value)) {
            return false;
        }
    }

    return true;
}

function normalizeCategoryFilter($category) {
    $category = trim((string) $category);
    return $category === '' || strtolower($category) === 'all' ? null : $category;
}

function getContentCategories($table) {
    global $db;
    if (!in_array($table, ['projects', 'services', 'works'], true)) {
        return [];
    }

    $result = $db->query("SELECT DISTINCT category FROM {$table} WHERE category IS NOT NULL AND category != '' ORDER BY category ASC");
    return $result ? array_column($result->fetch_all(MYSQLI_ASSOC), 'category') : [];
}

// Get all projects
function getProjects($limit = null, $category = null) {
    global $db;
    $category = normalizeCategoryFilter($category);
    $query = "SELECT * FROM projects";
    if ($category) {
        $safeCategory = $db->real_escape_string($category);
        $query .= " WHERE category = '{$safeCategory}'";
    }
    $query .= " ORDER BY featured DESC, created_at DESC";
    if ($limit) {
        $query .= " LIMIT " . intval($limit);
    }
    return $db->query($query)->fetch_all(MYSQLI_ASSOC);
}

// Get all services
function getServices($category = null) {
    global $db;
    $category = normalizeCategoryFilter($category);
    $query = "SELECT * FROM services";
    if ($category) {
        $safeCategory = $db->real_escape_string($category);
        $query .= " WHERE category = '{$safeCategory}'";
    }
    $query .= " ORDER BY order_by ASC";
    return $db->query($query)->fetch_all(MYSQLI_ASSOC);
}

// Get all works
function getWorks($limit = null, $category = null) {
    global $db;
    $category = normalizeCategoryFilter($category);
    $query = "SELECT * FROM works";
    if ($category) {
        $safeCategory = $db->real_escape_string($category);
        $query .= " WHERE category = '{$safeCategory}'";
    }
    $query .= " ORDER BY featured DESC, created_at DESC";
    if ($limit) {
        $query .= " LIMIT " . intval($limit);
    }
    return $db->query($query)->fetch_all(MYSQLI_ASSOC);
}

// Get all skills
function getSkills($category = null) {
    global $db;
    if ($category) {
        $category = $db->real_escape_string($category);
        return $db->query("SELECT * FROM skills WHERE category = '$category' ORDER BY order_by ASC")->fetch_all(MYSQLI_ASSOC);
    }
    return $db->query("SELECT * FROM skills ORDER BY category ASC, order_by ASC")->fetch_all(MYSQLI_ASSOC);
}

// Get all experience
function getExperience() {
    global $db;
    return $db->query("SELECT * FROM experience ORDER BY is_current DESC, start_date DESC")->fetch_all(MYSQLI_ASSOC);
}

// Get social links
function getSocialLinks() {
    global $db;
    return $db->query("SELECT * FROM social_links")->fetch_all(MYSQLI_ASSOC);
}

// Get messages (unread count or all)
function getMessages($unread_only = false) {
    global $db;
    $query = "SELECT * FROM messages";
    if ($unread_only) {
        $query .= " WHERE is_read = FALSE";
    }
    $query .= " ORDER BY created_at DESC";
    return $db->query($query)->fetch_all(MYSQLI_ASSOC);
}

// Mark message as read
function markMessageAsRead($id) {
    global $db;
    $id = intval($id);
    return $db->query("UPDATE messages SET is_read = TRUE WHERE id = $id");
}

// Delete message
function deleteMessage($id) {
    global $db;
    $id = intval($id);
    return $db->query("DELETE FROM messages WHERE id = $id");
}

// Get unread message count
function getUnreadMessageCount() {
    global $db;
    $result = $db->query("SELECT COUNT(*) as count FROM messages WHERE is_read = FALSE");
    $data = $result->fetch_assoc();
    return $data['count'];
}

// Add project
function addProject($title, $description, $technologies, $url = null, $github_url = null, $featured = false) {
    global $db;
    $title = $db->real_escape_string($title);
    $description = $db->real_escape_string($description);
    $technologies = $db->real_escape_string($technologies);
    $url = $url ? $db->real_escape_string($url) : null;
    $github_url = $github_url ? $db->real_escape_string($github_url) : null;
    $featured = $featured ? 1 : 0;
    
    return $db->query("INSERT INTO projects (title, description, technologies, url, github_url, featured) 
                      VALUES ('$title', '$description', '$technologies', '$url', '$github_url', $featured)");
}

// Add skill
function addSkill($name, $category, $proficiency = 80) {
    global $db;
    $name = $db->real_escape_string($name);
    $category = $db->real_escape_string($category);
    $proficiency = intval($proficiency);
    
    return $db->query("INSERT INTO skills (name, category, proficiency) 
                      VALUES ('$name', '$category', $proficiency)");
}

// Add experience
function addExperience($company, $position, $start_date, $end_date = null, $description = null, $is_current = false) {
    global $db;
    $company = $db->real_escape_string($company);
    $position = $db->real_escape_string($position);
    $description = $description ? $db->real_escape_string($description) : null;
    $is_current = $is_current ? 1 : 0;
    
    return $db->query("INSERT INTO experience (company_name, position, start_date, end_date, description, is_current) 
                      VALUES ('$company', '$position', '$start_date', '$end_date', '$description', $is_current)");
}

// Format date nicely
function formatDate($date, $format = 'M d, Y') {
    return date($format, strtotime($date));
}

// Truncate text
function truncateText($text, $length = 100) {
    if (strlen($text) > $length) {
        return substr($text, 0, $length) . '...';
    }
    return $text;
}

// Sanitize output
function sanitize($text) {
    return htmlspecialchars((string) $text, ENT_QUOTES, 'UTF-8');
}

function technologyBadges($technologies) {
    $items = array_filter(array_map('trim', explode(',', (string) $technologies)));
    return $items;
}

?>
