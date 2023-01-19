
// Фильтр "Цена"
const rangeInput = document.querySelectorAll(".range-input input");
priceInput = document.querySelectorAll(".price__input input");
progress = document.querySelector(".price__slider .price__progress")
let priceGap = 1000;
priceInput.forEach(input => {
   input.addEventListener("input", e => {
      let minVal = parseInt(priceInput[0].value),
         maxVal = parseInt(priceInput[1].value);
      if ((maxVal - minVal >= priceGap) && maxVal <= 17000) {
         if (e.target.className === "input-min") {
            rangeInput[0].value = minVal;
            progress.style.left = (minVal / rangeInput[0].max) * 100 + "%";
         } else {
            rangeInput[1].value = maxVal;
            progress.style.right = 100 - (maxVal / rangeInput[1].max) * 100 + "%";
         }

      }
   });
});
rangeInput.forEach(input => {
   input.addEventListener("input", e => {
      let minVal = parseInt(rangeInput[0].value),
         maxVal = parseInt(rangeInput[1].value);
      if (maxVal - minVal < priceGap) {
         if (e.target.className === "range-min") {
            rangeInput[0].value = maxVal - priceGap;
         } else {
            rangeInput[1].value = minVal + priceGap;
         }
      } else {
         priceInput[0].value = minVal;
         priceInput[1].value = maxVal;
         progress.style.left = (minVal / rangeInput[0].max) * 100 + "%";
         progress.style.right = 100 - (maxVal / rangeInput[1].max) * 100 + "%";
      }
   });
});
// Слайдер на странице продукта (product.php)
const swiper = new Swiper('.slider-block', {
   slidesPerView: 1,
   // Navigation arrows
   navigation: {
      nextEl: '.swiper-button-next',
      prevEl: '.swiper-button-prev',
   },
   // If we need pagination
   pagination: {
      el: '.swiper-pagination',
   }
});
const sliderNavItems = document.querySelectorAll('.slider-nav__item');
sliderNavItems.forEach((el, index) => {
   el.setAttribute('data-index', index);

   el.addEventListener('click', (e) => {
      const index = parseInt(e.currentTarget.dataset.index);
      console.log(index)
      swiper.slideTo(index);
   });
});
// Счетчик на странице продукта (product.php)
document.addEventListener('click', function (e) {
   if (e.target.classList.contains("increase")) {
      if (e.target.parentElement.querySelector("input").value >= 1 && e.target.parentElement.querySelector("input").value < 10) {
         ++e.target.parentElement.querySelector("input").value;
      }
   } else if (e.target.classList.contains("decrease")) {
      if (e.target.parentElement.querySelector("input").value <= 10 && e.target.parentElement.querySelector("input").value > 1) {
         --e.target.parentElement.querySelector("input").value;
      }
   }
});
// Всплывающие подсказки на странице продукта (product.php)
var tooltipTriggerList = Array.prototype.slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
   return new bootstrap.Tooltip(tooltipTriggerEl)
});



