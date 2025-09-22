// Homepage - JavaScript Específico para Skala Code
// Focado em conversão, UX e performance

document.addEventListener('DOMContentLoaded', function() {

    // Inicializar funcionalidades
    initScrollAnimations();
    initFormHandling();
    initCTATracking();
    initUrgencyElements();
    initWhatsAppButton();
    initAnalytics();

    // Scroll Animations - Elementos aparecem ao entrar na viewport
    function initScrollAnimations() {
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('animate');
                    // Animação dos números de impacto
                    if (entry.target.classList.contains('impact-number')) {
                        animateNumber(entry.target);
                    }
                }
            });
        }, {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        });

        // Observar elementos para animação
        document.querySelectorAll('.scroll-animate').forEach(el => {
            observer.observe(el);
        });
    }

    // Animação dos números de impacto
    function animateNumber(element) {
        const numberText = element.querySelector('.text-3xl, .text-4xl');
        if (!numberText) return;

        const finalNumber = parseInt(numberText.textContent);
        const duration = 2000; // 2 segundos
        const steps = 60;
        const increment = finalNumber / steps;
        let currentNumber = 0;

        const timer = setInterval(() => {
            currentNumber += increment;
            if (currentNumber >= finalNumber) {
                numberText.textContent = finalNumber + '%';
                clearInterval(timer);
            } else {
                numberText.textContent = Math.floor(currentNumber) + '%';
            }
        }, duration / steps);
    }

    // Manipulação do formulário principal
    function initFormHandling() {
        const leadForm = document.getElementById('lead-form');
        const ctaButtons = document.querySelectorAll('.cta-button');

        if (leadForm) {
            leadForm.addEventListener('submit', handleFormSubmit);

            // Validação em tempo real
            const inputs = leadForm.querySelectorAll('input, select');
            inputs.forEach(input => {
                input.addEventListener('blur', validateField);
                input.addEventListener('input', clearValidation);
            });
        }

        // CTAs que rolam para o formulário
        ctaButtons.forEach(button => {
            button.addEventListener('click', (e) => {
                e.preventDefault();
                scrollToForm();
                trackCTAClick(button.textContent);
            });
        });
    }

    // Envio do formulário
    function handleFormSubmit(e) {
        e.preventDefault();

        const formData = new FormData(e.target);
        const data = Object.fromEntries(formData);

        if (validateForm(data)) {
            showLoading(e.target);

            // Simular envio (substituir por endpoint real)
            setTimeout(() => {
                showSuccess();
                trackConversion(data);
                redirectToThankYou();
            }, 2000);
        } else {
            showValidationErrors();
        }
    }

    // Validação de campo individual
    function validateField(e) {
        const field = e.target;
        const value = field.value.trim();

        // Remover classes de validação anteriores
        field.classList.remove('error', 'success');

        // Validações específicas
        if (field.type === 'email') {
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (value && !emailRegex.test(value)) {
                field.classList.add('error');
                showFieldError(field, 'Email inválido');
                return false;
            }
        }

        if (field.type === 'tel') {
            const phoneRegex = /^[\d\s\(\)\-\+]+$/;
            if (value && (value.length < 10 || !phoneRegex.test(value))) {
                field.classList.add('error');
                showFieldError(field, 'WhatsApp inválido');
                return false;
            }
        }

        if (field.hasAttribute('required') && !value) {
            field.classList.add('error');
            showFieldError(field, 'Campo obrigatório');
            return false;
        }

        // Campo válido
        if (value) {
            field.classList.add('success');
            hideFieldError(field);
        }

        return true;
    }

    // Limpar validação ao digitar
    function clearValidation(e) {
        const field = e.target;
        field.classList.remove('error', 'success');
        hideFieldError(field);
    }

    // Validação completa do formulário
    function validateForm(data) {
        let isValid = true;

        // Email obrigatório
        if (!data.email || !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(data.email)) {
            isValid = false;
        }

        // WhatsApp obrigatório
        if (!data.whatsapp || data.whatsapp.length < 10) {
            isValid = false;
        }

        return isValid;
    }

    // Mostrar erro em campo específico
    function showFieldError(field, message) {
        // Remover erro anterior
        hideFieldError(field);

        // Criar elemento de erro
        const errorEl = document.createElement('div');
        errorEl.className = 'field-error text-red-500 text-sm mt-1';
        errorEl.textContent = message;

        // Inserir após o campo
        field.parentNode.insertBefore(errorEl, field.nextSibling);
    }

    // Ocultar erro do campo
    function hideFieldError(field) {
        const errorEl = field.parentNode.querySelector('.field-error');
        if (errorEl) {
            errorEl.remove();
        }
    }

    // Estados visuais do formulário
    function showLoading(form) {
        const submitBtn = form.querySelector('button[type="submit"]');
        submitBtn.innerHTML = '<span class="loading">Enviando...</span>';
        submitBtn.disabled = true;
        form.classList.add('loading');
    }

    function showSuccess() {
        // Mostrar mensagem de sucesso
        const successMsg = document.createElement('div');
        successMsg.className = 'success-message bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4';
        successMsg.innerHTML = '✅ Análise enviada! Entraremos em contato em até 2 horas.';

        const form = document.getElementById('lead-form');
        form.parentNode.insertBefore(successMsg, form);
    }

    // Rolar para o formulário
    function scrollToForm() {
        const form = document.getElementById('lead-form');
        if (form) {
            form.scrollIntoView({
                behavior: 'smooth',
                block: 'center'
            });

            // Highlight do formulário
            form.parentNode.classList.add('highlight');
            setTimeout(() => {
                form.parentNode.classList.remove('highlight');
            }, 2000);
        }
    }

    // Tracking de CTAs
    function initCTATracking() {
        // Track scroll depth para otimização
        let maxScroll = 0;
        let checkpoints = [25, 50, 75, 90];

        window.addEventListener('scroll', throttle(() => {
            const scrollPercent = Math.round(
                (window.scrollY / (document.body.scrollHeight - window.innerHeight)) * 100
            );

            if (scrollPercent > maxScroll) {
                maxScroll = scrollPercent;

                // Enviar eventos para checkpoints importantes
                checkpoints.forEach(checkpoint => {
                    if (scrollPercent >= checkpoint && maxScroll >= checkpoint) {
                        trackEvent('scroll_depth', checkpoint);
                        checkpoints = checkpoints.filter(c => c !== checkpoint);
                    }
                });
            }
        }, 1000));
    }

    // Elementos de urgência dinâmicos
    function initUrgencyElements() {
        updateVagasDisponiveis();
        updateUltimas48h();

        // Atualizar a cada 5 minutos
        setInterval(() => {
            updateVagasDisponiveis();
        }, 300000);
    }

    function updateVagasDisponiveis() {
        const vagasElements = document.querySelectorAll('[data-vagas]');
        // Simular redução de vagas (2-4)
        const vagas = Math.floor(Math.random() * 3) + 2;

        vagasElements.forEach(el => {
            el.textContent = el.textContent.replace(/\d+/, vagas);
        });
    }

    function updateUltimas48h() {
        const elementos48h = document.querySelectorAll('[data-ultimas-48h]');
        // Número entre 8-15
        const numero = Math.floor(Math.random() * 8) + 8;

        elementos48h.forEach(el => {
            el.textContent = el.textContent.replace(/\d+/, numero);
        });
    }

    // Botão WhatsApp flutuante
    function initWhatsAppButton() {
        // Criar botão se não existir
        if (!document.querySelector('.whatsapp-float')) {
            const whatsAppBtn = document.createElement('a');
            whatsAppBtn.href = 'https://wa.me/5511999999999?text=Olá! Gostaria de uma análise gratuita para reduzir meus custos de TI';
            whatsAppBtn.target = '_blank';
            whatsAppBtn.className = 'whatsapp-float';
            whatsAppBtn.innerHTML = '💬';
            whatsAppBtn.title = 'Falar no WhatsApp';

            document.body.appendChild(whatsAppBtn);

            // Track cliques
            whatsAppBtn.addEventListener('click', () => {
                trackEvent('whatsapp_click', 'float_button');
            });
        }
    }

    // Analytics e tracking
    function initAnalytics() {
        // Tempo na página
        const startTime = Date.now();

        // Track quando usuário sair
        window.addEventListener('beforeunload', () => {
            const timeOnPage = Math.round((Date.now() - startTime) / 1000);
            trackEvent('time_on_page', timeOnPage);
        });

        // Track interactions importantes
        document.addEventListener('click', (e) => {
            if (e.target.matches('.cta-button')) {
                trackEvent('cta_click', e.target.textContent.trim());
            }

            if (e.target.matches('.service-card')) {
                trackEvent('service_interest', e.target.querySelector('h3').textContent);
            }
        });
    }

    // Funções de tracking (integrar com Google Analytics, Facebook Pixel, etc.)
    function trackEvent(action, label, value = null) {
        // Google Analytics 4
        if (typeof gtag !== 'undefined') {
            gtag('event', action, {
                'event_label': label,
                'value': value
            });
        }

        // Facebook Pixel
        if (typeof fbq !== 'undefined') {
            fbq('trackCustom', action, {
                label: label,
                value: value
            });
        }

        // Console para debug
        console.log('Track Event:', action, label, value);
    }

    function trackCTAClick(ctaText) {
        trackEvent('cta_click', ctaText);

        // Facebook Pixel - Lead event
        if (typeof fbq !== 'undefined') {
            fbq('track', 'Lead');
        }
    }

    function trackConversion(formData) {
        trackEvent('form_submit', 'lead_generation', 1);

        // Facebook Pixel - CompleteRegistration
        if (typeof fbq !== 'undefined') {
            fbq('track', 'CompleteRegistration', {
                content_name: 'Lead Form',
                status: true
            });
        }

        // Google Analytics - Conversion
        if (typeof gtag !== 'undefined') {
            gtag('event', 'conversion', {
                'send_to': 'AW-CONVERSION_ID/CONVERSION_LABEL',
                'value': 1.0,
                'currency': 'BRL'
            });
        }
    }

    function redirectToThankYou() {
        // Aguardar 3 segundos e redirecionar
        setTimeout(() => {
            window.location.href = '/obrigado';
        }, 3000);
    }

    // Utility Functions
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

    // Detect mobile para otimizações específicas
    const isMobile = /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent);

    if (isMobile) {
        // Otimizações mobile
        document.body.classList.add('mobile-device');

        // Melhor UX para formulário mobile
        const inputs = document.querySelectorAll('input');
        inputs.forEach(input => {
            input.addEventListener('focus', () => {
                setTimeout(() => {
                    input.scrollIntoView({ behavior: 'smooth', block: 'center' });
                }, 300);
            });
        });
    }

    // Performance: Lazy load de recursos não críticos
    function loadNonCriticalResources() {
        // Carregar scripts de terceiros após interação
        let userInteracted = false;

        const loadThirdParty = () => {
            if (!userInteracted) {
                userInteracted = true;

                // Carregar Facebook Pixel, Google Analytics, etc.
                // Implementar conforme necessário
            }
        };

        // Carregar após primeira interação ou 3 segundos
        ['scroll', 'click', 'touchstart'].forEach(event => {
            document.addEventListener(event, loadThirdParty, { once: true });
        });

        setTimeout(loadThirdParty, 3000);
    }

    loadNonCriticalResources();
});

// Função global para CTAs externos
window.scrollToForm = function() {
    const form = document.getElementById('lead-form');
    if (form) {
        form.scrollIntoView({ behavior: 'smooth', block: 'center' });
    }
};