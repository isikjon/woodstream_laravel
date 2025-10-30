document.addEventListener('DOMContentLoaded', () => {
    // header
    const headerCatalog = document.querySelector('.header__catalog');
    const headerCatalogModal = document.querySelector('.header-catalog__modal');
    const headerCatalogClose = document.querySelector('.header-catalog__modal-close');
    headerCatalog.addEventListener('click', (e) => {
        e.preventDefault();
        headerCatalogModal.classList.toggle('header-catalog__modal--show');
    });

    headerCatalogClose.addEventListener('click', (e) => {
        e.preventDefault();
        headerCatalogModal.classList.remove('header-catalog__modal--show');
    });

    // menu
    const headerBurger = document.querySelector('.header__burger');
    const headerMenu = document.querySelector('.header-menu');
    const headerMenuClose = document.querySelector('.header-menu__close');
    headerMenuClose.addEventListener('click', (e) => {
        e.preventDefault();
        headerMenu.classList.remove('header-menu--show');
    });
    headerBurger.addEventListener('click', (e) => {
        e.preventDefault();
        headerMenu.classList.add('header-menu--show');
    });


    // header nav more
    const headerNavMore = document.querySelector('.header__nav-more');
    const headerNavList = document.querySelector('.header__nav-dropdown-list');
    headerNavMore.addEventListener('click', () => {
        headerNavMore.classList.toggle('header__nav-more--active');
        headerNavList.classList.toggle('header__nav-dropdown-list--show');
    });

    // modal theme
    const headerTheme = document.querySelector('.header__theme');
    const modalTheme = document.querySelector('.modal-theme');
    const modalThemeClose = document.querySelector('.modal-theme__close');
    const headerMenuTheme = document.querySelector('.header-menu__contacts-item--theme');
    const themeLight = document.querySelector('.modal-theme__item--light');
    const themeDark = document.querySelector('.modal-theme__item--dark');
    headerTheme.addEventListener('click', (e) => {
        e.preventDefault();
        modalTheme.classList.add('modal--show');
    });

    headerMenuTheme.addEventListener('click', (e) => {
        e.preventDefault();
        modalTheme.classList.add('modal--show');
    });

    modalThemeClose.addEventListener('click', (e) => {
        e.preventDefault();
        modalTheme.classList.remove('modal--show');
    });

    themeLight.addEventListener('click', (e) => {
        e.preventDefault();
        modalTheme.classList.remove('modal--show');
        document.body.classList.remove('dark');
        headerTheme.querySelector('.header__theme-mode').textContent = 'Светлая';
        headerMenuTheme.querySelector('span').textContent = 'Светлая';
    });

    themeDark.addEventListener('click', (e) => {
        e.preventDefault();
        modalTheme.classList.remove('modal--show');
        document.body.classList.add('dark');
        headerTheme.querySelector('.header__theme-mode').textContent = 'Тёмная';
        headerMenuTheme.querySelector('span').textContent = 'Тёмная';
    });

    const antiqueSwiper = new Swiper('.antique-swiper .swiper', {
        slidesPerView: 2.5,
        spaceBetween: 24,
        navigation: {
            nextEl: '.antique-button__next',
        },
        loop: true,

        breakpoints: {
            1: {
                slidesPerView: 1.8,
                spaceBetween: 12,
            },
            1191: {
                slidesPerView: 2.5,
                spaceBetween: 24,
            }
        },
    });

    // weekly show all
    const weeklyAll = document.querySelector('.weekly-all');
    const weeklyGrid = document.querySelector('.weekly-grid');

    if (weeklyGrid) {
        weeklyAll.addEventListener('click', () => {
            weeklyGrid.classList.toggle('weekly-grid--all');
            if (weeklyGrid.classList.contains('weekly-grid--all')) {
                weeklyAll.querySelector('span').textContent = 'Скрыть';
                weeklyAll.classList.add('weekly-all--active');
            } else {
                weeklyAll.querySelector('span').textContent = 'Показать ещё';
                weeklyAll.classList.remove('weekly-all--active');
            }
        });
    }

    const interiorSwiper = new Swiper('.interior-swiper .swiper', {
        slidesPerView: "auto",
        spaceBetween: 34,
        navigation: {
            nextEl: '.interior-button__next',
        },
        loop: true,
        breakpoints: {
            1: {
                spaceBetween: 16,
            },
            1191: {
                spaceBetween: 34,
            }
        },
    });

    document.querySelectorAll("img").forEach(img => {
        if (!img.hasAttribute("loading")) {
            img.setAttribute("loading", "lazy");
        }
    });

    // footer accordion
    const items = document.querySelectorAll(".footer-accordion__item");

    items.forEach(item => {
        const header = item.querySelector(".footer-accordion__header");

        header.addEventListener("click", () => {
            // 🔹 Agar faqat bitta accordion ochilsin desang, pastdagi kodni ishlat:
            items.forEach(i => {
                if (i !== item) {
                    i.classList.remove("footer-accordion__item--active");
                }
            });

            // 🔹 Bosilgan itemni toggle qilish
            item.classList.toggle("footer-accordion__item--active");
        });
    });

    // filter accordion
    const filterItems = document.querySelectorAll(".catalog-filter__item");

    if (filterItems.length > 0) {
        filterItems.forEach(item => {
            const header = item.querySelector(".catalog-filter__head");

            header.addEventListener("click", () => {
                // 🔹 Bosilgan itemni toggle qilish
                item.classList.toggle("catalog-filter__item--active");
            });
        });
    }


    const catalogFilterMore = document.querySelectorAll('.catalog-filter__more');

    if (catalogFilterMore.length > 0) {
        catalogFilterMore.forEach(item => {
            const catalogFilterLabel = item.parentElement.querySelectorAll('.catalog-filter__label');
            item.addEventListener('click', (e) => {
                e.preventDefault();
                item.classList.toggle('catalog-filter__more--active');
                catalogFilterLabel.forEach(label => {
                    label.classList.toggle('catalog-filter__label--active');
                });

                if (item.classList.contains('catalog-filter__more--active')) {
                    item.querySelector('span').textContent = 'Скрыть';
                } else {
                    item.querySelector('span').textContent = 'Показать ещё';
                }
            });
        });
    }

    // catalog all

    const catalogAll = document.querySelector('.catalog-all');
    const catalogGrid = document.querySelector('.catalog-products__grid');

    if (catalogGrid) {
        catalogAll.addEventListener('click', () => {
            catalogGrid.classList.toggle('catalog-products__grid--all');
            if (catalogGrid.classList.contains('catalog-products__grid--all')) {
                catalogAll.querySelector('span').textContent = 'Скрыть';
                catalogAll.classList.add('catalog-all--active');
            } else {
                catalogAll.querySelector('span').textContent = 'Показать ещё';
                catalogAll.classList.remove('catalog-all--active');
            }
        });
    }

    // product swiper
    let productThumbs = new Swiper(".product-thumbs", {
        spaceBetween: 10,
        slidesPerView: 5,
        loop: true,
        breakpoints: {
            1: {
                spaceBetween: 8,
            },
            1191: {
                spaceBetween: 10,
            }
        },
    });
    let productSwiper = new Swiper(".product-swiper", {
        spaceBetween: 10,
        loop: true,
        navigation: {
            nextEl: ".product-swiper__next",
            prevEl: ".product-swiper__prev",
        },
        pagination: {
            el: ".product-swiper__pagination",
            clickable: true,
        },
        thumbs: {
            swiper: productThumbs,
        },
    });


    // similar swiper
    const similarSwiper = new Swiper('.similar-swiper .swiper', {
        slidesPerView: 2.5,
        spaceBetween: 24,
        navigation: {
            nextEl: '.similar-button__next',
            prevEl: '.similar-button__prev',
        },
        loop: true,
        breakpoints: {
            1: {
                slidesPerView: 1.8,
                spaceBetween: 12,
            },
            1191: {
                slidesPerView: 4,
                spaceBetween: 29,
            }
        },
    });

    const catalogFilterOpener = document.querySelector('.catalog-filter__opener');
    const catalogFilter = document.querySelector('.catalog-filter');
    const catalogFilterClose = document.querySelectorAll('.catalog-filter__close');

    if (catalogFilterOpener && catalogFilter && catalogFilterClose.length > 0) {
        catalogFilterClose.forEach(item => {
            item.addEventListener('click', () => {
                catalogFilter.classList.remove('catalog-filter--active');
            })
        })
        catalogFilterOpener.addEventListener('click', () => {
            catalogFilter.classList.add('catalog-filter--active');
        });
    }

    // modal info with time
    const modalInfo = document.querySelector('.modal-info');

    const modalInfoClose = document.querySelector('.modal-info__close');

    if (modalInfo && modalInfoClose) {
        setTimeout(() => {
            modalInfo.classList.add('modal--show');
        }, 500);

        modalInfoClose.addEventListener('click', () => {
            modalInfo.classList.remove('modal--show');
        });

        window.addEventListener('click', (e) => {
            // modalning ichki qismiga bosilmagan bo‘lsa
            if (e.target === modalInfo) {
                modalInfo.classList.remove('modal--show');
            }
        });
    }

    const header = document.querySelector('.header');

    window.addEventListener('scroll', () => {
        if (window.scrollY > 30) {
            header.classList.add('header--scroll');
        } else {
            header.classList.remove('header--scroll');
        }
    });

    // modal login

    const openLogin = document.querySelector('.header__login');
    const modalLogin = document.querySelector('.modal-login');
    const modalLoginClose = document.querySelector('.modal-login__close');

    if (modalLogin && modalLoginClose) {
        modalLoginClose.addEventListener('click', (e) => {
            e.preventDefault();
            modalLogin.classList.remove('modal--show');
        });
        openLogin.addEventListener('click', (e) => {
            e.preventDefault();
            modalLogin.classList.add('modal--show');
        });

        window.addEventListener('click', (e) => {
            // modalning ichki qismiga bosilmagan bo‘lsa
            if (e.target === modalLogin) {
                modalLogin.classList.remove('modal--show');
            }
        });
    }


    const modalSuccess = document.querySelector('.modal-success');
    const modalSuccessClose = document.querySelector('.modal-success__close');
    const modalSuccessBtn = document.querySelector('.modal-success__btn');
    if (modalSuccess && modalSuccessClose) {
        modalSuccessClose.addEventListener('click', (e) => {
            e.preventDefault();
            modalSuccess.classList.remove('modal--show');
        });

        modalSuccessBtn.addEventListener('click', (e) => {
            e.preventDefault();
            modalSuccess.classList.remove('modal--show');
        });

        window.addEventListener('click', (e) => {
            // modalning ichki qismiga bosilmagan bo‘lsa
            if (e.target === modalSuccess) {
                modalSuccess.classList.remove('modal--show');
            }
        });
    }

});