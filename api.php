<?php
include 'functions.php';
$pdo = pdo_connect_mysql();
$infoData = json_decode(file_get_contents('php://input'));
if ($infoData->action == 'addCart') {
   //Добавление записи в таблицу orders заказа от пользователя
   $stmt = $pdo->prepare('SELECT * FROM takeandhug WHERE id = ' . $infoData->id_tovar);
   $stmt->execute();
   $selected_products = $stmt->fetchAll(PDO::FETCH_ASSOC);
   print_r($selected_products);
   $sql = "INSERT INTO orders (id_tovar, id_user, name, quantity, color, size, price, img, rrp, sale, all_quantity, all_price, all_sale ) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?)";
   $stmt = $pdo->prepare($sql);
   $stmt->execute([$infoData->id_tovar, $infoData->id_user, $selected_products[0]['name'], $infoData->quantity, $selected_products[0]['color'], $infoData->size, $selected_products[0]['price'], $selected_products[0]['img'], $selected_products[0]['rrp'], $selected_products[0]['sale'], $selected_products[0]['quantity'], $infoData->quantity * $selected_products[0]['price'], $infoData->quantity * $selected_products[0]['sale']]);
   echo "true";
}
// Удаление товара из корзины и таблицы заказов
$delProduct = json_decode(file_get_contents('php://input'));
if ($delProduct->action == 'deleteIntoCart') {
   $stmt = $pdo->prepare('SELECT * FROM orders WHERE id = ' . $delProduct->id_product);
   $stmt->execute();
   $selected_products = $stmt->fetchAll(PDO::FETCH_ASSOC);
   print_r($selected_products);
   $id = $selected_products[0]['id'];
   echo $id;
   $sql = "DELETE FROM orders WHERE id LIKE '$id'";
   $stmt = $pdo->prepare($sql);
   $stmt->execute();
   echo "true";
}
// Уменьшение и удаление количества товара в корзине таблизе заказов
$Quantity = json_decode(file_get_contents('php://input'));
if ($Quantity->action == 'QuantIntoCart') {
   $stmt = $pdo->prepare('SELECT * FROM orders WHERE id = ' . $Quantity->id_product);
   $stmt->execute();
   $selected_products = $stmt->fetchAll(PDO::FETCH_ASSOC);
   print_r($selected_products);
   $quantity = $Quantity->quantity;
   echo $quantity;
   $all_sum = $quantity * $selected_products[0]['price'];
   $all_sale = $quantity * $selected_products[0]['sale'];
   $id = $selected_products[0]['id'];
   echo $id;
   echo $sale;
   $sql = "UPDATE orders SET quantity=?, all_price=?, all_sale=? WHERE id LIKE '$id'";
   $stmt = $pdo->prepare($sql);
   $stmt->execute([$quantity, $all_sum, $all_sale]);
   echo "true";
}
