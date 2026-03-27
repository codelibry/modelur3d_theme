import Swiper from 'swiper';
import { Pagination, Autoplay } from 'swiper/modules';
import 'swiper/swiper-bundle.css';

function TestimSlider() {
    const swiper = document.querySelector('.testimonials__slider');

    if (swiper) {
        new Swiper(swiper, {
            modules: [Pagination, Autoplay],
            slidesPerView: 1,
            spaceBetween: 30,
            loop: true,
            autoplay: {
                delay: 4000,
                disableOnInteraction: false,
            },
            pagination: {
                el: '.testimonials__pagination',
                clickable: true,
            },
            breakpoints: {
                768: {
                    slidesPerView: 2,
                    spaceBetween: 20,
                },
                1024: {
                    slidesPerView: 3,
                    spaceBetween: 30,
                },
            },
        });
    }
}

export default TestimSlider;
