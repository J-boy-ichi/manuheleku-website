<?php
/**
 * The template for displaying single AI news posts
 * Manuheleku WordPress Theme
 */

get_header(); ?>

<main id="primary" class="site-main single-ai-news">
    <div class="container">
        
        <?php while (have_posts()) : the_post(); ?>
            
            <article id="post-<?php the_ID(); ?>" <?php post_class('ai-news-article'); ?>>
                
                <!-- Article Header -->
                <header class="article-header">
                    <div class="article-meta">
                        <div class="meta-left">
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
                            
                            <time class="article-date" datetime="<?php echo get_the_date('c'); ?>">
                                <?php echo get_the_date(); ?>
                            </time>
                            
                            <span class="reading-time">
                                <?php echo manuheleku_reading_time(); ?>分で読める
                            </span>
                        </div>
                        
                        <div class="meta-right">
                            <div class="article-share">
                                <button class="share-toggle" aria-label="シェア">
                                    <i class="fas fa-share-alt"></i>
                                </button>
                                <div class="share-dropdown">
                                    <a href="https://twitter.com/intent/tweet?url=<?php echo urlencode(get_permalink()); ?>&text=<?php echo urlencode(get_the_title()); ?>" target="_blank" rel="noopener" class="share-link twitter">
                                        <i class="fab fa-twitter"></i> Twitter
                                    </a>
                                    <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode(get_permalink()); ?>" target="_blank" rel="noopener" class="share-link facebook">
                                        <i class="fab fa-facebook"></i> Facebook
                                    </a>
                                    <a href="https://www.linkedin.com/sharing/share-offsite/?url=<?php echo urlencode(get_permalink()); ?>" target="_blank" rel="noopener" class="share-link linkedin">
                                        <i class="fab fa-linkedin"></i> LinkedIn
                                    </a>
                                    <button class="share-link copy-link" data-url="<?php echo get_permalink(); ?>">
                                        <i class="fas fa-link"></i> リンクをコピー
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <h1 class="article-title"><?php the_title(); ?></h1>
                    
                    <?php if (has_excerpt()) : ?>
                        <div class="article-excerpt">
                            <?php the_excerpt(); ?>
                        </div>
                    <?php endif; ?>
                    
                    <?php if (has_post_thumbnail()) : ?>
                        <div class="article-featured-image">
                            <?php the_post_thumbnail('news-featured', array('class' => 'featured-image')); ?>
                            <?php
                            $caption = get_the_post_thumbnail_caption();
                            if ($caption) :
                            ?>
                                <figcaption class="image-caption"><?php echo esc_html($caption); ?></figcaption>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>
                </header>

                <!-- Article Content -->
                <div class="article-content">
                    <?php
                    the_content();
                    
                    wp_link_pages(array(
                        'before' => '<div class="page-links">' . esc_html__('ページ:', 'manuheleku'),
                        'after'  => '</div>',
                    ));
                    ?>
                </div>

                <!-- Article Footer -->
                <footer class="article-footer">
                    
                    <!-- Tags -->
                    <?php
                    $tags = get_the_tags();
                    if ($tags && !is_wp_error($tags)) :
                    ?>
                        <div class="article-tags">
                            <h4>関連タグ</h4>
                            <div class="tags-list">
                                <?php foreach ($tags as $tag) : ?>
                                    <a href="<?php echo esc_url(get_tag_link($tag)); ?>" class="tag-link">
                                        #<?php echo esc_html($tag->name); ?>
                                    </a>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    <?php endif; ?>
                    
                    <!-- Author Info -->
                    <div class="article-author">
                        <div class="author-avatar">
                            <?php echo get_avatar(get_the_author_meta('ID'), 60); ?>
                        </div>
                        <div class="author-info">
                            <h4 class="author-name"><?php the_author(); ?></h4>
                            <p class="author-bio"><?php echo get_the_author_meta('description'); ?></p>
                            <div class="author-links">
                                <?php if (get_the_author_meta('url')) : ?>
                                    <a href="<?php echo esc_url(get_the_author_meta('url')); ?>" target="_blank" rel="noopener">
                                        <i class="fas fa-globe"></i> ウェブサイト
                                    </a>
                                <?php endif; ?>
                                
                                <?php if (get_the_author_meta('twitter')) : ?>
                                    <a href="https://twitter.com/<?php echo esc_attr(get_the_author_meta('twitter')); ?>" target="_blank" rel="noopener">
                                        <i class="fab fa-twitter"></i> Twitter
                                    </a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Navigation -->
                    <div class="article-navigation">
                        <?php
                        $prev_post = get_previous_post(true, '', 'ai_category');
                        $next_post = get_next_post(true, '', 'ai_category');
                        ?>
                        
                        <?php if ($prev_post) : ?>
                            <div class="nav-previous">
                                <a href="<?php echo get_permalink($prev_post); ?>" class="nav-link">
                                    <span class="nav-direction">
                                        <i class="fas fa-chevron-left"></i> 前の記事
                                    </span>
                                    <span class="nav-title"><?php echo get_the_title($prev_post); ?></span>
                                </a>
                            </div>
                        <?php endif; ?>
                        
                        <?php if ($next_post) : ?>
                            <div class="nav-next">
                                <a href="<?php echo get_permalink($next_post); ?>" class="nav-link">
                                    <span class="nav-direction">
                                        次の記事 <i class="fas fa-chevron-right"></i>
                                    </span>
                                    <span class="nav-title"><?php echo get_the_title($next_post); ?></span>
                                </a>
                            </div>
                        <?php endif; ?>
                    </div>
                </footer>

            </article>

            <!-- Related Articles -->
            <?php
            $related_posts = get_posts(array(
                'post_type' => 'ai_news',
                'posts_per_page' => 3,
                'post__not_in' => array(get_the_ID()),
                'tax_query' => array(
                    array(
                        'taxonomy' => 'ai_category',
                        'field' => 'term_id',
                        'terms' => wp_get_post_terms(get_the_ID(), 'ai_category', array('fields' => 'ids')),
                    ),
                ),
            ));
            
            if ($related_posts) :
            ?>
                <section class="related-articles">
                    <h3>関連記事</h3>
                    <div class="related-grid">
                        <?php foreach ($related_posts as $post) : setup_postdata($post); ?>
                            <article class="related-card">
                                <?php if (has_post_thumbnail()) : ?>
                                    <div class="related-image">
                                        <a href="<?php the_permalink(); ?>">
                                            <?php the_post_thumbnail('news-thumbnail'); ?>
                                        </a>
                                    </div>
                                <?php endif; ?>
                                
                                <div class="related-content">
                                    <div class="related-meta">
                                        <?php
                                        $categories = get_the_terms(get_the_ID(), 'ai_category');
                                        if ($categories && !is_wp_error($categories)) :
                                        ?>
                                            <span class="related-category"><?php echo esc_html($categories[0]->name); ?></span>
                                        <?php endif; ?>
                                        <span class="related-date"><?php echo get_the_date(); ?></span>
                                    </div>
                                    
                                    <h4 class="related-title">
                                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                    </h4>
                                    
                                    <p class="related-excerpt"><?php echo wp_trim_words(get_the_excerpt(), 15); ?></p>
                                </div>
                            </article>
                        <?php endforeach; wp_reset_postdata(); ?>
                    </div>
                </section>
            <?php endif; ?>

            <!-- Comments -->
            <?php
            if (comments_open() || get_comments_number()) :
                comments_template();
            endif;
            ?>

        <?php endwhile; ?>
        
    </div>
</main>

<style>
.single-ai-news {
    padding: 2rem 0;
}

.ai-news-article {
    max-width: 800px;
    margin: 0 auto;
}

.article-header {
    margin-bottom: 3rem;
}

.article-meta {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 1.5rem;
    padding-bottom: 1rem;
    border-bottom: 1px solid var(--border-color);
}

.meta-left {
    display: flex;
    align-items: center;
    gap: 1rem;
    flex-wrap: wrap;
}

.article-category a {
    background: var(--accent-blue);
    color: white;
    padding: 0.25rem 0.75rem;
    border-radius: 1rem;
    font-size: 0.875rem;
    text-decoration: none;
    text-transform: uppercase;
    letter-spacing: 0.05em;
}

.article-date,
.reading-time {
    color: var(--text-muted);
    font-size: 0.875rem;
}

.article-share {
    position: relative;
}

.share-toggle {
    background: rgba(30, 41, 59, 0.5);
    border: 1px solid var(--border-color);
    border-radius: 0.5rem;
    padding: 0.5rem;
    color: var(--text-secondary);
    cursor: pointer;
    transition: all 0.3s ease;
}

.share-toggle:hover {
    background: var(--accent-blue);
    color: white;
}

.share-dropdown {
    position: absolute;
    top: 100%;
    right: 0;
    background: var(--bg-secondary);
    border: 1px solid var(--border-color);
    border-radius: 0.5rem;
    padding: 0.5rem;
    min-width: 200px;
    opacity: 0;
    visibility: hidden;
    transform: translateY(-10px);
    transition: all 0.3s ease;
    z-index: 100;
}

.share-toggle:hover + .share-dropdown,
.share-dropdown:hover {
    opacity: 1;
    visibility: visible;
    transform: translateY(0);
}

.share-link {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0.5rem;
    color: var(--text-secondary);
    text-decoration: none;
    border-radius: 0.25rem;
    transition: all 0.3s ease;
    width: 100%;
    border: none;
    background: none;
    cursor: pointer;
}

.share-link:hover {
    background: rgba(59, 130, 246, 0.1);
    color: var(--accent-blue);
}

.article-title {
    font-size: 2.5rem;
    line-height: 1.2;
    margin-bottom: 1rem;
    background: var(--gradient-primary);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

.article-excerpt {
    font-size: 1.25rem;
    color: var(--text-secondary);
    line-height: 1.6;
    margin-bottom: 2rem;
}

.article-featured-image {
    margin-bottom: 2rem;
}

.featured-image {
    width: 100%;
    height: auto;
    border-radius: 1rem;
    box-shadow: 0 10px 30px var(--shadow-color);
}

.image-caption {
    text-align: center;
    font-size: 0.875rem;
    color: var(--text-muted);
    margin-top: 0.5rem;
    font-style: italic;
}

.article-content {
    font-size: 1.125rem;
    line-height: 1.8;
    margin-bottom: 3rem;
}

.article-content h2,
.article-content h3,
.article-content h4 {
    margin-top: 2rem;
    margin-bottom: 1rem;
}

.article-content h2 {
    font-size: 1.875rem;
    color: var(--text-primary);
}

.article-content h3 {
    font-size: 1.5rem;
    color: var(--text-primary);
}

.article-content h4 {
    font-size: 1.25rem;
    color: var(--text-primary);
}

.article-content p {
    margin-bottom: 1.5rem;
}

.article-content ul,
.article-content ol {
    margin-bottom: 1.5rem;
    padding-left: 2rem;
}

.article-content li {
    margin-bottom: 0.5rem;
}

.article-content blockquote {
    border-left: 4px solid var(--accent-blue);
    padding-left: 1.5rem;
    margin: 2rem 0;
    font-style: italic;
    color: var(--text-secondary);
    background: rgba(30, 41, 59, 0.3);
    padding: 1.5rem;
    border-radius: 0.5rem;
}

.article-content code {
    background: rgba(30, 41, 59, 0.8);
    padding: 0.25rem 0.5rem;
    border-radius: 0.25rem;
    font-family: 'Courier New', monospace;
    font-size: 0.9em;
}

.article-content pre {
    background: rgba(30, 41, 59, 0.8);
    padding: 1.5rem;
    border-radius: 0.5rem;
    overflow-x: auto;
    margin: 1.5rem 0;
}

.article-content pre code {
    background: none;
    padding: 0;
}

.article-footer {
    border-top: 1px solid var(--border-color);
    padding-top: 2rem;
}

.article-tags {
    margin-bottom: 2rem;
}

.article-tags h4 {
    margin-bottom: 1rem;
    color: var(--text-primary);
}

.tags-list {
    display: flex;
    flex-wrap: wrap;
    gap: 0.5rem;
}

.tag-link {
    background: rgba(59, 130, 246, 0.1);
    color: var(--accent-blue);
    padding: 0.25rem 0.75rem;
    border-radius: 1rem;
    text-decoration: none;
    font-size: 0.875rem;
    transition: all 0.3s ease;
}

.tag-link:hover {
    background: var(--accent-blue);
    color: white;
}

.article-author {
    display: flex;
    gap: 1rem;
    padding: 1.5rem;
    background: rgba(30, 41, 59, 0.3);
    border-radius: 1rem;
    margin-bottom: 2rem;
}

.author-avatar img {
    border-radius: 50%;
}

.author-name {
    margin-bottom: 0.5rem;
    color: var(--text-primary);
}

.author-bio {
    color: var(--text-secondary);
    margin-bottom: 1rem;
}

.author-links {
    display: flex;
    gap: 1rem;
}

.author-links a {
    color: var(--accent-blue);
    text-decoration: none;
    font-size: 0.875rem;
    transition: color 0.3s ease;
}

.author-links a:hover {
    color: var(--accent-purple);
}

.article-navigation {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 2rem;
    margin-bottom: 3rem;
}

.nav-link {
    display: block;
    padding: 1.5rem;
    background: rgba(30, 41, 59, 0.3);
    border: 1px solid var(--border-color);
    border-radius: 1rem;
    text-decoration: none;
    transition: all 0.3s ease;
}

.nav-link:hover {
    background: rgba(30, 41, 59, 0.5);
    border-color: var(--accent-blue);
    transform: translateY(-2px);
}

.nav-direction {
    display: block;
    font-size: 0.875rem;
    color: var(--text-muted);
    margin-bottom: 0.5rem;
}

.nav-title {
    display: block;
    color: var(--text-primary);
    font-weight: 500;
}

.nav-next {
    text-align: right;
}

.related-articles {
    margin-top: 3rem;
    padding-top: 3rem;
    border-top: 1px solid var(--border-color);
}

.related-articles h3 {
    text-align: center;
    margin-bottom: 2rem;
    color: var(--text-primary);
}

.related-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 2rem;
}

.related-card {
    background: rgba(30, 41, 59, 0.3);
    border: 1px solid var(--border-color);
    border-radius: 1rem;
    overflow: hidden;
    transition: all 0.3s ease;
}

.related-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 20px 40px var(--shadow-color);
}

.related-image img {
    width: 100%;
    height: 150px;
    object-fit: cover;
}

.related-content {
    padding: 1.5rem;
}

.related-meta {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 1rem;
    font-size: 0.875rem;
}

.related-category {
    background: var(--accent-blue);
    color: white;
    padding: 0.25rem 0.5rem;
    border-radius: 0.5rem;
    font-size: 0.75rem;
}

.related-date {
    color: var(--text-muted);
}

.related-title {
    margin-bottom: 0.75rem;
}

.related-title a {
    color: var(--text-primary);
    text-decoration: none;
    transition: color 0.3s ease;
}

.related-title a:hover {
    color: var(--accent-blue);
}

.related-excerpt {
    color: var(--text-secondary);
    font-size: 0.9rem;
    line-height: 1.5;
}

@media (max-width: 768px) {
    .article-title {
        font-size: 2rem;
    }
    
    .article-meta {
        flex-direction: column;
        align-items: flex-start;
        gap: 1rem;
    }
    
    .article-navigation {
        grid-template-columns: 1fr;
    }
    
    .nav-next {
        text-align: left;
    }
    
    .article-author {
        flex-direction: column;
        text-align: center;
    }
    
    .related-grid {
        grid-template-columns: 1fr;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Copy link functionality
    document.querySelectorAll('.copy-link').forEach(function(button) {
        button.addEventListener('click', function() {
            const url = this.dataset.url;
            navigator.clipboard.writeText(url).then(function() {
                button.innerHTML = '<i class="fas fa-check"></i> コピーしました';
                setTimeout(function() {
                    button.innerHTML = '<i class="fas fa-link"></i> リンクをコピー';
                }, 2000);
            });
        });
    });
});
</script>

<?php
get_footer();

// Helper function for reading time
function manuheleku_reading_time() {
    $content = get_post_field('post_content', get_the_ID());
    $word_count = str_word_count(strip_tags($content));
    $reading_time = ceil($word_count / 200); // Assuming 200 words per minute
    return $reading_time;
}
?>

