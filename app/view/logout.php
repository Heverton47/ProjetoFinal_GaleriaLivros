<?php
require_once __DIR__ . '/../core/Seguranca.php';

Seguranca::iniciarSessao();
session_destroy();

header('Location: login.php');
exit;
