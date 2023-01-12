<?php
session_start();
// Включаем функции и подключаемся к базе данных с помощью PDO MySQL
include 'functions.php';
$pdo = pdo_connect_mysql();
// Страница настроена на домашнюю (home.php) по умолчанию. Посетитель, посещая сайт впервые, попадает на эту страницу
$page = isset($_GET['page']) && file_exists($_GET['page'] . '.php') ? $_GET['page'] : 'home';
// Включить и показать запрошенную страницу
include $page . '.php';
