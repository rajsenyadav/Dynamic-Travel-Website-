<?php
// File: config/config.php
// Database Configuration

define('DB_HOST', 'sql100.infinityfree.com');
define('DB_USER', 'if0_40560187');
define('DB_PASS', 'rajsen01');
define('DB_NAME', 'if0_40560187_avipro');

// Site Configuration
define('SITE_URL', 'http://rajxxen1st.rf.gd/');
define('ADMIN_URL', SITE_URL . 'admin/');

// File Upload Paths
define('UPLOAD_PATH', $_SERVER['DOCUMENT_ROOT'] . '/avipro-travels/assets/uploads/');
define('UPLOAD_URL', SITE_URL . 'assets/uploads/');

// Session Configuration
ini_set('session.gc_maxlifetime', 3600);
session_start();

// Database Connection
try {
    $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    
    if ($conn->connect_error) {
        throw new Exception("Connection failed: " . $conn->connect_error);
    }
    
    $conn->set_charset("utf8mb4");
} catch (Exception $e) {
    die("Database Connection Error: " . $e->getMessage());
}

// Helper Functions
function sanitize_input($data) {
    global $conn;
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $conn->real_escape_string($data);
}

function is_admin_logged_in() {
    return isset($_SESSION['admin_id']) && isset($_SESSION['admin_username']);
}

function redirect($url) {
    header("Location: " . $url);
    exit();
}

function get_setting($key) {
    global $conn;
    $key = sanitize_input($key);
    $sql = "SELECT setting_value FROM site_settings WHERE setting_key = '$key'";
    $result = $conn->query($sql);
    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return $row['setting_value'];
    }
    return '';
}
?>