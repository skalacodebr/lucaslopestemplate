// UI/UX Interactions - Microinterações Premium
document.addEventListener('DOMContentLoaded', function() {

    // Inicializar todas as funcionalidades
    initScrollProgress();
    initMagneticButtons();
    initParallaxElements();
    initIntersectionAnimations();
    initSmartTooltips();
    initAdvancedFormHandling();
    initPerformanceOptimizations();
    initAccessibilityFeatures();

    // ==========================================================================
    // SCROLL PROGRESS INDICATOR
    // ==========================================================================
    function initScrollProgress() {
        const progressBar = document.createElement('div');
        progressBar.className = 'scroll-progress';
        document.body.appendChild(progressBar);

        const updateProgress = throttle(() => {
            const scrollTop = window.pageYOffset;
            const docHeight = document.documentElement.scrollHeight - window.innerHeight;
            const scrollPercent = (scrollTop / docHeight) * 100;

            progressBar.style.setProperty('--scroll-progress', `${Math.min(scrollPercent, 100)}%`);
        }, 10);

        window.addEventListener('scroll', updateProgress);
    }

    // ==========================================================================
    // BOTÕES MAGNÉTICOS
    // ==========================================================================
    function initMagneticButtons() {
        const magneticElements = document.querySelectorAll('.btn-magnetic, .cta-button');

        magneticElements.forEach(element => {
            element.addEventListener('mouseenter', function() {
                this.style.transition = 'transform 0.3s cubic-bezier(0.23, 1, 0.320, 1)';
            });

            element.addEventListener('mousemove', function(e) {
                const rect = this.getBoundingClientRect();
                const x = e.clientX - rect.left - rect.width / 2;
                const y = e.clientY - rect.top - rect.height / 2;

                const intensity = 0.3;
                this.style.transform = `translate(${x * intensity}px, ${y * intensity}px) scale(1.05)`;
            });

            element.addEventListener('mouseleave', function() {
                this.style.transform = '';
                this.style.transition = 'transform 0.5s cubic-bezier(0.23, 1, 0.320, 1)';
            });
        });
    }

    // ==========================================================================
    // EFEITOS PARALLAX SUAVES
    // ==========================================================================
    function initParallaxElements() {
        const parallaxElements = document.querySelectorAll('[data-parallax]');

        const handleParallax = throttle(() => {
            const scrolled = window.pageYOffset;

            parallaxElements.forEach(element => {
                const rate = parseFloat(element.dataset.parallax) || 0.5;
                const yPos = -(scrolled * rate);
                element.style.transform = `translateY(${yPos}px)`;
            });
        }, 16);

        if (parallaxElements.length > 0) {
            window.addEventListener('scroll', handleParallax);
        }
    }

    // ==========================================================================
    // ANIMAÇÕES POR INTERSECTION OBSERVER
    // ==========================================================================
    function initIntersectionAnimations() {
        const animatedElements = document.querySelectorAll('[data-animate]');

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const element = entry.target;
                    const animation = element.dataset.animate;
                    const delay = element.dataset.delay || 0;

                    setTimeout(() => {
                        element.classList.add(`animate-${animation}`);
                        element.style.opacity = '1';
                        element.style.transform = 'none';
                    }, delay);

                    observer.unobserve(element);
                }
            });
        }, {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        });

        animatedElements.forEach(element => {
            // Estado inicial
            element.style.opacity = '0';
            element.style.transform = 'translateY(30px)';
            observer.observe(element);
        });
    }

    // ==========================================================================
    // TOOLTIPS INTELIGENTES
    // ==========================================================================
    function initSmartTooltips() {
        const tooltipElements = document.querySelectorAll('[data-tooltip]');

        tooltipElements.forEach(element => {
            element.classList.add('tooltip');

            // Touch support para mobile
            element.addEventListener('touchstart', function(e) {
                e.preventDefault();
                this.classList.add('tooltip-active');

                setTimeout(() => {
                    this.classList.remove('tooltip-active');
                }, 2000);
            });
        });
    }

    // ==========================================================================
    // FORMULÁRIOS AVANÇADOS
    // ==========================================================================
    function initAdvancedFormHandling() {
        const forms = document.querySelectorAll('form');

        forms.forEach(form => {
            const inputs = form.querySelectorAll('input, textarea, select');

            inputs.forEach(input => {
                // Floating labels
                if (input.parentElement.classList.contains('input-floating')) {
                    input.addEventListener('focus', function() {
                        this.parentElement.classList.add('focused');
                    });

                    input.addEventListener('blur', function() {
                        if (!this.value) {
                            this.parentElement.classList.remove('focused');
                        }
                    });
                }

                // Validação em tempo real com feedback visual
                input.addEventListener('input', debounce(function() {
                    validateInput(this);
                }, 500));

                input.addEventListener('blur', function() {
                    validateInput(this);
                });
            });

            // Submit com loading state
            form.addEventListener('submit', function(e) {
                const submitBtn = this.querySelector('button[type="submit"]');
                if (submitBtn && !submitBtn.disabled) {
                    showLoadingState(submitBtn);
                }
            });
        });
    }

    function validateInput(input) {
        const isValid = input.checkValidity();
        const parent = input.parentElement;

        // Remove classes anteriores
        input.classList.remove('input-success', 'input-error');
        parent.querySelectorAll('.input-feedback').forEach(el => el.remove());

        if (input.value.length > 0) {
            if (isValid) {
                input.classList.add('input-success');
                showInputFeedback(parent, 'success', '✓ Válido');
            } else {
                input.classList.add('input-error');
                showInputFeedback(parent, 'error', input.validationMessage);
            }
        }
    }

    function showInputFeedback(parent, type, message) {
        const feedback = document.createElement('div');
        feedback.className = `input-feedback text-sm mt-1 ${type === 'success' ? 'text-green-600' : 'text-red-600'}`;
        feedback.textContent = message;
        parent.appendChild(feedback);
    }

    function showLoadingState(button) {
        const originalText = button.innerHTML;
        button.disabled = true;
        button.innerHTML = `
            <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white inline" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>
            Enviando...
        `;

        // Reset após 3 segundos se não houver resposta
        setTimeout(() => {
            button.disabled = false;
            button.innerHTML = originalText;
        }, 10000);
    }

    // ==========================================================================
    // OTIMIZAÇÕES DE PERFORMANCE
    // ==========================================================================
    function initPerformanceOptimizations() {
        // Lazy loading para imagens
        const images = document.querySelectorAll('img[data-src]');
        const imageObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const img = entry.target;
                    img.src = img.dataset.src;
                    img.classList.remove('skeleton');
                    imageObserver.unobserve(img);
                }
            });
        });

        images.forEach(img => {
            img.classList.add('skeleton');
            imageObserver.observe(img);
        });

        // Preload de recursos críticos
        const criticalResources = [
            '/css/ui-enhancements.css',
            '/js/ui-interactions.js'
        ];

        criticalResources.forEach(resource => {
            const link = document.createElement('link');
            link.rel = 'prefetch';
            link.href = resource;
            document.head.appendChild(link);
        });
    }

    // ==========================================================================
    // RECURSOS DE ACESSIBILIDADE
    // ==========================================================================
    function initAccessibilityFeatures() {
        // Navegação por teclado aprimorada
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Tab') {
                document.body.classList.add('user-is-tabbing');
            }
        });

        document.addEventListener('mousedown', function() {
            document.body.classList.remove('user-is-tabbing');
        });

        // Skip links
        const skipLink = document.createElement('a');
        skipLink.href = '#main-content';
        skipLink.textContent = 'Pular para o conteúdo principal';
        skipLink.className = 'sr-only focus:not-sr-only focus:absolute focus:top-4 focus:left-4 bg-blue-600 text-white px-4 py-2 rounded z-50';
        document.body.insertBefore(skipLink, document.body.firstChild);

        // Adicionar ID ao main content se não existir
        const mainContent = document.querySelector('main') || document.querySelector('[role="main"]') || document.body.children[1];
        if (mainContent && !mainContent.id) {
            mainContent.id = 'main-content';
        }

        // Anúncios para screen readers
        const announcer = document.createElement('div');
        announcer.setAttribute('aria-live', 'polite');
        announcer.setAttribute('aria-atomic', 'true');
        announcer.className = 'sr-only';
        announcer.id = 'announcer';
        document.body.appendChild(announcer);

        // Função global para anúncios
        window.announceToScreenReader = function(message) {
            const announcer = document.getElementById('announcer');
            announcer.textContent = message;
            setTimeout(() => {
                announcer.textContent = '';
            }, 1000);
        };
    }

    // ==========================================================================
    // EFEITOS ESPECIAIS CONTEXTUAIS
    // ==========================================================================

    // Efeito de digitação para títulos especiais
    function typeWriter(element, text, speed = 100) {
        let i = 0;
        element.innerHTML = '';

        function type() {
            if (i < text.length) {
                element.innerHTML += text.charAt(i);
                i++;
                setTimeout(type, speed);
            }
        }
        type();
    }

    // Ativar efeito de digitação em elementos com data-typewriter
    const typewriterElements = document.querySelectorAll('[data-typewriter]');
    const typewriterObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const element = entry.target;
                const text = element.textContent;
                const speed = parseInt(element.dataset.speed) || 100;
                typeWriter(element, text, speed);
                typewriterObserver.unobserve(element);
            }
        });
    });

    typewriterElements.forEach(el => typewriterObserver.observe(el));

    // Contador animado para números
    function animateNumber(element, finalNumber, duration = 2000) {
        const start = 0;
        const startTime = performance.now();

        function updateNumber(currentTime) {
            const elapsed = currentTime - startTime;
            const progress = Math.min(elapsed / duration, 1);

            const easeOutQuart = 1 - Math.pow(1 - progress, 4);
            const currentNumber = Math.floor(easeOutQuart * finalNumber);

            element.textContent = currentNumber.toLocaleString();

            if (progress < 1) {
                requestAnimationFrame(updateNumber);
            } else {
                element.textContent = finalNumber.toLocaleString();
            }
        }

        requestAnimationFrame(updateNumber);
    }

    // Ativar contador em elementos com data-counter
    const counterElements = document.querySelectorAll('[data-counter]');
    const counterObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const element = entry.target;
                const finalNumber = parseInt(element.dataset.counter);
                const duration = parseInt(element.dataset.duration) || 2000;
                animateNumber(element, finalNumber, duration);
                counterObserver.unobserve(element);
            }
        });
    });

    counterElements.forEach(el => counterObserver.observe(el));

    // ==========================================================================
    // UTILITY FUNCTIONS
    // ==========================================================================

    function throttle(func, limit) {
        let inThrottle;
        return function() {
            const args = arguments;
            const context = this;
            if (!inThrottle) {
                func.apply(context, args);
                inThrottle = true;
                setTimeout(() => inThrottle = false, limit);
            }
        };
    }

    function debounce(func, wait, immediate) {
        let timeout;
        return function() {
            const context = this, args = arguments;
            const later = function() {
                timeout = null;
                if (!immediate) func.apply(context, args);
            };
            const callNow = immediate && !timeout;
            clearTimeout(timeout);
            timeout = setTimeout(later, wait);
            if (callNow) func.apply(context, args);
        };
    }

    // Detectar dispositivos touch
    const isTouch = 'ontouchstart' in window || navigator.maxTouchPoints > 0;
    if (isTouch) {
        document.body.classList.add('touch-device');
    }

    // Detectar se o usuário prefere movimento reduzido
    if (window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
        document.body.classList.add('reduce-motion');
    }

    // Performance observer para métricas
    if ('PerformanceObserver' in window) {
        const observer = new PerformanceObserver((list) => {
            for (const entry of list.getEntries()) {
                if (entry.entryType === 'largest-contentful-paint') {
                    console.log('LCP:', entry.startTime);
                }
                if (entry.entryType === 'first-input') {
                    console.log('FID:', entry.processingStart - entry.startTime);
                }
            }
        });

        observer.observe({entryTypes: ['largest-contentful-paint', 'first-input']});
    }

    console.log('🎨 UI/UX Enhancements loaded successfully!');
});