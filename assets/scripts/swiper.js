var mySwiper = new Swiper('.swiper-container', {
    // Optional parameters
    spaceBetween: 5,
    slidesPerView: 2,
    loop: true,
    freeMode: true,
    speed: 500,
    // Navigation arrows
    navigation: {
        nextEl: '.swiper-button-next',
        nextEl: '.next',
        prevEl: '.prev',
    },
    breakpoints: {
        // when window width is >= 640px
        640: {
            slidesPerView: 5,
            slidesPerGroup: 5,
            freeMode: false
        }
    }
})