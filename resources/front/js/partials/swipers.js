/**
 * Declaração dos swipers
 * Exemplo:
 * let swiper = new Swiper(".swiper-teste", {opcoes})
 */

new Swiper(".banner-swiper", {
    autoplay: {
        delay: 7500,
        disableOnInteraction: false,
    },
    //rewind: false,
    navigation: {
        nextEl: ".banner-swiper .swiper-button-next",
        prevEl: ".banner-swiper .swiper-button-prev",
        clickable: true,
    },
    /*pagination: {
        el: ".banner-swiper .swiper-pagination",
        type: "bullets",
        clickable: true,
    },*/
    pagination: {
        el: ".banner-swiper .swiper-pagination",
        clickable: true,
        renderBullet: function (index, className) {
            return '<span class="p-22 p-700 text-primary ' + className + '">' + (index + 1) + "</span>";
        },
    },
});

new Swiper(".historia-swiper", {
    slidesPerView: 1.25,
    spaceBetween: 32,
    breakpoints: {
        580: {
            slidesPerView: 1.5,
        },
        992: {
            slidesPerView: 2.25,
        },

        1200: {
            slidesPerView: 2.5,
        },
        1400: {
            slidesPerView: 3.75,
        },
    },
    pagination: {
        el: ".historia-swiper .swiper-pagination",
        type: "bullets",
        dynamicBullets: true,
        clickable: true,
    },
});

new Swiper(".produtos-detalhe-swiper", {
    slidesPerView: 1,
    //rewind: false,
    navigation: {
        nextEl: ".produtos-detalhe-swiper .swiper-button-next",
        prevEl: ".produtos-detalhe-swiper .swiper-button-prev",
        clickable: true,
    },
    pagination: {
        el: ".produtos-detalhe-swiper .swiper-pagination",
        type: "bullets",
        clickable: true,
    },
});

new Swiper(".gallery-swiper", {
    rewind: false,
    slidesPerView: 1,
    spaceBetween: 1,
    navigation: {
        nextEl: ".gallery-swiper .swiper-button-next",
        prevEl: ".gallery-swiper .swiper-button-prev",
    },
    pagination: {
        el: ".gallery-swiper .swiper-pagination",
        type: "bullets",
        dynamicBullets: true,
        clickable: true,
    },
});
new Swiper(".categories-swiper", {
    rewind: false,
    slidesPerView: 1,
    spaceBetween: 25,
    navigation: {
        nextEl: ".categories-swiper .swiper-button-next",
        prevEl: ".categories-swiper .swiper-button-prev",
    },
    pagination: {
        el: ".categories-swiper .swiper-pagination",
        type: "bullets",
        dynamicBullets: true,
        clickable: true,
    },
    breakpoints: {
        992: {
            slidesPerView: 3,
        },
        767: {
            slidesPerView: 2,
        },
        0: {
            slidesPerView: 1,
        },
    },
});
new Swiper(".relacionados-swiper", {
    rewind: false,
    slidesPerView: 1,
    spaceBetween: 25,
    navigation: {
        nextEl: ".relacionados-swiper .swiper-button-next",
        prevEl: ".relacionados-swiper .swiper-button-prev",
    },
    pagination: {
        el: ".relacionados-swiper .swiper-pagination",
        type: "bullets",
        dynamicBullets: true,
        clickable: true,
    },
    breakpoints: {
        992: {
            slidesPerView: 4,
        },
        767: {
            slidesPerView: 3,
        },
        0: {
            slidesPerView: 2,
        },
    },
});
new Swiper(".produtos-swiper", {
    rewind: false,
    slidesPerView: 2,
    spaceBetween: 25,
    navigation: {
        nextEl: ".produtos-swiper .swiper-button-next",
        prevEl: ".produtos-swiper .swiper-button-prev",
    },
    pagination: {
        el: ".produtos-swiper .swiper-pagination",
        type: "bullets",
        dynamicBullets: true,
        clickable: true,
    },
    breakpoints: {
        992: {
            slidesPerView: 3,
        },
        576: {
            slidesPerView: 2,
        },
        0: {
            slidesPerView: 1,
        },
    },
});
new Swiper(".numeros-swiper", {
    //rewind: false,
    slidesPerView: 2,
    spaceBetween: 50,
    navigation: {
        nextEl: ".numeros-swiper .swiper-button-next",
        prevEl: ".numeros-swiper .swiper-button-prev",
    },
    pagination: {
        el: ".numeros-swiper .swiper-pagination",
        type: "bullets",
        dynamicBullets: true,
        clickable: true,
    },
    breakpoints: {
        992: {
            slidesPerView: 4,
        },
        767: {
            slidesPerView: 3,
        },
        576: {
            slidesPerView: 2,
        },
    },
});
new Swiper(".empresa-swiper", {
    //rewind: false,
    slidesPerView: 2,
    spaceBetween: 8,
    navigation: {
        nextEl: ".empresa-swiper .swiper-button-next",
        prevEl: ".empresa-swiper .swiper-button-prev",
    },
    pagination: {
        el: ".empresa-swiper .swiper-pagination",
        type: "bullets",
        dynamicBullets: true,
        clickable: true,
    },
    breakpoints: {
        992: {
            slidesPerView: 4,
        },
        767: {
            slidesPerView: 3,
        },
        576: {
            slidesPerView: 2,
        },
    },
});
new Swiper(".brief-swiper", {
    rewind: false,
    slidesPerView: 1,
    //spaceBetween: 25,
    navigation: {
        nextEl: ".brief-swiper .swiper-button-next",
        prevEl: ".brief-swiper .swiper-button-prev",
    },
    pagination: {
        el: ".brief-swiper .swiper-pagination",
        type: "bullets",
        dynamicBullets: true,
        clickable: true,
    },
});
