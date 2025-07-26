<?php
/**
 * Manuheleku WordPress Theme Functions
 * 海外の最先端アプリ風ダークテーマ
 */

// テーマのセットアップ
function manuheleku_theme_setup() {
    // テーマサポートを追加
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('custom-logo', array(
        'height'      => 100,
        'width'       => 400,
        'flex-height' => true,
        'flex-width'  => true,
    ));
    add_theme_support('html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
        'style',
        'script',
    ));
    add_theme_support('custom-background');
    add_theme_support('customize-selective-refresh-widgets');
    add_theme_support('responsive-embeds');
    add_theme_support('wp-block-styles');
    add_theme_support('align-wide');
    
    // メニューの登録
    register_nav_menus(array(
        'primary' => __('Primary Menu', 'manuheleku'),
        'footer' => __('Footer Menu', 'manuheleku'),
    ));
    
    // 画像サイズの追加
    add_image_size('hero-image', 1920, 1080, true);
    add_image_size('service-card', 400, 300, true);
    add_image_size('news-thumbnail', 350, 200, true);
    add_image_size('news-featured', 800, 400, true);
    
    // 言語ファイルの読み込み
    load_theme_textdomain('manuheleku', get_template_directory() . '/languages');
}
add_action('after_setup_theme', 'manuheleku_theme_setup');

// スタイルとスクリプトの読み込み
function manuheleku_scripts() {
    // メインスタイルシート
    wp_enqueue_style('manuheleku-style', get_stylesheet_uri(), array(), wp_get_theme()->get('Version'));
    
    // カスタムスタイル
    wp_enqueue_style('manuheleku-custom', get_template_directory_uri() . '/assets/css/custom.css', array('manuheleku-style'), wp_get_theme()->get('Version'));
    
    // Google Fonts
    wp_enqueue_style('google-fonts', 'https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap', array(), null);
    
    // Font Awesome (アイコン用)
    wp_enqueue_style('font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css', array(), '6.4.0');
    
    // メインJavaScript
    wp_enqueue_script('manuheleku-main', get_template_directory_uri() . '/assets/js/main.js', array('jquery'), wp_get_theme()->get('Version'), true);
    
    // アニメーションライブラリ (AOS - Animate On Scroll)
    wp_enqueue_style('aos-css', 'https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css', array(), '2.3.4');
    wp_enqueue_script('aos-js', 'https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js', array(), '2.3.4', true);
    
    // コメントフォーム用スクリプト
    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
    
    // Ajax用の設定
    wp_localize_script('manuheleku-main', 'manuheleku_ajax', array(
        'ajax_url' => admin_url('admin-ajax.php'),
        'nonce' => wp_create_nonce('manuheleku_nonce'),
    ));
}
add_action('wp_enqueue_scripts', 'manuheleku_scripts');

// カスタム投稿タイプ: AI最先端情報
function create_ai_news_post_type() {
    $labels = array(
        'name' => 'AI最先端情報',
        'singular_name' => 'AI記事',
        'menu_name' => 'AI最先端情報',
        'add_new' => '新規追加',
        'add_new_item' => '新しいAI記事を追加',
        'edit_item' => 'AI記事を編集',
        'new_item' => '新しいAI記事',
        'view_item' => 'AI記事を表示',
        'view_items' => 'AI記事を表示',
        'search_items' => 'AI記事を検索',
        'not_found' => 'AI記事が見つかりません',
        'not_found_in_trash' => 'ゴミ箱にAI記事はありません',
        'featured_image' => 'アイキャッチ画像',
        'set_featured_image' => 'アイキャッチ画像を設定',
        'remove_featured_image' => 'アイキャッチ画像を削除',
        'use_featured_image' => 'アイキャッチ画像として使用',
    );

    $args = array(
        'labels' => $labels,
        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'query_var' => true,
        'rewrite' => array('slug' => 'ai-news'),
        'capability_type' => 'post',
        'has_archive' => true,
        'hierarchical' => false,
        'menu_position' => 5,
        'menu_icon' => 'dashicons-admin-post',
        'supports' => array('title', 'editor', 'thumbnail', 'excerpt', 'custom-fields', 'author', 'comments'),
        'show_in_rest' => true,
    );

    register_post_type('ai_news', $args);
}
add_action('init', 'create_ai_news_post_type');

// カスタムタクソノミー: AIカテゴリ
function create_ai_news_taxonomy() {
    $labels = array(
        'name' => 'AIカテゴリ',
        'singular_name' => 'AIカテゴリ',
        'search_items' => 'AIカテゴリを検索',
        'all_items' => 'すべてのAIカテゴリ',
        'parent_item' => '親AIカテゴリ',
        'parent_item_colon' => '親AIカテゴリ:',
        'edit_item' => 'AIカテゴリを編集',
        'update_item' => 'AIカテゴリを更新',
        'add_new_item' => '新しいAIカテゴリを追加',
        'new_item_name' => '新しいAIカテゴリ名',
        'menu_name' => 'AIカテゴリ',
    );

    $args = array(
        'hierarchical' => true,
        'labels' => $labels,
        'show_ui' => true,
        'show_admin_column' => true,
        'query_var' => true,
        'rewrite' => array('slug' => 'ai-category'),
        'show_in_rest' => true,
    );

    register_taxonomy('ai_category', array('ai_news'), $args);
}
add_action('init', 'create_ai_news_taxonomy');

// デフォルトのAIカテゴリを作成
function create_default_ai_categories() {
    $categories = array(
        '機械学習' => '最新のML技術とアルゴリズム',
        '自動化' => '業務効率化とプロセス自動化',
        'AIツール' => '実用的なAIアプリケーション',
    );

    foreach ($categories as $name => $description) {
        if (!term_exists($name, 'ai_category')) {
            wp_insert_term($name, 'ai_category', array(
                'description' => $description,
            ));
        }
    }
}
add_action('init', 'create_default_ai_categories');

// ウィジェットエリアの登録
function manuheleku_widgets_init() {
    register_sidebar(array(
        'name' => 'サイドバー',
        'id' => 'sidebar-1',
        'description' => 'メインサイドバー',
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget' => '</section>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ));

    register_sidebar(array(
        'name' => 'フッター1',
        'id' => 'footer-1',
        'description' => 'フッターの最初のカラム',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h4 class="widget-title">',
        'after_title' => '</h4>',
    ));

    register_sidebar(array(
        'name' => 'フッター2',
        'id' => 'footer-2',
        'description' => 'フッターの2番目のカラム',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h4 class="widget-title">',
        'after_title' => '</h4>',
    ));

    register_sidebar(array(
        'name' => 'フッター3',
        'id' => 'footer-3',
        'description' => 'フッターの3番目のカラム',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h4 class="widget-title">',
        'after_title' => '</h4>',
    ));
}
add_action('widgets_init', 'manuheleku_widgets_init');

// カスタマイザーの設定
function manuheleku_customize_register($wp_customize) {
    // ヒーローセクション
    $wp_customize->add_section('hero_section', array(
        'title' => 'ヒーローセクション',
        'priority' => 30,
    ));

    $wp_customize->add_setting('hero_title', array(
        'default' => '未来を創るデジタル体験',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('hero_title', array(
        'label' => 'ヒーロータイトル',
        'section' => 'hero_section',
        'type' => 'text',
    ));

    $wp_customize->add_setting('hero_subtitle', array(
        'default' => 'Manuhelekuは、最先端のWebサイト制作・ECサイト制作を通じて、あなたのビジネスを次のレベルへと導きます。',
        'sanitize_callback' => 'sanitize_textarea_field',
    ));

    $wp_customize->add_control('hero_subtitle', array(
        'label' => 'ヒーローサブタイトル',
        'section' => 'hero_section',
        'type' => 'textarea',
    ));

    $wp_customize->add_setting('hero_image', array(
        'default' => '',
        'sanitize_callback' => 'esc_url_raw',
    ));

    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'hero_image', array(
        'label' => 'ヒーロー画像',
        'section' => 'hero_section',
    )));

    // 会社情報
    $wp_customize->add_section('company_info', array(
        'title' => '会社情報',
        'priority' => 35,
    ));

    $wp_customize->add_setting('company_email', array(
        'default' => 'info@manuheleku.com',
        'sanitize_callback' => 'sanitize_email',
    ));

    $wp_customize->add_control('company_email', array(
        'label' => 'メールアドレス',
        'section' => 'company_info',
        'type' => 'email',
    ));

    $wp_customize->add_setting('company_phone', array(
        'default' => '+81-3-1234-5678',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('company_phone', array(
        'label' => '電話番号',
        'section' => 'company_info',
        'type' => 'text',
    ));

    $wp_customize->add_setting('company_address', array(
        'default' => '東京都渋谷区',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('company_address', array(
        'label' => '住所',
        'section' => 'company_info',
        'type' => 'text',
    ));

    // サービス設定
    $wp_customize->add_section('services_section', array(
        'title' => 'サービス設定',
        'priority' => 40,
    ));

    // サービス1
    $wp_customize->add_setting('service_1_title', array(
        'default' => 'Webサイト制作',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('service_1_title', array(
        'label' => 'サービス1 タイトル',
        'section' => 'services_section',
        'type' => 'text',
    ));

    $wp_customize->add_setting('service_1_description', array(
        'default' => '最新のデザイントレンドと技術を駆使して、あなたのビジネスに最適なWebサイトを制作します。',
        'sanitize_callback' => 'sanitize_textarea_field',
    ));

    $wp_customize->add_control('service_1_description', array(
        'label' => 'サービス1 説明',
        'section' => 'services_section',
        'type' => 'textarea',
    ));

    // サービス2
    $wp_customize->add_setting('service_2_title', array(
        'default' => 'ECサイト制作',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('service_2_title', array(
        'label' => 'サービス2 タイトル',
        'section' => 'services_section',
        'type' => 'text',
    ));

    $wp_customize->add_setting('service_2_description', array(
        'default' => '売上向上を目指したECサイトを構築。決済システムから在庫管理まで、包括的なソリューションを提供します。',
        'sanitize_callback' => 'sanitize_textarea_field',
    ));

    $wp_customize->add_control('service_2_description', array(
        'label' => 'サービス2 説明',
        'section' => 'services_section',
        'type' => 'textarea',
    ));

    // サービス3
    $wp_customize->add_setting('service_3_title', array(
        'default' => 'モバイル最適化',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('service_3_title', array(
        'label' => 'サービス3 タイトル',
        'section' => 'services_section',
        'type' => 'text',
    ));

    $wp_customize->add_setting('service_3_description', array(
        'default' => 'モバイルファーストの時代に対応した、あらゆるデバイスで最適な体験を提供するレスポンシブデザイン。',
        'sanitize_callback' => 'sanitize_textarea_field',
    ));

    $wp_customize->add_control('service_3_description', array(
        'label' => 'サービス3 説明',
        'section' => 'services_section',
        'type' => 'textarea',
    ));
}
add_action('customize_register', 'manuheleku_customize_register');

// 検索結果でAI記事も含める
function include_ai_news_in_search($query) {
    if (!is_admin() && $query->is_main_query()) {
        if ($query->is_search()) {
            $query->set('post_type', array('post', 'page', 'ai_news'));
        }
    }
}
add_action('pre_get_posts', 'include_ai_news_in_search');

// AI記事のアーカイブページでの投稿数を調整
function ai_news_posts_per_page($query) {
    if (!is_admin() && $query->is_main_query()) {
        if (is_post_type_archive('ai_news')) {
            $query->set('posts_per_page', 9);
        }
    }
}
add_action('pre_get_posts', 'ai_news_posts_per_page');

// ショートコード: 最新のAI記事を表示
function latest_ai_news_shortcode($atts) {
    $atts = shortcode_atts(array(
        'count' => 3,
        'category' => '',
        'featured' => false,
    ), $atts);

    $args = array(
        'post_type' => 'ai_news',
        'posts_per_page' => intval($atts['count']),
        'post_status' => 'publish',
    );

    if (!empty($atts['category'])) {
        $args['tax_query'] = array(
            array(
                'taxonomy' => 'ai_category',
                'field' => 'slug',
                'terms' => $atts['category'],
            ),
        );
    }

    if ($atts['featured']) {
        $args['meta_query'] = array(
            array(
                'key' => 'featured',
                'value' => '1',
                'compare' => '=',
            ),
        );
    }

    $query = new WP_Query($args);
    $output = '';

    if ($query->have_posts()) {
        $output .= '<div class="latest-ai-news news-grid">';
        while ($query->have_posts()) {
            $query->the_post();
            $output .= '<article class="news-card">';
            
            if (has_post_thumbnail()) {
                $output .= '<div class="news-image-container">';
                $output .= get_the_post_thumbnail(get_the_ID(), 'news-thumbnail', array('class' => 'news-image'));
                $output .= '</div>';
            }
            
            $output .= '<div class="news-content">';
            $output .= '<div class="news-meta">';
            $output .= '<span class="news-date">' . get_the_date() . '</span>';
            
            $categories = get_the_terms(get_the_ID(), 'ai_category');
            if ($categories && !is_wp_error($categories)) {
                $output .= '<span class="news-category">' . esc_html($categories[0]->name) . '</span>';
            }
            
            $output .= '</div>';
            $output .= '<h3 class="news-title"><a href="' . get_permalink() . '">' . get_the_title() . '</a></h3>';
            $output .= '<p class="news-excerpt">' . get_the_excerpt() . '</p>';
            $output .= '</div>';
            $output .= '</article>';
        }
        $output .= '</div>';
        wp_reset_postdata();
    }

    return $output;
}
add_shortcode('latest_ai_news', 'latest_ai_news_shortcode');

// ショートコード: サービス一覧を表示
function services_grid_shortcode($atts) {
    $atts = shortcode_atts(array(
        'columns' => 3,
    ), $atts);

    $services = array(
        array(
            'icon' => 'fas fa-laptop-code',
            'title' => get_theme_mod('service_1_title', 'Webサイト制作'),
            'description' => get_theme_mod('service_1_description', '最新のデザイントレンドと技術を駆使して、あなたのビジネスに最適なWebサイトを制作します。'),
            'features' => array('レスポンシブデザイン', 'SEO最適化', '高速パフォーマンス', 'モダンUI/UX'),
        ),
        array(
            'icon' => 'fas fa-shopping-cart',
            'title' => get_theme_mod('service_2_title', 'ECサイト制作'),
            'description' => get_theme_mod('service_2_description', '売上向上を目指したECサイトを構築。決済システムから在庫管理まで、包括的なソリューションを提供します。'),
            'features' => array('決済システム統合', '在庫管理', '顧客管理', '分析ダッシュボード'),
        ),
        array(
            'icon' => 'fas fa-mobile-alt',
            'title' => get_theme_mod('service_3_title', 'モバイル最適化'),
            'description' => get_theme_mod('service_3_description', 'モバイルファーストの時代に対応した、あらゆるデバイスで最適な体験を提供するレスポンシブデザイン。'),
            'features' => array('PWA対応', 'タッチ最適化', '高速読み込み', 'オフライン対応'),
        ),
    );

    $output = '<div class="services-grid grid grid-' . intval($atts['columns']) . '">';
    
    foreach ($services as $service) {
        $output .= '<div class="service-card card" data-aos="fade-up">';
        $output .= '<div class="service-icon"><i class="' . esc_attr($service['icon']) . '"></i></div>';
        $output .= '<h3 class="card-title">' . esc_html($service['title']) . '</h3>';
        $output .= '<p class="card-content">' . esc_html($service['description']) . '</p>';
        $output .= '<ul class="service-features">';
        foreach ($service['features'] as $feature) {
            $output .= '<li>' . esc_html($feature) . '</li>';
        }
        $output .= '</ul>';
        $output .= '</div>';
    }
    
    $output .= '</div>';
    
    return $output;
}
add_shortcode('services_grid', 'services_grid_shortcode');

// 管理画面のカスタマイズ
function manuheleku_admin_styles() {
    echo '<style>
        .post-type-ai_news .wp-list-table .column-title {
            width: 30%;
        }
        .post-type-ai_news .wp-list-table .column-taxonomy-ai_category {
            width: 15%;
        }
        .post-type-ai_news .wp-list-table .column-date {
            width: 15%;
        }
        .manuheleku-admin-notice {
            background: #0073aa;
            color: white;
            padding: 15px;
            border-left: 4px solid #00a0d2;
        }
    </style>';
}
add_action('admin_head', 'manuheleku_admin_styles');

// AI記事の管理画面カラムをカスタマイズ
function ai_news_custom_columns($columns) {
    $new_columns = array();
    $new_columns['cb'] = $columns['cb'];
    $new_columns['title'] = $columns['title'];
    $new_columns['taxonomy-ai_category'] = 'カテゴリ';
    $new_columns['featured'] = '注目記事';
    $new_columns['date'] = $columns['date'];
    return $new_columns;
}
add_filter('manage_ai_news_posts_columns', 'ai_news_custom_columns');

function ai_news_custom_column_content($column, $post_id) {
    switch ($column) {
        case 'featured':
            $featured = get_post_meta($post_id, 'featured', true);
            echo $featured ? '<span style="color: #f39c12;">★ 注目</span>' : '';
            break;
    }
}
add_action('manage_ai_news_posts_custom_column', 'ai_news_custom_column_content', 10, 2);

// セキュリティ強化
function manuheleku_security_headers() {
    if (!is_admin()) {
        header('X-Content-Type-Options: nosniff');
        header('X-Frame-Options: SAMEORIGIN');
        header('X-XSS-Protection: 1; mode=block');
        header('Referrer-Policy: strict-origin-when-cross-origin');
    }
}
add_action('send_headers', 'manuheleku_security_headers');

// パフォーマンス最適化
function manuheleku_optimize_performance() {
    // 不要なWordPress機能を無効化
    remove_action('wp_head', 'wp_generator');
    remove_action('wp_head', 'wlwmanifest_link');
    remove_action('wp_head', 'rsd_link');
    remove_action('wp_head', 'wp_shortlink_wp_head');
    
    // 絵文字スクリプトを無効化
    remove_action('wp_head', 'print_emoji_detection_script', 7);
    remove_action('wp_print_styles', 'print_emoji_styles');
    remove_action('admin_print_scripts', 'print_emoji_detection_script');
    remove_action('admin_print_styles', 'print_emoji_styles');
    
    // XMLRPCを無効化
    add_filter('xmlrpc_enabled', '__return_false');
}
add_action('init', 'manuheleku_optimize_performance');

// コンタクトフォーム処理
function handle_contact_form() {
    if (isset($_POST['contact_form_submit'])) {
        // nonce検証
        if (!wp_verify_nonce($_POST['contact_nonce'], 'contact_form_nonce')) {
            wp_die('セキュリティチェックに失敗しました。');
        }

        $name = sanitize_text_field($_POST['contact_name']);
        $email = sanitize_email($_POST['contact_email']);
        $subject = sanitize_text_field($_POST['contact_subject']);
        $message = sanitize_textarea_field($_POST['contact_message']);

        // バリデーション
        if (empty($name) || empty($email) || empty($message)) {
            wp_redirect(add_query_arg('contact', 'error', wp_get_referer()));
            exit;
        }

        // メール送信
        $to = get_theme_mod('company_email', 'info@manuheleku.com');
        $email_subject = 'お問い合わせ: ' . $subject;
        $email_message = "お名前: {$name}\n";
        $email_message .= "メールアドレス: {$email}\n";
        $email_message .= "件名: {$subject}\n\n";
        $email_message .= "メッセージ:\n{$message}";

        $headers = array(
            'Content-Type: text/plain; charset=UTF-8',
            'From: ' . $name . ' <' . $email . '>',
            'Reply-To: ' . $email,
        );

        if (wp_mail($to, $email_subject, $email_message, $headers)) {
            wp_redirect(add_query_arg('contact', 'success', wp_get_referer()));
        } else {
            wp_redirect(add_query_arg('contact', 'error', wp_get_referer()));
        }
        exit;
    }
}
add_action('init', 'handle_contact_form');

// Ajax検索機能
function ajax_search_ai_news() {
    check_ajax_referer('manuheleku_nonce', 'nonce');

    $search_term = sanitize_text_field($_POST['search_term']);
    $category = sanitize_text_field($_POST['category']);

    $args = array(
        'post_type' => 'ai_news',
        'posts_per_page' => 6,
        's' => $search_term,
    );

    if (!empty($category) && $category !== 'all') {
        $args['tax_query'] = array(
            array(
                'taxonomy' => 'ai_category',
                'field' => 'slug',
                'terms' => $category,
            ),
        );
    }

    $query = new WP_Query($args);
    $results = array();

    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();
            $categories = get_the_terms(get_the_ID(), 'ai_category');
            $category_name = $categories && !is_wp_error($categories) ? $categories[0]->name : '';

            $results[] = array(
                'id' => get_the_ID(),
                'title' => get_the_title(),
                'excerpt' => get_the_excerpt(),
                'permalink' => get_permalink(),
                'date' => get_the_date(),
                'category' => $category_name,
                'thumbnail' => get_the_post_thumbnail_url(get_the_ID(), 'news-thumbnail'),
            );
        }
        wp_reset_postdata();
    }

    wp_send_json_success($results);
}
add_action('wp_ajax_search_ai_news', 'ajax_search_ai_news');
add_action('wp_ajax_nopriv_search_ai_news', 'ajax_search_ai_news');

// テーマアクティベーション時の処理
function manuheleku_theme_activation() {
    // デフォルトページの作成
    $pages = array(
        'ホーム' => array(
            'content' => '[hero_section][services_grid][latest_ai_news count="6"]',
            'template' => 'front-page.php',
        ),
        'AI最先端情報' => array(
            'content' => 'AI技術の最新動向をお届けします。',
            'template' => 'page-ai-news.php',
        ),
        'お問い合わせ' => array(
            'content' => '[contact_form]',
            'template' => 'page-contact.php',
        ),
    );

    foreach ($pages as $title => $page_data) {
        $existing_page = get_page_by_title($title);
        if (!$existing_page) {
            wp_insert_post(array(
                'post_title' => $title,
                'post_content' => $page_data['content'],
                'post_status' => 'publish',
                'post_type' => 'page',
            ));
        }
    }

    // フラッシュリライトルール
    flush_rewrite_rules();
}
add_action('after_switch_theme', 'manuheleku_theme_activation');

// 管理画面に通知を表示
function manuheleku_admin_notices() {
    $screen = get_current_screen();
    if ($screen->id === 'themes') {
        echo '<div class="notice notice-info manuheleku-admin-notice">';
        echo '<p><strong>Manuhelekuテーマ</strong>が有効化されました。カスタマイザーでサイトの設定を行ってください。</p>';
        echo '</div>';
    }
}
add_action('admin_notices', 'manuheleku_admin_notices');

?>

