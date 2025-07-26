<!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    
    <!-- SEO Meta Tags -->
    <meta name="description" content="<?php bloginfo('description'); ?>">
    <meta name="keywords" content="Web制作,ECサイト,AI,最先端技術,Manuheleku">
    <meta name="author" content="Manuheleku">
    
    <!-- Open Graph Meta Tags -->
    <meta property="og:title" content="<?php wp_title('|', true, 'right'); bloginfo('name'); ?>">
    <meta property="og:description" content="<?php bloginfo('description'); ?>">
    <meta property="og:type" content="website">
    <meta property="og:url" content="<?php echo esc_url(home_url('/')); ?>">
    <meta property="og:site_name" content="<?php bloginfo('name'); ?>">
    <?php if (has_post_thumbnail() && is_singular()) : ?>
        <meta property="og:image" content="<?php echo get_the_post_thumbnail_url(get_the_ID(), 'large'); ?>">
    <?php else : ?>
        <meta property="og:image" content="<?php echo get_template_directory_uri(); ?>/assets/images/manuheleku-main.png">
    <?php endif; ?>
    
    <!-- Twitter Card Meta Tags -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="<?php wp_title('|', true, 'right'); bloginfo('name'); ?>">
    <meta name="twitter:description" content="<?php bloginfo('description'); ?>">
    <?php if (has_post_thumbnail() && is_singular()) : ?>
        <meta name="twitter:image" content="<?php echo get_the_post_thumbnail_url(get_the_ID(), 'large'); ?>">
    <?php else : ?>
        <meta name="twitter:image" content="<?php echo get_template_directory_uri(); ?>/assets/images/manuheleku-main.png">
    <?php endif; ?>
    
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="<?php echo get_template_directory_uri(); ?>/assets/images/favicon.ico">
    <link rel="apple-touch-icon" href="<?php echo get_template_directory_uri(); ?>/assets/images/apple-touch-icon.png">
    
    <!-- Preconnect for Performance -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preconnect" href="https://cdnjs.cloudflare.com">
    
    <!-- Theme Color -->
    <meta name="theme-color" content="#0f172a">
    <meta name="msapplication-TileColor" content="#0f172a">
    
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<div id="page" class="site">
    <a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e('コンテンツへスキップ', 'manuheleku'); ?></a>

    <header id="masthead" class="site-header">
        <div class="container">
            <div class="header-container">
                
                <!-- Site Logo/Branding -->
                <div class="site-branding">
                    <?php if (has_custom_logo()) : ?>
                        <div class="site-logo">
                            <?php the_custom_logo(); ?>
                        </div>
                    <?php else : ?>
                        <div class="site-logo">
                            <a href="<?php echo esc_url(home_url('/')); ?>" rel="home">
                                <?php bloginfo('name'); ?>
                            </a>
                        </div>
                    <?php endif; ?>
                    
                    <?php
                    $manuheleku_description = get_bloginfo('description', 'display');
                    if ($manuheleku_description || is_customize_preview()) :
                    ?>
                        <p class="site-description screen-reader-text"><?php echo $manuheleku_description; ?></p>
                    <?php endif; ?>
                </div>

                <!-- Primary Navigation -->
                <nav id="site-navigation" class="main-navigation">
                    <button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false">
                        <span class="hamburger-line"></span>
                        <span class="hamburger-line"></span>
                        <span class="hamburger-line"></span>
                        <span class="screen-reader-text"><?php esc_html_e('メニュー', 'manuheleku'); ?></span>
                    </button>
                    
                    <?php
                    wp_nav_menu(array(
                        'theme_location' => 'primary',
                        'menu_id'        => 'primary-menu',
                        'container'      => false,
                        'fallback_cb'    => 'manuheleku_fallback_menu',
                    ));
                    ?>
                </nav>

                <!-- Header Actions -->
                <div class="header-actions">
                    <!-- Search Toggle -->
                    <button class="search-toggle" aria-label="検索を開く">
                        <i class="fas fa-search"></i>
                    </button>
                    
                    <!-- Dark Mode Toggle (if needed) -->
                    <button class="theme-toggle" aria-label="テーマ切り替え">
                        <i class="fas fa-moon"></i>
                    </button>
                    
                    <!-- CTA Button -->
                    <a href="#contact" class="btn btn-primary header-cta">
                        お問い合わせ
                    </a>
                </div>
            </div>
        </div>
        
        <!-- Search Overlay -->
        <div class="search-overlay">
            <div class="search-overlay-content">
                <button class="search-close" aria-label="検索を閉じる">
                    <i class="fas fa-times"></i>
                </button>
                <div class="search-form-container">
                    <?php get_search_form(); ?>
                </div>
            </div>
        </div>
    </header>

    <!-- Mobile Menu Overlay -->
    <div class="mobile-menu-overlay">
        <div class="mobile-menu-content">
            <div class="mobile-menu-header">
                <div class="site-logo">
                    <a href="<?php echo esc_url(home_url('/')); ?>" rel="home">
                        <?php bloginfo('name'); ?>
                    </a>
                </div>
                <button class="mobile-menu-close" aria-label="メニューを閉じる">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            
            <nav class="mobile-navigation">
                <?php
                wp_nav_menu(array(
                    'theme_location' => 'primary',
                    'menu_id'        => 'mobile-menu',
                    'container'      => false,
                    'fallback_cb'    => 'manuheleku_fallback_menu',
                ));
                ?>
            </nav>
            
            <div class="mobile-menu-footer">
                <div class="mobile-contact-info">
                    <p><i class="fas fa-envelope"></i> <?php echo esc_html(get_theme_mod('company_email', 'info@manuheleku.com')); ?></p>
                    <p><i class="fas fa-phone"></i> <?php echo esc_html(get_theme_mod('company_phone', '+81-3-1234-5678')); ?></p>
                </div>
                <div class="mobile-social-links">
                    <!-- Add social media links here if needed -->
                </div>
            </div>
        </div>
    </div>

<?php
// Fallback menu function
function manuheleku_fallback_menu() {
    echo '<ul id="primary-menu" class="menu">';
    echo '<li><a href="' . esc_url(home_url('/')) . '">ホーム</a></li>';
    echo '<li><a href="#services">サービス</a></li>';
    echo '<li><a href="#about">会社概要</a></li>';
    echo '<li><a href="' . esc_url(get_post_type_archive_link('ai_news')) . '">AI最先端情報</a></li>';
    echo '<li><a href="#contact">お問い合わせ</a></li>';
    echo '</ul>';
}
?>

