/**
 * Manuheleku WordPress Theme - Main JavaScript
 * 海外の最先端アプリ風ダークテーマ
 */

(function($) {
    'use strict';

    // DOM Ready
    $(document).ready(function() {
        initializeTheme();
    });

    // Window Load
    $(window).on('load', function() {
        hideLoadingOverlay();
        initializeAnimations();
    });

    // Window Resize
    $(window).on('resize', function() {
        handleResize();
    });

    // Window Scroll
    $(window).on('scroll', function() {
        handleScroll();
    });

    /**
     * Initialize Theme
     */
    function initializeTheme() {
        initializeNavigation();
        initializeSearch();
        initializeFilters();
        initializeSmoothScroll();
        initializeContactForm();
        initializeNewsletterForm();
        initializeBackToTop();
        initializeThemeToggle();
        initializeLazyLoading();
        initializeTooltips();
    }

    /**
     * Navigation Functions
     */
    function initializeNavigation() {
        // Mobile menu toggle
        $('.menu-toggle').on('click', function() {
            $(this).toggleClass('active');
            $('.mobile-menu-overlay').toggleClass('active');
            $('body').toggleClass('menu-open');
        });

        // Close mobile menu
        $('.mobile-menu-close, .mobile-menu-overlay').on('click', function(e) {
            if (e.target === this) {
                $('.menu-toggle').removeClass('active');
                $('.mobile-menu-overlay').removeClass('active');
                $('body').removeClass('menu-open');
            }
        });

        // Close mobile menu on link click
        $('.mobile-navigation a').on('click', function() {
            $('.menu-toggle').removeClass('active');
            $('.mobile-menu-overlay').removeClass('active');
            $('body').removeClass('menu-open');
        });

        // Header scroll effect
        let lastScrollTop = 0;
        $(window).on('scroll', function() {
            const scrollTop = $(this).scrollTop();
            const header = $('.site-header');

            if (scrollTop > 100) {
                header.addClass('scrolled');
            } else {
                header.removeClass('scrolled');
            }

            // Hide/show header on scroll
            if (scrollTop > lastScrollTop && scrollTop > 200) {
                header.addClass('hidden');
            } else {
                header.removeClass('hidden');
            }
            lastScrollTop = scrollTop;
        });
    }

    /**
     * Search Functions
     */
    function initializeSearch() {
        // Search toggle
        $('.search-toggle').on('click', function() {
            $('.search-overlay').addClass('active');
            $('.search-overlay input[type="search"]').focus();
            $('body').addClass('search-open');
        });

        // Close search
        $('.search-close, .search-overlay').on('click', function(e) {
            if (e.target === this) {
                $('.search-overlay').removeClass('active');
                $('body').removeClass('search-open');
            }
        });

        // Close search on escape key
        $(document).on('keydown', function(e) {
            if (e.keyCode === 27 && $('.search-overlay').hasClass('active')) {
                $('.search-overlay').removeClass('active');
                $('body').removeClass('search-open');
            }
        });

        // AI News Search
        initializeAINewsSearch();
    }

    /**
     * AI News Search with AJAX
     */
    function initializeAINewsSearch() {
        const searchForm = $('.ai-news-search');
        const searchInput = searchForm.find('input[type="search"]');
        const resultsContainer = $('.ai-news-results');
        let searchTimeout;

        searchInput.on('input', function() {
            const searchTerm = $(this).val().trim();
            
            clearTimeout(searchTimeout);
            searchTimeout = setTimeout(function() {
                if (searchTerm.length >= 2) {
                    performAINewsSearch(searchTerm);
                } else {
                    resultsContainer.empty();
                }
            }, 300);
        });
    }

    function performAINewsSearch(searchTerm) {
        const category = $('.news-filters .filter-btn.active').data('category') || 'all';
        
        $.ajax({
            url: manuheleku_ajax.ajax_url,
            type: 'POST',
            data: {
                action: 'search_ai_news',
                search_term: searchTerm,
                category: category,
                nonce: manuheleku_ajax.nonce
            },
            beforeSend: function() {
                $('.ai-news-results').html('<div class="loading-spinner"><div class="spinner"></div></div>');
            },
            success: function(response) {
                if (response.success && response.data.length > 0) {
                    displaySearchResults(response.data);
                } else {
                    $('.ai-news-results').html('<p class="no-results">検索結果が見つかりませんでした。</p>');
                }
            },
            error: function() {
                $('.ai-news-results').html('<p class="error">検索中にエラーが発生しました。</p>');
            }
        });
    }

    function displaySearchResults(results) {
        let html = '<div class="news-grid">';
        
        results.forEach(function(article) {
            html += `
                <article class="news-card">
                    ${article.thumbnail ? `<img src="${article.thumbnail}" alt="${article.title}" class="news-image">` : ''}
                    <div class="news-content">
                        <div class="news-meta">
                            <span class="news-date">${article.date}</span>
                            ${article.category ? `<span class="news-category">${article.category}</span>` : ''}
                        </div>
                        <h3 class="news-title">
                            <a href="${article.permalink}">${article.title}</a>
                        </h3>
                        <p class="news-excerpt">${article.excerpt}</p>
                    </div>
                </article>
            `;
        });
        
        html += '</div>';
        $('.ai-news-results').html(html);
    }

    /**
     * Filter Functions
     */
    function initializeFilters() {
        $('.filter-btn').on('click', function() {
            const $this = $(this);
            const category = $this.data('category');
            
            // Update active state
            $('.filter-btn').removeClass('active');
            $this.addClass('active');
            
            // Filter news articles
            filterNewsArticles(category);
        });
    }

    function filterNewsArticles(category) {
        const $articles = $('.news-card');
        
        if (category === 'all') {
            $articles.show().addClass('animate-fade-in-up');
        } else {
            $articles.each(function() {
                const $article = $(this);
                const articleCategory = $article.find('.news-category').text().toLowerCase();
                const categoryMap = {
                    'machine-learning': '機械学習',
                    'automation': '自動化',
                    'tools': 'aiツール'
                };
                
                if (articleCategory === categoryMap[category]?.toLowerCase()) {
                    $article.show().addClass('animate-fade-in-up');
                } else {
                    $article.hide().removeClass('animate-fade-in-up');
                }
            });
        }
    }

    /**
     * Smooth Scroll
     */
    function initializeSmoothScroll() {
        $('a[href^="#"]').on('click', function(e) {
            e.preventDefault();
            
            const target = $(this.getAttribute('href'));
            if (target.length) {
                const headerHeight = $('.site-header').outerHeight();
                const targetOffset = target.offset().top - headerHeight - 20;
                
                $('html, body').animate({
                    scrollTop: targetOffset
                }, 800, 'easeInOutCubic');
            }
        });
    }

    /**
     * Contact Form Enhancement
     */
    function initializeContactForm() {
        const $form = $('.contact-form-inner');
        
        if ($form.length) {
            // Real-time validation
            $form.find('input, textarea').on('blur', function() {
                validateField($(this));
            });
            
            // Form submission
            $form.on('submit', function(e) {
                if (!validateForm($form)) {
                    e.preventDefault();
                    return false;
                }
                
                // Add loading state
                $form.addClass('loading');
                $(this).find('.btn').prop('disabled', true);
            });
        }
    }

    function validateField($field) {
        const value = $field.val().trim();
        const fieldType = $field.attr('type') || $field.prop('tagName').toLowerCase();
        let isValid = true;
        let errorMessage = '';

        // Remove existing error
        $field.removeClass('error');
        $field.next('.field-error').remove();

        // Required field validation
        if ($field.prop('required') && !value) {
            isValid = false;
            errorMessage = 'この項目は必須です。';
        }

        // Email validation
        if (fieldType === 'email' && value) {
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailRegex.test(value)) {
                isValid = false;
                errorMessage = '有効なメールアドレスを入力してください。';
            }
        }

        // Display error
        if (!isValid) {
            $field.addClass('error');
            $field.after(`<span class="field-error">${errorMessage}</span>`);
        }

        return isValid;
    }

    function validateForm($form) {
        let isValid = true;
        
        $form.find('input[required], textarea[required]').each(function() {
            if (!validateField($(this))) {
                isValid = false;
            }
        });

        // Privacy policy checkbox
        const privacyCheckbox = $form.find('input[name="contact_privacy"]');
        if (!privacyCheckbox.is(':checked')) {
            isValid = false;
            showFormMessage('プライバシーポリシーに同意してください。', 'error');
        }

        return isValid;
    }

    function showFormMessage(message, type) {
        const messageHtml = `
            <div class="contact-message ${type}">
                <i class="fas fa-${type === 'success' ? 'check-circle' : 'exclamation-circle'}"></i>
                <p>${message}</p>
            </div>
        `;
        
        $('.contact-form').prepend(messageHtml);
        
        setTimeout(function() {
            $('.contact-message').fadeOut();
        }, 5000);
    }

    /**
     * Newsletter Form
     */
    function initializeNewsletterForm() {
        $('.newsletter-form').on('submit', function(e) {
            e.preventDefault();
            
            const email = $(this).find('input[type="email"]').val();
            const privacy = $(this).find('input[type="checkbox"]').is(':checked');
            
            if (!email || !privacy) {
                alert('メールアドレスを入力し、プライバシーポリシーに同意してください。');
                return;
            }
            
            // Simulate newsletter signup
            $(this).find('.btn').text('登録中...').prop('disabled', true);
            
            setTimeout(function() {
                alert('ニュースレターの登録ありがとうございます！');
                $('.newsletter-form')[0].reset();
                $('.newsletter-form .btn').text('登録').prop('disabled', false);
            }, 1000);
        });
    }

    /**
     * Back to Top Button
     */
    function initializeBackToTop() {
        const $backToTop = $('#back-to-top');
        
        $(window).on('scroll', function() {
            if ($(this).scrollTop() > 300) {
                $backToTop.addClass('visible');
            } else {
                $backToTop.removeClass('visible');
            }
        });
        
        $backToTop.on('click', function() {
            $('html, body').animate({
                scrollTop: 0
            }, 800, 'easeInOutCubic');
        });
    }

    /**
     * Theme Toggle (Dark/Light Mode)
     */
    function initializeThemeToggle() {
        const $themeToggle = $('.theme-toggle');
        const currentTheme = localStorage.getItem('theme') || 'dark';
        
        // Set initial theme
        $('body').attr('data-theme', currentTheme);
        updateThemeIcon(currentTheme);
        
        $themeToggle.on('click', function() {
            const newTheme = $('body').attr('data-theme') === 'dark' ? 'light' : 'dark';
            $('body').attr('data-theme', newTheme);
            localStorage.setItem('theme', newTheme);
            updateThemeIcon(newTheme);
        });
    }

    function updateThemeIcon(theme) {
        const $icon = $('.theme-toggle i');
        if (theme === 'dark') {
            $icon.removeClass('fa-sun').addClass('fa-moon');
        } else {
            $icon.removeClass('fa-moon').addClass('fa-sun');
        }
    }

    /**
     * Lazy Loading for Images
     */
    function initializeLazyLoading() {
        if ('IntersectionObserver' in window) {
            const imageObserver = new IntersectionObserver(function(entries, observer) {
                entries.forEach(function(entry) {
                    if (entry.isIntersecting) {
                        const img = entry.target;
                        img.src = img.dataset.src;
                        img.classList.remove('lazy');
                        imageObserver.unobserve(img);
                    }
                });
            });

            document.querySelectorAll('img[data-src]').forEach(function(img) {
                imageObserver.observe(img);
            });
        }
    }

    /**
     * Tooltips
     */
    function initializeTooltips() {
        $('[data-tooltip]').each(function() {
            const $this = $(this);
            const tooltipText = $this.data('tooltip');
            
            $this.on('mouseenter', function() {
                const tooltip = $(`<div class="tooltip">${tooltipText}</div>`);
                $('body').append(tooltip);
                
                const rect = this.getBoundingClientRect();
                tooltip.css({
                    top: rect.top - tooltip.outerHeight() - 10,
                    left: rect.left + (rect.width / 2) - (tooltip.outerWidth() / 2)
                });
                
                setTimeout(() => tooltip.addClass('visible'), 10);
            });
            
            $this.on('mouseleave', function() {
                $('.tooltip').remove();
            });
        });
    }

    /**
     * Animations
     */
    function initializeAnimations() {
        // Parallax effect for hero background
        $(window).on('scroll', function() {
            const scrolled = $(this).scrollTop();
            const parallax = $('.hero-background');
            const speed = scrolled * 0.5;
            
            parallax.css('transform', `translateY(${speed}px)`);
        });

        // Counter animation
        $('.stat-number').each(function() {
            const $this = $(this);
            const countTo = parseInt($this.text().replace(/\D/g, ''));
            
            $({ countNum: 0 }).animate({
                countNum: countTo
            }, {
                duration: 2000,
                easing: 'swing',
                step: function() {
                    const suffix = $this.text().replace(/\d/g, '');
                    $this.text(Math.floor(this.countNum) + suffix);
                },
                complete: function() {
                    const suffix = $this.text().replace(/\d/g, '');
                    $this.text(countTo + suffix);
                }
            });
        });
    }

    /**
     * Handle Window Resize
     */
    function handleResize() {
        // Close mobile menu on resize
        if ($(window).width() > 768) {
            $('.menu-toggle').removeClass('active');
            $('.mobile-menu-overlay').removeClass('active');
            $('body').removeClass('menu-open');
        }
    }

    /**
     * Handle Window Scroll
     */
    function handleScroll() {
        // Add scroll-based animations here
    }

    /**
     * Hide Loading Overlay
     */
    function hideLoadingOverlay() {
        $('#loading-overlay').fadeOut(500);
    }

    /**
     * Utility Functions
     */
    
    // Debounce function
    function debounce(func, wait, immediate) {
        let timeout;
        return function() {
            const context = this;
            const args = arguments;
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

    // Throttle function
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

    // Add easing function for smooth animations
    $.easing.easeInOutCubic = function(x, t, b, c, d) {
        if ((t /= d / 2) < 1) return c / 2 * t * t * t + b;
        return c / 2 * ((t -= 2) * t * t + 2) + b;
    };

})(jQuery);

// Vanilla JavaScript for performance-critical functions
document.addEventListener('DOMContentLoaded', function() {
    
    // Service Worker Registration (for PWA features)
    if ('serviceWorker' in navigator) {
        navigator.serviceWorker.register('/sw.js')
            .then(function(registration) {
                console.log('ServiceWorker registration successful');
            })
            .catch(function(err) {
                console.log('ServiceWorker registration failed');
            });
    }
    
    // Performance monitoring
    if ('performance' in window) {
        window.addEventListener('load', function() {
            setTimeout(function() {
                const perfData = performance.getEntriesByType('navigation')[0];
                console.log('Page load time:', perfData.loadEventEnd - perfData.loadEventStart);
            }, 0);
        });
    }
    
    // Accessibility enhancements
    document.addEventListener('keydown', function(e) {
        // Skip to main content with Tab key
        if (e.key === 'Tab' && !e.shiftKey) {
            const skipLink = document.querySelector('.skip-link');
            if (document.activeElement === skipLink) {
                e.preventDefault();
                document.querySelector('#primary').focus();
            }
        }
        
        // Close modals with Escape key
        if (e.key === 'Escape') {
            const activeModal = document.querySelector('.modal.active, .overlay.active');
            if (activeModal) {
                activeModal.classList.remove('active');
            }
        }
    });
});

