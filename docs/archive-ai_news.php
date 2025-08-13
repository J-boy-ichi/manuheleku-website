<?php
/**
 * The template for displaying AI news archive
 * Manuheleku WordPress Theme
 */

get_header(); ?>

<main id="primary" class="site-main ai-news-archive">
    <div class="container">
        
        <!-- Archive Header -->
        <header class="archive-header">
            <div class="archive-title-section">
                <h1 class="archive-title">AI技術の最前線</h1>
                <p class="archive-description">
                    最新のAI技術動向、実用的な活用事例、そして未来への展望をわかりやすくお届けします。
                    テクノロジーの進歩とともに変化するビジネス環境に対応するための情報をご提供します。
                </p>
            </div>
            
            <!-- Search and Filter Section -->
            <div class="archive-controls">
                <div class="search-section">
                    <form class="ai-news-search" role="search" method="get" action="<?php echo esc_url(home_url('/')); ?>">
                        <div class="search-input-group">
                            <input type="search" name="s" placeholder="AI記事を検索..." value="<?php echo get_search_query(); ?>" class="search-input">
                            <input type="hidden" name="post_type" value="ai_news">
                            <button type="submit" class="search-button">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </form>
                </div>
                
                <div class="filter-section">
                    <div class="filter-tabs">
                        <button class="filter-btn active" data-category="all">すべて</button>
                        <?php
                        $categories = get_terms(array(
                            'taxonomy' => 'ai_category',
                            'hide_empty' => true,
                        ));
                        
                        if ($categories && !is_wp_error($categories)) :
                            foreach ($categories as $category) :
                        ?>
                            <button class="filter-btn" data-category="<?php echo esc_attr($category->slug); ?>">
                                <?php echo esc_html($category->name); ?>
                                <span class="count">(<?php echo $category->count; ?>)</span>
                            </button>
                        <?php
                            endforeach;
                        endif;
                        ?>
                    </div>
                    
                    <div class="sort-section">
                        <select class="sort-select" id="sort-posts">
                            <option value="date-desc">新しい順</option>
                            <option value="date-asc">古い順</option>
                            <option value="title-asc">タイトル順</option>
                            <option value="popular">人気順</option>
                        </select>
                    </div>
                </div>
            </div>
        </header>

        <!-- Featured Articles Section -->
        <?php
        $featured_posts = get_posts(array(
            'post_type' => 'ai_news',
            'posts_per_page' => 3,
            'meta_query' => array(
                array(
                    'key' => 'featured',
                    'value' => '1',
                    'compare' => '='
                )
            )
        ));
        
        if ($featured_posts) :
        ?>
            <section class="featured-articles">
                <h2 class="section-title">注目記事</h2>
                <div class="featured-grid">
                    <?php foreach ($featured_posts as $post) : setup_postdata($post); ?>
                        <article class="featured-card">
                            <?php if (has_post_thumbnail()) : ?>
                                <div class="featured-image">
                                    <a href="<?php the_permalink(); ?>">
                                        <?php the_post_thumbnail('news-featured'); ?>
                                    </a>
                                    <div class="featured-badge">注目</div>
                                </div>
                            <?php endif; ?>
                            
                            <div class="featured-content">
                                <div class="featured-meta">
                                    <?php
                                    $categories = get_the_terms(get_the_ID(), 'ai_category');
                                    if ($categories && !is_wp_error($categories)) :
                                    ?>
                                        <span class="featured-category"><?php echo esc_html($categories[0]->name); ?></span>
                                    <?php endif; ?>
                                    <span class="featured-date"><?php echo get_the_date(); ?></span>
                                </div>
                                
                                <h3 class="featured-title">
                                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                </h3>
                                
                                <p class="featured-excerpt"><?php echo wp_trim_words(get_the_excerpt(), 20); ?></p>
                                
                                <a href="<?php the_permalink(); ?>" class="read-more-btn">
                                    続きを読む <i class="fas fa-arrow-right"></i>
                                </a>
                            </div>
                        </article>
                    <?php endforeach; wp_reset_postdata(); ?>
                </div>
            </section>
        <?php endif; ?>

        <!-- Main Articles Grid -->
        <section class="main-articles">
            <div class="articles-header">
                <h2 class="section-title">すべての記事</h2>
                <div class="view-toggle">
                    <button class="view-btn active" data-view="grid" aria-label="グリッド表示">
                        <i class="fas fa-th"></i>
                    </button>
                    <button class="view-btn" data-view="list" aria-label="リスト表示">
                        <i class="fas fa-list"></i>
                    </button>
                </div>
            </div>
            
            <div class="articles-container" id="articles-container">
                <?php if (have_posts()) : ?>
                    <div class="articles-grid" id="articles-grid">
                        <?php while (have_posts()) : the_post(); ?>
                            <article id="post-<?php the_ID(); ?>" <?php post_class('article-card'); ?> data-category="<?php 
                                $categories = get_the_terms(get_the_ID(), 'ai_category');
                                echo $categories && !is_wp_error($categories) ? esc_attr($categories[0]->slug) : '';
                            ?>">
                                
                                <?php if (has_post_thumbnail()) : ?>
                                    <div class="article-image">
                                        <a href="<?php the_permalink(); ?>">
                                            <?php the_post_thumbnail('news-thumbnail'); ?>
                                        </a>
                                        
                                        <?php if (get_post_meta(get_the_ID(), 'featured', true)) : ?>
                                            <div class="article-badge">注目</div>
                                        <?php endif; ?>
                                    </div>
                                <?php endif; ?>
                                
                                <div class="article-content">
                                    <div class="article-meta">
                                        <?php
                                        $categories = get_the_terms(get_the_ID(), 'ai_category');
                                        if ($categories && !is_wp_error($categories)) :
                                        ?>
                                            <span class="article-category">
                                                <a href="<?php echo esc_url(get_term_link($categories[0])); ?>">
                                                    <?php echo esc_html($categories[0]->name); ?>
                                                </a>
                                            </span>
                                        <?php endif; ?>
                                        
                                        <span class="article-date"><?php echo get_the_date(); ?></span>
                                        <span class="reading-time"><?php echo manuheleku_reading_time(); ?>分</span>
                                    </div>
                                    
                                    <h3 class="article-title">
                                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                    </h3>
                                    
                                    <p class="article-excerpt"><?php echo wp_trim_words(get_the_excerpt(), 15); ?></p>
                                    
                                    <div class="article-footer">
                                        <a href="<?php the_permalink(); ?>" class="read-more">
                                            続きを読む <i class="fas fa-arrow-right"></i>
                                        </a>
                                        
                                        <div class="article-actions">
                                            <button class="bookmark-btn" data-post-id="<?php the_ID(); ?>" aria-label="ブックマーク">
                                                <i class="far fa-bookmark"></i>
                                            </button>
                                            <button class="share-btn" data-url="<?php the_permalink(); ?>" data-title="<?php the_title_attribute(); ?>" aria-label="シェア">
                                                <i class="fas fa-share-alt"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </article>
                        <?php endwhile; ?>
                    </div>

                    <!-- Pagination -->
                    <div class="pagination-container">
                        <?php
                        echo paginate_links(array(
                            'prev_text' => '<i class="fas fa-chevron-left"></i> 前へ',
                            'next_text' => '次へ <i class="fas fa-chevron-right"></i>',
                            'type' => 'list',
                            'end_size' => 2,
                            'mid_size' => 1,
                        ));
                        ?>
                    </div>

                <?php else : ?>
                    
                    <div class="no-posts">
                        <div class="no-posts-icon">
                            <i class="fas fa-search"></i>
                        </div>
                        <h3>記事が見つかりませんでした</h3>
                        <p>検索条件を変更するか、すべての記事をご覧ください。</p>
                        <a href="<?php echo get_post_type_archive_link('ai_news'); ?>" class="btn btn-primary">
                            すべての記事を見る
                        </a>
                    </div>

                <?php endif; ?>
            </div>
        </section>

        <!-- Newsletter Signup -->
        <section class="newsletter-section">
            <div class="newsletter-content">
                <h3>AI最先端情報を受け取る</h3>
                <p>最新のAI技術動向や実用的な活用事例を定期的にお届けします。</p>
                <form class="newsletter-form">
                    <div class="newsletter-input-group">
                        <input type="email" placeholder="メールアドレスを入力" required>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-paper-plane"></i> 登録
                        </button>
                    </div>
                </form>
            </div>
        </section>

    </div>
</main>

<style>
.ai-news-archive {
    padding: 2rem 0;
}

.archive-header {
    text-align: center;
    margin-bottom: 4rem;
}

.archive-title-section {
    margin-bottom: 3rem;
}

.archive-title {
    font-size: 3rem;
    margin-bottom: 1rem;
    background: var(--gradient-primary);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

.archive-description {
    font-size: 1.125rem;
    color: var(--text-secondary);
    max-width: 800px;
    margin: 0 auto;
    line-height: 1.6;
}

.archive-controls {
    display: flex;
    flex-direction: column;
    gap: 2rem;
    max-width: 1000px;
    margin: 0 auto;
}

.search-section {
    display: flex;
    justify-content: center;
}

.search-input-group {
    display: flex;
    max-width: 500px;
    width: 100%;
    background: rgba(30, 41, 59, 0.5);
    border: 1px solid var(--border-color);
    border-radius: 2rem;
    overflow: hidden;
}

.search-input {
    flex: 1;
    padding: 1rem 1.5rem;
    background: transparent;
    border: none;
    color: var(--text-primary);
    font-size: 1rem;
}

.search-input:focus {
    outline: none;
}

.search-button {
    padding: 1rem 1.5rem;
    background: var(--gradient-primary);
    border: none;
    color: white;
    cursor: pointer;
    transition: all 0.3s ease;
}

.search-button:hover {
    background: var(--gradient-secondary);
}

.filter-section {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 2rem;
}

.filter-tabs {
    display: flex;
    gap: 1rem;
    flex-wrap: wrap;
    justify-content: center;
}

.filter-btn {
    padding: 0.75rem 1.5rem;
    background: transparent;
    border: 1px solid var(--border-color);
    border-radius: 2rem;
    color: var(--text-secondary);
    cursor: pointer;
    transition: all 0.3s ease;
    font-size: 0.9rem;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.filter-btn:hover,
.filter-btn.active {
    background: var(--accent-blue);
    color: white;
    border-color: var(--accent-blue);
}

.filter-btn .count {
    font-size: 0.8rem;
    opacity: 0.8;
}

.sort-section {
    min-width: 200px;
}

.sort-select {
    width: 100%;
    padding: 0.75rem 1rem;
    background: rgba(30, 41, 59, 0.5);
    border: 1px solid var(--border-color);
    border-radius: 0.5rem;
    color: var(--text-primary);
    cursor: pointer;
}

.featured-articles {
    margin-bottom: 4rem;
}

.section-title {
    text-align: center;
    margin-bottom: 2rem;
    color: var(--text-primary);
}

.featured-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
    gap: 2rem;
}

.featured-card {
    background: rgba(30, 41, 59, 0.3);
    border: 1px solid var(--border-color);
    border-radius: 1rem;
    overflow: hidden;
    transition: all 0.3s ease;
    position: relative;
}

.featured-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 20px 40px var(--shadow-color);
}

.featured-image {
    position: relative;
    overflow: hidden;
}

.featured-image img {
    width: 100%;
    height: 200px;
    object-fit: cover;
    transition: transform 0.3s ease;
}

.featured-card:hover .featured-image img {
    transform: scale(1.05);
}

.featured-badge {
    position: absolute;
    top: 1rem;
    left: 1rem;
    background: var(--gradient-secondary);
    color: white;
    padding: 0.25rem 0.75rem;
    border-radius: 1rem;
    font-size: 0.75rem;
    font-weight: 600;
}

.featured-content {
    padding: 1.5rem;
}

.featured-meta {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 1rem;
    font-size: 0.875rem;
}

.featured-category {
    background: var(--accent-blue);
    color: white;
    padding: 0.25rem 0.75rem;
    border-radius: 1rem;
    font-size: 0.75rem;
}

.featured-date {
    color: var(--text-muted);
}

.featured-title {
    margin-bottom: 1rem;
}

.featured-title a {
    color: var(--text-primary);
    text-decoration: none;
    transition: color 0.3s ease;
}

.featured-title a:hover {
    color: var(--accent-blue);
}

.featured-excerpt {
    color: var(--text-secondary);
    line-height: 1.6;
    margin-bottom: 1.5rem;
}

.read-more-btn {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    color: var(--accent-blue);
    text-decoration: none;
    font-weight: 500;
    transition: all 0.3s ease;
}

.read-more-btn:hover {
    color: var(--accent-purple);
    transform: translateX(5px);
}

.main-articles {
    margin-bottom: 4rem;
}

.articles-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 2rem;
}

.view-toggle {
    display: flex;
    gap: 0.5rem;
}

.view-btn {
    padding: 0.5rem;
    background: transparent;
    border: 1px solid var(--border-color);
    border-radius: 0.5rem;
    color: var(--text-secondary);
    cursor: pointer;
    transition: all 0.3s ease;
}

.view-btn:hover,
.view-btn.active {
    background: var(--accent-blue);
    color: white;
    border-color: var(--accent-blue);
}

.articles-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
    gap: 2rem;
}

.articles-grid.list-view {
    grid-template-columns: 1fr;
}

.article-card {
    background: rgba(30, 41, 59, 0.3);
    border: 1px solid var(--border-color);
    border-radius: 1rem;
    overflow: hidden;
    transition: all 0.3s ease;
    position: relative;
}

.article-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 20px 40px var(--shadow-color);
}

.articles-grid.list-view .article-card {
    display: flex;
    align-items: center;
}

.article-image {
    position: relative;
    overflow: hidden;
}

.article-image img {
    width: 100%;
    height: 200px;
    object-fit: cover;
    transition: transform 0.3s ease;
}

.articles-grid.list-view .article-image img {
    width: 200px;
    height: 150px;
}

.article-card:hover .article-image img {
    transform: scale(1.05);
}

.article-badge {
    position: absolute;
    top: 1rem;
    right: 1rem;
    background: var(--gradient-secondary);
    color: white;
    padding: 0.25rem 0.75rem;
    border-radius: 1rem;
    font-size: 0.75rem;
    font-weight: 600;
}

.article-content {
    padding: 1.5rem;
    flex: 1;
}

.article-meta {
    display: flex;
    gap: 1rem;
    margin-bottom: 1rem;
    font-size: 0.875rem;
    flex-wrap: wrap;
}

.article-category a {
    background: var(--accent-blue);
    color: white;
    padding: 0.25rem 0.75rem;
    border-radius: 1rem;
    text-decoration: none;
    font-size: 0.75rem;
}

.article-date,
.reading-time {
    color: var(--text-muted);
}

.article-title {
    margin-bottom: 1rem;
}

.article-title a {
    color: var(--text-primary);
    text-decoration: none;
    transition: color 0.3s ease;
}

.article-title a:hover {
    color: var(--accent-blue);
}

.article-excerpt {
    color: var(--text-secondary);
    line-height: 1.6;
    margin-bottom: 1.5rem;
}

.article-footer {
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.read-more {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    color: var(--accent-blue);
    text-decoration: none;
    font-weight: 500;
    transition: all 0.3s ease;
}

.read-more:hover {
    color: var(--accent-purple);
    transform: translateX(5px);
}

.article-actions {
    display: flex;
    gap: 0.5rem;
}

.bookmark-btn,
.share-btn {
    padding: 0.5rem;
    background: transparent;
    border: 1px solid var(--border-color);
    border-radius: 0.5rem;
    color: var(--text-secondary);
    cursor: pointer;
    transition: all 0.3s ease;
}

.bookmark-btn:hover,
.share-btn:hover {
    background: var(--accent-blue);
    color: white;
    border-color: var(--accent-blue);
}

.pagination-container {
    margin-top: 3rem;
    text-align: center;
}

.page-numbers {
    display: inline-flex;
    gap: 0.5rem;
    list-style: none;
    padding: 0;
    margin: 0;
}

.page-numbers li {
    margin: 0;
}

.page-numbers a,
.page-numbers span {
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 0.75rem 1rem;
    background: rgba(30, 41, 59, 0.3);
    border: 1px solid var(--border-color);
    border-radius: 0.5rem;
    color: var(--text-secondary);
    text-decoration: none;
    transition: all 0.3s ease;
    min-width: 45px;
}

.page-numbers a:hover,
.page-numbers .current {
    background: var(--accent-blue);
    color: white;
    border-color: var(--accent-blue);
}

.no-posts {
    text-align: center;
    padding: 4rem 2rem;
}

.no-posts-icon {
    font-size: 4rem;
    color: var(--text-muted);
    margin-bottom: 1rem;
}

.no-posts h3 {
    margin-bottom: 1rem;
    color: var(--text-primary);
}

.no-posts p {
    color: var(--text-secondary);
    margin-bottom: 2rem;
}

.newsletter-section {
    background: rgba(30, 41, 59, 0.3);
    border: 1px solid var(--border-color);
    border-radius: 1rem;
    padding: 3rem 2rem;
    text-align: center;
    margin-top: 4rem;
}

.newsletter-content h3 {
    margin-bottom: 1rem;
    color: var(--text-primary);
}

.newsletter-content p {
    color: var(--text-secondary);
    margin-bottom: 2rem;
}

.newsletter-input-group {
    display: flex;
    max-width: 400px;
    margin: 0 auto;
    gap: 1rem;
}

.newsletter-input-group input {
    flex: 1;
    padding: 0.75rem 1rem;
    background: rgba(15, 23, 42, 0.8);
    border: 1px solid var(--border-color);
    border-radius: 0.5rem;
    color: var(--text-primary);
}

@media (max-width: 768px) {
    .archive-title {
        font-size: 2rem;
    }
    
    .archive-controls {
        gap: 1.5rem;
    }
    
    .filter-section {
        flex-direction: column;
        gap: 1rem;
    }
    
    .filter-tabs {
        justify-content: center;
    }
    
    .articles-header {
        flex-direction: column;
        gap: 1rem;
        text-align: center;
    }
    
    .articles-grid {
        grid-template-columns: 1fr;
    }
    
    .articles-grid.list-view .article-card {
        flex-direction: column;
    }
    
    .articles-grid.list-view .article-image img {
        width: 100%;
        height: 200px;
    }
    
    .newsletter-input-group {
        flex-direction: column;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Filter functionality
    const filterBtns = document.querySelectorAll('.filter-btn');
    const articles = document.querySelectorAll('.article-card');
    
    filterBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            const category = this.dataset.category;
            
            // Update active state
            filterBtns.forEach(b => b.classList.remove('active'));
            this.classList.add('active');
            
            // Filter articles
            articles.forEach(article => {
                const articleCategory = article.dataset.category;
                if (category === 'all' || articleCategory === category) {
                    article.style.display = 'block';
                } else {
                    article.style.display = 'none';
                }
            });
        });
    });
    
    // View toggle functionality
    const viewBtns = document.querySelectorAll('.view-btn');
    const articlesGrid = document.getElementById('articles-grid');
    
    viewBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            const view = this.dataset.view;
            
            // Update active state
            viewBtns.forEach(b => b.classList.remove('active'));
            this.classList.add('active');
            
            // Update grid view
            if (view === 'list') {
                articlesGrid.classList.add('list-view');
            } else {
                articlesGrid.classList.remove('list-view');
            }
        });
    });
    
    // Bookmark functionality
    document.querySelectorAll('.bookmark-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            this.classList.toggle('bookmarked');
            const icon = this.querySelector('i');
            if (this.classList.contains('bookmarked')) {
                icon.classList.remove('far');
                icon.classList.add('fas');
            } else {
                icon.classList.remove('fas');
                icon.classList.add('far');
            }
        });
    });
    
    // Share functionality
    document.querySelectorAll('.share-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            const url = this.dataset.url;
            const title = this.dataset.title;
            
            if (navigator.share) {
                navigator.share({
                    title: title,
                    url: url
                });
            } else {
                // Fallback to copy to clipboard
                navigator.clipboard.writeText(url).then(() => {
                    alert('リンクをクリップボードにコピーしました');
                });
            }
        });
    });
});
</script>

<?php
get_footer();

// Helper function for reading time (if not already defined)
if (!function_exists('manuheleku_reading_time')) {
    function manuheleku_reading_time() {
        $content = get_post_field('post_content', get_the_ID());
        $word_count = str_word_count(strip_tags($content));
        $reading_time = ceil($word_count / 200); // Assuming 200 words per minute
        return $reading_time;
    }
}
?>

