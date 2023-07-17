// Scripts especificos do layout
/**
 * Exemplo:
 * Se precisar adicionar alguma classe ou manipular algum elemento
 *
 *
 */

//NUMBERSUP
// const numObserver = new IntersectionObserver(
//     (entries, observer) => {
//         entries.forEach((entry) => {
//             if (entry.isIntersecting) {
//                 observer.unobserve(entry.target);
//                 let valueDisplays = document.querySelectorAll(".counter-up");
//                 let interval = 2000;
//                 valueDisplays.forEach((valueDisplay) => {
//                     let startValue = 0;
//                     let endValue = parseInt(valueDisplay.getAttribute("data-val"));
//                     let countPlus = parseInt(valueDisplay.getAttribute("data-plus"));
//                     if (endValue > 1000) {
//                         countPlus = 10
//                     }
//                     if (endValue > 10000) {
//                         countPlus = 100
//                     }
//                     let duration = Math.floor(interval / endValue);
//                     let counter = setInterval(function () {
//                         startValue += countPlus;
//                         valueDisplay.textContent = startValue;
//                         if (startValue == endValue) {
//                             clearInterval(counter);
//                         }
//                     }, duration);
//                 });
//             }
//         });
//     },
//     {
//         rootMargin: "0px 0px 0px 0px",
//     }
// );
// numObserver.observe(document.querySelector(".numbers-up"));


// Smooth scroll para seção
(function () {
    document.querySelectorAll('a[href^="#"]').forEach((anchor) => {
        anchor.addEventListener("click", function (e) {
            e.preventDefault();
            if (this.getAttribute("href") !== "#") {
                let target = document.querySelector(this.getAttribute("href"));
                if (target) {
                    target.scrollIntoView({
                        behavior: "smooth",
                        block: "center",
                        inline: "center",
                    });
                }
            }
        });
    });
})();

// Lazy loading das imagens que possuem data-src
(function () {
    var lazyLoadImages = document.querySelectorAll("img[data-src]");
    if (lazyLoadImages) {
        const lazyLoadObserver = new IntersectionObserver(
            (entries, observer) => {
                entries.forEach((entry) => {
                    if (entry.isIntersecting) {
                        let currentImage = entry.target;
                        currentImage.src = currentImage.dataset.src; // src = data-src
                        // Remove loader caso ele seja o proximo irmao daquela imagem
                        entry.target.addEventListener("load", function () {
                            let loader = this.nextElementSibling;
                            if (loader && loader.classList.contains("loader"))
                                loader.remove();
                        });
                        observer.unobserve(entry.target);
                    }
                });
            },
            {
                rootMargin: "50% 50% 50% 50%",
            }
        );

        lazyLoadImages.forEach((el) => {
            lazyLoadObserver.observe(el);
        });
    }
})();

// Botão whatsapp fixo
$(document).ready(function () {
    $(".btn-whatsapp").click(function () {
        $(this).addClass("active");
        $(".whatsapp-form").toggleClass("show");
    });

    $(".whatsapp-form-close").click(function () {
        $(".whatsapp-form").removeClass("show");
        $(".btn-whatsapp").removeClass("active");
    });

    $(".timeline-image").css({
        "margin-top": -$(".timeline-title").height(),
    });
});

$('.input-radio-filter').on('change', function(){
    $(this).closest("form").submit()
})