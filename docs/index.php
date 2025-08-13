<?php
/**
 * The main template file
 * Manuheleku WordPress Theme
 */

get_header(); ?>

<main id="primary" class="site-main">
    
    <?php if (is_home() || is_front_page()) : ?>
        
        <!-- Hero Section -->
        <section class="hero-section">
            <div class="hero-background"></div>
            <div class="container">
                <div class="hero-content" data-aos="fade-up">
                    <h1 class="hero-title">
                        <?php echo esc_html(get_theme_mod('hero_title', '未来を創るデジタル体験')); ?>
                    </h1>
                    <p class="hero-subtitle">
                        <?php echo esc_html(get_theme_mod('hero_subtitle', 'Manuhelekuは、最先端のWebサイト制作・ECサイト制作を通じて、あなたのビジネスを次のレベルへと導きます。')); ?>
                    </p>
                    <div class="hero-buttons">
                        <a href="#services" class="btn btn-primary">サービスを見る</a>
                        <a href="#contact" class="btn btn-secondary">お問い合わせ</a>
                    </div>
                </div>
                
                <?php if (get_theme_mod('hero_image')) : ?>
                    <div class="hero-image" data-aos="fade-up" data-aos-delay="200">
                        <img src="<?php echo esc_url(get_theme_mod('hero_image')); ?>" alt="Manuheleku Hero Image">
                    </div>
                <?php else : ?>
                    <div class="hero-image" data-aos="fade-up" data-aos-delay="200">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/manuheleku-main.png" alt="Manuheleku - 未来を創るデジタル体験">
                    </div>
                <?php endif; ?>
            </div>
        </section>

        <!-- Services Section -->
        <section id="services" class="services-section section">
            <div class="container">
                <div class="section-title" data-aos="fade-up">
                    <h2>私たちのサービス</h2>
                    <p class="section-subtitle">最先端の技術と創造性で、あなたのビジネスを成功に導きます</p>
                </div>
                
                <?php echo do_shortcode('[services_grid columns="3"]'); ?>
            </div>
        </section>

        <!-- About Section -->
        <section id="about" class="about-section section">
            <div class="container">
                <div class="about-content">
                    <div class="about-text" data-aos="fade-right">
                        <h2>Manuhelekuについて</h2>
                        <p>私たちは、デジタル技術の力でビジネスの可能性を最大化することを使命としています。海外の最先端アプリのような洗練されたデザインと、確かな技術力で、お客様のビジョンを現実に変えます。</p>
                        <p>AI技術の最前線で活動する私たちだからこそ提供できる、未来志向のソリューションをお届けします。</p>
                        
                        <div class="about-stats">
                            <div class="stat-item">
                                <span class="stat-number">100+</span>
                                <span class="stat-label">完了プロジェクト</span>
                            </div>
                            <div class="stat-item">
                                <span class="stat-number">50+</span>
                                <span class="stat-label">満足クライアント</span>
                            </div>
                            <div class="stat-item">
                                <span class="stat-number">24/7</span>
                                <span class="stat-label">サポート体制</span>
                            </div>
                            <div class="stat-item">
                                <span class="stat-number">5年</span>
                                <span class="stat-label">業界経験</span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="about-image" data-aos="fade-left">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/web_design_modern_1.jpg" alt="About Manuheleku" class="glass">
                    </div>
                </div>
            </div>
        </section>

        <!-- AI News Section -->
        <section id="ai-news" class="ai-news-section section">
            <div class="container">
                <div class="section-title" data-aos="fade-up">
                    <h2>AI技術の最前線</h2>
                    <p class="section-subtitle">最新のAI技術動向、実用的な活用事例、そして未来への展望をわかりやすくお届けします</p>
                </div>
                
                <div class="news-filters" data-aos="fade-up" data-aos-delay="100">
                    <button class="filter-btn active" data-category="all">すべて</button>
                    <button class="filter-btn" data-category="machine-learning">機械学習</button>
                    <button class="filter-btn" data-category="automation">自動化</button>
                    <button class="filter-btn" data-category="tools">AIツール</button>
                </div>
                
                <?php echo do_shortcode('[latest_ai_news count="6"]'); ?>
                
                <div class="text-center" data-aos="fade-up" data-aos-delay="300">
                    <a href="<?php echo get_post_type_archive_link('ai_news'); ?>" class="btn btn-primary">すべての記事を見る</a>
                </div>
            </div>
        </section>

        <!-- Contact Section -->
        <section id="contact" class="contact-section section">
            <div class="container">
                <div class="section-title" data-aos="fade-up">
                    <h2>お問い合わせ</h2>
                    <p class="section-subtitle">プロジェクトのご相談やお見積もりなど、お気軽にお問い合わせください</p>
                </div>
                
                <div class="contact-content">
                    <div class="contact-info" data-aos="fade-right">
                        <h3>お気軽にご連絡ください</h3>
                        <p>私たちは、あなたのビジネスの成功をサポートするために、常にお客様との対話を大切にしています。</p>
                        
                        <div class="contact-item">
                            <div class="contact-icon">
                                <i class="fas fa-envelope"></i>
                            </div>
                            <div class="contact-details">
                                <h4>メールアドレス</h4>
                                <p><?php echo esc_html(get_theme_mod('company_email', 'info@manuheleku.com')); ?></p>
                            </div>
                        </div>
                        
                        <div class="contact-item">
                            <div class="contact-icon">
                                <i class="fas fa-phone"></i>
                            </div>
                            <div class="contact-details">
                                <h4>電話番号</h4>
                                <p><?php echo esc_html(get_theme_mod('company_phone', '+81-3-1234-5678')); ?></p>
                            </div>
                        </div>
                        
                        <div class="contact-item">
                            <div class="contact-icon">
                                <i class="fas fa-map-marker-alt"></i>
                            </div>
                            <div class="contact-details">
                                <h4>所在地</h4>
                                <p><?php echo esc_html(get_theme_mod('company_address', '東京都渋谷区')); ?></p>
                            </div>
                        </div>
                        
                        <div class="contact-item">
                            <div class="contact-icon">
                                <i class="fas fa-clock"></i>
                            </div>
                            <div class="contact-details">
                                <h4>営業時間</h4>
                                <p>平日 9:00-18:00</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="contact-form-container" data-aos="fade-left">
                        <?php get_template_part('template-parts/contact-form'); ?>
                    </div>
                </div>
            </div>
        </section>

    <?php else : ?>
        
        <!-- Standard Blog/Archive Layout -->
        <div class="container">
            <div class="content-area">
                
                <?php if (have_posts()) : ?>
                    
                    <header class="page-header">
                        <?php
                        the_archive_title('<h1 class="page-title">', '</h1>');
                        the_archive_description('<div class="archive-description">', '</div>');
                        ?>
                    </header>

                    <div class="posts-grid">
                        <?php while (have_posts()) : the_post(); ?>
                            <article id="post-<?php the_ID(); ?>" <?php post_class('post-card'); ?>>
                                
                                <?php if (has_post_thumbnail()) : ?>
                                    <div class="post-thumbnail">
                                        <a href="<?php the_permalink(); ?>">
                                            <?php the_post_thumbnail('news-thumbnail'); ?>
                                        </a>
                                    </div>
                                <?php endif; ?>
                                
                                <div class="post-content">
                                    <div class="post-meta">
                                        <span class="post-date"><?php echo get_the_date(); ?></span>
                                        <?php if (get_post_type() === 'ai_news') : ?>
                                            <?php
                                            $categories = get_the_terms(get_the_ID(), 'ai_category');
                                            if ($categories && !is_wp_error($categories)) :
                                            ?>
                                                <span class="post-category"><?php echo esc_html($categories[0]->name); ?></span>
                                            <?php endif; ?>
                                        <?php else : ?>
                                            <span class="post-category"><?php the_category(', '); ?></span>
                                        <?php endif; ?>
                                    </div>
                                    
                                    <h2 class="post-title">
                                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                    </h2>
                                    
                                    <div class="post-excerpt">
                                        <?php the_excerpt(); ?>
                                    </div>
                                    
                                    <a href="<?php the_permalink(); ?>" class="read-more">続きを読む</a>
                                </div>
                            </article>
                        <?php endwhile; ?>
                    </div>

                    <?php
                    the_posts_pagination(array(
                        'mid_size' => 2,
                        'prev_text' => __('前へ', 'manuheleku'),
                        'next_text' => __('次へ', 'manuheleku'),
                    ));
                    ?>

                <?php else : ?>
                    
                    <section class="no-results not-found">
                        <header class="page-header">
                            <h1 class="page-title"><?php esc_html_e('何も見つかりませんでした', 'manuheleku'); ?></h1>
                        </header>

                        <div class="page-content">
                            <?php if (is_home() && current_user_can('publish_posts')) : ?>
                                <p><?php
                                    printf(
                                        wp_kses(
                                            __('投稿を開始するには<a href="%1$s">こちら</a>をクリックしてください。', 'manuheleku'),
                                            array(
                                                'a' => array(
                                                    'href' => array(),
                                                ),
                                            )
                                        ),
                                        esc_url(admin_url('post-new.php'))
                                    );
                                ?></p>
                            <?php elseif (is_search()) : ?>
                                <p><?php esc_html_e('検索キーワードに一致するものが見つかりませんでした。別のキーワードで再度お試しください。', 'manuheleku'); ?></p>
                                <?php get_search_form(); ?>
                            <?php else : ?>
                                <p><?php esc_html_e('ここには何もありません。検索をお試しください。', 'manuheleku'); ?></p>
                                <?php get_search_form(); ?>
                            <?php endif; ?>
                        </div>
                    </section>

                <?php endif; ?>
                
            </div>
        </div>
        
    <?php endif; ?>

</main>

<?php
get_footer();
?>

