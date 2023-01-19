<?php
$stmt = $pdo->prepare('SELECT * FROM orders ORDER BY date_added');
$stmt->execute();
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);
// Выводим общее количество товаров в корзине
$quant = array_column($products, 'quantity');
$quant_sum = array_sum($quant);
// Выводим общую стоимость товаров в корзине
$all_price = array_column($products, 'all_price');
$all_sum = array_sum($all_price);
// Выводим скидку на товары
$sale = array_column($products, 'all_sale');
$all_sale = array_sum($sale);
?>
<!DOCTYPE html>
<html>

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
   <link rel="stylesheet" href="styles/style.css">
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
            <?php if (empty($products)) : ?>
               <div>
                  <h2>Корзина пуста</h2>
               </div>
            <?php else : ?>
               <?php foreach ($products as $product) : ?>
                  <div class="cart-product position-relative">
                     <div class="cart-product position-relative">
                        <div class="cart-product__img">
                           <a href="index.php?page=product&id=<?= $product['id_tovar'] ?>"><img src="images/<?= $product['img'] ?>" alt="<?= $product['name'] ?>"></a>
                        </div>
                        <div class="cart-product__wrapper-xs  position-relative">
                           <div class="cart-item__delete position-absolute d-block d-sm-none" style="margin-right: 50px;">
                              <button class="remone" onclick="deleteIntoCart(event, <?= $product['id'] ?>)">Удалить <span>Х</span></button>
                           </div>
                           <div class="wrapper-xs__name d-block d-sm-none">
                              <a href="#"><?= $product['name'] ?></a>
                           </div>
                           <h6 class="wrapper-xs__price d-block d-sm-none"><?= $product['price'] * $product['quantity'] . " руб." ?> <span class="cart-product__wrapper-calc">
                                 <small>
                                    <?php if (intval($product['rrp']) > 0) {
                                       echo $product['rrp'] . " руб.";
                                    }
                                    ?>
                                 </small>
                              </span></h6>
                           <p class="cart-product__wrapper-calc d-block d-sm-none"><?= $product['quantity'] . "X" . $product['price'] . " руб." ?></p>
                           <div class="position-absolute bottom-0 wrapper-xs__all">
                              <div class="input-quontity">
                                 <span class="input-quantity__title">Количество:</span>
                                 <div class="input-quantity__wrap ">
                                    <button onclick="minusQuantity(event, <?= $product['quantity'] ?>, <?= $product['id'] ?>)" class="minus input-quantity__wrap-btn card-info__num-button decrease" name="update">–</button>
                                    <input class=" col input-quantity__wrap-btn" type="number" name="quantity-<?= $product['id_tovar'] ?>" value="<?= $product['quantity'] ?>" min="1" max="<?= $product['all_quantity'] ?>" placeholder="Quantity" required>
                                    <button onclick="plusQuantity(event, <?= $product['quantity'] ?>, <?= $product['id'] ?>)" class="plus input-quantity__wrap-btn card-info__num-button increase" name="update">+</button>
                                 </div>
                              </div>
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
                                 <a href="index.php?page=product&id=<?= $product['id_tovar'] ?>"><?= $product['name'] ?></a>
                              </div>
                           </div>
                        </div>
                        <div class="cart-product__price d-none d-sm-block">
                           <div class="cart-product__wrapper-price">
                              <h6 class="d-flex flex-row-reverse"><?= $product['price'] * $product['quantity'] . " руб." ?></h6>
                              <div class="d-flex flex-row-reverse cart-product__wrapper-calc">
                                 <span><?= $product['quantity'] . "X" . $product['price'] . " руб." ?></span>
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
                                 <button class="remone" onclick="deleteIntoCart(event, <?= $product['id'] ?>)">Удалить <span>Х</span></button>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               <?php endforeach; ?>
            <?php endif; ?>
         </div>
         <div class="col-12 col-xl-5 offset-xl-1">
            <h1 class="cart-title">Корзина</h1>
            <table class="table cart-table table-borderless">
               <tbody class="">
                  <tr>
                     <td>Количество товаров</td>
                     <td></td>
                     <td><?= $quant_sum ?></td>
                  </tr>
                  <tr>
                     <td>Стоимость</td>
                     <td></td>
                     <td><?= $all_sum . ' руб.' ?></td>
                  </tr>
                  <tr>
                     <td>Скидка</td>
                     <td></td>
                     <td><?= $all_sale . ' руб.' ?></td>
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
                     <td><?= $all_sum + 350 . ' руб.*' ?></td>
                  </tr>
               </tbody>
            </table>
            <div class="card-info__div cart-button">
               <button name="placeorder" class="card-info__to-cart cart-button__style">ПЕРЕЙТИ К ОФОРМЛЕНИЮ</button>
            </div>
            <h6 class="cart-go-back d-none d-sm-block"><a href="http://localhost:8080/sites/takeandhug/index.php?page=1">Вернуться на главную <img src="images/arrow-main.svg" alt=""></a></h6>
         </div>
      </div>
   </div>
   </div>
   </div>
   <script>
      {
         "use strict";
         // Удалить товар из корзины
         window.deleteIntoCart = async (e, idProduct) => {
            let delProduct = {
               action: 'deleteIntoCart',
               id_product: idProduct
            };
            console.log(delProduct);
            let response = await fetch('/sites/takeandhug/api.php', {
               method: 'POST',
               headers: {
                  'Content-Type': 'text/plain;charset=UTF-8'
               },
               body: JSON.stringify(delProduct)
            });
            let result = await response.text();
            console.log(result);
            location.reload();
         }
         // Уменьшить количество товара в корзине
         window.minusQuantity = async (e, quantity, idProduct) => {
            console.log(quantity, idProduct);
            if (quantity > 1) {
               quantity -= 1;
            }
            console.log(quantity);
            let Quantity = {
               action: 'QuantIntoCart',
               id_product: idProduct,
               quantity: quantity
            };
            console.log(minusQuantity);
            let response = await fetch('/sites/takeandhug/api.php', {
               method: 'POST',
               headers: {
                  'Content-Type': 'text/plain;charset=UTF-8'
               },
               body: JSON.stringify(Quantity)
            });
            let result = await response.text();
            console.log(result);
            location.reload();
         }
         // Увеличить количество товара в корзине
         window.plusQuantity = async (e, quantity, idProduct) => {
            console.log(quantity, idProduct);
            if (quantity >= 1 && quantity < 10) {
               quantity += 1;
            }
            console.log(quantity);
            let Quantity = {
               action: 'QuantIntoCart',
               id_product: idProduct,
               quantity: quantity
            };
            console.log(minusQuantity);
            let response = await fetch('/sites/takeandhug/api.php', {
               method: 'POST',
               headers: {
                  'Content-Type': 'text/plain;charset=UTF-8'
               },
               body: JSON.stringify(
                  Quantity)
            });
            let result = await response.text();
            console.log(result);
            location.reload();
         }
      }
   </script>
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
   <script src="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.js"></script>
   <script src="script/script.js"></script>
</body>

</html>