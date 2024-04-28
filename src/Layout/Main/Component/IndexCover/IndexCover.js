const makeIndexCover = () => {
    const coversCount = document.querySelectorAll('.index-cover .cover').length;

    new Swiper('.swiper-container', {
        loop: true,
        speed: 400,
        followFinger: coversCount > 1,
        pagination: {
            el: '.cover-pagination',
            clickableClass: 'cover-pagination',
            modifierClass: 'cover-pagination-',
            bulletClass: 'cover-pagination-bullet',
            bulletActiveClass: 'cover-pagination-bullet-active',
            clickable: true,
            progressbarOpposite: false,
            renderBullet: function (index, className) {
                return '<span class="' + className + '">' + (index % 2 == 0 ? '&#9650;' : '&#9660;') + '</span>';
            },
        },
        autoplay: {
            delay: coversCount > 1 ? 5000 : 999999,
        },
    });
};
