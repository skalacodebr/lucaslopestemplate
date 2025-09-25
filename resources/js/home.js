// Home Page JavaScript - Global SST Identity

document.addEventListener('DOMContentLoaded', function() {
    // FAQ Accordion
    initFAQ();

    // Smooth scrolling for anchor links
    initSmoothScroll();

    // Animate on scroll
    initScrollAnimations();

    // Service cards hover effects
    initServiceCards();

    // Stats counter animation
    initStatsCounter();

    // Initialize carousel
    initCarousel();

    // Initialize sticky header
    initStickyHeader();
});

// Carousel functionality
let currentSlide = 0;
const totalSlides = 3; // We'll show 3 slides (2 cards per slide)

function initFAQ() {
    const faqItems = document.querySelectorAll('.faq-item');

    faqItems.forEach(item => {
        const question = item.querySelector('.faq-question');
        const answer = item.querySelector('.faq-answer');

        if (question && answer) {
            // Initially hide all answers
            answer.style.display = 'none';

            question.addEventListener('click', () => {
                const isOpen = answer.style.display !== 'none';

                // Close all other FAQs
                faqItems.forEach(otherItem => {
                    const otherAnswer = otherItem.querySelector('.faq-answer');
                    const otherIcon = otherItem.querySelector('.faq-icon');
                    if (otherAnswer && otherItem !== item) {
                        otherAnswer.style.display = 'none';
                        if (otherIcon) {
                            otherIcon.style.transform = 'rotate(0deg)';
                        }
                    }
                });

                // Toggle current FAQ
                if (isOpen) {
                    answer.style.display = 'none';
                    const icon = question.querySelector('.faq-icon');
                    if (icon) {
                        icon.style.transform = 'rotate(0deg)';
                    }
                } else {
                    answer.style.display = 'block';
                    const icon = question.querySelector('.faq-icon');
                    if (icon) {
                        icon.style.transform = 'rotate(45deg)';
                    }
                }
            });
        }
    });
}

function initSmoothScroll() {
    const links = document.querySelectorAll('a[href^="#"]');

    links.forEach(link => {
        link.addEventListener('click', function(e) {
            const href = this.getAttribute('href');
            if (href === '#') return;

            const target = document.querySelector(href);
            if (target) {
                e.preventDefault();
                const offsetTop = target.getBoundingClientRect().top + window.pageYOffset - 80;

                window.scrollTo({
                    top: offsetTop,
                    behavior: 'smooth'
                });
            }
        });
    });
}

function initScrollAnimations() {
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('animate-fade-in-up');
            }
        });
    }, observerOptions);

    // Observe service cards
    const serviceCards = document.querySelectorAll('.service-card');
    serviceCards.forEach(card => {
        card.style.opacity = '0';
        card.style.transform = 'translateY(30px)';
        observer.observe(card);
    });

    // Observe blog cards
    const blogCards = document.querySelectorAll('.blog-card');
    blogCards.forEach(card => {
        card.style.opacity = '0';
        card.style.transform = 'translateY(30px)';
        observer.observe(card);
    });

    // Add CSS animation class
    const style = document.createElement('style');
    style.textContent = `
        .animate-fade-in-up {
            animation: fadeInUp 0.6s ease forwards;
        }

        @keyframes fadeInUp {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    `;
    document.head.appendChild(style);
}

function initServiceCards() {
    const serviceCards = document.querySelectorAll('.service-card');

    serviceCards.forEach(card => {
        const icon = card.querySelector('.service-icon');

        card.addEventListener('mouseenter', () => {
            if (icon) {
                icon.style.transform = 'scale(1.1) rotate(5deg)';
                icon.style.transition = 'transform 0.3s ease';
            }
        });

        card.addEventListener('mouseleave', () => {
            if (icon) {
                icon.style.transform = 'scale(1) rotate(0deg)';
            }
        });
    });
}

function initStatsCounter() {
    const statNumbers = document.querySelectorAll('.stat-number');

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const target = entry.target;
                const finalValue = parseInt(target.textContent.replace(/\D/g, ''));
                const suffix = target.textContent.replace(/\d/g, '');

                animateCounter(target, 0, finalValue, 2000, suffix);
                observer.unobserve(target);
            }
        });
    }, {
        threshold: 0.5
    });

    statNumbers.forEach(stat => {
        observer.observe(stat);
    });
}

function animateCounter(element, start, end, duration, suffix) {
    const startTime = Date.now();

    function update() {
        const elapsed = Date.now() - startTime;
        const progress = Math.min(elapsed / duration, 1);

        // Easing function (ease-out)
        const easeOut = 1 - Math.pow(1 - progress, 3);
        const current = Math.round(start + (end - start) * easeOut);

        element.textContent = current + suffix;

        if (progress < 1) {
            requestAnimationFrame(update);
        }
    }

    update();
}

// WhatsApp integration
function openWhatsApp() {
    const message = encodeURIComponent('Olá! Gostaria de solicitar um orçamento para serviços de SST.');
    const whatsappURL = `https://wa.me/5511999999999?text=${message}`;
    window.open(whatsappURL, '_blank');
}

// Form handling for contact
function handleContactForm(form) {
    const formData = new FormData(form);

    // Show loading state
    const submitBtn = form.querySelector('[type="submit"]');
    const originalText = submitBtn.textContent;
    submitBtn.textContent = 'Enviando...';
    submitBtn.disabled = true;

    // Simulate form submission (replace with actual endpoint)
    setTimeout(() => {
        // Show success message
        showNotification('Mensagem enviada com sucesso! Entraremos em contato em breve.', 'success');

        // Reset form
        form.reset();

        // Reset button
        submitBtn.textContent = originalText;
        submitBtn.disabled = false;
    }, 2000);
}

function showNotification(message, type = 'info') {
    const notification = document.createElement('div');
    notification.className = `fixed top-4 right-4 z-50 p-4 rounded-lg text-white font-medium transition-all duration-300 transform translate-x-full`;

    if (type === 'success') {
        notification.classList.add('bg-green-500');
    } else if (type === 'error') {
        notification.classList.add('bg-red-500');
    } else {
        notification.classList.add('bg-blue-500');
    }

    notification.textContent = message;
    document.body.appendChild(notification);

    // Animate in
    setTimeout(() => {
        notification.classList.remove('translate-x-full');
    }, 100);

    // Auto remove
    setTimeout(() => {
        notification.classList.add('translate-x-full');
        setTimeout(() => {
            document.body.removeChild(notification);
        }, 300);
    }, 5000);
}

function initCarousel() {
    const track = document.querySelector('.services-track');
    if (!track) return;

    // Auto-slide every 5 seconds
    setInterval(() => {
        moveCarousel('next');
    }, 5000);
}

function moveCarousel(direction) {
    const track = document.querySelector('.services-track');
    const dots = document.querySelectorAll('.dot');

    if (!track) return;

    if (direction === 'next') {
        currentSlide = (currentSlide + 1) % totalSlides;
    } else {
        currentSlide = (currentSlide - 1 + totalSlides) % totalSlides;
    }

    updateCarousel();
}

function goToSlide(slideIndex) {
    currentSlide = slideIndex;
    updateCarousel();
}

function updateCarousel() {
    const track = document.querySelector('.services-track');
    const dots = document.querySelectorAll('.dot');

    if (!track) return;

    // Calculate the translate value
    const translateX = -(currentSlide * 100 / totalSlides);
    track.style.transform = `translateX(${translateX}%)`;

    // Update dots
    dots.forEach((dot, index) => {
        dot.classList.toggle('active', index === currentSlide);
    });
}

function initStickyHeader() {
    const header = document.getElementById('main-header');
    if (!header) return;

    let lastScrollY = window.scrollY;

    window.addEventListener('scroll', () => {
        const currentScrollY = window.scrollY;

        if (currentScrollY > 100) {
            header.classList.add('scrolled');
        } else {
            header.classList.remove('scrolled');
        }

        lastScrollY = currentScrollY;
    });
}

// Export functions for global access
window.homePageUtils = {
    openWhatsApp,
    handleContactForm,
    showNotification,
    moveCarousel,
    goToSlide
};