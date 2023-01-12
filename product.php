<?php
// Убедимся, что параметр id указан в URL-адресе.
if (isset($_GET['id'])) {
   $stmt = $pdo->prepare('SELECT * FROM takeandhug WHERE id = ?');
   $stmt->execute([$_GET['id']]);
   // Получим продукт из базы данных и вернуть результат в виде массива
   $product = $stmt->fetch(PDO::FETCH_ASSOC);
   // Проверим, существует ли продукт (массив не пуст)
   if (!$product) {
      // Выведем предупреждение об ошибке, если идентификатора продукта не существует (массив пуст)
      exit('Product does not exist!');
   }
} else {
   // Выведем предупреждение об ошибке, если идентификатор не был указан
   exit('Product does not exist!');
}

$dop = $pdo->prepare('SELECT * FROM takeandhug ORDER BY id DESC LIMIT 1');
$dop->execute();
$recently_added_products = $dop->fetchAll(PDO::FETCH_ASSOC);
?>

<?= template_header($product['name']) ?>

<div class="container-fluid ">
   <div class="row">
      <div class="field-top col-12 breadcrumb-div">
         <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
               <li class="breadcrumb-item breadcrumb--notactive"><a href="http://localhost:8080/sites/takeandhug/index.php?page=home">Главная</a></li>
               <li class="breadcrumb-item"><a href="#">Каталог</a></li>
               <li class="breadcrumb-item" aria-current="page"><a href="#">Девочки</a></li>
               <li class="breadcrumb-item" aria-current="page"><a href="http://localhost:8080/sites/takeandhug/index.php?page=products">Платья и сарафаны</a></li>
               <li class="breadcrumb-item active" aria-current="page"><span class="breadcrumb--active"><?= $product['name'] ?></span></li>
            </ol>
         </nav>
      </div>
   </div>
</div>
<div class="container-fluid">
   <div class="row">
      <div class="col-lg-2 d-none d-sm-none d-md-none d-lg-block card-slider ">
         <div class="card-slider__nav field-left slider-nav">
            <div class="slider-nav__item"><img class="img-fluid" src="images/<?= $product['img'] ?>" alt="<?= $product['name'] ?>"></div>
            <div class="slider-nav__item">
               <?php if ($product['img_1'] != 0) {
                  $image = "images/" . $product['img_1'];
               } else {
                  $class = 'display: none';
               }
               ?>
               <img style="<?= $class ?>" class="img-fluid" src="<?= $image ?>" alt="<?= $product['name'] ?>">
            </div>
            <div class="slider-nav__item">
               <?php if ($product['img_2'] != 0) {
                  $image = "images/" . $product['img_2'];
               } else {
                  $class2 = 'display: none';
               }
               ?>
               <img style="<?= $class2 ?>" class="img-fluid" src="<?= $image ?>" alt="<?= $product['name'] ?>">
            </div>


         </div>
      </div>
      <div class="col-lg-4 col-12 col-sm-12 col-md-6 col-4__padding ">
         <div class="card-slider__block slider-block position-relative">

            <div class="swiper-wrapper">
               <div class="swiper-slide">
                  <div class="swiper-button-prev"></div>
                  <div class="swiper-button-next"></div>
                  <img src="images/<?= $product['img'] ?>" alt="<?= $product['name'] ?>">
               </div>
               <?php if ($product['img_1'] != 0) {
                  $image2 = "images/" . $product['img_1'];
               } else {
                  $image3 = '';
                  $class3 = 'display: none;';
               }
               ?>
               <div class="swiper-slide" style="<?= $class3 ?>">
                  <div class="swiper-button-prev"></div>
                  <div class="swiper-button-next"></div>
                  <img class="img-fluid" src="<?= $image2 ?>" alt="<?= $product['name'] ?>">
               </div>
               <?php if ($product['img_2'] != 0) {
                  $image3 = "images/" . $product['img_2'];
               } else {
                  $image3 = '';
                  $class4 = 'display: none;';
               }
               ?>
               <div class="swiper-slide" style="<?= $class4 ?>">
                  <div class="swiper-button-prev"></div>
                  <div class="swiper-button-next"></div>
                  <img class="img-fluid" src="<?= $image3 ?>" alt="<?= $product['name'] ?>">
               </div>
            </div>
            <div class="swiper-pagination d-lg-none d-xl-none d-xxl-none"></div>
         </div>
      </div>
      <div class="col-12 col-sm-12 col-md-6 col-lg-6 offset-xl-1 col-xl-5 card-info">
         <div class="row card-info__row">
            <div class="col-9 card-info__div">
               <h1 class="card-info__title"><?= $product['name'] ?></h1>
            </div>
            <div class=" col-3 d-flex justify-content-end card-info__div card-info__favourites">
               <a class="" href="#"><img class="img-fluid" src="images/favourites.svg" alt="Избранное"></a>
            </div>
         </div>
         <div class="row card-info__row">
            <div class="col-12 card-info__div">
               <h2 class="card-info__sign"><?= $product['mini_description'] ?></h2>
            </div>
         </div>
         <div class="row card-info__row">
            <div class="col-12 card-info__div">
               <h1 class="card-info__price"><?= $product['price'] . " руб."; ?>
                  <small>
                     <?php if (intval($product['rrp']) > 0) {
                        echo $product['rrp'] . " руб.";
                     }
                     ?>
                  </small>
               </h1>
            </div>
         </div>
         <div class="row card-info__row">
            <div class="col-12 card-info__div">
               <ul class="card-info__color">
                  <li class="card-info__color-list card-info__color-button1 d-inline-flex" style="background-color: #EAE118;"><a class="card-info__color-button" href="#"></a></li>
                  <li class=" d-inline-flex card-info__color-list--active" <?= $product['color'] ?>></li>
                  <li class="card-info__color-list d-inline-flex" style="background-color: #3D8B0E;"><a class="card-info__color-button" href="#"></a>
                  </li>
                  <li class="card-info__color-list d-inline-flex" style="background-color: #9457EB;"><a class="card-info__color-button" href="#"></a>
                  </li>
               </ul>
            </div>
         </div>
         <form action="index.php?page=cart" method="post">
            <div class="row card-info__row">
               <div class="col-12 card-info__div">
                  <h6 class="card-info__size-title">Размер:</h6>
               </div>
            </div>
            <div class="row card-info__row">
               <div class="col-12 card-info__div">
                  <div class="card-info__radio-btn">
                     <input id="radio-1" type="radio" name="radio" value="1" checked>
                     <label for="radio-1"><?= $product['size1'] ?></label>
                  </div>

                  <div class="card-info__radio-btn">
                     <input id="radio-2" type="radio" name="radio" value="2">
                     <label for="radio-2"><?= $product['size2'] ?></label>
                  </div>

                  <div class="card-info__radio-btn">
                     <input id="radio-3" type="radio" name="radio" value="3">
                     <label for="radio-3"><?= $product['size3'] ?></label>
                  </div>
                  <div class="card-info__radio-btn">
                     <input id="radio-4" type="radio" name="radio" value="4">
                     <label for="radio-4"><?= $product['size4'] ?></label>
                  </div>
                  <div class="card-info__radio-btn">
                     <input id="radio-5" type="radio" name="radio" value="5">
                     <label for="radio-5"><?= $product['size5'] ?></label>
                  </div>
                  <div class="card-info__radio-btn">
                     <input id="radio-6" type="radio" name="radio" value="6">
                     <label for="radio-6"><?= $product['size6'] ?></label>
                  </div>
               </div>
            </div>
            <div class="row card-info__row">
               <div class="col-12 card-info__div">
                  <div class="card-info__size-table"><a class="" href="#">Таблица размеров</a>
                  </div>
               </div>
            </div>
            <div class="row card-info__row">
               <div class="col-12 card-info__div">
                  <h6 class="card-info__num">Количество:</h6>
               </div>
            </div>
            <div class="row card-info__row">
               <div class="col-12 card-info__div">


                  <div class=" d-inline-flex card-info__num-all">
                     <button id="minus" class="card-info__num-input card-info__num-button decrease" type="button">–</button>
                     <input id="col" class="card-info__num-input" type="number" name="quantity" value="1" min="1" max="<?= $product['quantity'] ?>" placeholder="Quantity" required>
                     <input type="hidden" name="product_id" value="<?= $product['id'] ?>">
                     <button id="plus" class=" card-info__num-input card-info__num-button increase" type="button">+</button>
                  </div>
                  <button class="card-info__to-cart">ДОБАВИТЬ В КОРЗИНУ</button>
         </form>

      </div>
   </div>
   <div class="row card-info__row">
      <div class="col-12 card-info__div">
         <div class="accordion card-info__accordion" id="accordion">
            <div class="accordion-item">
               <h2 class="accordion-header" id="headingOne">
                  <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">ОБ ИЗДЕЛИИ
                  </button>
               </h2>
               <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordion">
                  <div class="accordion-body">
                     <p><?= $product['description'] ?></p>
                  </div>
               </div>
            </div>
            <div class="accordion-item">
               <h2 class="accordion-header" id="headingTwo">
                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                     СОСТАВ
                  </button>
               </h2>
               <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                  <div class="accordion-body">
                     <?= $product['structure'] ?>
                  </div>
               </div>
            </div>
            <div class="accordion-item">
               <h2 class="accordion-header" id="headingThree">
                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                     УХОД
                  </button>
               </h2>
               <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                  <div class="accordion-body d-flex justify-content-center">
                     <div class="accordion-body__icon d-inline-flex" data-title="Стирка в обычном режиме с температурой не выше 40 градусов"><img src="images/<?= $product['care'] ?>" alt="Стирка в обычном режиме с температурой не выше 40 градусов">
                     </div>
                     <div class="accordion-body__icon d-inline-flex" data-title="Изделие можно гладить при средней температуре"><img src="images/<?= $product['care_2'] ?>" alt="Mожно гладить при средней температуре">
                     </div>
                     <div class="accordion-body__icon d-inline-flex" data-title="Химчистка запрещена"><img src="images/<?= $product['care_3'] ?>" alt="Химчистка запрещена">
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
   <div class="row card-info__row">
      <div class="col-12 card-info__div">
         <h2 class="card-info__extra">Дополни образ</h2>
      </div>
   </div>
   <div class="row card-info__row">
      <?php foreach ($recently_added_products as $dop_prod) : ?>
         <div class="col-6 card-info__div">
            <div class="position-relative card-product card-product__mini">
               <a class="" href="http://localhost:8080/sites/takeandhug/index.php?page=product&id=<?= $dop_prod['id'] ?>">
                  <div class="position-absolute top-0 end-0 product-favorite">
                     <a href="#"><img class="product-favorite__img" src="images/favourites.svg" alt="Избранное"></a>
                  </div>
                  <div class="product-thumb">
                     <a class href="http://localhost:8080/sites/takeandhug/index.php?page=product&id=<?= $dop_prod['id'] ?>"><img class="product-image d-block" src="images/<?= $dop_prod['img'] ?>" alt="<?= $dop_prod['img'] ?>"></a>
                  </div>
                  <div class="product-title">
                     <h4>
                        Панама «Солнышко»
                     </h4>
                  </div>
                  <div class="product-price product-price__mini">
                     <span>
                        <?= $dop_prod['price'] . "руб."; ?>
                        <small>
                           <?php if (intval($dop_prod['rrp']) > 0) {
                              echo $dop_prod['rrp'] . "руб.";
                           }
                           ?>
                        </small>
                     </span>
                  </div>
               </a>
            </div>
         </div>
      <?php endforeach; ?>
   </div>
</div>
</div>

</div>
<?= template_footer() ?>