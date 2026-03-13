<?php
require_once __DIR__ . '/../../database/config.php';
ensure_session();
$_SESSION = [];
session_destroy();
redirect('/backend/auth/login.php?ok=' . urlencode('تم تسجيل الخروج'));







