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
  X
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

