    <footer id="colophon" class="site-footer">
        <div class="container">
            <div class="footer-content">
                
                <!-- Footer Section 1: Company Info -->
                <div class="footer-section">
                    <h4>Manuheleku</h4>
                    <p>海外の最先端アプリ風デザインで、あなたのビジネスを次のレベルへと導くデジタルエージェンシーです。</p>
                    
                    <div class="footer-contact">
                        <p><i class="fas fa-envelope"></i> <?php echo esc_html(get_theme_mod('company_email', 'info@manuheleku.com')); ?></p>
                        <p><i class="fas fa-phone"></i> <?php echo esc_html(get_theme_mod('company_phone', '+81-3-1234-5678')); ?></p>
                        <p><i class="fas fa-map-marker-alt"></i> <?php echo esc_html(get_theme_mod('company_address', '東京都渋谷区')); ?></p>
                    </div>
                    
                    <!-- Social Media Links -->
                    <div class="footer-social">
                        <a href="#" aria-label="Twitter" class="social-link">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="#" aria-label="Facebook" class="social-link">
                            <i class="fab fa-facebook"></i>
                        </a>
                        <a href="#" aria-label="LinkedIn" class="social-link">
                            <i class="fab fa-linkedin"></i>
                        </a>
                        <a href="#" aria-label="Instagram" class="social-link">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="#" aria-label="GitHub" class="social-link">
                            <i class="fab fa-github"></i>
                        </a>
                    </div>
                </div>

                <!-- Footer Section 2: Services -->
                <div class="footer-section">
                    <h4>サービス</h4>
                    <ul>
                        <li><a href="#services">Webサイト制作</a></li>
                        <li><a href="#services">ECサイト制作</a></li>
                        <li><a href="#services">モバイル最適化</a></li>
                        <li><a href="#services">SEO対策</a></li>
                        <li><a href="#services">パフォーマンス最適化</a></li>
                        <li><a href="#services">ブランディング</a></li>
                    </ul>
                </div>

                <!-- Footer Section 3: AI News & Resources -->
                <div class="footer-section">
                    <h4>AI最先端情報</h4>
                    <ul>
                        <li><a href="<?php echo esc_url(get_post_type_archive_link('ai_news')); ?>">すべての記事</a></li>
                        <li><a href="<?php echo esc_url(get_term_link(get_term_by('slug', 'machine-learning', 'ai_category'))); ?>">機械学習</a></li>
                        <li><a href="<?php echo esc_url(get_term_link(get_term_by('slug', 'automation', 'ai_category'))); ?>">自動化</a></li>
                        <li><a href="<?php echo esc_url(get_term_link(get_term_by('slug', 'tools', 'ai_category'))); ?>">AIツール</a></li>
                        <li><a href="#ai-news">注目記事</a></li>
                        <li><a href="<?php echo esc_url(home_url('/feed/')); ?>">RSS配信</a></li>
                    </ul>
                </div>

                <!-- Footer Section 4: Company & Legal -->
                <div class="footer-section">
                    <h4>会社情報</h4>
                    <ul>
                        <li><a href="#about">会社概要</a></li>
                        <li><a href="#contact">お問い合わせ</a></li>
                        <li><a href="<?php echo esc_url(home_url('/privacy-policy/')); ?>">プライバシーポリシー</a></li>
                        <li><a href="<?php echo esc_url(home_url('/terms-of-service/')); ?>">利用規約</a></li>
                        <li><a href="<?php echo esc_url(home_url('/sitemap/')); ?>">サイトマップ</a></li>
                        <li><a href="#careers">採用情報</a></li>
                    </ul>
                </div>

                <!-- Footer Widget Areas -->
                <?php if (is_active_sidebar('footer-1') || is_active_sidebar('footer-2') || is_active_sidebar('footer-3')) : ?>
                    <div class="footer-widgets">
                        <?php if (is_active_sidebar('footer-1')) : ?>
                            <div class="footer-widget-area">
                                <?php dynamic_sidebar('footer-1'); ?>
                            </div>
                        <?php endif; ?>
                        
                        <?php if (is_active_sidebar('footer-2')) : ?>
                            <div class="footer-widget-area">
                                <?php dynamic_sidebar('footer-2'); ?>
                            </div>
                        <?php endif; ?>
                        
                        <?php if (is_active_sidebar('footer-3')) : ?>
                            <div class="footer-widget-area">
                                <?php dynamic_sidebar('footer-3'); ?>
                            </div>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>

            </div>

            <!-- Newsletter Signup -->
            <div class="footer-newsletter">
                <div class="newsletter-content">
                    <h4>AI最先端情報を受け取る</h4>
                    <p>最新のAI技術動向や実用的な活用事例を定期的にお届けします。</p>
                    <form class="newsletter-form" action="#" method="post">
                        <div class="newsletter-input-group">
                            <input type="email" name="newsletter_email" placeholder="メールアドレスを入力" required>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-paper-plane"></i>
                                登録
                            </button>
                        </div>
                        <p class="newsletter-privacy">
                            <small>
                                <input type="checkbox" id="newsletter-privacy" required>
                                <label for="newsletter-privacy">
                                    <a href="<?php echo esc_url(home_url('/privacy-policy/')); ?>">プライバシーポリシー</a>に同意します
                                </label>
                            </small>
                        </p>
                    </form>
                </div>
            </div>

            <!-- Footer Bottom -->
            <div class="footer-bottom">
                <div class="footer-bottom-content">
                    <div class="copyright">
                        <p>&copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?>. All rights reserved.</p>
                        <p>Powered by <a href="https://wordpress.org/" target="_blank" rel="noopener">WordPress</a> | 
                           Design by <a href="<?php echo esc_url(home_url('/')); ?>">Manuheleku</a></p>
                    </div>
                    
                    <div class="footer-bottom-menu">
                        <?php
                        wp_nav_menu(array(
                            'theme_location' => 'footer',
                            'menu_id'        => 'footer-menu',
                            'container'      => false,
                            'depth'          => 1,
                            'fallback_cb'    => false,
                        ));
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <!-- Back to Top Button -->
    <button id="back-to-top" class="back-to-top" aria-label="ページトップへ戻る">
        <i class="fas fa-chevron-up"></i>
    </button>

    <!-- Loading Overlay (Optional) -->
    <div id="loading-overlay" class="loading-overlay">
        <div class="loading-spinner">
            <div class="spinner"></div>
            <p>Loading...</p>
        </div>
    </div>

</div><!-- #page -->

<!-- Additional CSS for Footer -->
<style>
.footer-social {
    display: flex;
    gap: 1rem;
    margin-top: 1rem;
}

.social-link {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 40px;
    height: 40px;
    background: var(--gradient-primary);
    border-radius: 50%;
    color: white;
    transition: all 0.3s ease;
}

.social-link:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(59, 130, 246, 0.4);
    color: white;
    text-decoration: none;
}

.footer-newsletter {
    background: rgba(30, 41, 59, 0.5);
    border: 1px solid var(--border-color);
    border-radius: 1rem;
    padding: 2rem;
    margin: 2rem 0;
    text-align: center;
}

.newsletter-input-group {
    display: flex;
    gap: 1rem;
    max-width: 400px;
    margin: 1rem auto;
}

.newsletter-input-group input {
    flex: 1;
    padding: 0.75rem 1rem;
    background: rgba(15, 23, 42, 0.8);
    border: 1px solid var(--border-color);
    border-radius: 0.5rem;
    color: var(--text-primary);
}

.newsletter-privacy {
    margin-top: 0.5rem;
    color: var(--text-muted);
}

.newsletter-privacy input[type="checkbox"] {
    margin-right: 0.5rem;
}

.back-to-top {
    position: fixed;
    bottom: 2rem;
    right: 2rem;
    width: 50px;
    height: 50px;
    background: var(--gradient-primary);
    border: none;
    border-radius: 50%;
    color: white;
    cursor: pointer;
    opacity: 0;
    visibility: hidden;
    transition: all 0.3s ease;
    z-index: 1000;
}

.back-to-top.visible {
    opacity: 1;
    visibility: visible;
}

.back-to-top:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(59, 130, 246, 0.4);
}

.loading-overlay {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: var(--bg-primary);
    display: flex;
    align-items: center;
    justify-content: center;
    z-index: 9999;
    opacity: 0;
    visibility: hidden;
    transition: all 0.3s ease;
}

.loading-overlay.active {
    opacity: 1;
    visibility: visible;
}

.loading-spinner {
    text-align: center;
}

.spinner {
    width: 50px;
    height: 50px;
    border: 3px solid rgba(59, 130, 246, 0.3);
    border-top: 3px solid var(--accent-blue);
    border-radius: 50%;
    animation: spin 1s linear infinite;
    margin: 0 auto 1rem;
}

@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}

.footer-bottom-content {
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    gap: 1rem;
}

.footer-bottom-menu ul {
    display: flex;
    list-style: none;
    gap: 2rem;
    margin: 0;
    padding: 0;
}

.footer-bottom-menu a {
    color: var(--text-muted);
    font-size: 0.875rem;
    transition: color 0.3s ease;
}

.footer-bottom-menu a:hover {
    color: var(--accent-blue);
    text-decoration: none;
}

@media (max-width: 768px) {
    .footer-content {
        grid-template-columns: 1fr;
        gap: 2rem;
    }
    
    .newsletter-input-group {
        flex-direction: column;
    }
    
    .footer-bottom-content {
        flex-direction: column;
        text-align: center;
    }
    
    .footer-bottom-menu ul {
        flex-direction: column;
        gap: 1rem;
    }
    
    .back-to-top {
        bottom: 1rem;
        right: 1rem;
        width: 45px;
        height: 45px;
    }
}
</style>

<?php wp_footer(); ?>

<!-- Initialize AOS Animation Library -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Initialize AOS
    if (typeof AOS !== 'undefined') {
        AOS.init({
            duration: 800,
            easing: 'ease-out-cubic',
            once: true,
            offset: 100
        });
    }
    
    // Back to top functionality
    const backToTopBtn = document.getElementById('back-to-top');
    if (backToTopBtn) {
        window.addEventListener('scroll', function() {
            if (window.pageYOffset > 300) {
                backToTopBtn.classList.add('visible');
            } else {
                backToTopBtn.classList.remove('visible');
            }
        });
        
        backToTopBtn.addEventListener('click', function() {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });
    }
    
    // Newsletter form handling
    const newsletterForm = document.querySelector('.newsletter-form');
    if (newsletterForm) {
        newsletterForm.addEventListener('submit', function(e) {
            e.preventDefault();
            // Add newsletter signup logic here
            alert('ニュースレターの登録ありがとうございます！');
        });
    }
});
</script>

</body>
</html>

