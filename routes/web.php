<?php
// Web Routes

$router->get('/', 'landing');
$router->get('/about', 'about');
$router->get('/services', 'services');
$router->get('/my-work', 'my-work');
$router->get('/our-work', function() {
    redirectTo('/my-work');
});
$router->get('/projects', 'projects');
$router->get('/contact', 'contact');
$router->get('/resume-download', function() {
    downloadResume();
});

// Admin Routes
$router->get('/admin/login', 'admin/login');

$router->post('/admin/login', function() {
    verifyCsrfToken();

    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';
    $admin = getAdminByUsername($username);

    if ($admin && password_verify($password, $admin['password_hash'])) {
        session_regenerate_id(true);
        $_SESSION['admin_user'] = [
            'id' => $admin['id'],
            'username' => $admin['username'],
            'name' => $admin['name'],
        ];
        $GLOBALS['db']->query("UPDATE admin_users SET last_login_at = NOW() WHERE id = " . intval($admin['id']));
        redirectTo('/admin');
    }

    setFlash('error', 'Invalid admin username or password.');
    redirectTo('/admin/login');
});

$router->get('/admin/logout', function() {
    unset($_SESSION['admin_user']);
    setFlash('success', 'You have been logged out.');
    redirectTo('/admin/login');
});

$router->get('/admin', function() {
    requireAdmin();
    return 'admin/dashboard';
});

$router->get('/admin/projects', function() {
    requireAdmin();
    return 'admin/projects';
});

$router->get('/admin/services', function() {
    requireAdmin();
    return 'admin/services';
});

$router->get('/admin/about', function() {
    requireAdmin();
    return 'admin/about';
});

$router->get('/admin/works', function() {
    requireAdmin();
    return 'admin/works';
});

$router->get('/admin/skills', function() {
    requireAdmin();
    return 'admin/skills';
});

$router->get('/admin/messages', function() {
    requireAdmin();
    return 'admin/messages';
});

$router->post('/admin/projects/save', function() {
    requireAdmin();
    verifyCsrfToken();
    $saved = saveAdminProject();
    setFlash($saved ? 'success' : 'error', $saved ? 'Project saved.' : 'Project could not be saved.');
    redirectTo('/admin/projects');
});

$router->post('/admin/services/save', function() {
    requireAdmin();
    verifyCsrfToken();
    $saved = saveAdminService();
    setFlash($saved ? 'success' : 'error', $saved ? 'Service saved.' : 'Service could not be saved.');
    redirectTo('/admin/services');
});

$router->post('/admin/about/save', function() {
    requireAdmin();
    verifyCsrfToken();
    $saved = saveAdminAboutSettings();
    setFlash($saved ? 'success' : 'error', $saved ? 'About content saved.' : 'About content could not be saved.');
    redirectTo('/admin/about');
});

$router->post('/admin/works/save', function() {
    requireAdmin();
    verifyCsrfToken();
    $saved = saveAdminWork();
    setFlash($saved ? 'success' : 'error', $saved ? 'Work item saved.' : 'Work item could not be saved.');
    redirectTo('/admin/works');
});

$router->post('/admin/skills/save', function() {
    requireAdmin();
    verifyCsrfToken();
    $saved = saveAdminSkill();
    setFlash($saved ? 'success' : 'error', $saved ? 'Skill saved.' : 'Skill could not be saved.');
    redirectTo('/admin/skills');
});

$router->post('/admin/delete', function() {
    requireAdmin();
    verifyCsrfToken();
    $table = $_POST['table'] ?? '';
    $id = intval($_POST['id'] ?? 0);

    if ($table === 'messages') {
        $deleted = deleteMessage($id);
    } else {
        $deleted = deleteAdminRecord($table, $id);
    }

    setFlash($deleted ? 'success' : 'error', $deleted ? 'Record deleted.' : 'Record could not be deleted.');
    redirectTo('/admin/' . ($table === 'works' ? 'works' : $table));
});

$router->post('/admin/messages/read', function() {
    requireAdmin();
    verifyCsrfToken();
    $id = intval($_POST['id'] ?? 0);
    setFlash(markMessageAsRead($id) ? 'success' : 'error', 'Message updated.');
    redirectTo('/admin/messages');
});

// POST Routes
$router->post('/contact', function() {
    // Handle contact form submission
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $name = htmlspecialchars($_POST['name'] ?? '');
        $email = htmlspecialchars($_POST['email'] ?? '');
        $phone = htmlspecialchars($_POST['phone'] ?? '');
        $subject = htmlspecialchars($_POST['subject'] ?? '');
        $message = htmlspecialchars($_POST['message'] ?? '');
        
        // Validate
        if (!empty($name) && !empty($email) && !empty($message)) {
            global $db;
            $stmt = $db->prepare("INSERT INTO messages (name, email, phone, subject, message) VALUES (?, ?, ?, ?, ?)");
            $stmt->bind_param("sssss", $name, $email, $phone, $subject, $message);
            
            if ($stmt->execute()) {
                $_SESSION['success'] = "Message sent successfully!";
            } else {
                $_SESSION['error'] = "Failed to send message.";
            }
            $stmt->close();
        }
    }
    return 'contact';
});
?>
