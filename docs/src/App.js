import { useState, useEffect } from 'react'
import { Button } from '@/components/ui/button.js'
import { Card, CardContent, CardDescription, CardHeader, CardTitle } from '@/components/ui/card.js'
import { Input } from '@/components/ui/input.js'
import { Textarea } from '@/components/ui/textarea.js'
import { Badge } from '@/components/ui/badge.js'
import { 
  Globe, 
  ShoppingCart, 
  Smartphone, 
  Zap, 
  Search, 
  Filter,
  Mail,
  Phone,
  MapPin,
  Clock,
  Star,
  Users,
  Award,
  Headphones,
  ChevronRight,
  Menu,
  X,
  Rocket,
  ShieldCheck,
  BarChart3,
  Sparkles,
  Lightbulb,
  Layers,
  Cpu,
  TrendingUp,
  BookOpen,
  Calendar,
  MessageCircle,
  CheckCircle
} from 'lucide-react'
import { motion, AnimatePresence } from 'framer-motion'
import manuhelekuMain from './assets/manuheleku-main.png'
import './App.css'

function App() {
  const [currentPage, setCurrentPage] = useState('home')
  const [searchTerm, setSearchTerm] = useState('')
  const [selectedCategory, setSelectedCategory] = useState('all')
  const [isMenuOpen, setIsMenuOpen] = useState(false)

  // AI最先端情報の記事データ
  const aiArticles = [
    {
      id: 1,
      title: "ChatGPT-5の新機能",
      description: "マルチモーダル対応の革新的進化",
      category: "AIツール",
      tags: ["ChatGPT", "マルチモーダル", "AI"],
      featured: true
    },
    {
      id: 2,
      title: "Google Gemini Pro活用事例",
      description: "ビジネス現場での導入方法",
      category: "AIツール",
      tags: ["Google", "Gemini", "ビジネス"]
    },
    {
      id: 3,
      title: "AI自動化ツール2025年版",
      description: "注目の10選",
      category: "自動化",
      tags: ["自動化", "ツール", "2025"]
    },
    {
      id: 4,
      title: "機械学習最適化テクニック",
      description: "パフォーマンス向上の秘訣",
      category: "機械学習",
      tags: ["機械学習", "最適化", "パフォーマンス"]
    },
    {
      id: 5,
      title: "AIアートジェネレーター比較",
      description: "Midjourney v6 vs DALL-E 3",
      category: "AIツール",
      tags: ["AIアート", "Midjourney", "DALL-E"]
    },
    {
      id: 6,
      title: "自然言語処理の最新動向",
      description: "LLMの進化と実用化",
      category: "機械学習",
      tags: ["NLP", "LLM", "自然言語処理"]
    }
  ]

  const categories = ['all', '機械学習', '自動化', 'AIツール']

  const filteredArticles = aiArticles.filter(article => {
    const matchesSearch = article.title.toLowerCase().includes(searchTerm.toLowerCase()) ||
                         article.description.toLowerCase().includes(searchTerm.toLowerCase())
    const matchesCategory = selectedCategory === 'all' || article.category === selectedCategory
    return matchesSearch && matchesCategory
  })

  const services = [
    {
      icon: Globe,
      title: "Webサイト制作",
      description: "レスポンシブデザイン、SEO最適化、高速パフォーマンス、モダンUI/UX",
      features: ["レスポンシブデザイン", "SEO最適化", "高速パフォーマンス", "モダンUI/UX"]
    },
    {
      icon: ShoppingCart,
      title: "ECサイト制作",
      description: "決済システム統合、在庫管理、顧客管理、分析ダッシュボード",
      features: ["決済システム統合", "在庫管理", "顧客管理", "分析ダッシュボード"]
    },
    {
      icon: Smartphone,
      title: "モバイル最適化",
      description: "PWA対応、タッチ最適化、高速読み込み、オフライン対応",
      features: ["PWA対応", "タッチ最適化", "高速読み込み", "オフライン対応"]
    }
  ]

  const stats = [
    { icon: Award, label: "設立年", value: "2020年" },
    { icon: Users, label: "完了プロジェクト", value: "100+" },
    { icon: Star, label: "満足クライアント", value: "50+" },
    { icon: Headphones, label: "サポート体制", value: "24/7" }
  ]

  const valueProps = [
    {
      icon: Rocket,
      title: "高速なプロダクト投入",
      description: "アジャイル開発と自動化パイプラインでアイデアを迅速にローンチ"
    },
    {
      icon: ShieldCheck,
      title: "堅牢なセキュリティ",
      description: "設計段階からセキュリティを考慮し、信頼できるユーザー体験を提供"
    },
    {
      icon: BarChart3,
      title: "データドリブン改善",
      description: "計測設計と分析ダッシュボードで継続的にUXを最適化"
    },
    {
      icon: Sparkles,
      title: "モダンなUI演出",
      description: "海外SaaSトレンドを取り入れた洗練されたインタラクション"
    }
  ]

  const caseStudies = [
    {
      id: 'Web 01',
      title: "AI Robot Science",
      category: "Webサイト", 
      url: "https://ai-robot-science.com/",
      summary: "AI・ロボット分野の情報発信サイトを制作し、継続的な運用サポートを提供。",
      supports: [
        "サイト設計とデザイン制作",
        "WordPressテーマとプラグインの保守",
        "定期的なセキュリティ・バックアップ管理"
      ]
    },
    {
      id: 'Web 02',
      title: "freeas.jp",
      category: "Webサイト",
      url: "https://freeas.jp/",
      summary: "フリーランス支援サービスのコーポレートサイトを構築し、更新作業と改善提案を実施。",
      supports: [
        "コンテンツ更新とデザイン調整",
        "お問い合わせ導線の最適化",
        "運用レポートの定期共有"
      ]
    },
    {
      id: 'Web 03',
      title: "EAFONS",
      category: "Webサイト",
      url: "https://www.eafons.org/",
      summary: "国際看護学会の公式サイトを継続管理し、イベント情報の最新化をサポート。",
      supports: [
        "多言語ページの更新管理",
        "イベント・ニュースのタイムリーな掲載",
        "アクセス性向上のための軽微な機能追加"
      ]
    },
    {
      id: 'Web 04',
      title: "助産ケア・ナラティブ",
      category: "Webサイト",
      url: "https://midwifery-care-narrative.com/",
      summary: "助産ケアの情報サイトを管理し、読みやすさを重視した更新と運用を担当。",
      supports: [
        "記事・コンテンツ投入のサポート",
        "モバイル表示の最適化",
        "アクセス解析をもとにした改善提案"
      ]
    },
    {
      id: 'Web 05',
      title: "氷川台あおば眼科",
      category: "Webサイト",
      url: "https://hikawadai-eye.com/",
      summary: "クリニックの公式サイトを管理し、診療情報の更新と保守を継続。",
      supports: [
        "診療カレンダー・お知らせの更新",
        "表示速度とアクセシビリティの調整",
        "SSL証明書やサーバー保守のサポート"
      ]
    },
    {
      id: 'EC 01',
      title: "WOOD FIELD オンラインストア",
      category: "ECサイト",
      url: "https://woodfield.base.shop/",
      summary: "ハンドメイド雑貨のECサイトを制作し、商品登録や販促施策を支援。",
      supports: [
        "ショップデザインと商品カテゴリ設計",
        "配送・在庫設定のチューニング",
        "キャンペーン運用と更新代行"
      ]
    }
  ]

  const workflowSteps = [
    {
      icon: Lightbulb,
      title: "リサーチ & 戦略設計",
      description: "ビジネスゴールとユーザー課題を整理し、KPIとロードマップを策定"
    },
    {
      icon: Layers,
      title: "UX/UIプロトタイピング",
      description: "Figmaプロトタイプとユーザーテストで体験価値を検証"
    },
    {
      icon: Cpu,
      title: "開発 & アジャイル改善",
      description: "モダンスタックで実装し、スプリントごとにレビューと改善を実施"
    },
    {
      icon: CheckCircle,
      title: "リリース & グロース支援",
      description: "運用・計測体制を整備し、継続的な成長施策を伴走サポート"
    }
  ]

  const techStack = [
    {
      category: "Frontend",
      items: ["Next.js", "React", "Vite", "Tailwind CSS"]
    },
    {
      category: "Backend / Infra",
      items: ["Laravel", "Supabase", "Firebase", "PlanetScale"]
    },
    {
      category: "AI / Data",
      items: ["OpenAI", "LangChain", "Vertex AI", "BigQuery"]
    },
    {
      category: "Operations",
      items: ["Notion", "Linear", "Looker Studio", "Figma"]
    }
  ]

  const trendingTopics = [
    {
      title: "RAGパターン実装ベストプラクティス",
      description: "生成AI導入で避けられないガバナンスとログ設計のポイント",
      tags: ["RAG", "LangChain", "LLMOps"],
      icon: TrendingUp
    },
    {
      title: "国内企業のAIガイドラインまとめ",
      description: "金融・ヘルスケアでの運用規約とコンプライアンス対応",
      tags: ["セキュリティ", "ガバナンス"],
      icon: ShieldCheck
    },
    {
      title: "Edge AIデバイス最新カタログ",
      description: "製造DX・小売向けの省電力デバイスを比較",
      tags: ["IoT", "Edge", "ハードウェア"],
      icon: Cpu
    }
  ]

  const aiResources = [
    {
      title: "AIプロジェクト立ち上げチェックリスト",
      description: "ビジネス要件からPoC設計までを網羅したドキュメント",
      type: "テンプレート",
      icon: BookOpen
    },
    {
      title: "AIマーケティング施策30選",
      description: "顧客獲得・育成に効くAI活用アイデア集",
      type: "eBook",
      icon: Sparkles
    },
    {
      title: "毎月開催ウェビナー",
      description: "生成AI導入とUIデザインの成功事例を解説",
      type: "ウェビナー",
      icon: Calendar
    }
  ]

  const faqs = [
    {
      question: "相談前に準備しておく資料はありますか？",
      answer: "プロジェクトの背景、現状の課題、ターゲットユーザーや目標指標が分かる資料があるとスムーズです。フォーマットが無い場合はこちらでヒアリングシートをご用意します。"
    },
    {
      question: "小規模プロジェクトにも対応していますか？",
      answer: "はい。MVP開発や既存プロダクトの改善スプリントなど、期間や規模に合わせたプランをご提案しています。"
    },
    {
      question: "海外向けサービスのローカライズは可能ですか？",
      answer: "英語・日本語のバイリンガルUX設計や多言語対応CMS構築の実績があり、マーケティング面も含めて支援可能です。"
    }
  ]

  useEffect(() => {
    // ダークテーマを適用
    document.documentElement.classList.add('dark')
  }, [])

  const Navigation = () => (
    <nav className="fixed top-0 left-0 right-0 z-50 bg-background/80 backdrop-blur-md border-b border-border">
      <div className="container mx-auto px-4 py-4">
        <div className="flex items-center justify-between">
          <motion.div 
            className="text-2xl font-bold bg-gradient-to-r from-blue-400 to-purple-600 bg-clip-text text-transparent"
            whileHover={{ scale: 1.05 }}
          >
            Manuheleku
          </motion.div>
          
          {/* Desktop Navigation */}
          <div className="hidden md:flex items-center space-x-8">
            <button 
              onClick={() => setCurrentPage('home')}
              className={`transition-colors ${currentPage === 'home' ? 'text-primary' : 'text-muted-foreground hover:text-foreground'}`}
            >
              ホーム
            </button>
            <button 
              onClick={() => setCurrentPage('ai-news')}
              className={`transition-colors ${currentPage === 'ai-news' ? 'text-primary' : 'text-muted-foreground hover:text-foreground'}`}
            >
              AI最先端情報
            </button>
            <Button onClick={() => setCurrentPage('contact')} size="sm">
              お問い合わせ
            </Button>
          </div>

          {/* Mobile Menu Button */}
          <button 
            className="md:hidden"
            onClick={() => setIsMenuOpen(!isMenuOpen)}
          >
            {isMenuOpen ? <X /> : <Menu />}
          </button>
        </div>

        {/* Mobile Navigation */}
        <AnimatePresence>
          {isMenuOpen && (
            <motion.div
              initial={{ opacity: 0, height: 0 }}
              animate={{ opacity: 1, height: 'auto' }}
              exit={{ opacity: 0, height: 0 }}
              className="md:hidden mt-4 pb-4 border-t border-border pt-4"
            >
              <div className="flex flex-col space-y-4">
                <button 
                  onClick={() => { setCurrentPage('home'); setIsMenuOpen(false) }}
                  className={`text-left transition-colors ${currentPage === 'home' ? 'text-primary' : 'text-muted-foreground'}`}
                >
                  ホーム
                </button>
                <button 
                  onClick={() => { setCurrentPage('ai-news'); setIsMenuOpen(false) }}
                  className={`text-left transition-colors ${currentPage === 'ai-news' ? 'text-primary' : 'text-muted-foreground'}`}
                >
                  AI最先端情報
                </button>
                <Button onClick={() => { setCurrentPage('contact'); setIsMenuOpen(false) }} size="sm" className="w-fit">
                  お問い合わせ
                </Button>
              </div>
            </motion.div>
          )}
        </AnimatePresence>
      </div>
    </nav>
  )

  const HomePage = () => (
    <div className="min-h-screen">
      {/* Hero Section */}
      <section className="pt-24 pb-16 px-4">
        <div className="container mx-auto">
          <div className="grid lg:grid-cols-2 gap-12 items-center">
            <motion.div
              initial={{ opacity: 0, x: -50 }}
              animate={{ opacity: 1, x: 0 }}
              transition={{ duration: 0.8 }}
            >
              <h1 className="text-4xl md:text-6xl font-bold mb-6 bg-gradient-to-r from-blue-400 via-purple-500 to-green-400 bg-clip-text text-transparent">
                Manuheleku
              </h1>
              <p className="text-xl md:text-2xl text-muted-foreground mb-8">
                海外最先端アプリ風デザインで<br />
                あなたのビジネスを次のレベルへ
              </p>
              <div className="flex flex-col sm:flex-row gap-4">
                <Button size="lg" className="bg-gradient-to-r from-blue-500 to-purple-600 hover:from-blue-600 hover:to-purple-700">
                  サービスを見る
                  <ChevronRight className="ml-2 h-4 w-4" />
                </Button>
                <Button variant="outline" size="lg" onClick={() => setCurrentPage('ai-news')}>
                  AI最先端情報
                </Button>
              </div>
            </motion.div>
            
            <motion.div
              initial={{ opacity: 0, x: 50 }}
              animate={{ opacity: 1, x: 0 }}
              transition={{ duration: 0.8, delay: 0.2 }}
              className="relative"
            >
              <div className="relative rounded-2xl overflow-hidden bg-gradient-to-br from-blue-500/20 to-purple-600/20 p-8">
                <img 
                  src={manuhelekuMain} 
                  alt="Manuheleku - ペンギンがラップトップを使用している魅力的なメイン画像" 
                  className="w-full h-auto rounded-lg shadow-2xl"
                />
                <div className="absolute inset-0 bg-gradient-to-t from-background/20 to-transparent rounded-2xl"></div>
              </div>
            </motion.div>
          </div>
        </div>
      </section>

      {/* Value Proposition Section */}
      <section className="py-16 px-4 bg-card/20">
        <div className="container mx-auto">
          <motion.div
            initial={{ opacity: 0, y: 50 }}
            whileInView={{ opacity: 1, y: 0 }}
            transition={{ duration: 0.8 }}
            className="text-center mb-16"
          >
            <h2 className="text-3xl md:text-4xl font-bold mb-4">選ばれる理由</h2>
            <p className="text-xl text-muted-foreground">戦略から開発・グロースまで一気通貫で伴走します</p>
          </motion.div>

          <div className="grid md:grid-cols-2 xl:grid-cols-4 gap-6">
            {valueProps.map((item, index) => (
              <motion.div
                key={item.title}
                initial={{ opacity: 0, y: 30 }}
                whileInView={{ opacity: 1, y: 0 }}
                transition={{ duration: 0.6, delay: index * 0.1 }}
                whileHover={{ translateY: -6 }}
              >
                <Card className="h-full bg-card/60 backdrop-blur-sm border-border/40 hover:border-primary/50 transition-all duration-300">
                  <CardHeader>
                    <div className="w-12 h-12 rounded-full bg-gradient-to-br from-blue-500 to-purple-600 flex items-center justify-center mb-4">
                      <item.icon className="h-6 w-6 text-white" />
                    </div>
                    <CardTitle className="text-lg">{item.title}</CardTitle>
                    <CardDescription>{item.description}</CardDescription>
                  </CardHeader>
                </Card>
              </motion.div>
            ))}
          </div>
        </div>
      </section>

      {/* Services Section */}
      <section className="py-16 px-4">
        <div className="container mx-auto">
          <motion.div
            initial={{ opacity: 0, y: 50 }}
            whileInView={{ opacity: 1, y: 0 }}
            transition={{ duration: 0.8 }}
            className="text-center mb-16"
          >
            <h2 className="text-3xl md:text-4xl font-bold mb-4">サービス</h2>
            <p className="text-xl text-muted-foreground">最先端技術で、あなたのビジネスを加速させます</p>
          </motion.div>

          <div className="grid md:grid-cols-3 gap-8">
            {services.map((service, index) => (
              <motion.div
                key={index}
                initial={{ opacity: 0, y: 50 }}
                whileInView={{ opacity: 1, y: 0 }}
                transition={{ duration: 0.8, delay: index * 0.2 }}
                whileHover={{ scale: 1.05 }}
              >
                <Card className="h-full bg-card/50 backdrop-blur-sm border-border/50 hover:border-primary/50 transition-all duration-300">
                  <CardHeader>
                    <div className="w-12 h-12 rounded-lg bg-gradient-to-br from-blue-500 to-purple-600 flex items-center justify-center mb-4">
                      <service.icon className="h-6 w-6 text-white" />
                    </div>
                    <CardTitle className="text-xl">{service.title}</CardTitle>
                    <CardDescription>{service.description}</CardDescription>
                  </CardHeader>
                  <CardContent>
                    <ul className="space-y-2">
                      {service.features.map((feature, featureIndex) => (
                        <li key={featureIndex} className="flex items-center text-sm text-muted-foreground">
                          <Zap className="h-4 w-4 mr-2 text-green-400" />
                          {feature}
                        </li>
                      ))}
                    </ul>
                  </CardContent>
                </Card>
              </motion.div>
            ))}
          </div>
        </div>
      </section>

      {/* Case Studies Section */}
      <section className="py-16 px-4">
        <div className="container mx-auto">
          <motion.div
            initial={{ opacity: 0, y: 50 }}
            whileInView={{ opacity: 1, y: 0 }}
            transition={{ duration: 0.8 }}
            className="flex flex-col md:flex-row md:items-end md:justify-between gap-6 mb-12"
          >
            <div>
              <h2 className="text-3xl md:text-4xl font-bold mb-4">導入事例</h2>
              <p className="text-lg text-muted-foreground">多様な業界の課題をデジタル体験で解決しています</p>
            </div>
            <Button variant="outline" className="w-fit">
              すべての事例を見る
            </Button>
          </motion.div>

          <div className="grid md:grid-cols-2 xl:grid-cols-3 gap-8">
            {caseStudies.map((study, index) => (
              <motion.div
                key={study.id}
                initial={{ opacity: 0, y: 50 }}
                whileInView={{ opacity: 1, y: 0 }}
                transition={{ duration: 0.8, delay: index * 0.1 }}
              >
                <Card className="h-full bg-card/50 backdrop-blur-sm border-border/50 hover:border-primary/60 transition-all duration-300">
                  <CardHeader className="space-y-3">
                    <div className="flex items-center justify-between text-sm text-muted-foreground">
                      <span className="font-medium tracking-wide text-primary">{study.id}</span>
                      <Badge variant="secondary">{study.category}</Badge>
                    </div>
                    <CardTitle className="text-xl">{study.title}</CardTitle>
                    <CardDescription>{study.summary}</CardDescription>
                  </CardHeader>
                  <CardContent className="space-y-4">
                    <div className="flex items-center justify-between text-sm">
                      <span className="text-muted-foreground">運用サポート</span>
                      <a
                        href={study.url}
                        target="_blank"
                        rel="noreferrer"
                        className="inline-flex items-center text-primary hover:underline"
                      >
                        サイトを見る
                        <ChevronRight className="ml-1 h-3 w-3" />
                      </a>
                    </div>
                    <ul className="space-y-2 text-sm text-muted-foreground">
                      {study.supports.map((support) => (
                        <li key={support} className="flex items-start gap-2">
                          <CheckCircle className="h-4 w-4 text-green-400 mt-1" />
                          <span>{support}</span>
                        </li>
                      ))}
                    </ul>
                  </CardContent>
                </Card>
              </motion.div>
            ))}
          </div>
        </div>
      </section>

      {/* Stats Section */}
      <section className="py-16 px-4 bg-card/20">
        <div className="container mx-auto">
          <div className="grid grid-cols-2 md:grid-cols-4 gap-8">
            {stats.map((stat, index) => (
              <motion.div
                key={index}
                initial={{ opacity: 0, scale: 0.8 }}
                whileInView={{ opacity: 1, scale: 1 }}
                transition={{ duration: 0.8, delay: index * 0.1 }}
                className="text-center"
              >
                <div className="w-16 h-16 rounded-full bg-gradient-to-br from-blue-500 to-purple-600 flex items-center justify-center mx-auto mb-4">
                  <stat.icon className="h-8 w-8 text-white" />
                </div>
                <div className="text-2xl font-bold text-primary mb-2">{stat.value}</div>
                <div className="text-sm text-muted-foreground">{stat.label}</div>
              </motion.div>
            ))}
          </div>
        </div>
      </section>

      {/* Workflow Section */}
      <section className="py-16 px-4">
        <div className="container mx-auto">
          <motion.div
            initial={{ opacity: 0, y: 50 }}
            whileInView={{ opacity: 1, y: 0 }}
            transition={{ duration: 0.8 }}
            className="text-center mb-16"
          >
            <h2 className="text-3xl md:text-4xl font-bold mb-4">プロジェクト進行フロー</h2>
            <p className="text-xl text-muted-foreground">透明性の高いプロセスで確実に成果へ導きます</p>
          </motion.div>

          <div className="grid md:grid-cols-2 xl:grid-cols-4 gap-6">
            {workflowSteps.map((step, index) => (
              <motion.div
                key={step.title}
                initial={{ opacity: 0, y: 40 }}
                whileInView={{ opacity: 1, y: 0 }}
                transition={{ duration: 0.7, delay: index * 0.1 }}
              >
                <Card className="h-full bg-card/50 backdrop-blur-sm border-border/40">
                  <CardHeader>
                    <div className="flex items-center justify-between mb-4">
                      <div className="w-12 h-12 rounded-full bg-gradient-to-br from-blue-500 to-purple-600 flex items-center justify-center">
                        <step.icon className="h-6 w-6 text-white" />
                      </div>
                      <span className="text-sm font-semibold text-muted-foreground">STEP {index + 1}</span>
                    </div>
                    <CardTitle className="text-lg">{step.title}</CardTitle>
                    <CardDescription>{step.description}</CardDescription>
                  </CardHeader>
                </Card>
              </motion.div>
            ))}
          </div>
        </div>
      </section>

      {/* Tech Stack Section */}
      <section className="py-16 px-4">
        <div className="container mx-auto">
          <motion.div
            initial={{ opacity: 0, y: 50 }}
            whileInView={{ opacity: 1, y: 0 }}
            transition={{ duration: 0.8 }}
            className="text-center mb-16"
          >
            <h2 className="text-3xl md:text-4xl font-bold mb-4">対応テクノロジー</h2>
            <p className="text-xl text-muted-foreground">信頼性と拡張性を両立するモダンスタックを採用</p>
          </motion.div>

          <div className="grid md:grid-cols-2 xl:grid-cols-4 gap-6">
            {techStack.map((stack, index) => (
              <motion.div
                key={stack.category}
                initial={{ opacity: 0, y: 40 }}
                whileInView={{ opacity: 1, y: 0 }}
                transition={{ duration: 0.7, delay: index * 0.1 }}
              >
                <Card className="h-full bg-card/50 backdrop-blur-sm border-border/40">
                  <CardHeader>
                    <CardTitle className="text-lg">{stack.category}</CardTitle>
                  </CardHeader>
                  <CardContent>
                    <ul className="space-y-2 text-sm text-muted-foreground">
                      {stack.items.map((item) => (
                        <li key={item} className="flex items-center gap-2">
                          <Sparkles className="h-4 w-4 text-primary" />
                          {item}
                        </li>
                      ))}
                    </ul>
                  </CardContent>
                </Card>
              </motion.div>
            ))}
          </div>
        </div>
      </section>

      {/* CTA Section */}
      <section className="py-16 px-4 bg-card/20">
        <div className="container mx-auto">
          <motion.div
            initial={{ opacity: 0, y: 40 }}
            whileInView={{ opacity: 1, y: 0 }}
            transition={{ duration: 0.8 }}
            className="max-w-4xl mx-auto"
          >
            <Card className="bg-gradient-to-br from-blue-500/20 via-purple-600/20 to-green-500/20 border border-primary/40">
              <CardHeader className="text-center space-y-4">
                <h3 className="text-3xl font-bold">AI×デザイン相談セッション</h3>
                <CardDescription className="text-base text-foreground/80">
                  プロダクトの現状をヒアリングし、改善ポイントとロードマップを45分で提案します。
                </CardDescription>
              </CardHeader>
              <CardContent>
                <div className="flex flex-col md:flex-row gap-4 md:items-center">
                  <Input placeholder="メールアドレスを入力" type="email" className="flex-1" />
                  <Button size="lg" className="bg-gradient-to-r from-blue-500 to-purple-600 hover:from-blue-600 hover:to-purple-700">
                    無料相談を申し込む
                  </Button>
                </div>
                <p className="text-xs text-muted-foreground mt-4 text-center md:text-left">
                  スパムは送信しません。相談前チェックリストも合わせてお送りします。
                </p>
              </CardContent>
            </Card>
          </motion.div>
        </div>
      </section>

      {/* Contact Section */}
      <section className="py-16 px-4">
        <div className="container mx-auto">
          <motion.div
            initial={{ opacity: 0, y: 50 }}
            whileInView={{ opacity: 1, y: 0 }}
            transition={{ duration: 0.8 }}
            className="text-center mb-16"
          >
            <h2 className="text-3xl md:text-4xl font-bold mb-4">お問い合わせ</h2>
            <p className="text-xl text-muted-foreground">プロジェクトについてお気軽にご相談ください</p>
          </motion.div>

          <div className="grid lg:grid-cols-2 gap-12">
            <motion.div
              initial={{ opacity: 0, x: -50 }}
              whileInView={{ opacity: 1, x: 0 }}
              transition={{ duration: 0.8 }}
            >
              <Card className="bg-card/50 backdrop-blur-sm border-border/50">
                <CardHeader>
                  <CardTitle>連絡先情報</CardTitle>
                </CardHeader>
                <CardContent className="space-y-6">
                  <div className="flex items-center space-x-4">
                    <Mail className="h-5 w-5 text-primary" />
                    <span>info@manuheleku.com</span>
                  </div>
                  <div className="flex items-center space-x-4">
                    <Phone className="h-5 w-5 text-primary" />
                    <span>+81-3-1234-5678</span>
                  </div>
                  <div className="flex items-center space-x-4">
                    <MapPin className="h-5 w-5 text-primary" />
                    <span>東京都渋谷区</span>
                  </div>
                  <div className="flex items-center space-x-4">
                    <Clock className="h-5 w-5 text-primary" />
                    <span>平日 9:00-18:00</span>
                  </div>
                </CardContent>
              </Card>
            </motion.div>

            <motion.div
              initial={{ opacity: 0, x: 50 }}
              whileInView={{ opacity: 1, x: 0 }}
              transition={{ duration: 0.8 }}
            >
              <Card className="bg-card/50 backdrop-blur-sm border-border/50">
                <CardHeader>
                  <CardTitle>お問い合わせフォーム</CardTitle>
                </CardHeader>
                <CardContent className="space-y-4">
                  <Input placeholder="お名前" />
                  <Input placeholder="メールアドレス" type="email" />
                  <Input placeholder="件名" />
                  <Textarea placeholder="メッセージ" rows={4} />
                  <Button className="w-full bg-gradient-to-r from-blue-500 to-purple-600 hover:from-blue-600 hover:to-purple-700">
                    送信する
                  </Button>
                </CardContent>
              </Card>
            </motion.div>
          </div>
        </div>
      </section>
    </div>
  )

  const AINewsPage = () => (
    <div className="min-h-screen pt-24 pb-16 px-4">
      <div className="container mx-auto">
        <motion.div
          initial={{ opacity: 0, y: 50 }}
          animate={{ opacity: 1, y: 0 }}
          transition={{ duration: 0.8 }}
          className="text-center mb-16"
        >
          <h1 className="text-4xl md:text-5xl font-bold mb-4 bg-gradient-to-r from-blue-400 to-purple-600 bg-clip-text text-transparent">
            AI最先端情報
          </h1>
          <p className="text-xl text-muted-foreground">最新のAI技術とトレンドをお届けします</p>
        </motion.div>

        {/* Trending Topics */}
        <div className="mb-12">
          <motion.div
            initial={{ opacity: 0, y: 40 }}
            whileInView={{ opacity: 1, y: 0 }}
            transition={{ duration: 0.8 }}
            className="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6"
          >
            <h2 className="text-2xl font-bold">注目トピック</h2>
            <p className="text-sm text-muted-foreground">AI戦略に取り入れたいホットテーマを厳選</p>
          </motion.div>

          <div className="grid md:grid-cols-3 gap-6">
            {trendingTopics.map((topic, index) => (
              <motion.div
                key={topic.title}
                initial={{ opacity: 0, y: 30 }}
                whileInView={{ opacity: 1, y: 0 }}
                transition={{ duration: 0.7, delay: index * 0.1 }}
              >
                <Card className="h-full bg-card/60 backdrop-blur-sm border-border/50 hover:border-primary/60 transition-all duration-300">
                  <CardHeader>
                    <div className="flex items-center gap-3 mb-4">
                      <div className="w-10 h-10 rounded-full bg-gradient-to-br from-blue-500 to-purple-600 flex items-center justify-center">
                        <topic.icon className="h-5 w-5 text-white" />
                      </div>
                      <CardTitle className="text-lg">{topic.title}</CardTitle>
                    </div>
                    <CardDescription>{topic.description}</CardDescription>
                  </CardHeader>
                  <CardContent>
                    <div className="flex flex-wrap gap-2">
                      {topic.tags.map((tag) => (
                        <Badge key={tag} variant="outline" className="text-xs">
                          #{tag}
                        </Badge>
                      ))}
                    </div>
                  </CardContent>
                </Card>
              </motion.div>
            ))}
          </div>
        </div>

        {/* Search and Filter */}
        <div className="mb-12">
          <div className="flex flex-col md:flex-row gap-4 mb-6">
            <div className="relative flex-1">
              <Search className="absolute left-3 top-1/2 transform -translate-y-1/2 h-4 w-4 text-muted-foreground" />
              <Input
                placeholder="記事を検索..."
                value={searchTerm}
                onChange={(e) => setSearchTerm(e.target.value)}
                className="pl-10"
              />
            </div>
            <div className="flex items-center space-x-2">
              <Filter className="h-4 w-4 text-muted-foreground" />
              <div className="flex flex-wrap gap-2">
                {categories.map((category) => (
                  <Button
                    key={category}
                    variant={selectedCategory === category ? "default" : "outline"}
                    size="sm"
                    onClick={() => setSelectedCategory(category)}
                  >
                    {category === 'all' ? 'すべて' : category}
                  </Button>
                ))}
              </div>
            </div>
          </div>
        </div>

        {/* Featured Articles */}
        <div className="mb-12">
          <h2 className="text-2xl font-bold mb-6">注目記事</h2>
          <div className="grid md:grid-cols-2 gap-6">
            {filteredArticles.filter(article => article.featured).map((article) => (
              <motion.div
                key={article.id}
                initial={{ opacity: 0, scale: 0.9 }}
                whileInView={{ opacity: 1, scale: 1 }}
                transition={{ duration: 0.8 }}
                whileHover={{ scale: 1.02 }}
              >
                <Card className="h-full bg-gradient-to-br from-blue-500/10 to-purple-600/10 border-primary/20 hover:border-primary/40 transition-all duration-300">
                  <CardHeader>
                    <div className="flex items-center justify-between mb-2">
                      <Badge variant="secondary">{article.category}</Badge>
                      <Badge variant="outline">注目</Badge>
                    </div>
                    <CardTitle className="text-xl">{article.title}</CardTitle>
                    <CardDescription>{article.description}</CardDescription>
                  </CardHeader>
                  <CardContent>
                    <div className="flex flex-wrap gap-2">
                      {article.tags.map((tag, tagIndex) => (
                        <Badge key={tagIndex} variant="outline" className="text-xs">
                          {tag}
                        </Badge>
                      ))}
                    </div>
                  </CardContent>
                </Card>
              </motion.div>
            ))}
          </div>
        </div>

        {/* All Articles */}
        <div>
          <h2 className="text-2xl font-bold mb-6">すべての記事</h2>
          <div className="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
            {filteredArticles.map((article, index) => (
              <motion.div
                key={article.id}
                initial={{ opacity: 0, y: 50 }}
                whileInView={{ opacity: 1, y: 0 }}
                transition={{ duration: 0.8, delay: index * 0.1 }}
                whileHover={{ scale: 1.02 }}
              >
                <Card className="h-full bg-card/50 backdrop-blur-sm border-border/50 hover:border-primary/50 transition-all duration-300">
                  <CardHeader>
                    <div className="flex items-center justify-between mb-2">
                      <Badge variant="secondary">{article.category}</Badge>
                      {article.featured && <Badge variant="outline">注目</Badge>}
                    </div>
                    <CardTitle className="text-lg">{article.title}</CardTitle>
                    <CardDescription>{article.description}</CardDescription>
                  </CardHeader>
                  <CardContent>
                    <div className="flex flex-wrap gap-2">
                      {article.tags.map((tag, tagIndex) => (
                        <Badge key={tagIndex} variant="outline" className="text-xs">
                          {tag}
                        </Badge>
                      ))}
                    </div>
                  </CardContent>
                </Card>
              </motion.div>
            ))}
          </div>
        </div>

        {filteredArticles.length === 0 && (
          <div className="text-center py-12">
            <p className="text-muted-foreground">検索条件に一致する記事が見つかりませんでした。</p>
          </div>
        )}

        {/* Resources */}
        <div className="mt-16">
          <motion.div
            initial={{ opacity: 0, y: 40 }}
            whileInView={{ opacity: 1, y: 0 }}
            transition={{ duration: 0.8 }}
            className="text-center mb-12"
          >
            <h2 className="text-3xl font-bold mb-4">リソース &amp; イベント</h2>
            <p className="text-lg text-muted-foreground">実務に役立つテンプレートやウェビナーを定期配信</p>
          </motion.div>

          <div className="grid md:grid-cols-3 gap-6">
            {aiResources.map((resource, index) => (
              <motion.div
                key={resource.title}
                initial={{ opacity: 0, y: 30 }}
                whileInView={{ opacity: 1, y: 0 }}
                transition={{ duration: 0.7, delay: index * 0.1 }}
              >
                <Card className="h-full bg-card/50 backdrop-blur-sm border-border/50 hover:border-primary/50 transition-all duration-300">
                  <CardHeader>
                    <div className="flex items-center gap-3 mb-3">
                      <div className="w-10 h-10 rounded-full bg-gradient-to-br from-blue-500 to-purple-600 flex items-center justify-center">
                        <resource.icon className="h-5 w-5 text-white" />
                      </div>
                      <Badge variant="secondary">{resource.type}</Badge>
                    </div>
                    <CardTitle className="text-lg">{resource.title}</CardTitle>
                    <CardDescription>{resource.description}</CardDescription>
                  </CardHeader>
                </Card>
              </motion.div>
            ))}
          </div>

          <Card className="mt-12 bg-gradient-to-br from-blue-500/15 via-purple-600/15 to-green-500/15 border border-primary/30">
            <CardHeader className="text-center space-y-3">
              <h3 className="text-2xl font-semibold">AI最新情報ニュースレター</h3>
              <CardDescription className="text-base text-foreground/80">
                月2回の配信で、導入事例・プロダクトアップデート・イベント情報をまとめてご案内します。
              </CardDescription>
            </CardHeader>
            <CardContent>
              <div className="max-w-2xl mx-auto flex flex-col md:flex-row gap-4 md:items-center">
                <Input placeholder="メールアドレス" type="email" className="flex-1" />
                <Button className="bg-gradient-to-r from-blue-500 to-purple-600 hover:from-blue-600 hover:to-purple-700">
                  購読する
                </Button>
              </div>
            </CardContent>
          </Card>
        </div>
      </div>
    </div>
  )

  const ContactPage = () => (
    <div className="min-h-screen pt-24 pb-16 px-4">
      <div className="container mx-auto max-w-4xl">
        <motion.div
          initial={{ opacity: 0, y: 50 }}
          animate={{ opacity: 1, y: 0 }}
          transition={{ duration: 0.8 }}
          className="text-center mb-16"
        >
          <h1 className="text-4xl md:text-5xl font-bold mb-4 bg-gradient-to-r from-blue-400 to-purple-600 bg-clip-text text-transparent">
            お問い合わせ
          </h1>
          <p className="text-xl text-muted-foreground">プロジェクトについてお気軽にご相談ください</p>
        </motion.div>

        <div className="grid lg:grid-cols-2 gap-12">
          <motion.div
            initial={{ opacity: 0, x: -50 }}
            animate={{ opacity: 1, x: 0 }}
            transition={{ duration: 0.8 }}
          >
            <Card className="bg-card/50 backdrop-blur-sm border-border/50">
              <CardHeader>
                <CardTitle>連絡先情報</CardTitle>
                <CardDescription>以下の方法でお気軽にお問い合わせください</CardDescription>
              </CardHeader>
              <CardContent className="space-y-6">
                <div className="flex items-center space-x-4">
                  <div className="w-10 h-10 rounded-full bg-gradient-to-br from-blue-500 to-purple-600 flex items-center justify-center">
                    <Mail className="h-5 w-5 text-white" />
                  </div>
                  <div>
                    <div className="font-medium">メール</div>
                    <div className="text-muted-foreground">info@manuheleku.com</div>
                  </div>
                </div>
                <div className="flex items-center space-x-4">
                  <div className="w-10 h-10 rounded-full bg-gradient-to-br from-blue-500 to-purple-600 flex items-center justify-center">
                    <Phone className="h-5 w-5 text-white" />
                  </div>
                  <div>
                    <div className="font-medium">電話</div>
                    <div className="text-muted-foreground">+81-3-1234-5678</div>
                  </div>
                </div>
                <div className="flex items-center space-x-4">
                  <div className="w-10 h-10 rounded-full bg-gradient-to-br from-blue-500 to-purple-600 flex items-center justify-center">
                    <MapPin className="h-5 w-5 text-white" />
                  </div>
                  <div>
                    <div className="font-medium">所在地</div>
                    <div className="text-muted-foreground">東京都渋谷区</div>
                  </div>
                </div>
                <div className="flex items-center space-x-4">
                  <div className="w-10 h-10 rounded-full bg-gradient-to-br from-blue-500 to-purple-600 flex items-center justify-center">
                    <Clock className="h-5 w-5 text-white" />
                  </div>
                  <div>
                    <div className="font-medium">営業時間</div>
                    <div className="text-muted-foreground">平日 9:00-18:00</div>
                  </div>
                </div>
              </CardContent>
            </Card>
          </motion.div>

          <motion.div
            initial={{ opacity: 0, x: 50 }}
            animate={{ opacity: 1, x: 0 }}
            transition={{ duration: 0.8 }}
          >
            <Card className="bg-card/50 backdrop-blur-sm border-border/50">
              <CardHeader>
                <CardTitle>お問い合わせフォーム</CardTitle>
                <CardDescription>以下のフォームからお問い合わせください</CardDescription>
              </CardHeader>
              <CardContent className="space-y-4">
                <div className="grid grid-cols-2 gap-4">
                  <Input placeholder="お名前" />
                  <Input placeholder="会社名" />
                </div>
                <Input placeholder="メールアドレス" type="email" />
                <Input placeholder="電話番号" />
                <Input placeholder="件名" />
                <Textarea placeholder="メッセージ" rows={6} />
                <Button className="w-full bg-gradient-to-r from-blue-500 to-purple-600 hover:from-blue-600 hover:to-purple-700">
                  送信する
                </Button>
              </CardContent>
            </Card>
          </motion.div>
        </div>

        <motion.div
          initial={{ opacity: 0, y: 40 }}
          animate={{ opacity: 1, y: 0 }}
          transition={{ duration: 0.8 }}
          className="mt-16"
        >
          <div className="text-center mb-10">
            <h2 className="text-3xl font-bold mb-3">よくある質問</h2>
            <p className="text-muted-foreground">初回打ち合わせ前に寄せられるご質問にお答えします</p>
          </div>

          <div className="space-y-4">
            {faqs.map((faq, index) => (
              <motion.div
                key={faq.question}
                initial={{ opacity: 0, y: 20 }}
                whileInView={{ opacity: 1, y: 0 }}
                transition={{ duration: 0.6, delay: index * 0.1 }}
              >
                <Card className="bg-card/50 backdrop-blur-sm border-border/40">
                  <CardHeader className="space-y-2">
                    <div className="flex items-center gap-3">
                      <MessageCircle className="h-5 w-5 text-primary" />
                      <CardTitle className="text-lg">{faq.question}</CardTitle>
                    </div>
                    <CardDescription className="text-base text-foreground/80 leading-relaxed">
                      {faq.answer}
                    </CardDescription>
                  </CardHeader>
                </Card>
              </motion.div>
            ))}
          </div>
        </motion.div>

        <motion.div
          initial={{ opacity: 0, y: 40 }}
          animate={{ opacity: 1, y: 0 }}
          transition={{ duration: 0.8 }}
          className="mt-16"
        >
          <Card className="bg-gradient-to-br from-blue-500/15 via-purple-600/15 to-green-500/15 border border-primary/30">
            <CardHeader className="space-y-4 text-center md:text-left md:flex md:items-center md:justify-between">
              <div>
                <div className="flex items-center justify-center md:justify-start gap-3 mb-2">
                  <Calendar className="h-5 w-5 text-primary" />
                  <span className="text-sm font-semibold text-muted-foreground">無料ヒアリング（45分）</span>
                </div>
                <h3 className="text-2xl font-bold">最短翌週からKick-offが可能です</h3>
                <CardDescription className="text-base text-foreground/80 mt-2">
                  現状把握からPoC計画、概算見積もりまでまとめてご案内。スピード感のある意思決定を支援します。
                </CardDescription>
              </div>
              <Button size="lg" className="mt-4 md:mt-0 bg-gradient-to-r from-blue-500 to-purple-600 hover:from-blue-600 hover:to-purple-700">
                ヒアリングを予約する
              </Button>
            </CardHeader>
            <CardContent>
              <ul className="grid md:grid-cols-3 gap-3 text-sm text-muted-foreground">
                <li className="flex items-center gap-2">
                  <CheckCircle className="h-4 w-4 text-green-400" />課題整理ワークショップ
                </li>
                <li className="flex items-center gap-2">
                  <CheckCircle className="h-4 w-4 text-green-400" />AI活用ロードマップ提示
                </li>
                <li className="flex items-center gap-2">
                  <CheckCircle className="h-4 w-4 text-green-400" />概算予算と体制プラン
                </li>
              </ul>
            </CardContent>
          </Card>
        </motion.div>
      </div>
    </div>
  )

  return (
    <div className="min-h-screen bg-background text-foreground">
      <Navigation />
      
      <AnimatePresence mode="wait">
        {currentPage === 'home' && <HomePage key="home" />}
        {currentPage === 'ai-news' && <AINewsPage key="ai-news" />}
        {currentPage === 'contact' && <ContactPage key="contact" />}
      </AnimatePresence>

      {/* Footer */}
      <footer className="border-t border-border bg-card/20">
        <div className="container mx-auto px-4 py-8">
          <div className="text-center">
            <div className="text-2xl font-bold bg-gradient-to-r from-blue-400 to-purple-600 bg-clip-text text-transparent mb-4">
              Manuheleku
            </div>
            <p className="text-muted-foreground mb-4">
              海外最先端アプリ風デザインで、あなたのビジネスを次のレベルへ
            </p>
            <div className="flex justify-center space-x-6 text-sm text-muted-foreground">
              <span>© 2025 Manuheleku. All rights reserved.</span>
            </div>
          </div>
        </div>
      </footer>
    </div>
  )
}

export default App
