<?php
// Include necessary files
require_once '../includes/session.php';

// Destroy the session and redirect to the login page
session_destroy();
header('Location: login.php');
exit;
?>