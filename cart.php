<?php
// Товар попадает в корзину при нажатии на кнопку "Добавить в корзину" на странице product.php. 
//Нужно сделать так, чтобы товар добавлялся в корзину в 1 клик при нажатии кнопки на миниатюре 
//(популярные товары на странице home.php) + размер товара
if (isset($_POST['product_id'], $_POST['quantity']) && is_numeric($_POST['product_id']) && is_numeric($_POST['quantity'])) {
   $product_id = (int)$_POST['product_id'];
   $quantity = (int)$_POST['quantity'];
   $stmt = $pdo->prepare('SELECT * FROM takeandhug WHERE id = ?');
   $stmt->execute([$_POST['product_id']]);
   $product = $stmt->fetch(PDO::FETCH_ASSOC);
   if ($product && $quantity > 0) {
      if (isset($_SESSION['cart']) && is_array($_SESSION['cart'])) {
         if (array_key_exists($product_id, $_SESSION['cart'])) {
            $_SESSION['cart'][$product_id] += $quantity;
         } else {
            $_SESSION['cart'][$product_id] = $quantity;
         }
      } else {
         $_SESSION['cart'] = array($product_id => $quantity);
      }
   }
   header('location: index.php?page=cart');
   exit;
}

// Удалить товар из корзины
if (isset($_GET['remove']) && is_numeric($_GET['remove']) && isset($_SESSION['cart']) && isset($_SESSION['cart'][$_GET['remove']])) {
   unset($_SESSION['cart'][$_GET['remove']]);
}

// Подключены кнопки plus и minus, при нажатии на них изменяется количество товара, введеное пользователем в input. Но нужно сделать так, чтобы количество товара увеличивалось или уменбшалось 
if (isset($_POST['update']) && isset($_SESSION['cart'])) {
   foreach ($_POST as $k => $v) {
      if (strpos($k, 'quantity') !== false && is_numeric($v)) {
         $id = str_replace('quantity-', '', $k);
         $quantity = (int)$v;
         if (is_numeric($id) && isset($_SESSION['cart'][$id]) && $quantity > 0) {
            $_SESSION['cart'][$id] = $quantity;
         }
      }
   }
   header('location: index.php?page=cart');
   exit;
}

// Проверка сессии для продуктов вкорзине
$products_in_cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : array();
$products = array();
$subtotal = 0.00;
$sale = 0.00;
// Массив продуктов в корзине
if ($products_in_cart) {
   $array_to_question_marks = implode(',', array_fill(0, count($products_in_cart), '?'));
   $stmt = $pdo->prepare('SELECT * FROM takeandhug WHERE id IN (' . $array_to_question_marks . ')');
   $stmt->execute(array_keys($products_in_cart));
   $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
   foreach ($products as $product) {
      $subtotal += (float)$product['price'] * (int)$products_in_cart[$product['id']];
   }
   foreach ($products as $product) {
      $sale += (float)$product['sale'] * (int)$products_in_cart[$product['id']];
   }
}

// Страница благодарности
if (isset($_POST['placeorder']) && isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
   header('Location: index.php?page=placeorder');
   exit;
}

?>

<!DOCTYPE html>
<html>

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
   <link rel="stylesheet" href="styles/style.css">
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css" />
   <title>Корзина</title>
</head>

<body>
   <div class="container-fluid ">
      <div class="row">
         <div class="col-12 d-flex justify-content-center">
            <div class="cart-logo">
               <a href="http://localhost:8080/sites/takeandhug/index.php?page=1"><img class="" src="images/logo.svg" alt="Взять и обнять"></a>
            </div>
         </div>
      </div>
   </div>
   <div class="container">
      <div class="row">
         <div class="field-top col-12 col-xl-6">
            <div class="cart-product position-relative">
               <form class="" action="index.php?page=cart" method="post">
                  <?php if (empty($products)) : ?>
                     <div>
                        <h2>Корзина пуста</h2>
                     </div>
                  <?php else : ?>
                     <?php foreach ($products as $product) : ?>
                        <div class="cart-product position-relative">
                           <div class="cart-product__img">
                              <a href="index.php?page=product&id=<?= $product['id'] ?>"><img src="images/<?= $product['img'] ?>" alt="<?= $product['name'] ?>"></a>
                           </div>
                           <div class="cart-product__wrapper-xs  position-relative">
                              <div class="cart-item__delete position-absolute d-block d-sm-none" style="margin-right: 50px;">
                                 <a href="index.php?page=cart&remove=<?= $product['id'] ?>" class="">Удалить <span>Х</span></a>
                              </div>
                              <div class="wrapper-xs__name d-block d-sm-none">
                                 <a href="index.php?page=product&id=<?= $product['id'] ?>"><?= $product['name'] ?></a>
                              </div>
                              <h6 class="wrapper-xs__price d-block d-sm-none"><?= $product['price'] * $products_in_cart[$product['id']] . " руб." ?> <span class="cart-product__wrapper-calc">
                                    <small>
                                       <?php if (intval($product['rrp']) > 0) {
                                          echo $product['rrp'] . " руб.";
                                       }
                                       ?>
                                    </small>
                                 </span></h6>
                              <p class="cart-product__wrapper-calc d-block d-sm-none"><?= $products_in_cart[$product['id']] . "X" . $product['price'] . " руб." ?></p>
                              <div class="position-absolute bottom-0 wrapper-xs__all">
                                 <!--не понимаю как подключить кнопки, чтобы при нажатии на plus количество товаров увеличивалось, а на minus - уменьшалось-->
                                 <div class="input-quontity">
                                    <span class="input-quantity__title">Количество:</span>
                                    <div class="input-quantity__wrap ">
                                       <input id="" type="submit" class="input-quantity__wrap-btn card-info__num-button decrease" value="–" name="update">
                                       <input id="" class="input-quantity__wrap-btn" type="number" name="quantity-<?= $product['id'] ?>" value="<?= $products_in_cart[$product['id']] ?>" min="1" max="<?= $product['quantity'] ?>" placeholder="Quantity" required>
                                       <input id="" type="submit" class="input-quantity__wrap-btn card-info__num-button increase" value="+" name="update">

                                    </div>
                                 </div>
                                 <!--не понимаю как сделать так, чтобы на странице товара (product.php) и в миниатюре товара на странице home.php выбранный размер товара отображался здесь-->
                                 <div class="cart-item__size"><span class="cart-item__size-title">Размер:</span><span class="cart-item__size-input">122</span></div>
                                 <div class="cart-item__color">
                                    <span class="cart-item__color-title">Цвет:</span>
                                    <span class="cart-item__color-view" <?= $product['color'] ?>></span>
                                 </div>
                              </div>
                           </div>
                           <div class="cart-product__wrapper ">
                              <div class="cart-product__wrapper-desc">
                                 <div class="cart-product__wrapper-name d-none d-sm-block">
                                    <a href="index.php?page=product&id=<?= $product['id'] ?>"><?= $product['name'] ?></a>
                                 </div>
                              </div>
                           </div>
                           <div class="cart-product__price d-none d-sm-block">
                              <div class="cart-product__wrapper-price">
                                 <h6 class="d-flex flex-row-reverse"><?= $product['price'] * $products_in_cart[$product['id']] . " руб." ?></h6>
                                 <div class="d-flex flex-row-reverse cart-product__wrapper-calc">
                                    <span><?= $products_in_cart[$product['id']] . "X" . $product['price'] . " руб." ?></span>
                                 </div>
                                 <div class="d-flex flex-row-reverse cart-product__wrapper-calc">
                                    <span>
                                       <small>
                                          <?php if (intval($product['rrp']) > 0) {
                                             echo $product['rrp'] . " руб.";
                                          }
                                          ?>
                                       </small>
                                    </span>
                                 </div>
                                 <div class="cart-item__delete position-absolute bottom-0 end-0">
                                    <a href="index.php?page=cart&remove=<?= $product['id'] ?>" class="remove">Удалить <span>Х</span></a>
                                 </div>
                              </div>
                           </div>

                        </div>
                     <?php endforeach; ?>
                  <?php endif; ?>
               </form>
            </div>
         </div>
         <div class="col-12 col-xl-5 offset-xl-1">
            <h1 class="cart-title">Корзина</h1>
            <table class="table cart-table table-borderless">
               <tbody class="">
                  <tr>
                     <td>Количество товаров</td>
                     <td></td>
                     <td><?= array_sum($products_in_cart) ?></td>
                  </tr>
                  <tr>
                     <td>Стоимость</td>
                     <td></td>
                     <td><?= $subtotal . " руб." ?></td>
                  </tr>
                  <tr>
                     <td>Скидка</td>
                     <td></td>
                     <td><?= $sale ?></td>
                  </tr>
                  <tr>
                     <td>Доставка</td>
                     <td></td>
                     <td>350 руб.*</td>
                  </tr>
               </tbody>
            </table>
            <p class="cart-sign">*Указана максимальная стоимость доставки. Окончательная сумма
               расчитывается автоматически при оформлении заказа</p>
            <table class="table cart-table table-borderless">
               <tbody>
                  <tr>
                     <td>Итого</td>
                     <td></td>
                     <td><?= $subtotal + 350 . " руб." ?></td>
                  </tr>
               </tbody>
            </table>
            <form action="index.php?page=cart" method="post">
               <div class="card-info__div cart-button">
                  <button name="placeorder" class="card-info__to-cart cart-button__style">ПЕРЕЙТИ К ОФОРМЛЕНИЮ</button>
               </div>
            </form>
            <h6 class="cart-go-back d-none d-sm-block"><a href="http://localhost:8080/sites/takeandhug/index.php?page=1">Вернуться на главную <img src="images/arrow-main.svg" alt=""></a></h6>
         </div>
      </div>
   </div>

   </div>
   </div>

   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
   <script src="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.js"></script>
   <script src="script/script.js"></script>
</body>

</html>