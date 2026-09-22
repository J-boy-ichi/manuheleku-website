import { useEffect, useState } from 'react'
import {
  ArrowRight,
  Check,
  ChevronRight,
  FileText,
  Globe2,
  Mail,
  Menu,
  MessageSquareText,
  PenTool,
  Plane,
  SearchCheck,
  ShoppingBag,
  Sparkles,
  X,
} from 'lucide-react'
import { AnimatePresence, motion as Motion, useReducedMotion } from 'framer-motion'
import manuhelekuMain from './assets/manuheleku-main.webp'
import './App.css'

const services = [
  {
    number: '01',
    icon: PenTool,
    eyebrow: 'TECH WRITING',
    title: 'テックを、伝わる言葉に。',
    description:
      'AI・Web3・暗号資産など、複雑なテーマを一次情報から調査し、読み手が行動できる記事へ整えます。',
    deliverables: ['構成・執筆・校正', '公式情報の出典確認', 'SEO記事・オウンドメディア'],
    accent: 'blue',
  },
  {
    number: '02',
    icon: ShoppingBag,
    eyebrow: 'EC COPY',
    title: '商品の魅力を、買う理由に。',
    description:
      'スニーカー・アパレル・香水を中心に、ブランドの空気感と検索性を両立する商品説明を制作します。',
    deliverables: ['商品説明・タイトル', 'ブランドトーン設計', 'SNS投稿文への展開'],
    accent: 'violet',
  },
  {
    number: '03',
    icon: Plane,
    eyebrow: 'HAWAII PLANNING',
    title: 'ハワイ時間を、旅の前から。',
    description:
      '希望・予算・同行者に合わせ、移動時間や雨天案まで考えたオーダーメイド旅程を作成します。',
    deliverables: ['日別オリジナル旅程', '予算・予約リスト', '代替案と公式リンク'],
    accent: 'coral',
  },
]

const projects = [
  { code: 'WEB / 01', name: 'AI・ロボット系情報サイト', category: 'Webサイト制作・運用', tone: 'project-blue' },
  { code: 'WEB / 02', name: 'フリーランス支援サイト', category: 'Webサイト制作・改善', tone: 'project-purple' },
  { code: 'WEB / 03', name: '国際学会系サイト', category: '多言語サイト運用', tone: 'project-green' },
  { code: 'WEB / 04', name: '医療・研究系情報サイト', category: 'Webサイト制作・運用', tone: 'project-coral' },
  { code: 'WEB / 05', name: '医療系クリニックサイト', category: 'Webサイト運用・更新', tone: 'project-cyan' },
  { code: 'EC / 01', name: 'ハンドメイド系ECサイト', category: 'オンラインストア制作', tone: 'project-amber' },
]

const process = [
  { step: '01', icon: MessageSquareText, title: '聞く', description: '目的、届けたい相手、困っていることをオンラインで整理します。' },
  { step: '02', icon: SearchCheck, title: '調べる', description: '公式情報と競合を確認し、成果につながる切り口を設計します。' },
  { step: '03', icon: FileText, title: 'つくる', description: 'AIを制作補助に使い、人の目で検証・編集して仕上げます。' },
  { step: '04', icon: Check, title: '届ける', description: '確認と修正を経て納品。次の改善につながる形でお渡しします。' },
]

const marqueeItems = ['TECH WRITING', 'EC COPY', 'HAWAII PLANNING', 'WEB DESIGN', 'RESEARCH']

const reveal = {
  hidden: { opacity: 0, y: 42 },
  visible: { opacity: 1, y: 0 },
}

function App() {
  const [menuOpen, setMenuOpen] = useState(false)
  const reduceMotion = useReducedMotion()

  useEffect(() => {
    document.documentElement.classList.add('dark')
    const closeMenu = () => setMenuOpen(false)
    window.addEventListener('resize', closeMenu)
    return () => window.removeEventListener('resize', closeMenu)
  }, [])

  const motionProps = reduceMotion
    ? {}
    : {
        initial: 'hidden',
        whileInView: 'visible',
        viewport: { once: true, amount: 0.18 },
        variants: reveal,
        transition: { duration: 0.7, ease: [0.22, 1, 0.36, 1] },
      }

  const scrollTo = (id) => {
    setMenuOpen(false)
    document.getElementById(id)?.scrollIntoView({ behavior: reduceMotion ? 'auto' : 'smooth' })
  }

  return (
    <div className="site-shell">
      <a className="skip-link" href="#main">本文へ移動</a>

      <header className="site-header">
        <a className="brand" href="#top" aria-label="Manuheleku ホーム">
          <span className="brand-mark" aria-hidden="true">M</span>
          <span>manuheleku</span>
        </a>

        <nav className="desktop-nav" aria-label="メインナビゲーション">
          <button onClick={() => scrollTo('services')}>Services</button>
          <button onClick={() => scrollTo('works')}>Works</button>
          <button onClick={() => scrollTo('process')}>Process</button>
          <button className="nav-cta" onClick={() => scrollTo('contact')}>
            Talk to us <ArrowRight size={15} />
          </button>
        </nav>

        <button
          className="menu-button"
          type="button"
          aria-label={menuOpen ? 'メニューを閉じる' : 'メニューを開く'}
          aria-expanded={menuOpen}
          onClick={() => setMenuOpen((open) => !open)}
        >
          {menuOpen ? <X /> : <Menu />}
        </button>

        <AnimatePresence>
          {menuOpen && (
            <Motion.nav
              className="mobile-nav"
              aria-label="モバイルナビゲーション"
              initial={{ opacity: 0, height: 0 }}
              animate={{ opacity: 1, height: 'auto' }}
              exit={{ opacity: 0, height: 0 }}
            >
              <button onClick={() => scrollTo('services')}>Services</button>
              <button onClick={() => scrollTo('works')}>Works</button>
              <button onClick={() => scrollTo('process')}>Process</button>
              <button onClick={() => scrollTo('contact')}>Contact</button>
            </Motion.nav>
          )}
        </AnimatePresence>
      </header>

      <main id="main">
        <section className="hero" id="top">
          <div className="hero-grid" aria-hidden="true" />
          <div className="aurora aurora-one" aria-hidden="true" />
          <div className="aurora aurora-two" aria-hidden="true" />

          <div className="hero-content">
            <Motion.div
              className="availability-pill"
              initial={reduceMotion ? undefined : { opacity: 0, y: 14 }}
              animate={reduceMotion ? undefined : { opacity: 1, y: 0 }}
              transition={{ duration: 0.6 }}
            >
              <span className="status-dot" /> New projects welcome
            </Motion.div>

            <Motion.h1
              initial={reduceMotion ? undefined : { opacity: 0, y: 48 }}
              animate={reduceMotion ? undefined : { opacity: 1, y: 0 }}
              transition={{ duration: 0.9, delay: 0.08, ease: [0.22, 1, 0.36, 1] }}
            >
              <span>好きと専門性を、</span>
              <span className="gradient-line">届く体験に。</span>
            </Motion.h1>

            <Motion.p
              className="hero-copy"
              initial={reduceMotion ? undefined : { opacity: 0, y: 28 }}
              animate={reduceMotion ? undefined : { opacity: 1, y: 0 }}
              transition={{ duration: 0.8, delay: 0.24 }}
            >
              テック、EC、ハワイ。リサーチとデザイン、言葉の力で、
              <br className="desktop-break" />
              あなたの「伝えたい」を選ばれる理由へ変えます。
            </Motion.p>

            <Motion.div
              className="hero-actions"
              initial={reduceMotion ? undefined : { opacity: 0, y: 22 }}
              animate={reduceMotion ? undefined : { opacity: 1, y: 0 }}
              transition={{ duration: 0.7, delay: 0.38 }}
            >
              <button className="primary-button" onClick={() => scrollTo('services')}>
                サービスを見る <ArrowRight size={18} />
              </button>
              <button className="text-button" onClick={() => scrollTo('works')}>
                制作実績 <ChevronRight size={17} />
              </button>
            </Motion.div>
          </div>

          <Motion.div
            className="hero-visual"
            initial={reduceMotion ? undefined : { opacity: 0, scale: 0.9, rotate: 2 }}
            animate={reduceMotion ? undefined : { opacity: 1, scale: 1, rotate: 0 }}
            transition={{ duration: 1, delay: 0.25, ease: [0.22, 1, 0.36, 1] }}
          >
            <div className="visual-ring ring-one" />
            <div className="visual-ring ring-two" />
            <div className="visual-card">
              <img src={manuhelekuMain} alt="ラップトップを操作するManuhelekuのペンギン" />
              <div className="visual-overlay" />
              <div className="visual-label"><Sparkles size={15} /> Human ideas, amplified.</div>
            </div>
            <Motion.div
              className="floating-chip chip-top"
              animate={reduceMotion ? undefined : { y: [0, -10, 0] }}
              transition={{ duration: 4, repeat: Infinity, ease: 'easeInOut' }}
            >
              <Globe2 size={17} /> Global perspective
            </Motion.div>
            <Motion.div
              className="floating-chip chip-bottom"
              animate={reduceMotion ? undefined : { y: [0, 10, 0] }}
              transition={{ duration: 4.6, repeat: Infinity, ease: 'easeInOut' }}
            >
              <Sparkles size={17} /> Crafted with AI
            </Motion.div>
          </Motion.div>
        </section>

        <div className="marquee" aria-label="提供分野">
          <div className="marquee-track">
            {[...marqueeItems, ...marqueeItems].map((item, index) => (
              <span key={`${item}-${index}`}>{item} <Sparkles size={14} /></span>
            ))}
          </div>
        </div>

        <section className="section services-section" id="services">
          <Motion.div className="section-heading" {...motionProps}>
            <div>
              <p className="section-kicker">SERVICES / 03</p>
              <h2>最初に育てる、<br />3つの仕事。</h2>
            </div>
            <p>得意分野を広げすぎず、価値を出せる3領域に集中。必要な部分だけ、小さく試すご相談も歓迎します。</p>
          </Motion.div>

          <div className="service-list">
            {services.map((service, index) => {
              const Icon = service.icon
              return (
                <Motion.article
                  className={`service-card service-${service.accent}`}
                  key={service.title}
                  {...motionProps}
                  transition={{ ...motionProps.transition, delay: index * 0.1 }}
                  whileHover={reduceMotion ? undefined : { y: -8 }}
                >
                  <div className="service-glow" aria-hidden="true" />
                  <div className="service-topline"><span>{service.number}</span><Icon size={24} /></div>
                  <p className="service-eyebrow">{service.eyebrow}</p>
                  <h3>{service.title}</h3>
                  <p className="service-description">{service.description}</p>
                  <ul>
                    {service.deliverables.map((item) => <li key={item}><Check size={15} /> {item}</li>)}
                  </ul>
                  <button className="service-link" onClick={() => scrollTo('contact')}>相談する <ArrowRight size={16} /></button>
                </Motion.article>
              )
            })}
          </div>
        </section>

        <section className="section works-section" id="works">
          <Motion.div className="section-heading works-heading" {...motionProps}>
            <div>
              <p className="section-kicker">SELECTED WORKS</p>
              <h2>これまでの<br />プロジェクト。</h2>
            </div>
            <p>サイト制作・更新・運用を通じて、情報がきちんと届く体験を支援してきました。</p>
          </Motion.div>

          <div className="project-grid">
            {projects.map((project, index) => (
              <Motion.article
                className={`project-card ${project.tone}`}
                key={project.name}
                {...motionProps}
                transition={{ ...motionProps.transition, delay: (index % 3) * 0.08 }}
              >
                <div className="project-noise" aria-hidden="true" />
                <div className="project-meta"><span>{project.code}</span><span>CASE STUDY</span></div>
                <div className="project-orbit" aria-hidden="true"><span /></div>
                <div><p>{project.category}</p><h3>{project.name}</h3></div>
              </Motion.article>
            ))}
          </div>
        </section>

        <section className="section process-section" id="process">
          <Motion.div className="section-heading" {...motionProps}>
            <div>
              <p className="section-kicker">HOW WE WORK</p>
              <h2>速く、丁寧に、<br />曖昧さを減らす。</h2>
            </div>
            <p>生成AIは速さのために。調査・判断・最終品質は人の手で。シンプルな4ステップで進めます。</p>
          </Motion.div>

          <div className="process-grid">
            {process.map((item, index) => {
              const Icon = item.icon
              return (
                <Motion.article
                  className="process-item"
                  key={item.step}
                  {...motionProps}
                  transition={{ ...motionProps.transition, delay: index * 0.08 }}
                >
                  <div className="process-icon"><Icon size={22} /></div>
                  <span>{item.step}</span>
                  <h3>{item.title}</h3>
                  <p>{item.description}</p>
                </Motion.article>
              )
            })}
          </div>
        </section>

        <section className="contact-section" id="contact">
          <div className="contact-orb contact-orb-one" aria-hidden="true" />
          <div className="contact-orb contact-orb-two" aria-hidden="true" />
          <Motion.div className="contact-inner" {...motionProps}>
            <p className="section-kicker">START A PROJECT</p>
            <h2>話すところから、<br />始めましょう。</h2>
            <p className="contact-copy">まだ内容が固まっていなくても大丈夫です。やりたいことと現在地を、メールでお聞かせください。</p>
            <a className="contact-button" href="mailto:info@manuheleku.com?subject=Manuhelekuへのご相談">
              <Mail size={19} /> info@manuheleku.com <ArrowRight size={18} />
            </a>
            <p className="contact-note">内容を確認のうえ、メールで返信します。</p>
          </Motion.div>
        </section>
      </main>

      <footer>
        <a className="brand footer-brand" href="#top">
          <span className="brand-mark" aria-hidden="true">M</span>
          <span>manuheleku</span>
        </a>
        <p>Tech writing, EC copy &amp; Hawaii planning.</p>
        <p>© 2026 Manuheleku</p>
      </footer>
    </div>
  )
}

export default App
