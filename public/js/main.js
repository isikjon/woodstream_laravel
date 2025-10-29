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
        if (window.innerWidth <= 1190) {
            headerNavMore.classList.toggle('header__nav-more--active');
            headerNavList.classList.toggle('header__nav-dropdown-list--show');
        }
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

    // Modal system with queue and close counter
    const modalInfo = document.querySelector('.modal-info');
    const promoModals = document.querySelectorAll('.modal-promo');
    const allModals = [];
    
    if (modalInfo) allModals.push(modalInfo);
    promoModals.forEach(modal => allModals.push(modal));
    
    if (allModals.length > 0) {
        let currentModalIndex = 0;
        const CLOSE_LIMIT = 3;
        
        function getModalCloseCount() {
            const closeData = localStorage.getItem('modal_close_count');
            return closeData ? JSON.parse(closeData) : {};
        }
        
        function setModalCloseCount(modalId, count) {
            const closeData = getModalCloseCount();
            closeData[modalId] = count;
            localStorage.setItem('modal_close_count', JSON.stringify(closeData));
        }
        
        function shouldShowModal(modal) {
            const modalId = modal.dataset.modalId;
            const closeCount = getModalCloseCount()[modalId] || 0;
            return closeCount < CLOSE_LIMIT;
        }
        
        function showNextModal() {
            if (currentModalIndex >= allModals.length) return;
            
            const modal = allModals[currentModalIndex];
            const isActive = modal.dataset.active === 'true';
            const delay = parseInt(modal.dataset.delay || 0) * 1000;
            
            if (isActive && shouldShowModal(modal)) {
                setTimeout(() => {
                    modal.classList.add('modal--show');
                }, delay);
            } else {
                currentModalIndex++;
                showNextModal();
            }
        }
        
        // Обработчик для modal-info
        if (modalInfo) {
            const closeBtn = modalInfo.querySelector('.modal-info__close');
            const modalId = modalInfo.dataset.modalId;
            
            if (closeBtn) {
                closeBtn.addEventListener('click', () => {
                    modalInfo.classList.remove('modal--show');
                    
                    const closeCount = getModalCloseCount()[modalId] || 0;
                    setModalCloseCount(modalId, closeCount + 1);
                    
                    currentModalIndex++;
                    setTimeout(() => showNextModal(), 500);
                });
            }
            
            window.addEventListener('click', (e) => {
                if (e.target === modalInfo) {
                    modalInfo.classList.remove('modal--show');
                    
                    const closeCount = getModalCloseCount()[modalId] || 0;
                    setModalCloseCount(modalId, closeCount + 1);
                    
                    currentModalIndex++;
                    setTimeout(() => showNextModal(), 500);
                }
            });
        }
        
        // Обработчики для promo модалок
        promoModals.forEach((modal) => {
            const closeBtn = modal.querySelector('.modal-promo__close');
            const modalId = modal.dataset.modalId;
            
            if (closeBtn) {
                closeBtn.addEventListener('click', () => {
                    modal.classList.remove('modal--show');
                    
                    const closeCount = getModalCloseCount()[modalId] || 0;
                    setModalCloseCount(modalId, closeCount + 1);
                    
                    currentModalIndex++;
                    setTimeout(() => showNextModal(), 500);
                });
            }
            
            window.addEventListener('click', (e) => {
                if (e.target === modal) {
                    modal.classList.remove('modal--show');
                    
                    const closeCount = getModalCloseCount()[modalId] || 0;
                    setModalCloseCount(modalId, closeCount + 1);
                    
                    currentModalIndex++;
                    setTimeout(() => showNextModal(), 500);
                }
            });
        });
        
        showNextModal();
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
            if (e.target === modalLogin) {
                modalLogin.classList.remove('modal--show');
            }
        });
    }

    // phone mask
    const phoneInput = document.querySelector('input[type="tel"]');
    if (phoneInput) {
    phoneInput.addEventListener('input', function(e) {
        let value = e.target.value.replace(/\D/g, '');
        
        if (value.length === 0) {
            e.target.value = '';
            validateField(e.target);
            return;
        }
        
        if (value[0] === '7' || value[0] === '8') {
            value = value.substring(1);
        }
        
        if (value.length > 10) {
            value = value.substring(0, 10);
        }
        
        let formattedValue = '8';
        
        if (value.length > 0) {
            formattedValue += ' (' + value.substring(0, 3);
        }
        if (value.length > 3) {
            formattedValue += ') ' + value.substring(3, 6);
        }
        if (value.length > 6) {
            formattedValue += '-' + value.substring(6, 8);
        }
        if (value.length > 8) {
            formattedValue += '-' + value.substring(8, 10);
        }
        
        e.target.value = formattedValue;
        validateField(e.target);
    });

    phoneInput.addEventListener('keydown', function(e) {
        if (e.key === 'Backspace' && e.target.value === '8 ') {
            e.preventDefault();
            e.target.value = '';
            validateField(e.target);
        }
    });

    phoneInput.addEventListener('focus', function(e) {
        if (e.target.value === '') {
            e.target.value = '8 ';
        }
    });

    phoneInput.addEventListener('blur', function(e) {
        validateField(e.target);
    });
    }

    // field validation
    function validateField(field) {
        field.classList.remove('valid', 'invalid');
        
        if (field.value.trim() === '') {
            return;
        }
        
        if (field.checkValidity()) {
            field.classList.add('valid');
        } else {
            field.classList.add('invalid');
        }
    }

    // validate all form inputs
    const formInputs = document.querySelectorAll('.modal-input');
    formInputs.forEach(input => {
        input.addEventListener('input', function(e) {
            validateField(e.target);
        });
        
        input.addEventListener('blur', function(e) {
            validateField(e.target);
        });
    });


    const modalSuccess = document.querySelector('.modal-success');
    const modalSuccessClose = document.querySelector('.modal-success__close');
    const modalSuccessBtn = document.querySelector('.modal-success__btn');
    if (modalSuccess && modalSuccessClose) {
        modalSuccessClose.addEventListener('click', (e) => {
            e.preventDefault();
            modalSuccess.style.display = 'none';
            modalSuccess.style.opacity = '0';
            modalSuccess.style.visibility = 'hidden';
            modalSuccess.classList.remove('modal--active');
            document.body.style.overflow = 'auto';
        });

        modalSuccessBtn.addEventListener('click', (e) => {
            e.preventDefault();
            modalSuccess.style.display = 'none';
            modalSuccess.style.opacity = '0';
            modalSuccess.style.visibility = 'hidden';
            modalSuccess.classList.remove('modal--active');
            document.body.style.overflow = 'auto';
        });

        window.addEventListener('click', (e) => {
            if (e.target === modalSuccess) {
                modalSuccess.style.display = 'none';
                modalSuccess.style.opacity = '0';
                modalSuccess.style.visibility = 'hidden';
                modalSuccess.classList.remove('modal--active');
                document.body.style.overflow = 'auto';
            }
        });
    }

    const searchInput = document.querySelector('.header__search-input');
    const searchForm = document.querySelector('.header__search');
    
    const searchResults = document.createElement('div');
    searchResults.className = 'search-results';
    
    if (searchInput && searchForm) {
        searchForm.appendChild(searchResults);
        
        let searchTimeout;
        let selectedIndex = -1;
        let results = [];
        
        searchInput.addEventListener('input', function(e) {
            const query = e.target.value.trim();
            
            clearTimeout(searchTimeout);
            
            if (query.length < 2) {
                searchResults.style.display = 'none';
                return;
            }
            
            searchResults.innerHTML = '<div class="search-results-loading">Поиск...</div>';
            searchResults.style.display = 'block';
            
            searchTimeout = setTimeout(() => {
                fetch(`/search/autocomplete?q=${encodeURIComponent(query)}`)
                    .then(response => response.json())
                    .then(data => {
                        results = data;
                        selectedIndex = -1;
                        displayResults(data);
                    })
                    .catch(err => {
                        console.error('Search error:', err);
                        searchResults.innerHTML = '<div class="search-results-empty">Ошибка поиска</div>';
                    });
            }, 300);
        });
        
        searchInput.addEventListener('keydown', function(e) {
            if (!searchResults.style.display || searchResults.style.display === 'none') {
                return;
            }
            
            if (e.key === 'ArrowDown') {
                e.preventDefault();
                selectedIndex = Math.min(selectedIndex + 1, results.length - 1);
                highlightResult();
            } else if (e.key === 'ArrowUp') {
                e.preventDefault();
                selectedIndex = Math.max(selectedIndex - 1, -1);
                highlightResult();
            } else if (e.key === 'Enter') {
                e.preventDefault();
                if (selectedIndex >= 0 && results[selectedIndex]) {
                    window.location.href = results[selectedIndex].url;
                } else if (results.length > 0) {
                    window.location.href = results[0].url;
                } else if (searchInput.value.trim().length >= 2) {
                    window.location.href = `/search?q=${encodeURIComponent(searchInput.value.trim())}`;
                }
            } else if (e.key === 'Escape') {
                searchResults.style.display = 'none';
                selectedIndex = -1;
            }
        });
        
        searchForm.addEventListener('submit', function(e) {
            e.preventDefault();
            const query = searchInput.value.trim();
            if (query.length >= 2) {
                if (results.length > 0) {
                    window.location.href = results[0].url;
                } else {
                    window.location.href = `/search?q=${encodeURIComponent(query)}`;
                }
            }
        });
        
        function displayResults(data) {
            if (data.length === 0) {
                searchResults.innerHTML = '<div class="search-results-empty">Ничего не найдено</div>';
                searchResults.style.display = 'block';
                return;
            }
            
            searchResults.innerHTML = data.map((item, index) => {
                const statusClass = item.status === 'Продан' ? 'sold' : '';
                return `
                    <a href="${item.url}" class="search-result-item" data-index="${index}">
                        <div class="search-result-content">
                            <div class="search-result-name">${item.name}</div>
                            <div class="search-result-meta">
                                ${item.code ? `<span class="search-result-code">Арт: ${item.code}</span>` : ''}
                                <span class="search-result-status ${statusClass}">${item.status}</span>
                            </div>
                        </div>
                        <div class="search-result-price">${item.price}</div>
                    </a>
                `;
            }).join('');
            
            searchResults.style.display = 'block';
            
            document.querySelectorAll('.search-result-item').forEach(item => {
                item.addEventListener('mouseenter', function() {
                    selectedIndex = parseInt(this.dataset.index);
                    highlightResult();
                });
                item.addEventListener('click', function(e) {
                    e.preventDefault();
                    window.location.href = this.href;
                });
            });
        }
        
        function highlightResult() {
            const items = searchResults.querySelectorAll('.search-result-item');
            items.forEach((item, index) => {
                if (index === selectedIndex) {
                    item.classList.add('active');
                } else {
                    item.classList.remove('active');
                }
            });
        }
        
        document.addEventListener('click', function(e) {
            if (!searchForm.contains(e.target)) {
                searchResults.style.display = 'none';
                selectedIndex = -1;
            }
        });
    }

    // Product order form handling
    const productForm = document.querySelector('.product-form');
    if (productForm) {
        const productButton = productForm.querySelector('.product-button');
        const nameInput = productForm.querySelector('input[placeholder="Имя"]');
        const phoneInput = productForm.querySelector('input[placeholder="Телефон"]');
        const emailInput = productForm.querySelector('input[placeholder="E-mail"]');
        const checkboxes = productForm.querySelectorAll('input[type="checkbox"]');
        
        // Phone input formatting
        if (phoneInput) {
            // Initialize phone input on page load
            if (phoneInput.value === '') {
                phoneInput.value = '8 ';
            }
            
            phoneInput.addEventListener('input', function(e) {
                let value = e.target.value.replace(/\D/g, '');
                
                if (value.length === 0) {
                    e.target.value = '';
                    return;
                }
                
                if (value[0] === '7' || value[0] === '8') {
                    value = value.substring(1);
                }
                
                if (value.length > 10) {
                    value = value.substring(0, 10);
                }
                
                let formatted = '8';
                if (value.length > 0) {
                    formatted += ' (' + value.substring(0, 3);
                }
                if (value.length > 3) {
                    formatted += ') ' + value.substring(3, 6);
                }
                if (value.length > 6) {
                    formatted += '-' + value.substring(6, 8);
                }
                if (value.length > 8) {
                    formatted += '-' + value.substring(8, 10);
                }
                
                e.target.value = formatted;
                validateField(e.target);
            });
            
            phoneInput.addEventListener('keydown', function(e) {
                if (e.key === 'Backspace' && e.target.value === '8 ') {
                    e.preventDefault();
                    e.target.value = '';
                }
            });
            
            phoneInput.addEventListener('focus', function(e) {
                if (e.target.value === '') {
                    e.target.value = '8 ';
                }
            });
            
            phoneInput.addEventListener('blur', function(e) {
                validateField(e.target);
            });
        }
        
        // Name input validation
        if (nameInput) {
            nameInput.addEventListener('input', function(e) {
                validateField(e.target);
            });
            
            nameInput.addEventListener('blur', function(e) {
                validateField(e.target);
            });
        }
        
        // Email input validation
        if (emailInput) {
            emailInput.addEventListener('input', function(e) {
                validateField(e.target);
            });
            
            emailInput.addEventListener('blur', function(e) {
                validateField(e.target);
            });
        }
        
        // Form submission
        productButton.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            
            console.log('Form submission started');
            
            if (!validateForm()) {
                console.log('Form validation failed');
                return;
            }
            
            const formData = {
                product_id: parseInt(window.location.pathname.split('/').pop()),
                name: nameInput.value.trim(),
                phone: phoneInput.value.trim(),
                email: emailInput.value.trim(),
                _token: document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            };
            
            console.log('Sending data:', formData);
            
            productButton.disabled = true;
            productButton.textContent = 'Отправка...';
            
            fetch('/order', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': formData._token,
                    'Accept': 'application/json'
                },
                body: JSON.stringify(formData)
            })
            .then(response => {
                console.log('Response status:', response.status);
                return response.json();
            })
            .then(data => {
                console.log('Response data:', data);
                if (data.success) {
                    console.log('Success response received, calling showSuccessModal...');
                    showSuccessModal();
                    productForm.reset();
                    // Сброс стилей полей
                    [nameInput, phoneInput, emailInput].forEach(input => {
                        if (input) {
                            input.classList.remove('valid', 'invalid');
                        }
                    });
                } else {
                    console.error('Form errors:', data.errors);
                    showErrorModal(data.errors || {});
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showErrorModal({ general: ['Произошла ошибка при отправке заявки'] });
            })
            .finally(() => {
                productButton.disabled = false;
                productButton.innerHTML = 'Оформить заказ <span class="product-button__arrow"><svg xmlns="http://www.w3.org/2000/svg" width="6" height="11" viewBox="0 0 6 11" fill="none"><path d="M0.472589 0.9177C0.410103 0.979675 0.360507 1.05341 0.326661 1.13465C0.292816 1.21589 0.27539 1.30302 0.27539 1.39103C0.27539 1.47904 0.292816 1.56618 0.326661 1.64742C0.360507 1.72866 0.410104 1.80239 0.472589 1.86436L3.52592 4.9177C3.58841 4.97967 3.638 5.05341 3.67185 5.13465C3.7057 5.21589 3.72312 5.30302 3.72312 5.39103C3.72312 5.47904 3.7057 5.56618 3.67185 5.64742C3.638 5.72866 3.58841 5.80239 3.52592 5.86437L0.472589 8.9177C0.410104 8.97967 0.360507 9.05341 0.326662 9.13465C0.292816 9.21589 0.275391 9.30302 0.275391 9.39103C0.275391 9.47904 0.292816 9.56618 0.326662 9.64742C0.360508 9.72866 0.410104 9.80239 0.472589 9.86437C0.597498 9.98853 0.766466 10.0582 0.942589 10.0582C1.11871 10.0582 1.28768 9.98853 1.41259 9.86437L4.47259 6.80437C4.84712 6.42936 5.0575 5.92103 5.0575 5.39103C5.0575 4.86103 4.84712 4.3527 4.47259 3.9777L1.41259 0.9177C1.28768 0.793532 1.11871 0.723837 0.942589 0.723837C0.766465 0.723837 0.597497 0.793532 0.472589 0.9177Z" fill="#F0F4FF" /></svg></span>';
            });
        });
        
        function validateForm() {
            let isValid = true;
            
            // Validate name
            if (!nameInput.value.trim()) {
                nameInput.classList.add('invalid');
                isValid = false;
            } else {
                nameInput.classList.add('valid');
                nameInput.classList.remove('invalid');
            }
            
            // Validate phone - более мягкая проверка
            const phoneValue = phoneInput.value.trim();
            if (!phoneValue || phoneValue.length < 10) {
                phoneInput.classList.add('invalid');
                isValid = false;
            } else {
                phoneInput.classList.add('valid');
                phoneInput.classList.remove('invalid');
            }
            
            // Validate checkboxes
            checkboxes.forEach(checkbox => {
                if (!checkbox.checked) {
                    checkbox.classList.add('invalid');
                    isValid = false;
                } else {
                    checkbox.classList.remove('invalid');
                }
            });
            
            return isValid;
        }
        
        function validateField(field) {
            field.classList.remove('valid', 'invalid');
            
            if (field.value.trim() === '') {
                return;
            }
            
            if (field === nameInput) {
                if (field.value.trim().length > 0) {
                    field.classList.add('valid');
                } else {
                    field.classList.add('invalid');
                }
            } else if (field === phoneInput) {
                if (field.value.trim().length >= 10) {
                    field.classList.add('valid');
                } else {
                    field.classList.add('invalid');
                }
            } else if (field === emailInput) {
                const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                if (emailPattern.test(field.value.trim())) {
                    field.classList.add('valid');
                } else {
                    field.classList.add('invalid');
                }
            }
        }
        
        function showSuccessModal() {
            console.log('showSuccessModal called');
            const modal = document.querySelector('.modal-success');
            console.log('Modal element:', modal);
            if (modal) {
                console.log('Setting modal styles...');
                // Method 1: Inline styles
                modal.style.display = 'flex';
                modal.style.opacity = '1';
                modal.style.visibility = 'visible';
                document.body.style.overflow = 'hidden';
                
                // Method 2: Add CSS class (backup)
                modal.classList.add('modal--active');
                
                console.log('Modal styles set:', {
                    display: modal.style.display,
                    opacity: modal.style.opacity,
                    visibility: modal.style.visibility,
                    classList: modal.classList.toString()
                });
            } else {
                console.error('Modal element not found!');
            }
        }
        
        function showErrorModal(errors) {
            console.error('Form errors:', errors);
            
            let errorMessage = 'Произошла ошибка при отправке заявки:\n';
            for (let field in errors) {
                if (errors[field] && errors[field].length > 0) {
                    errorMessage += `- ${field}: ${errors[field].join(', ')}\n`;
                }
            }
            
            alert(errorMessage);
        }
    }

});