<?php
if (isset($_GET['page'])) {
   $page = intval($_GET['page']);
} else {
   $page = 1;
}
$stmt = $pdo->prepare('SELECT * FROM takeandhug ORDER BY date_added');
$stmt->execute();
$recently_added_products = $stmt->fetchAll(PDO::FETCH_ASSOC);
$countAllTovars = count($recently_added_products);
//Список все страниц нужно будет потом для точек в пагинации
$allPages = floor($countAllTovars / 3);
if ($countAllTovars % 3 > 0) {
   $allPages = $allPages + 1;
}
if ($page - 1 >= 0) {
   $indexPosition = ($page - 1) * 3;
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
$recently_added_products = array_slice($recently_added_products, $indexPosition, 3);




?>

<?= template_header('Взять и обнять') ?>


<!--Обложка-->
<div class="container-fluid cover">
   <div class="row cover__row">
      <div class="col-sm-6 col-8  position-relative">
         <div class="field-left ss2023 my-auto">
            <div>
               <p class="ss2023__sign">SS’2023</p>
               <h1 class="ss2023__title">Этой весной будет<br>
                  уютно, тепло и удобно</h1>
               <p class="ss2023__desc">В новой коллекции весна – лето 2023<br>
                  больше образов для прогулок,<br>
                  активного отдыха и семейных праздников</p>
               <button type="button" class="btn btn-link ss2023__button">
                  <a href="#" class="ss2023__a "><img src="images/Arrow_2.svg" alt="Стрелка" class="ss2023__arrow">СМОТРЕТЬ
                     КОЛЛЕКЦИЮ</a>
               </button>
            </div>
            <ul class="slider__pages list-group list-group-horizontal list-unstyled">
               <li class="slider__list"><a class="slider__a" href="#">
                     <p class="mx-auto page">1</p><img class="sircle" src="images/sircle.svg" alt="Первая страница">
                  </a></li>
               <li class="slider__list"><a class="slider__a" href="#">
                     <p class="mx-auto page page--active">2</p><img class="sircle" src="images/sircle2.svg" alt="Вторая страница">
                  </a></li>
               <li class="slider__list"><a class="slider__a" href="#">
                     <p class="mx-auto page">3</p><img class="sircle" src="images/sircle.svg" alt="Третья страница">
                  </a></li>
               <li class="slider__list"><a class="slider__a" href="#">
                     <p class="mx-auto page">4</p><img class="sircle" src="images/sircle.svg" alt="Четвертая страница">
                  </a></li>
            </ul>
         </div>
      </div>
      <div class="col-sm-6 col-4  photo">
         <div class="position-relative">
            <div><img class="img-fluid d-none d-md-block" src="images/cover_img.png" alt="Две девочки в платьях коллекции SS’2023">
               <img class="img-fluid d-none d-sm-block d-md-none" src="images/cover_img-sm.png" alt="Две девочки в платьях коллекции SS’2023">
               <img class="img-fluid d-block d-sm-none photo-cover" src="images/photo.png" alt="Две девочки в платьях коллекции SS’2023">
            </div>
            <div class="cover-social d-none d-sm-block">
               <p>СОЦИАЛЬНЫЕ СЕТИ</p>
               <ul class="cover-social__all">
                  <li><a href="#"><img class="img-fluid img1" src="images/vk1.svg" alt=""></a></li>
                  <li><a href="#"><img class="img-fluid img2" src="images/tg2.svg" alt=""></a></li>
                  <li><a href="#"><img class="img-fluid img3" src="images/inst2.svg" alt=""></a></li>
               </ul>
            </div>
         </div>
      </div>
   </div>
</div>
<!--Окончание блока Обложка-->
<!--О нас-->
<div class="container-fluid about-us">
   <div class="row">
      <div class="col-12">
         <h2 class="about-us__title field-left">О нас</h2>
      </div>
   </div>
   <div class="row about-us__row">
      <div class="col-xl-4 col-xxl-4 col-lg-4 about-us__col d-none  d-xl-block d-xxl-block">
         <p class="about-us__text field-left paragraph-space">Привет! Меня зовут Надя. Я основательница бренда
            «Взять и
            обнять».
            Идея
            создавать одежду пришла мне в
            голову во время беременности. На тот момент я не думала о чем-то глобальном — сначала научилась шить
            самые простые вещи длявоей семьи.
            Как оказалось, этот навык стал моим спасением во время декрета. Все, что предлагали магазины детской
            одежды, мне не нравилось. Шить для дочери я стала сама. </p>
      </div>
      <div class="col-xl-4 col-xxl-4 col-lg-4 about-us__col d-none  d-xl-block d-xxl-block">
         <p class="about-us__text paragraph-space ">Новый гардероб понадобился не только малышке — мое тело
            изменилось и восприятие
            себя тоже. Шить я стала и себе.
         </p>
         <p class="about-us__text ">
            Создавать вещи для других мам и детей я стала к концу декрета, когда немного отошла от навалившейся
            ответсвенности. Мне хотелось помочь таким же мамам в этой суматохе одинаковых дней. Своим делом я могу
            освободить маму от одной заботы — во что одеть ребенка и что надеть на себя.
         </p>
      </div>
      <div class="order-2 order-sm-2 order-md-1 col-lg-6 col-md-6 col-12 col-sm-12 d-xl-none d-xxl-none">
         <p class="about-us__text field-left">
            Привет! Меня зовут Надя. Я основательница бренда «Взять и
            обнять».
            Идея
            создавать одежду пришла мне в
            голову во время беременности. На тот момент я не думала о чем-то глобальном — сначала научилась шить
            самые простые вещи длявоей семьи.
            Как оказалось, этот навык стал моим спасением во время декрета. Все, что предлагали магазины детской
            одежды, мне не нравилось. Шить для дочери я стала сама.
         </p>

         <p class="about-us__text field-left">
            Создавать вещи для других мам и детей я стала к концу декрета, когда немного отошла от навалившейся
            ответсвенности. Мне хотелось помочь таким же мамам в этой суматохе одинаковых дней. Своим делом я могу
            освободить маму от одной заботы — во что одеть ребенка и что надеть на себя.
         </p>
      </div>
      <div class="order-1 order-sm-1 order-md-2 col-12 col-sm-12 col-md-6 col-lg-6 col-xl-4 col-xxl-4 col-lg-4 about-us__img">
         <img class="d-block field-right img-fluid my-auto mx-auto " src="images/about-us.png" alt="Мама с ребенком">
      </div>
   </div>
</div>
<!--Окончание блока О нас-->
<!--Порулярные товары-->
<div class="container-fluid popular-products">
   <div class="row">
      <div class="col-12">
         <h2 class="popular-products__title field-left">Популярные товары</h2>
      </div>
   </div>

   <div class="row justify-content-center">
      <?php foreach ($recently_added_products as $product) : ?>
         <div class=" col-7 col-sm-4 col-md-4 col-lg-3 col-xl-3 col-xxl-3">
            <div class="position-relative card-product ">
               <a class="" href="http://localhost:8080/sites/takeandhug/index.php?page=product&id=<?= $product['id'] ?>">

                  <div class="position-absolute top-0 end-0 product-favorite">
                     <a href="#"><img class="product-favorite__img" src="images/favourites.svg" alt="Избранное"></a>
                  </div>
                  <div class="product-thumb">
                     <a class href="http://localhost:8080/sites/takeandhug/index.php?page=product&id=<?= $product['id'] ?>">

                        <img class="product-image d-block" src="images/<?= $product['img'] ?>" alt="<?= $product['name'] ?>">
                     </a>
                  </div>
                  <div class="product-title">
                     <h4><?= $product['name'] ?></h4>
                  </div>
                  <div class="product-price">
                     <span><?= $product['price'] . "руб."; ?>
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
                  <form action="index.php?page=cart" method="post">
                     <div class="">
                        <a class="d-block add-button position-absolute bottom-0 end-0" role="button" href="#"></a>
                     </div>
                  </form>
               </a>
            </div>
         </div>

      <?php endforeach; ?>
   </div>
   <div class="row pagination-row justify-content-center">
      <div class="col-12">
         <nav class="nav-pag " aria-label="Навигация по страницам">
            <ul class="pagination justify-content-center">
               <li class="page-item last">
                  <a class="page-link" href="http://localhost:8080/sites/takeandhug/index.php?page=<?php echo $previous; ?>" aria-label="Предыдущая">
                     <img class="img-fluid" src="images/arrow-left.svg" alt="Предыдущая" aria-hidden="true">

                  </a>
               </li>
               <?php for ($i = 1; $i <= $allPages; $i++) { ?>
                  <?php if ($i == $page) { ?>
                     <li class="page-item "><a class="page-link" href="http://localhost:8080/sites/takeandhug/index.php?page=<?php echo $i; ?>"><img class="img-fluid" src="images/2.svg" alt="1" aria-hidden="true"></a>
                     </li>
                  <?php } else { ?>
                     <li class="page-item "><a class="page-link" href="http://localhost:8080/sites/takeandhug/index.php?page=<?php echo $i; ?>"><img class="img-fluid" src="images/1.svg" alt="1" aria-hidden="true"></a>
                     </li>
                  <?php } ?>
               <?php } ?>
               <li class="page-item next">
                  <a class="page-link" href="http://localhost:8080/sites/takeandhug/index.php?page=<?php echo $next; ?>" aria-label="Следующая">
                     <img src="images/arrow-right.svg" alt="Следующая" aria-hidden="true">
                  </a>
               </li>
            </ul>
         </nav>

      </div>
   </div>
</div>
<!--Окончание блока Порулярные товары-->
<!--Подписка на рассылку-->
<div class="container-fluid">
   <div class="row">
      <div class="col-12">
         <h3 class="text-center sale">– 10 % на первый заказ<br>за подписку</h3>
      </div>
   </div>
   <div class="row">
      <div class="col-12">
         <p class="text-center sale__p">Рекомендации для детей и взрослых, фешн-гайды, <br>
            новости, предложения и акции</p>
      </div>
   </div>
   <form class="row justify-content-center form" action="">
      <div class="col-auto ">
         <input type="email" class="form-sub form-control-plaintext" id="exampleFormControlInput1" placeholder="Введите email">
      </div>
      <div class="col-auto">
         <button type="submit" class="button-sub">ПОДПИСАТЬСЯ</button>
      </div>
   </form>
   <div class="row">
      <div class="col-12">
         <p class="text-center privacy-policy">
            Подписываясь на рассылку, вы соглашаетесь <br>
            с <a class="privacy-policy__a" href="#">Политикой конфиденциальности</a>.
         </p>
      </div>
   </div>
</div>


<?= template_footer() ?>