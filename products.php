<?php
if (isset($_GET['p'])) {
   $page = intval($_GET['p']);
} else {
   $page = 1;
}
$stmt = $pdo->prepare('SELECT * FROM takeandhug ORDER BY date_added');
$stmt->execute();
$recently_added_products = $stmt->fetchAll(PDO::FETCH_ASSOC);
$countAllTovars = count($recently_added_products);
//Список все страниц нужно будет потом для точек в пагинации
$allPages = floor($countAllTovars / 6);
if ($countAllTovars % 6 > 0) {
   $allPages = $allPages + 1;
}
if ($page - 1 >= 0) {
   $indexPosition = ($page - 1) * 6;
   $previous = $page - 1;
} else {
   $indexPosition = 0;
   $previous = 0;
}

if ($page + 1 <= $allPages) {
   $next = $page + 1;
} else {
   $next = $page;
}
$recently_added_products = array_slice($recently_added_products, $indexPosition, 6);
?>

<?= template_header('Каталог') ?>

<div class="container-fluid ">
   <div class="row">
      <!--Хлебные крошки-->
      <div class="field-left field-top col-12">
         <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
               <li class="breadcrumb-item breadcrumb--notactive"><a href="http://localhost:8080/sites/takeandhug/index.php?page=home">Главная</a></li>
               <li class="breadcrumb-item"><a href="#">Каталог</a></li>
               <li class="breadcrumb-item" aria-current="page"><a href="#">Девочки</a></li>
               <li class="breadcrumb-item active" aria-current="page"><span class="breadcrumb--active">Платья и
                     сарафаны</span></li>
            </ol>
         </nav>
      </div>
   </div>
   <!--Заголовок страницы-->
   <div class="row">
      <div class="field-left catalog-title col-12">
         <h1>Платья и сарафаны</h1>
      </div>
   </div>
</div>
<!--Фильтры-->
<div class="container-fluid container-filters">
   <div class="field-left row  filters">
      <div class="align-self-end col-xl-1 col-lg-1 col-md-1 col-sm-2 d-none d-sm-block ">
         <h5 class="price__title">Цена</h5>
      </div>
      <div class=" price col-xl-3 col-lg-3 col-md-5 col-sm-5 d-none d-sm-block">
         <div class=" price__input">
            <div class="field d-inline"><input type="number" class="input-min" value="1000"></div>
            <div class="separator"> </div>
            <div class="field d-inline"><input type="number" class="input-max" value="17000"></div>
         </div>
         <div class="price__slider">
            <div class="price__progress"></div>
         </div>
         <div class="range-input">
            <input type="range" class=" range-min" min="0" max="17000" value="1000" step="100">
            <input type="range" class="range-max" min="0" max="17000" value="17000" step="100">
         </div>
      </div>
      <div class="offset-xl-1 col-xl-1 offset-lg-1 col-lg-1 filter-color d-none d-xl-block d-xxl-block d-lg-block">
         <div class="dropdown ">
            <a class="dropdown-toggle " href="#" id="color" role="button" data-bs-toggle="dropdown" aria-expanded="false">Цвет
            </a>
            <ul class="dropdown-menu filter-color__dropdown" aria-labelledby="color">
               <li class="form-check"><input class="form-check-input filter-input" type="checkbox" value="" id="white">
                  <label class="form-check-label " for="white">
                     <span class="filter-color__label">Белый</span>
                  </label>
               </li>
               <li class="form-check"><input class="form-check-input filter-input" type="checkbox" value="" id="grey">
                  <label class="form-check-label" for="grey">
                     <span class="filter-color__label">Серый</span>
                  </label>
               </li>
               <li class="form-check"><input class="form-check-input filter-input" type="checkbox" value="" id="black">
                  <label class="form-check-label" for="black">
                     <span class="filter-color__label">Черный</span>
                  </label>
               </li>
               <li class="form-check"><input class="form-check-input filter-input" type="checkbox" value="" id="green">
                  <label class="form-check-label" for="green">
                     <span class="filter-color__label">Зеленый</span>
                  </label>
               </li>
               <li class="form-check"><input class="form-check-input filter-input" type="checkbox" value="" id="yellow">
                  <label class="form-check-label" for="yellow">
                     <span class="filter-color__label">Жёлтый</span>
                  </label>
               </li>
            </ul>
         </div>
      </div>
      <div class=" col-xl-2 col-lg-2 filter-size d-none d-xl-block d-xxl-block d-lg-block">
         <div class="dropdown ">
            <a class="dropdown-toggle " href="#" id="size" role="button" data-bs-toggle="dropdown" aria-expanded="false">Размер
            </a>
            <ul class="dropdown-menu filter-color__dropdown" aria-labelledby="size">
               <li class="form-check"><input class="form-check-input filter-input" type="checkbox" value="" id="122">
                  <label class="form-check-label " for="122">
                     <span class="filter-color__label">122</span>
                  </label>
               </li>
               <li class="form-check"><input class="form-check-input filter-input" type="checkbox" value="" id="128">
                  <label class="form-check-label" for="128">
                     <span class="filter-color__label">128</span>
                  </label>
               </li>
               <li class="form-check"><input class="form-check-input filter-input" type="checkbox" value="" id="134">
                  <label class="form-check-label" for="134">
                     <span class="filter-color__label">134</span>
                  </label>
               </li>
               <li class="form-check"><input class="form-check-input filter-input" type="checkbox" value="" id="140">
                  <label class="form-check-label" for="140">
                     <span class="filter-color__label">140</span>
                  </label>
               </li>
               <li class="form-check"><input class="form-check-input filter-input" type="checkbox" value="" id="146">
                  <label class="form-check-label" for="146">
                     <span class="filter-color__label">146</span>
                  </label>
               </li>
               <li class="form-check"><input class="form-check-input filter-input" type="checkbox" value="" id="152">
                  <label class="form-check-label" for="152">
                     <span class="filter-color__label">152</span>
                  </label>
               </li>
            </ul>
         </div>
      </div>
      <div class="col-xl-3 col-lg-3 col-md-6 col-sm-5 col-12">
         <a class="all-filters d-block d-sm-flex flex-sm-row-reverse " data-bs-toggle="offcanvas" href="#allFilters" role="button" aria-controls="allFilters"><img src="images/filtr.svg" alt="Фильтры" class="image-fluid all-filters__img d-sm-none">Все фильтры<img src="images/filtr.svg" alt="Фильтры" class="image-fluid all-filters__img d-none d-sm-block"></a>
         <div class="offcanvas offcanvas-end" tabindex="-1" id="allFilters" aria-labelledby="allFiltersleLabel">
            <div class="all-filters__title">
               <button type="button" class="btn-close text-reset d-inline" data-bs-dismiss="offcanvas" aria-label="Закрыть"></button>
               <h5 class="d-inline all-filters__h5" id="allFiltersleLabel">Фильтры</h5>
            </div>
            <div class="offcanvas-body offcanvas-body__all-filters">
               <div class="d-block d-sm-none ">
                  <h6 class="d-inline-block">Цена</h6>
                  <div class=" price__input">
                     <div class="field d-inline"><input type="number" class="input-min" value="1000"></div>
                     <div class="separator"> </div>
                     <div class="field d-inline"><input type="number" class="input-max" value="17000"></div>
                  </div>
                  <div class="price__slider">
                     <div class="price__progress"></div>
                  </div>
                  <div class="range-input">
                     <input type="range" class=" range-min" min="0" max="17000" value="1000" step="100">
                     <input type="range" class="range-max" min="0" max="17000" value="17000" step="100">
                  </div>
               </div>
               <div class="d-block d-lg-none offcanvas-field">
                  <h6 class="d-inline-block ">Цвет</h6>
                  <ul class="checkbox-offcanvas filter-color__dropdown" aria-labelledby="color">
                     <li class="form-check"><input class="form-check-input filter-input" type="checkbox" value="" id="white1">
                        <label class="form-check-label " for="white1">
                           <span class="filter-color__label">Белый</span>
                        </label>
                     </li>
                     <li class="form-check"><input class="form-check-input filter-input" type="checkbox" value="" id="grey1">
                        <label class="form-check-label" for="grey1">
                           <span class="filter-color__label">Серый</span>
                        </label>
                     </li>
                     <li class="form-check"><input class="form-check-input filter-input" type="checkbox" value="" id="black1">
                        <label class="form-check-label" for="black1">
                           <span class="filter-color__label">Черный</span>
                        </label>
                     </li>
                     <li class="form-check"><input class="form-check-input filter-input" type="checkbox" value="" id="green1">
                        <label class="form-check-label" for="green1">
                           <span class="filter-color__label">Зеленый</span>
                        </label>
                     </li>
                     <li class="form-check"><input class="form-check-input filter-input" type="checkbox" value="" id="yellow1">
                        <label class="form-check-label" for="yellow1">
                           <span class="filter-color__label">Жёлтый</span>
                        </label>
                     </li>
                  </ul>
               </div>
               <div class="d-block d-lg-none offcanvas-field">
                  <h6 class="d-inline-block">Размер</h6>
                  <ul class="checkbox-offcanvas filter-color__dropdown" aria-labelledby="size">
                     <li class="form-check"><input class="form-check-input filter-input" type="checkbox" value="" id="122s">
                        <label class="form-check-label " for="122s">
                           <span class="filter-color__label">122</span>
                        </label>
                     </li>
                     <li class="form-check"><input class="form-check-input filter-input" type="checkbox" value="" id="128s">
                        <label class="form-check-label" for="128s">
                           <span class="filter-color__label">128</span>
                        </label>
                     </li>
                     <li class="form-check"><input class="form-check-input filter-input" type="checkbox" value="" id="134s">
                        <label class="form-check-label" for="134s">
                           <span class="filter-color__label">134</span>
                        </label>
                     </li>
                     <li class="form-check"><input class="form-check-input filter-input" type="checkbox" value="" id="140s">
                        <label class="form-check-label" for="140s">
                           <span class="filter-color__label">140</span>
                        </label>
                     </li>
                     <li class="form-check"><input class="form-check-input filter-input" type="checkbox" value="" id="146s">
                        <label class="form-check-label" for="146s">
                           <span class="filter-color__label">146</span>
                        </label>
                     </li>
                     <li class="form-check"><input class="form-check-input filter-input" type="checkbox" value="" id="152s">
                        <label class="form-check-label" for="152s">
                           <span class="filter-color__label">152</span>
                        </label>
                     </li>
                  </ul>
               </div>
               <div class=" d-lg-flex d-lg-inline-flex">
                  <div class="offcanvas-field">
                     <h6 class="d-inline-block">Возраст</h6>
                     <ul class="checkbox-offcanvas">
                        <li class="form-check"><input class="form-check-input filter-input" type="checkbox" value="" id="2-6">
                           <label class="form-check-label " for="2-6">
                              <span class="filter-offcanvas">2 – 6 лет</span>
                           </label>
                        </li>
                        <li class="form-check"><input class="form-check-input filter-input" type="checkbox" value="" id="7-12">
                           <label class="form-check-label" for="7-12">
                              <span class="filter-offcanvas">7 – 12 лет</span>
                           </label>
                        </li>
                     </ul>
                  </div>
               </div>
               <div class="filter-sale d-lg-flex d-lg-inline-flex">
                  <div class="offcanvas-field">
                     <h6 class="d-inline-block">Скидка</h6>
                     <ul class="checkbox-offcanvas" aria-labelledby="color">
                        <li class="form-check"><input class="form-check-input filter-input" type="checkbox" value="" id="sale">
                           <label class="form-check-label " for="sale">
                              <span class="filter-offcanvas">со скидкой</span>
                           </label>
                        </li>
                        <li class="form-check"><input class="form-check-input filter-input" type="checkbox" value="" id="notSale">
                           <label class="form-check-label" for="notSale">
                              <span class="filter-offcanvas">без скидки</span>
                           </label>
                        </li>
                     </ul>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<!--Карточки товара-->
<div class="container-fluid catalog-cards">
   <div class="justify-content-center field-left field-right row">
      <?php foreach ($recently_added_products as $product) : ?>
         <div class=" col-10 col-sm-6 col-md-6 col-lg-4 col-xl-4 col-xxl-4  catalog-cards__col">
            <div class="position-relative card-product">
               <a class="" href="http://localhost:8080/sites/takeandhug/index.php?page=product&id=<?= $product['id'] ?>">
                  <div class="position-absolute top-0 end-0 product-favorite">
                     <a href="#"><img class="product-favorite__img" src="images/favourites.svg" alt="Избранное"></a>
                  </div>
                  <div class="product-thumb">
                     <a class href="http://localhost:8080/sites/takeandhug/index.php?page=product&id=<?= $product['id'] ?>"><img class="product-image d-block" src="images/<?= $product['img'] ?>" alt="<?= $product['name'] ?>"></a>
                  </div>
                  <div class="product-title">
                     <h4><?= $product['name'] ?></h4>
                  </div>
                  <div class="product-price">
                     <span>
                        <?= $product['price'] . "руб."; ?>
                        <small>
                           <?php if (intval($product['rrp']) > 0) {
                              echo $product['rrp'] . "руб.";
                           }
                           ?>
                        </small>
                     </span>
                  </div>
                  <div class="product-color">
                     <img class="img-fluid product-color--space" src="images/yellow.svg" alt="желтый">
                     <img class="img-fluid product-color--space" src="images/white.svg" alt="белый">
                     <img class="img-fluid product-color--space" src="images/green.svg" alt="зелёный">
                     <img class="img-fluid product-color--space" src="images/black.svg" alt="чёрный">
                  </div>
                  <div class=" product-size">
                     <select class="form-select product-size__btn" aria-label="Размер">
                        <option selected>Размер</option>
                        <option value="1"><?= $product['size1'] ?></option>
                        <option value="2"><?= $product['size2'] ?></option>
                        <option value="3"><?= $product['size3'] ?></option>
                        <option value="4"><?= $product['size4'] ?></option>
                        <option value="5"><?= $product['size5'] ?></option>
                        <option value="6"><?= $product['size6'] ?></option>
                     </select>
                  </div>
                  <div class="">
                     <a class="d-block add-button position-absolute bottom-0 end-0" role="button" href="#"></a>
                  </div>
               </a>
            </div>
         </div>
      <?php endforeach; ?>
   </div>
   <!--Пагинация-->
   <div class="justify-content-center pages row">
      <nav aria-label="Пример навигации по страницам">
         <ul class="pagination justify-content-center">
            <li class="page-item"><a class="page-link" href="http://localhost:8080/sites/takeandhug/index.php?page=products&p=<?php echo $previous; ?>" aria-label="Предыдущая">
                  <img class="img-fluid" src="images/arrow-left.svg" alt="Предыдущая" aria-hidden="true"></a>
            </li>
            <?php for ($i = 1; $i <= $allPages; $i++) { ?>
               <?php if ($i == $page) { ?>
                  <li class="page-item "><a class="page-link pages-number__active" href="http://localhost:8080/sites/takeandhug/index.php?page=products&p=<?php echo $i; ?>"><?php echo $i; ?></a>
                  </li>
               <?php } else { ?>
                  <li class="page-item "><a class="page-link pages-number" href="http://localhost:8080/sites/takeandhug/index.php?page=products&p=<?php echo $i; ?>"><?php echo $i; ?></a>
                  </li>
               <?php } ?>
            <?php } ?>
            <li class="page-item next">

               <a class="page-link" href="http://localhost:8080/sites/takeandhug/index.php?page=products&p=<?php echo $next; ?>" aria-label="Следующая">
                  <img src="images/arrow-right.svg" alt="Следующая" aria-hidden="true">
               </a>

            </li>
         </ul>
      </nav>
   </div>
</div>


<?= template_footer() ?>