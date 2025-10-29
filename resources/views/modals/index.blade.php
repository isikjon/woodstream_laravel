<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Модалки - WoodStream</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
            background: #f5f5f5;
            padding: 40px 20px;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
        }

        h1 {
            font-size: 32px;
            margin-bottom: 40px;
            color: #333;
            text-align: center;
        }

        .modals-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 30px;
        }

        .modal-preview {
            background: white;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
        }

        .modal-preview:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.15);
        }

        .modal-header {
            padding: 20px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }

        .modal-header h3 {
            font-size: 18px;
            margin-bottom: 8px;
        }

        .modal-header p {
            font-size: 13px;
            opacity: 0.9;
        }

        .modal-images {
            padding: 20px;
        }

        .modal-image-wrapper {
            position: relative;
            margin-bottom: 20px;
        }

        .modal-image-wrapper:last-child {
            margin-bottom: 0;
        }

        .modal-label {
            font-size: 12px;
            font-weight: 600;
            color: #666;
            margin-bottom: 8px;
            display: block;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .modal-image {
            width: 100%;
            height: auto;
            border-radius: 12px;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .modal-image:hover {
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
            transform: scale(1.02);
        }

        .test-button {
            width: 100%;
            padding: 15px;
            background: #667eea;
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-top: 15px;
        }

        .test-button:hover {
            background: #5568d3;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(102, 126, 234, 0.4);
        }

        .modal-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.8);
            display: none;
            align-items: center;
            justify-content: center;
            z-index: 10000;
            padding: 20px;
        }

        .modal-overlay.active {
            display: flex;
        }

        .modal-content-wrapper {
            position: relative;
            max-width: 90%;
            max-height: 90vh;
            background: white;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            animation: modalAppear 0.3s ease;
        }

        @keyframes modalAppear {
            from {
                opacity: 0;
                transform: scale(0.9) translateY(20px);
            }
            to {
                opacity: 1;
                transform: scale(1) translateY(0);
            }
        }

        .modal-close-btn {
            position: absolute;
            top: 20px;
            right: 20px;
            width: 40px;
            height: 40px;
            background: rgba(0, 0, 0, 0.8);
            border: none;
            border-radius: 50%;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 10;
            transition: all 0.3s ease;
        }

        .modal-close-btn:hover {
            background: rgba(0, 0, 0, 1);
            transform: rotate(90deg);
        }

        .modal-close-btn::before,
        .modal-close-btn::after {
            content: '';
            position: absolute;
            width: 20px;
            height: 2px;
            background: white;
        }

        .modal-close-btn::before {
            transform: rotate(45deg);
        }

        .modal-close-btn::after {
            transform: rotate(-45deg);
        }

        .modal-image-full {
            width: 100%;
            height: auto;
            display: block;
            cursor: pointer;
        }

        .empty-state {
            text-align: center;
            padding: 60px 20px;
            color: #999;
        }

        .empty-state svg {
            width: 80px;
            height: 80px;
            margin-bottom: 20px;
            opacity: 0.5;
        }

        @media (max-width: 768px) {
            h1 {
                font-size: 24px;
                margin-bottom: 30px;
            }

            .modals-grid {
                grid-template-columns: 1fr;
                gap: 20px;
            }

            .modal-content-wrapper {
                max-width: 95%;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Модальные окна WoodStream</h1>

        @if($modals->count() > 0)
            <div class="modals-grid">
                <div class="modal-preview">
                    <div class="modal-header">
                        <h3>Telegram Модалка 1</h3>
                        <p>Woodstream в Telegram!</p>
                    </div>
                    <div class="modal-images">
                        <div class="modal-image-wrapper">
                            <span class="modal-label">Десктоп версия</span>
                            <img src="{{ asset('images/desktop1.png') }}" alt="Desktop 1" class="modal-image" onclick="openModal('{{ asset('images/desktop1.png') }}', 'desktop')">
                        </div>
                        <div class="modal-image-wrapper">
                            <span class="modal-label">Мобильная версия</span>
                            <img src="{{ asset('images/mobile1.png') }}" alt="Mobile 1" class="modal-image" onclick="openModal('{{ asset('images/mobile1.png') }}', 'mobile')">
                        </div>
                        <button class="test-button" onclick="openModal('{{ asset('images/desktop1.png') }}', 'desktop')">Протестировать</button>
                    </div>
                </div>

                <div class="modal-preview">
                    <div class="modal-header">
                        <h3>Telegram Модалка 2</h3>
                        <p>Больше не нужно ждать!</p>
                    </div>
                    <div class="modal-images">
                        <div class="modal-image-wrapper">
                            <span class="modal-label">Десктоп версия</span>
                            <img src="{{ asset('images/desktop2.png') }}" alt="Desktop 2" class="modal-image" onclick="openModal('{{ asset('images/desktop2.png') }}', 'desktop')">
                        </div>
                        <div class="modal-image-wrapper">
                            <span class="modal-label">Мобильная версия</span>
                            <img src="{{ asset('images/mobile2.png') }}" alt="Mobile 2" class="modal-image" onclick="openModal('{{ asset('images/mobile2.png') }}', 'mobile')">
                        </div>
                        <button class="test-button" onclick="openModal('{{ asset('images/desktop2.png') }}', 'desktop')">Протестировать</button>
                    </div>
                </div>
            </div>
        @else
            <div class="empty-state">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                </svg>
                <h3>Модальные окна не найдены</h3>
                <p>Активируйте модальные окна в админ панели</p>
            </div>
        @endif
    </div>

    <div class="modal-overlay" id="modalOverlay" onclick="closeModalOnOverlay(event)">
        <div class="modal-content-wrapper" id="modalContentWrapper">
            <button class="modal-close-btn" onclick="closeModal()"></button>
            <img src="" alt="Modal" class="modal-image-full" id="modalImageFull" onclick="redirectToTelegram()">
        </div>
    </div>

    <script>
        const modalOverlay = document.getElementById('modalOverlay');
        const modalImageFull = document.getElementById('modalImageFull');
        const modalContentWrapper = document.getElementById('modalContentWrapper');

        function openModal(imageSrc, type) {
            const isMobile = window.innerWidth <= 768;
            
            let finalImageSrc = imageSrc;
            if (type === 'desktop' && isMobile) {
                finalImageSrc = imageSrc.replace('desktop', 'mobile');
            } else if (type === 'mobile' && !isMobile) {
                finalImageSrc = imageSrc.replace('mobile', 'desktop');
            }

            modalImageFull.src = finalImageSrc;
            modalOverlay.classList.add('active');
            document.body.style.overflow = 'hidden';
        }

        function closeModal() {
            modalOverlay.classList.remove('active');
            document.body.style.overflow = '';
        }

        function closeModalOnOverlay(event) {
            if (event.target === modalOverlay) {
                closeModal();
            }
        }

        function redirectToTelegram() {
            window.open('https://t.me/woodstream63bot', '_blank');
        }

        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape') {
                closeModal();
            }
        });

        window.addEventListener('resize', function() {
            if (modalOverlay.classList.contains('active')) {
                const currentSrc = modalImageFull.src;
                const isMobile = window.innerWidth <= 768;
                
                if (isMobile && currentSrc.includes('desktop')) {
                    modalImageFull.src = currentSrc.replace('desktop', 'mobile');
                } else if (!isMobile && currentSrc.includes('mobile')) {
                    modalImageFull.src = currentSrc.replace('mobile', 'desktop');
                }
            }
        });
    </script>
</body>
</html>

