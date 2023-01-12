<?php
function pdo_connect_mysql()
{
   // Подключиться к БД
   $DATABASE_HOST = 'localhost';
   $DATABASE_USER = 'takeandhug';
   $DATABASE_PASS = 'takeandhug12345';
   $DATABASE_NAME = 'takeandhug';
   try {
      return new PDO('mysql:host=' . $DATABASE_HOST . ';dbname=' . $DATABASE_NAME . ';charset=utf8', $DATABASE_USER, $DATABASE_PASS);
   } catch (PDOException $exception) {
      // Если есть ошибка с подключением, скрипт остановится и отобразится ошибка.
      exit('Failed to connect to database!');
   }
}


// Заголовок шаблона
function template_header($title)
{
   // Получить количество товаров в корзине, чтобы отобразить их количество в хедере
   $num_items_in_cart = isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0;
   echo <<<EOT
   <!DOCTYPE html>
   <html lang="ru">
   <head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
         integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
      <link rel="stylesheet" href="styles/style.css">
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css"/>
      <title>$title</title>
   </head>
   
   <body>
      <!--Меню-->
      <header class="sticky-top">
         <nav class="navbar  navbar-expand-xl navbar-light">
            <div class="container-fluid">
               <a class="field-left navbar-brand d-none d-xl-block d-xxl-block" href="http://localhost:8080/sites/takeandhug/index.php?page=1"><img class="logo"
                     src="images/logo.svg" alt="Логотип «Взять и обнять»"></a>
   
               <button class="field-left navbar-toggler" type="button" data-bs-toggle="offcanvas"
                  data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                  aria-label="Переключатель навигации">
                  <img class="gamburger" src="images/hamburger.svg" alt="Меню">
               </button>
               <div class="offcanvas offcanvas-start" tabindex="-1" id="navbarSupportedContent">
                  <div class="offcanvas-header" style="padding: 2rem 6.5rem;">
                     <a href="http://localhost:8080/sites/takeandhug/index.php?page=1" class="" id="offcanvasRightLabel"><img class="logo2" src="images/logo.svg"
                           alt="Логотип «Взять и обнять»"></a>
                     <button type="button" class="btn btn-link" data-bs-dismiss="offcanvas" aria-label="Закрыть"><img
                           src="images/close.svg" alt="Закрыть"></button>
                  </div>
                  <ul class="offcanvas-body navbar-nav mb-2 mb-lg-0 top-menu mx-auto">
   
                     <li class="nav-item top-menu__list d-xl-none d-xxl-none">
                        <p class="offcanvas-cpllapse">
                           <a class="top-menu__list1 offcanvas-cpllapse__a" data-bs-toggle="collapse"
                              href="#collapseCatalogHeader" role="button" aria-expanded="false"
                              aria-controls="collapseExample">
                              Каталог <img class="carret-catalogHeader" src="images/Carret_Down.svg" alt="Вниз">
                           </a>
                        </p>
                        <div class="collapse collapse-list" id="collapseCatalogHeader">
                           <nav class="nav flex-column footer__firstcolumn">
                              <a class="nav-link item__list item__list--small" href="index.php?page=products">Девочки</a>
                              <a class="nav-link item__list item__list--small" href="#">Мальчики</a>
                              <a class="nav-link item__list item__list--small" href="#">Женщины</a>
                              <a class="nav-link item__list item__list--small" href="#">Аксессуары</a>
                              <a class="nav-link item__list item__list--small" href="#">Все для сна</a>
                           </nav>
                        </div>
                     </li>
                     <li class="nav-item top-menu__list  d-xl-none d-xxl-none">
                        <p class="">
                           <a class="top-menu__list1 offcanvas-cpllapse__a" data-bs-toggle="collapse"
                              href="#collapseCustomsHeader" role="button" aria-expanded="false"
                              aria-controls="collapseExample">
                              Покупателям <img class="carret-customers" src="images/Carret_Down.svg" alt="Вниз">
                           </a>
                        </p>
                        <div class="collapse collapse-list" id="collapseCustomsHeader">
                           <nav class="nav flex-column footer__firstcolumn">
                              <a class="nav-link item__list item__list--small" href="#">Доставка</a>
                              <a class="nav-link item__list item__list--small" href="#">Возврат и обмен</a>
                              <a class="nav-link item__list item__list--small" href="#">Уход за товаром</a>
                              <a class="nav-link item__list item__list--small" href="#">Таблица размеров</a>
                           </nav>
                        </div>
                     </li>
                     <li class="nav-item top-menu__list ">
                        <a class="nav-link" aria-current="page" href="#"><span class="top-menu__list1">О нас</span>
                        </a>
                     </li>
                     <li class="nav-item top-menu__list dropdown d-none d-xl-block d-xxl-block">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarCustomers" role="button"
                           data-bs-toggle="dropdown" aria-expanded="false"><span class="top-menu__list1">Покупателям</span>
                        </a>
                        <ul class="dropdown-menu customers second-menu" aria-labelledby="navbarCustomers">
                           <li><a class="dropdown-item" href="#"><span class="customers__list">Доставка</span></a></li>
                           <li><a class="dropdown-item" href="#"><span class="customers__list">Возврат и обмен</span></a>
                           </li>
                           <li><a class="dropdown-item" href="#"><span class="customers__list">Уход за товаром</span></a>
                           </li>
                           <li><a class="dropdown-item" href="#"><span class="customers__list">Таблица размеров</span></a>
                           </li>
                        </ul>
                     </li>
                     <li class="nav-item top-menu__list dropdown mega-menu d-none d-xl-block d-xxl-block">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarCatalog" role="button"
                           data-bs-toggle="dropdown" aria-expanded="false">
                           <span class="top-menu__list1">Каталог</span>
                        </a>
                        <div class="dropdown-menu second-menu mega-area" aria-labelledby="navbarCatalog">
                           <div class="mega-area__content px-md-4">
                              <div class="container-fluid">
                                 <div class="container">
                                    <div class="row pt-5">
                                       <div class="col-xl-4 col-xl-4 class">
                                          <a href="#"><span class="class__title">Девочки</span></a>
                                          <a class="class__years" href="#"><span class="class__years--style">2 — 6
                                                лет</span></a>
                                          <a class="class__years" href="#"><span class="class__years--style">7 — 12
                                                лет</span></a>
                                          <ul class="list-unstyled mb-5 categories">
                                             <li><a class="dropdown-item ps-0 pt-4 pb-3" href="#"><span
                                                      class="categories__span">Все
                                                      товары</span></a></li>
                                             <li><a class="dropdown-item ps-0" href="#"><span
                                                      class="categories__span">Спортивные
                                                      костюмы</span></a></li>
                                             <li><a class="dropdown-item ps-0" href="index.php?page=products"><span
                                                      class="categories__span">Платья
                                                      и
                                                      сарафаны</span></a></li>
                                             <li><a class="dropdown-item ps-0" href="#"><span
                                                      class="categories__span">Домашняя
                                                      одежда</span></a></li>
                                             <li><a class="dropdown-item ps-0" href="#"><span
                                                      class="categories__span">Верхняя
                                                      одежда</span></a></li>
                                             <li><a class="dropdown-item ps-0" href="#"><span
                                                      class="categories__span">Брюки и
                                                      шорты</span></a></li>
                                             <li><a class="dropdown-item ps-0" href="#"><span
                                                      class="categories__span">Толстовки</span></a></li>
                                             <li><a class="dropdown-item ps-0" href="#"><span
                                                      class="categories__span">Футболки</span></a></li>
                                             <li><a class="dropdown-item ps-0" href="#"><span
                                                      class="categories__span">Рубашки</span></a></li>
                                          </ul>
                                       </div>
                                       <div class="col-xl-4 col-xl-4">
                                          <a href="#"><span class="class__title">Мальчики</span></a>
                                          <a class="class__years" href="#"><span class="class__years--style">2 — 6
                                                лет</span></a>
                                          <a class="class__years" href="#"><span class="class__years--style">7 — 12
                                                лет</span></a>
                                          <ul class="list-unstyled mb-5 categories">
                                             <li><a class="dropdown-item ps-0 pt-4 pb-3" href="#"><span
                                                      class="categories__span">Все
                                                      товары</span></a></li>
                                             <li><a class="dropdown-item ps-0" href="#"><span
                                                      class="categories__span">Спортивные
                                                      костюмы</span></a></li>
                                             <li><a class="dropdown-item ps-0" href="#"><span
                                                      class="categories__span">Домашняя
                                                      одежда</span></a></li>
                                             <li><a class="dropdown-item ps-0" href="#"><span
                                                      class="categories__span">Верхняя
                                                      одежда</span></a></li>
                                             <li><a class="dropdown-item ps-0" href="#"><span
                                                      class="categories__span">Брюки и
                                                      шорты</span></a></li>
                                             <li><a class="dropdown-item ps-0" href="#"><span
                                                      class="categories__span">Толстовки</span></a></li>
                                             <li><a class="dropdown-item ps-0" href="#"><span
                                                      class="categories__span">Футболки</span></a></li>
                                             <li><a class="dropdown-item ps-0" href="#"><span
                                                      class="categories__span">Рубашки</span></a></li>
                                          </ul>
                                       </div>
                                       <div class="col-xl-4 col-xl-4">
                                          <a href="#"><span class="class__title">Женщины</span></a>
                                          <ul class="list-unstyled mb-5 categories">
                                             <li><a class="dropdown-item ps-0 pt-4 pb-3" href="#"><span
                                                      class="categories__span">Все
                                                      товары</span></a></li>
                                             <li><a class="dropdown-item ps-0" href="#"><span
                                                      class="categories__span">Спортивные
                                                      костюмы</span></a></li>
                                             <li><a class="dropdown-item ps-0" href="#"><span
                                                      class="categories__span">Платья
                                                      и
                                                      сарафаны</span></a></li>
                                             <li><a class="dropdown-item ps-0" href="#"><span
                                                      class="categories__span">Домашняя
                                                      одежда</span></a></li>
                                             <li><a class="dropdown-item ps-0" href="#"><span
                                                      class="categories__span">Верхняя
                                                      одежда</span></a></li>
                                             <li><a class="dropdown-item ps-0" href="#"><span
                                                      class="categories__span">Брюки и
                                                      шорты</span></a></li>
                                             <li><a class="dropdown-item ps-0" href="#"><span
                                                      class="categories__span">Толстовки</span></a></li>
                                             <li><a class="dropdown-item ps-0" href="#"><span
                                                      class="categories__span">Футболки</span></a></li>
                                             <li><a class="dropdown-item ps-0" href="#"><span
                                                      class="categories__span">Рубашки</span></a></li>
                                          </ul>
                                       </div>
                                    </div>
                                    <div class="row">
                                       <div class="col-xl-4 col-xl-4">
                                          <a href="#"><span class="class__title">Аксессуары</span></a>
                                          <ul class="list-unstyled mb-5 categories">
                                             <li><a class="dropdown-item ps-0 pt-4 pb-3" href="#"><span
                                                      class="categories__span">Все
                                                      товары</span></a></li>
                                             <li><a class="dropdown-item ps-0" href="#"><span
                                                      class="categories__span">Панамы</span></a></li>
                                             <li><a class="dropdown-item ps-0" href="#"><span
                                                      class="categories__span">Шарфы</span></a></li>
                                             <li><a class="dropdown-item ps-0" href="#"><span
                                                      class="categories__span">Сумки</span></a></li>
                                          </ul>
                                       </div>
                                       <div class="col-xl-4 col-xl-4">
                                          <a href="#"><span class="class__title">Всё для сна</span></a>
                                          <ul class="list-unstyled mb-5">
                                             <li><a class="dropdown-item ps-0 pt-4 pb-3" href="#"><span
                                                      class="categories__span">Все
                                                      товары</span></a></li>
                                             <li><a class="dropdown-item ps-0" href="#"><span
                                                      class="categories__span">Пододеяльники</span></a></li>
                                             <li><a class="dropdown-item ps-0" href="#"><span
                                                      class="categories__span">Простыни</span></a></li>
                                             <li><a class="dropdown-item ps-0" href="#"><span
                                                      class="categories__span">Наволочки</span></a></li>
                                             <li><a class="dropdown-item ps-0" href="#"><span
                                                      class="categories__span">Комплекты</span></a></li>
                                          </ul>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </li>
                     <li class="nav-item top-menu__list">
                        <a class="nav-link"><span class="top-menu__list1">Lookbook</span></a>
                     </li>
                     <li class="nav-item">
                        <a class="nav-link" href="#"><span class="top-menu__list1">Контакты</span></a>
                     </li>
                  </ul>
   
               </div>
   
               <a class="navbar-brand d-xl-none d-xxl-none mx-auto" href="http://localhost:8080/sites/takeandhug/index.php?page=1"><img class="logo" src="images/logo.svg"
                     alt="Логотип «Взять и обнять»"></a>
               <ul class="office list-group list-group-horizontal field-right navbar-nav ms-0  mb-2 mb-lg-0">
                  <li class="me-2 nav-item">
                     <a href="#"><img class="office__icon" src="images/search.svg" alt="поиск"></a>
                  </li>
                  <li class="me-2 nav-item">
                     <a href="#"><img class="office__icon" src="images/private.svg" alt="Личный кабинет"></a>
                  </li>
                  <li class="me-2 nav-item dropdown">
                     <a href="#"><img class="office__icon" src="images/heart.svg" alt="Избранное"></a>
                  </li>
                  <li class="me-2 nav-item position-relative">
                     <a class="office-cart" href="index.php?page=cart"><img class="office__icon" src="images/basket.svg" alt="Корзина"><span class="position-absolute top-0 end-0">$num_items_in_cart</span></a>
                  </li>
   
               </ul>
            </div>
         </nav>
      </header>
      <!--Окончание блока Меню-->
      <main>
   EOT;
}

// Подключение футера
function template_footer()
{
   $year = date('Y');
   echo <<<EOT
           </main>
           <footer class="footer">
      <div class="container-fluid">
         <div class="row ffield footer__area">
            <div class=" col-xl-3 col-lg-3 d-none d-xl-block d-xxl-block d-lg-block ">
               <nav class="nav flex-column footer__firstcolumn">
                  <a class="nav-link item" href="#">Покупателям</a>
                  <a class="nav-link item__list" href="#">Доставка</a>
                  <a class="nav-link item__list" href="#">Возврат и обмен</a>
                  <a class="nav-link item__list" href="#">Уход за товаром</a>
                  <a class="nav-link item__list" href="#">Таблица размеров</a>
               </nav>
            </div>
            <div class="col-xl-3 col-lg-3 d-none d-xl-block d-xxl-block d-lg-block">
               <nav class="nav flex-column">
                  <a class="nav-link item" href="#">Каталог</a>
                  <a class="nav-link item__list" href="index.php?page=products">Девочки</a>
                  <a class="nav-link item__list" href="#">Мальчики</a>
                  <a class="nav-link item__list" href="#">Женщины</a>
                  <a class="nav-link item__list" href="#">Аксессуары</a>
                  <a class="nav-link item__list" href="#">Все для сна</a>
               </nav>
            </div>
            <div class="col-xl-3 col-lg-3 d-none d-xl-block d-xxl-block d-lg-block">
               <nav class="nav flex-column">
                  <a class="nav-link item" href="#">О нас</a>
                  <a class="nav-link item" href="#">Lookbook</a>
                  <a class="nav-link item" href="#">Контакты</a>
               </nav>
            </div>

            <div class="offset-md-1 col-md-5 col-sm-6  col-12 d-lg-none d-xl-none d-xxl-none">

               <p class="footer-collapse">
                  <a class="footer-collapse__a" data-bs-toggle="collapse" href="#collapseCustomsFooter" role="button"
                     aria-expanded="false" aria-controls="collapseExample">
                     Покупателям <img class="carret-customers" src="images/Carret_Down.svg" alt="Вниз">
                  </a>
               </p>
               <div class="collapse collapse-list" id="collapseCustomsFooter">
                  <nav class="nav flex-column footer__firstcolumn">
                     <a class="nav-link item__list item__list--small" href="#">Доставка</a>
                     <a class="nav-link item__list item__list--small" href="#">Возврат и обмен</a>
                     <a class="nav-link item__list item__list--small" href="#">Уход за товаром</a>
                     <a class="nav-link item__list item__list--small" href="#">Таблица размеров</a>
                  </nav>
               </div>
               <p class="footer-collapse">
                  <a class="footer-collapse__a" data-bs-toggle="collapse" href="#collapseCatalogFooter" role="button"
                     aria-expanded="false" aria-controls="collapseExample">
                     Каталог <img class="carret-catalog" src="images/Carret_Down.svg" alt="Вниз">
                  </a>
               </p>
               <div class="collapse collapse-list" id="collapseCatalogFooter">
                  <nav class="nav flex-column footer__firstcolumn">
                     <a class="nav-link item__list item__list--small" href="index.php?page=products">Девочки</a>
                     <a class="nav-link item__list item__list--small" href="#">Мальчики</a>
                     <a class="nav-link item__list item__list--small" href="#">Женщины</a>
                     <a class="nav-link item__list item__list--small" href="#">Аксессуары</a>
                     <a class="nav-link item__list item__list--small" href="#">Все для сна</a>
                  </nav>
               </div>
               <p class="item">
                  О нас
               </p>
               <p class="item">
                  Lookbook
               </p>
               <p class="item">
                  Контакты
               </p>
            </div>

            <div class="contacts  col-xl-3 col-lg-3 col-md-5 col-sm-6  col-12">
               <h5 class="item contacts__social">Мы в социальных сетях:</h5>
               <ul class="social list-unstyled list-group list-group-horizontal">
                  <li class="social__block"><a href="#"><img src="images/inst.svg" alt="Инстаграм"></a></li>
                  <li class="social__block"><a href="#"><img src="images/vk.svg" alt="Вконтакте"></a></li>
                  <li class="social__block"><a href="#"><img src="images/tg.svg" alt="Телеграм"></a></li>
               </ul>
               <h5 class="item contacts__phone">Телефон:</h5>
               <p class="phone"><a class="item__list phone__a" href="tel:+79123456789">+7 912 345–67–89</a></p>
               <h6 class="sign contacts-sign">Telegram и WhatsApp </h6>
            </div>
         </div>
         <div class="row copyright">
            <div class="copyright__block1 col-xl-4 col-lg-7 col-md-7 col-sm-12 col-12">
               <p class="sign copyright__area copyright__block1--center">Все права защищены &#xa9; $year ООО
                  «Взять и обнять»</p>
            </div>
            <div class="copyright__block2 col-xl-3 offset-xl-5  col-lg-5 col-md-5 col-sm-12 col-12">
               <p class="sign copyright__area sign__developer copyright__block2--center">Разработка сайта — <a
                     href="#">Дарья Рыкова</a></p>
            </div>
         </div>
      </div>
   </footer>
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
      crossorigin="anonymous"></script>
      <script src="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.js"></script>
      <script src="script/script.js"></script>
      
</body>
</html>
EOT;
}
