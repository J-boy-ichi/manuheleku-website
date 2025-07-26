<?php
/**
 * Template part for displaying contact form
 * Manuheleku WordPress Theme
 */
?>

<div class="contact-form">
    <?php
    // Display contact form messages
    if (isset($_GET['contact'])) {
        if ($_GET['contact'] === 'success') {
            echo '<div class="contact-message success">
                    <i class="fas fa-check-circle"></i>
                    <p>お問い合わせありがとうございます。24時間以内にご返信いたします。</p>
                  </div>';
        } elseif ($_GET['contact'] === 'error') {
            echo '<div class="contact-message error">
                    <i class="fas fa-exclamation-circle"></i>
                    <p>送信中にエラーが発生しました。もう一度お試しください。</p>
                  </div>';
        }
    }
    ?>
    
    <form method="post" action="<?php echo esc_url(home_url('/')); ?>" class="contact-form-inner">
        <?php wp_nonce_field('contact_form_nonce', 'contact_nonce'); ?>
        
        <div class="form-row">
            <div class="form-group">
                <label for="contact_name" class="form-label">お名前 <span class="required">*</span></label>
                <input type="text" id="contact_name" name="contact_name" class="form-input" required>
            </div>
            
            <div class="form-group">
                <label for="contact_email" class="form-label">メールアドレス <span class="required">*</span></label>
                <input type="email" id="contact_email" name="contact_email" class="form-input" required>
            </div>
        </div>
        
        <div class="form-group">
            <label for="contact_subject" class="form-label">件名</label>
            <select id="contact_subject" name="contact_subject" class="form-input">
                <option value="一般的なお問い合わせ">一般的なお問い合わせ</option>
                <option value="Webサイト制作について">Webサイト制作について</option>
                <option value="ECサイト制作について">ECサイト制作について</option>
                <option value="AI技術について">AI技術について</option>
                <option value="お見積もり依頼">お見積もり依頼</option>
                <option value="サポートについて">サポートについて</option>
                <option value="その他">その他</option>
            </select>
        </div>
        
        <div class="form-group">
            <label for="contact_message" class="form-label">メッセージ <span class="required">*</span></label>
            <textarea id="contact_message" name="contact_message" class="form-textarea" rows="6" placeholder="プロジェクトの詳細、ご要望、ご質問などをお聞かせください。" required></textarea>
        </div>
        
        <div class="form-group">
            <label class="checkbox-label">
                <input type="checkbox" name="contact_privacy" required>
                <span class="checkmark"></span>
                <a href="<?php echo esc_url(home_url('/privacy-policy/')); ?>" target="_blank">プライバシーポリシー</a>に同意します <span class="required">*</span>
            </label>
        </div>
        
        <div class="form-group">
            <label class="checkbox-label">
                <input type="checkbox" name="contact_newsletter">
                <span class="checkmark"></span>
                AI最先端情報のニュースレターを受け取る
            </label>
        </div>
        
        <div class="form-group">
            <button type="submit" name="contact_form_submit" class="btn btn-primary btn-full">
                <i class="fas fa-paper-plane"></i>
                メッセージを送信
            </button>
        </div>
        
        <div class="form-note">
            <p><small><span class="required">*</span> 必須項目</small></p>
            <p><small>通常24時間以内にご返信いたします。お急ぎの場合は、お電話でお問い合わせください。</small></p>
        </div>
    </form>
</div>

<style>
.contact-form {
    background: rgba(30, 41, 59, 0.5);
    border: 1px solid var(--border-color);
    border-radius: 1rem;
    padding: 2rem;
    backdrop-filter: blur(10px);
}

.contact-message {
    padding: 1rem;
    border-radius: 0.5rem;
    margin-bottom: 1.5rem;
    display: flex;
    align-items: center;
    gap: 0.75rem;
}

.contact-message.success {
    background: rgba(16, 185, 129, 0.1);
    border: 1px solid rgba(16, 185, 129, 0.3);
    color: #10b981;
}

.contact-message.error {
    background: rgba(239, 68, 68, 0.1);
    border: 1px solid rgba(239, 68, 68, 0.3);
    color: #ef4444;
}

.contact-message p {
    margin: 0;
}

.form-row {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 1rem;
}

.form-group {
    margin-bottom: 1.5rem;
}

.form-label {
    display: block;
    margin-bottom: 0.5rem;
    color: var(--text-primary);
    font-weight: 500;
}

.required {
    color: #ef4444;
}

.form-input,
.form-textarea {
    width: 100%;
    padding: 0.75rem 1rem;
    background: rgba(15, 23, 42, 0.8);
    border: 1px solid var(--border-color);
    border-radius: 0.5rem;
    color: var(--text-primary);
    font-size: 1rem;
    transition: all 0.3s ease;
}

.form-input:focus,
.form-textarea:focus {
    outline: none;
    border-color: var(--accent-blue);
    box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
    background: rgba(15, 23, 42, 0.9);
}

.form-textarea {
    resize: vertical;
    min-height: 120px;
    font-family: inherit;
}

.checkbox-label {
    display: flex;
    align-items: flex-start;
    gap: 0.75rem;
    cursor: pointer;
    color: var(--text-secondary);
    line-height: 1.5;
}

.checkbox-label input[type="checkbox"] {
    display: none;
}

.checkmark {
    width: 20px;
    height: 20px;
    background: rgba(15, 23, 42, 0.8);
    border: 1px solid var(--border-color);
    border-radius: 0.25rem;
    position: relative;
    flex-shrink: 0;
    transition: all 0.3s ease;
}

.checkbox-label input[type="checkbox"]:checked + .checkmark {
    background: var(--accent-blue);
    border-color: var(--accent-blue);
}

.checkbox-label input[type="checkbox"]:checked + .checkmark::after {
    content: "✓";
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    color: white;
    font-size: 0.875rem;
    font-weight: bold;
}

.btn-full {
    width: 100%;
    justify-content: center;
    gap: 0.5rem;
    padding: 1rem 2rem;
    font-size: 1.1rem;
}

.form-note {
    margin-top: 1rem;
    padding-top: 1rem;
    border-top: 1px solid var(--border-color);
}

.form-note p {
    margin: 0.25rem 0;
    color: var(--text-muted);
}

@media (max-width: 768px) {
    .contact-form {
        padding: 1.5rem;
    }
    
    .form-row {
        grid-template-columns: 1fr;
    }
    
    .checkbox-label {
        font-size: 0.9rem;
    }
}

/* Loading state for form submission */
.contact-form-inner.loading {
    opacity: 0.7;
    pointer-events: none;
}

.contact-form-inner.loading .btn {
    position: relative;
}

.contact-form-inner.loading .btn::after {
    content: "";
    position: absolute;
    width: 20px;
    height: 20px;
    border: 2px solid transparent;
    border-top: 2px solid white;
    border-radius: 50%;
    animation: spin 1s linear infinite;
    margin-left: 0.5rem;
}

@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const contactForm = document.querySelector('.contact-form-inner');
    
    if (contactForm) {
        contactForm.addEventListener('submit', function(e) {
            // Add loading state
            this.classList.add('loading');
            
            // Basic client-side validation
            const name = document.getElementById('contact_name').value.trim();
            const email = document.getElementById('contact_email').value.trim();
            const message = document.getElementById('contact_message').value.trim();
            const privacy = document.querySelector('input[name="contact_privacy"]').checked;
            
            if (!name || !email || !message || !privacy) {
                e.preventDefault();
                this.classList.remove('loading');
                alert('必須項目をすべて入力してください。');
                return false;
            }
            
            // Email validation
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailRegex.test(email)) {
                e.preventDefault();
                this.classList.remove('loading');
                alert('有効なメールアドレスを入力してください。');
                return false;
            }
        });
    }
    
    // Auto-hide success/error messages after 5 seconds
    const contactMessage = document.querySelector('.contact-message');
    if (contactMessage) {
        setTimeout(function() {
            contactMessage.style.opacity = '0';
            setTimeout(function() {
                contactMessage.style.display = 'none';
            }, 300);
        }, 5000);
    }
});
</script>

