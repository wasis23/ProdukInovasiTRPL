<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Showcase Inovasi D4 TRPL - Katalog Produk Inovatif</title>
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&family=Outfit:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <!-- Tailwind CSS v4 via Vite -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        html, body {
            height: 100%;
            margin: 0;
        }
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            display: flex !important;
            flex-direction: column !important;
            min-height: 100vh !important;
        }
        main {
            flex-grow: 1 !important;
        }
        h1, h2, h3, .font-heading {
            font-family: 'Outfit', sans-serif;
        }
        .glow-effect {
            box-shadow: 0 0 40px -10px rgba(99, 102, 241, 0.15);
        }
        .glow-hover:hover {
            box-shadow: 0 0 30px -5px rgba(99, 102, 241, 0.3);
        }
        [x-cloak] { display: none !important; }
        .video-portrait {
            aspect-ratio: 9 / 16 !important;
            max-width: 340px !important;
            margin: 0 auto !important;
            width: 100% !important;
        }
    </style>
</head>
<body class="min-h-screen flex flex-col relative overflow-x-hidden transition-colors duration-300" x-data="{
    theme: localStorage.getItem('theme') || 'dark',
    activeCategory: 'all',
    modalOpen: false,
    selectedProduct: null,
    activeVideoUrl: '',
    currentSlide: 0,
    toggleTheme() {
        this.theme = this.theme === 'dark' ? 'light' : 'dark';
        localStorage.setItem('theme', this.theme);
    },
    openModal(product) {
        this.selectedProduct = product;
        this.activeVideoUrl = product.youtube_embed_url;
        this.currentSlide = 0;
        this.modalOpen = true;
    },
    closeModal() {
        this.modalOpen = false;
        this.activeVideoUrl = '';
        this.selectedProduct = null;
    },
    isPortraitVideo() {
        if (!this.activeVideoUrl) return false;
        return this.activeVideoUrl.includes('tiktok.com') || this.activeVideoUrl.includes('instagram.com');
    }
}" :class="theme === 'dark' ? 'dark bg-[#0b0f19] text-slate-200' : 'bg-slate-50 text-slate-800'">

    <!-- Gradient Backdrop Orbs -->
    <div class="absolute top-[-20%] left-[-10%] w-[600px] h-[600px] rounded-full bg-indigo-500/5 dark:bg-indigo-900/10 blur-[120px] pointer-events-none"></div>
    <div class="absolute top-[40%] right-[-10%] w-[500px] h-[500px] rounded-full bg-emerald-500/5 dark:bg-emerald-900/10 blur-[120px] pointer-events-none"></div>
    <div class="absolute bottom-[-10%] left-[20%] w-[600px] h-[600px] rounded-full bg-violet-500/5 dark:bg-violet-900/10 blur-[120px] pointer-events-none"></div>

    <!-- Header / Navigation -->
    <header class="border-b border-slate-200 bg-white/80 dark:border-slate-800/80 dark:bg-slate-950/60 backdrop-blur-md sticky top-0 z-40 transition-all duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-20 flex items-center justify-between">
            <div class="flex items-center gap-3">
                <div class="h-10 w-10 rounded-xl bg-gradient-to-tr from-indigo-600 to-emerald-500 flex items-center justify-center shadow-lg shadow-indigo-500/20">
                    <span class="text-white font-bold text-xl font-heading">T</span>
                </div>
                <div>
                    <span class="font-heading font-extrabold text-xl tracking-tight bg-gradient-to-r from-slate-950 via-slate-800 to-slate-600 dark:from-white dark:via-slate-100 dark:to-slate-400 bg-clip-text text-transparent">TRPL Innovation</span>
                    <span class="block text-[10px] text-slate-500 dark:text-slate-400 font-semibold tracking-wider uppercase">D4 Teknologi Rekayasa Perangkat Lunak</span>
                </div>
            </div>
            
            <nav class="flex items-center gap-4">
                <a href="#katalog" class="text-sm font-medium text-slate-600 hover:text-slate-950 dark:text-slate-300 dark:hover:text-white transition-colors hidden sm:block">Katalog</a>
                
                @auth
                    <a href="{{ url('/admin') }}" class="inline-flex items-center justify-center px-4 py-2 text-xs font-bold text-white bg-indigo-600 hover:bg-indigo-500 rounded-lg transition-all shadow-md shadow-indigo-600/20 cursor-pointer">
                        Dashboard Admin
                    </a>
                @else
                    <a href="{{ url('/admin/login') }}" class="inline-flex items-center justify-center px-4 py-2 text-xs font-bold text-slate-700 dark:text-white bg-slate-100 hover:bg-slate-200 dark:bg-slate-800 dark:hover:bg-slate-700 rounded-lg border border-slate-200 dark:border-slate-700 transition-all cursor-pointer">
                        Admin Login
                    </a>
                @endauth

                <span class="h-4 w-px bg-slate-200 dark:bg-slate-800 hidden sm:block"></span>

                <!-- Theme Toggle Button -->
                <button 
                    @click="toggleTheme()" 
                    class="p-2 rounded-xl border border-slate-200 dark:border-slate-800 bg-white hover:bg-slate-100 dark:bg-slate-900/50 dark:hover:bg-slate-900 text-slate-600 hover:text-slate-950 dark:text-slate-400 dark:hover:text-white transition-all cursor-pointer flex items-center justify-center h-10 w-10"
                    title="Ubah Tema"
                >
                    <!-- Sun Icon (visible in dark mode) -->
                    <svg x-show="theme === 'dark'" x-cloak class="w-5 h-5 text-amber-400 animate-pulse" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 2.25a.75.75 0 0 1 .75.75v2.25a.75.75 0 0 1-1.5 0V3a.75.75 0 0 1 .75-.75zM6.16 5.1a.75.75 0 0 1 1.06 0l1.59 1.59a.75.75 0 1 1-1.06 1.06L6.16 6.16a.75.75 0 0 1 0-1.06zm11.68 0a.75.75 0 0 1 0 1.06l-1.59 1.59a.75.75 0 1 1-1.06-1.06l1.59-1.59a.75.75 0 0 1 1.06 0zM12 5.25a6.75 6.75 0 1 0 0 13.5 6.75 6.75 0 0 0 0-13.5zM3 12a.75.75 0 0 1 .75-.75h2.25a.75.75 0 0 1 0 1.5H3.75A.75.75 0 0 1 3 12zm15 0a.75.75 0 0 1 .75-.75h2.25a.75.75 0 0 1 0 1.5h-2.25A.75.75 0 0 1 18 12zM6.16 17.84a.75.75 0 0 1 1.06-1.06l1.59 1.59a.75.75 0 1 1-1.06 1.06l-1.59-1.59a.75.75 0 0 1 0-1.06zm11.68 0a.75.75 0 0 1 0-1.06l1.59 1.59a.75.75 0 1 1-1.06-1.06l-1.59-1.59a.75.75 0 0 1 0-1.06zM12 17.25a.75.75 0 0 1 .75.75v2.25a.75.75 0 0 1-1.5 0V18a.75.75 0 0 1 .75-.75z"/>
                    </svg>
                    <!-- Moon Icon (visible in light mode) -->
                    <svg x-show="theme === 'light'" x-cloak class="w-5 h-5 text-slate-700" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M9.528 1.718a.75.75 0 0 1 .162.819A8.97 8.97 0 0 0 9 6a9 9 0 0 0 9 9 8.97 8.97 0 0 0 3.463-.69.75.75 0 0 1 .981.98 10.503 10.503 0 0 1-9.694 6.46c-5.799 0-10.5-4.701-10.5-10.5a10.503 10.503 0 0 1 7.278-10.032.75.75 0 0 1 .819.162z"/>
                    </svg>
                </button>
            </nav>
        </div>
    </header>

    <!-- Main Content Wrapper to push footer to the bottom -->
    <main class="flex-grow">

        <!-- Image Slider at the Top -->
        @if($sliderImages->isNotEmpty())
            <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-8 mb-4" x-data="{
                currentSlide: 0,
                totalSlides: {{ $sliderImages->count() }},
                autoplayInterval: null,
                startAutoplay() {
                    this.autoplayInterval = setInterval(() => {
                        this.next();
                    }, 5000);
                },
                stopAutoplay() {
                    if (this.autoplayInterval) {
                        clearInterval(this.autoplayInterval);
                    }
                },
                next() {
                    this.currentSlide = (this.currentSlide + 1) % this.totalSlides;
                },
                prev() {
                    this.currentSlide = (this.currentSlide - 1 + this.totalSlides) % this.totalSlides;
                }
            }" x-init="startAutoplay()" @mouseenter="stopAutoplay()" @mouseleave="startAutoplay()">
                <div class="relative rounded-3xl overflow-hidden aspect-[21/9] min-h-[300px] sm:min-h-[400px] bg-slate-950 border border-slate-200/80 dark:border-slate-800 shadow-xl group">
                    <!-- Slides -->
                    <div class="relative w-full h-full">
                        @foreach($sliderImages as $index => $slide)
                            <div 
                                x-show="currentSlide === {{ $index }}"
                                x-transition:enter="transition ease-out duration-700"
                                x-transition:enter-start="opacity-0 scale-102"
                                x-transition:enter-end="opacity-100 scale-100"
                                x-transition:leave="transition ease-in duration-700"
                                x-transition:leave-start="opacity-100 scale-100"
                                x-transition:leave-end="opacity-0 scale-98"
                                class="absolute inset-0 w-full h-full"
                            >
                                <img 
                                    src="{{ asset('storage/' . $slide->image_path) }}" 
                                    alt="{{ $slide->title ?? 'Slide ' . ($index + 1) }}"
                                    class="w-full h-full object-cover"
                                    style="object-position: {{ $slide->focus_x }}% {{ $slide->focus_y }}%;"
                                >
                                
                                <!-- Dark Overlay Gradient -->
                                <div class="absolute inset-0 bg-gradient-to-t from-slate-950/80 via-slate-950/20 to-transparent"></div>
                                
                                <!-- Slide Content -->
                                @if($slide->title || $slide->description)
                                    <div class="absolute bottom-0 left-0 right-0 p-8 sm:p-12 text-left">
                                        <div class="max-w-2xl">
                                            @if($slide->title)
                                                <h2 class="text-2xl sm:text-3xl md:text-4xl font-extrabold text-white mb-3 tracking-tight font-heading leading-tight drop-shadow-md">
                                                    {{ $slide->title }}
                                                </h2>
                                            @endif
                                            @if($slide->description)
                                                <p class="text-sm sm:text-base text-slate-200 font-light drop-shadow-sm line-clamp-2">
                                                    {{ $slide->description }}
                                                </p>
                                            @endif
                                        </div>
                                    </div>
                                @endif
                            </div>
                        @endforeach
                    </div>

                    <!-- Navigation Controls -->
                    @if($sliderImages->count() > 1)
                        <!-- Left Arrow -->
                        <button 
                            @click="prev()" 
                            class="absolute left-4 top-1/2 -translate-y-1/2 h-12 w-12 rounded-full bg-white/10 hover:bg-white/20 backdrop-blur-md border border-white/20 text-white flex items-center justify-center transition-all opacity-0 group-hover:opacity-100 cursor-pointer shadow-lg"
                        >
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"></path>
                            </svg>
                        </button>
                        
                        <!-- Right Arrow -->
                        <button 
                            @click="next()" 
                            class="absolute right-4 top-1/2 -translate-y-1/2 h-12 w-12 rounded-full bg-white/10 hover:bg-white/20 backdrop-blur-md border border-white/20 text-white flex items-center justify-center transition-all opacity-0 group-hover:opacity-100 cursor-pointer shadow-lg"
                        >
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </button>

                        <!-- Indicators -->
                        <div class="absolute bottom-6 right-8 flex gap-2 z-10">
                            @foreach($sliderImages as $index => $slide)
                                <button 
                                    @click="currentSlide = {{ $index }}"
                                    :class="currentSlide === {{ $index }} ? 'bg-indigo-500 w-8' : 'bg-white/40 hover:bg-white/60 w-2'"
                                    class="h-2 rounded-full transition-all duration-300 cursor-pointer"
                                ></button>
                            @endforeach
                        </div>
                    @endif
                </div>
            </section>
        @endif



    <!-- Catalog Section -->
    <section id="katalog" class="pt-2 pb-12 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 scroll-mt-24">
        
        <!-- Filter Tabs -->
        <div class="flex justify-center mb-12">
            <div class="inline-flex p-1.5 rounded-xl bg-slate-200/60 border border-slate-300/80 dark:bg-slate-900/80 dark:border-slate-800 backdrop-blur-sm shadow-inner">
                <button 
                    @click="activeCategory = 'all'" 
                    :class="activeCategory === 'all' ? 'bg-indigo-600 text-white shadow' : 'text-slate-600 hover:text-slate-950 dark:text-slate-400 dark:hover:text-white'"
                    class="px-5 py-2.5 rounded-lg text-sm font-semibold tracking-wide transition-all duration-200 cursor-pointer">
                    Semua
                </button>
                
                @foreach ($categories as $cat)
                    <button 
                        @click="activeCategory = '{{ $cat->slug }}'" 
                        :class="activeCategory === '{{ $cat->slug }}' ? 'bg-indigo-600 text-white shadow' : 'text-slate-600 hover:text-slate-950 dark:text-slate-400 dark:hover:text-white'"
                        class="px-5 py-2.5 rounded-lg text-sm font-semibold tracking-wide transition-all duration-200 cursor-pointer">
                        {{ $cat->name }}
                    </button>
                @endforeach
            </div>
        </div>

        <!-- Products Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse ($products as $product)
                <!-- Card -->
                <div 
                    x-show="activeCategory === 'all' || activeCategory === '{{ $product->category->slug }}'"
                    x-transition:enter="transition ease-out duration-300"
                    x-transition:enter-start="opacity-0 scale-95"
                    x-transition:enter-end="opacity-100 scale-100"
                    @click='openModal({
                        id: {{ $product->id }},
                        title: {{ json_encode($product->title) }},
                        category_slug: {{ json_encode($product->category->slug) }},
                        category_name: {{ json_encode($product->category->name) }},
                        description: {{ json_encode($product->description) }},
                        youtube_embed_url: {{ json_encode($product->youtube_embed_url) }},
                        live_preview_url: {{ json_encode($product->live_preview_url) }},
                        images: {{ $product->images->toJson() }}
                    })'
                    class="group rounded-2xl bg-white border border-slate-200/80 dark:bg-slate-900/40 dark:border-slate-800/80 overflow-hidden shadow-sm hover:shadow-lg dark:glow-effect hover:border-slate-300 dark:hover:border-slate-700/80 transition-all duration-300 flex flex-col h-full hover:translate-y-[-4px] cursor-pointer"
                >
                    <!-- Image Thumbnail -->
                    <div class="aspect-video w-full bg-slate-950 overflow-hidden relative">
                        @if($product->images->isNotEmpty())
                            <img 
                                src="{{ asset('storage/' . $product->images->first()->image_path) }}" 
                                alt="{{ $product->title }}" 
                                loading="lazy"
                                class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                            >
                        @else
                            <div class="w-full h-full bg-gradient-to-tr from-indigo-950/80 to-slate-900 flex items-center justify-center">
                                <svg class="w-12 h-12 text-indigo-500/40" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                        @endif
                        
                        <!-- Category Badge -->
                        <div class="absolute top-4 left-4 z-10">
                            <span class="px-3 py-1 rounded-full text-[10px] font-bold tracking-wider uppercase bg-slate-950/80 backdrop-blur-md text-indigo-400 border border-indigo-500/20">
                                {{ $product->category->name }}
                            </span>
                        </div>

                        <!-- Video Play Indicator Overlay -->
                        <div class="absolute inset-0 bg-slate-950/20 group-hover:bg-slate-950/40 transition-colors flex items-center justify-center opacity-0 group-hover:opacity-100 duration-300">
                            <div class="h-14 w-14 rounded-full bg-indigo-600/90 flex items-center justify-center shadow-lg text-white scale-90 group-hover:scale-100 transition-transform duration-300">
                                <svg class="w-6 h-6 fill-current ml-0.5" viewBox="0 0 24 24">
                                    <path d="M8 5v14l11-7z"/>
                                </svg>
                            </div>
                        </div>
                    </div>

                    <!-- Content -->
                    <div class="p-6 flex flex-col flex-grow">
                        <h3 class="text-xl font-bold text-slate-950 dark:text-white mb-3 group-hover:text-indigo-600 dark:group-hover:text-indigo-400 transition-colors">
                            {{ $product->title }}
                        </h3>
                        
                        <div class="text-slate-600 dark:text-slate-400 text-sm mb-6 flex-grow line-clamp-3">
                            {!! strip_tags($product->description) !!}
                        </div>

                        <div class="flex items-center justify-between pt-4 border-t border-slate-100 dark:border-slate-800/80 mt-auto">
                            <!-- Link Preview for website -->
                            @if($product->category->slug === 'website' && $product->live_preview_url)
                                <a 
                                    href="{{ $product->live_preview_url }}" 
                                    target="_blank" 
                                    class="text-xs font-semibold text-emerald-600 hover:text-emerald-555 dark:text-emerald-400 dark:hover:text-emerald-300 flex items-center gap-1.5 transition-colors"
                                    @click.stop
                                >
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                                    </svg>
                                    Demo Website
                                </a>
                            @else
                                <span class="text-xs text-slate-400 dark:text-slate-500 font-medium">Galeri Media</span>
                            @endif

                            <button 
                                @click.stop='openModal({
                                    id: {{ $product->id }},
                                    title: {{ json_encode($product->title) }},
                                    category_slug: {{ json_encode($product->category->slug) }},
                                    category_name: {{ json_encode($product->category->name) }},
                                    description: {{ json_encode($product->description) }},
                                    youtube_embed_url: {{ json_encode($product->youtube_embed_url) }},
                                    live_preview_url: {{ json_encode($product->live_preview_url) }},
                                    images: {{ $product->images->toJson() }}
                                })'
                                class="px-4 py-2 rounded-lg text-xs font-bold text-slate-700 dark:text-white bg-slate-100 hover:bg-slate-200 dark:bg-slate-800 dark:hover:bg-slate-700 transition-colors cursor-pointer"
                            >
                                Lihat Detail
                            </button>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full py-16 text-center">
                    <svg class="w-16 h-16 text-slate-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0a2 2 0 01-2 2H6a2 2 0 01-2-2m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path>
                    </svg>
                    <h3 class="text-lg font-bold text-slate-500 mb-1">Belum Ada Produk</h3>
                    <p class="text-sm text-slate-400">Katalog saat ini sedang dalam proses pembaruan data.</p>
                </div>
            @endforelse
        </div>
    </section>

    <!-- Testimonial Alumni Section -->
    <section class="py-16 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 border-t border-slate-200 dark:border-slate-900 relative z-10" x-data="{
        activeSlide: 0,
        totalSlides: {{ $testimonials->count() }},
        slidesToShow: window.innerWidth >= 1024 ? 3 : (window.innerWidth >= 768 ? 2 : 1),
        init() {
            window.addEventListener('resize', () => {
                this.slidesToShow = window.innerWidth >= 1024 ? 3 : (window.innerWidth >= 768 ? 2 : 1);
            });
        },
        next() {
            if (this.activeSlide < this.totalSlides - this.slidesToShow) {
                this.activeSlide++;
            } else {
                this.activeSlide = 0;
            }
        },
        prev() {
            if (this.activeSlide > 0) {
                this.activeSlide--;
            } else {
                this.activeSlide = Math.max(0, this.totalSlides - this.slidesToShow);
            }
        }
    }">
        <!-- Section Header -->
        <div class="text-center mb-12">
            <div class="inline-block px-4 py-1.5 rounded-full bg-amber-500/10 border border-amber-500/20 text-xs font-bold uppercase tracking-wider text-amber-600 dark:text-amber-400 mb-4">
                Testimonial Alumni
            </div>
            <h2 class="text-3xl sm:text-4xl font-extrabold tracking-tight">
                <span class="text-slate-950 dark:text-white">Kata</span> 
                <span class="text-amber-500">Mereka</span>
            </h2>
        </div>

        <!-- Testimonials Slider Container -->
        @if($testimonials->isNotEmpty())
            <div class="relative overflow-hidden px-1 py-4">
                <!-- Slides wrapper -->
                <div class="flex transition-transform duration-500 ease-out" :style="'transform: translateX(-' + (activeSlide * (100 / slidesToShow)) + '%)'">
                    @foreach($testimonials as $testimonial)
                        <div class="flex-shrink-0 px-4 w-full md:w-1/2 lg:w-1/3">
                            <div class="h-full rounded-2xl bg-white border border-slate-200/80 dark:bg-slate-900/30 dark:border-slate-800/80 p-8 flex flex-col items-center text-center shadow-sm hover:shadow-md transition-all duration-300 relative group dark:glow-effect">
                                <!-- Quote Mark -->
                                <span class="text-5xl text-amber-500/30 font-serif leading-none mb-4 font-bold">“</span>
                                
                                <!-- Testimonial Content -->
                                <p class="text-slate-600 dark:text-slate-300 italic text-sm leading-relaxed mb-6 flex-grow">
                                    "{{ $testimonial->content }}"
                                </p>
                                
                                <!-- Alumnus Info -->
                                <div class="flex flex-col items-center mt-auto">
                                    <div class="w-16 h-16 rounded-full overflow-hidden border-2 border-amber-500/40 mb-3 shadow-md bg-slate-100 dark:bg-slate-800">
                                        @if($testimonial->photo_path)
                                            <img src="{{ asset('storage/' . $testimonial->photo_path) }}" alt="{{ $testimonial->name }}" class="w-full h-full object-cover">
                                        @else
                                            <!-- Default avatar -->
                                            <div class="w-full h-full flex items-center justify-center bg-amber-500/10 text-amber-500">
                                                <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 24 24">
                                                    <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
                                                </svg>
                                            </div>
                                        @endif
                                    </div>
                                    <h4 class="font-bold text-slate-900 dark:text-white text-base mb-1">{{ $testimonial->name }}</h4>
                                    <p class="text-slate-500 dark:text-slate-400 text-xs font-medium text-center">{{ $testimonial->profession }}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Navigation Buttons and Line Indicator -->
            <div class="flex items-center justify-center gap-6 mt-8" x-show="totalSlides > slidesToShow">
                <!-- Prev Button -->
                <button @click="prev()" class="p-3 rounded-full border border-slate-200 dark:border-slate-800 bg-white dark:bg-slate-950 text-slate-600 hover:text-slate-950 dark:text-slate-400 dark:hover:text-white transition-all shadow-sm hover:shadow-md cursor-pointer flex items-center justify-center">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"></path>
                    </svg>
                </button>

                <!-- Line Indicator -->
                <div class="w-24 h-1 bg-slate-200 dark:bg-slate-800 rounded-full overflow-hidden relative">
                    <div class="h-full bg-amber-500 rounded-full transition-all duration-500 absolute top-0"
                         :style="'left: ' + (activeSlide * (100 / (totalSlides - slidesToShow + 1))) + '%; width: ' + (100 / (totalSlides - slidesToShow + 1)) + '%'"></div>
                </div>

                <!-- Next Button -->
                <button @click="next()" class="p-3 rounded-full border border-slate-200 dark:border-slate-800 bg-white dark:bg-slate-950 text-slate-600 hover:text-slate-950 dark:text-slate-400 dark:hover:text-white transition-all shadow-sm hover:shadow-md cursor-pointer flex items-center justify-center">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"></path>
                    </svg>
                </button>
            </div>
        @else
            <div class="text-center py-8 text-slate-500 dark:text-slate-400">
                Belum ada testimoni alumni.
            </div>
        @endif
    </section>

    </main>

    <!-- Footer -->
    <footer class="border-t border-slate-200 dark:border-slate-900 bg-white/60 dark:bg-slate-950/60 backdrop-blur-md py-6 mt-20 relative z-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col md:flex-row items-center justify-between gap-6">
            <div class="flex items-center gap-3">
                <div class="h-8 w-8 rounded-lg bg-gradient-to-tr from-indigo-600 to-emerald-500 flex items-center justify-center">
                    <span class="text-white font-bold text-base font-heading">T</span>
                </div>
                <div>
                    <span class="font-heading font-bold text-slate-800 dark:text-slate-300">TRPL Showcase</span>
                    <span class="block text-[10px] text-slate-500">© 2026 D4 Teknologi Rekayasa Perangkat Lunak. All Rights Reserved.</span>
                </div>
            </div>
            
            <!-- Social Media Links -->
            <div class="flex gap-5 items-center">
                @if($setting->instagram_url)
                    <a href="{{ $setting->instagram_url }}" target="_blank" class="text-slate-500 hover:text-pink-600 dark:text-slate-400 dark:hover:text-pink-500 transition-colors" title="Instagram">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.051C.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 1 0 0 12.324 6.162 6.162 0 0 0 0-12.324zM12 16a4 4 0 1 1 0-8 4 4 0 0 1 0 8zm6.406-11.845a1.44 1.44 0 1 0 0 2.881 1.44 1.44 0 0 0 0-2.881z"/>
                        </svg>
                    </a>
                @endif
                
                @if($setting->tiktok_url)
                    <a href="{{ $setting->tiktok_url }}" target="_blank" class="text-slate-500 hover:text-black dark:text-slate-400 dark:hover:text-white transition-colors" title="TikTok">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12.525.02c1.31-.02 2.61-.01 3.91-.02.08 1.53.63 3.02 1.59 4.23.97 1.2 2.27 2.01 3.73 2.37v3.91c-1.39-.08-2.73-.62-3.83-1.53-.88-.71-1.55-1.67-1.92-2.75v8.79c.04 1.9-.53 3.78-1.63 5.31-1.12 1.58-2.8 2.67-4.71 3.07-1.89.39-3.87.16-5.61-.66-1.74-.83-3.13-2.27-3.95-4.05-.84-1.82-.99-3.88-.41-5.78.58-1.9 1.83-3.53 3.52-4.59C6.46 9.4 8.2 9.02 9.94 9.4c.08.02.15.05.23.09v4.06c-1.2-.55-2.61-.47-3.73.23-.98.6-1.63 1.63-1.78 2.77-.15 1.15.22 2.32 1 3.2.78.88 1.93 1.37 3.1 1.34 1.26-.04 2.45-.72 3.14-1.78.68-1.04.81-2.36.79-3.57V.02z"/>
                        </svg>
                    </a>
                @endif
            </div>
        </div>
    </footer>

    <!-- Alpine.js Modal Detail -->
    <div 
        x-show="modalOpen" 
        class="fixed inset-0 z-50 overflow-y-auto flex items-center justify-center p-4 sm:p-6 lg:p-8"
        x-cloak
    >
        <!-- Modal Backdrop with blur -->
        <div 
            x-show="modalOpen"
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            class="fixed inset-0 bg-slate-950/40 dark:bg-slate-950/80 backdrop-blur-md"
            @click="closeModal()"
        ></div>

        <!-- Modal Content Container -->
        <div 
            x-show="modalOpen"
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 scale-95 translate-y-4"
            x-transition:enter-end="opacity-100 scale-100 translate-y-0"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100 scale-100 translate-y-0"
            x-transition:leave-end="opacity-0 scale-95 translate-y-4"
            class="bg-white border border-slate-200 dark:bg-slate-900 dark:border-slate-800 rounded-2xl w-full max-w-4xl max-h-[90vh] overflow-hidden shadow-2xl relative z-10 flex flex-col"
        >
            <!-- Close Button -->
            <button 
                @click="closeModal()" 
                class="absolute top-4 right-4 z-20 h-10 w-10 rounded-full bg-slate-100 hover:bg-slate-200 border border-slate-200 dark:bg-slate-950/60 dark:border-slate-800 text-slate-600 hover:text-slate-950 dark:text-slate-400 hover:dark:text-white flex items-center justify-center transition-colors cursor-pointer"
            >
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>

            <!-- Scrollable Modal Body -->
            <div class="overflow-y-auto p-6 sm:p-8 flex-grow">
                <template x-if="selectedProduct">
                    <div>
                        <!-- Header Details -->
                        <div class="mb-6">
                            <span x-text="selectedProduct.category_name" class="inline-block px-3 py-1 rounded-full text-[10px] font-bold tracking-wider uppercase bg-indigo-500/10 text-indigo-600 dark:text-indigo-400 border border-indigo-500/20 mb-3"></span>
                            <h2 x-text="selectedProduct.title" class="text-2xl sm:text-3xl lg:text-4xl font-extrabold text-slate-950 dark:text-white leading-tight"></h2>
                        </div>

                        <!-- Split Grid: Video Player + Description -->
                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 items-start mb-8">
                            
                            <!-- Video Section -->
                            <div class="w-full">
                                <div 
                                    :class="isPortraitVideo() ? 'video-portrait' : 'aspect-video w-full'" 
                                    class="rounded-xl overflow-hidden bg-slate-100 dark:bg-slate-950 border border-slate-200 dark:border-slate-800 shadow-lg relative transition-all duration-300"
                                >
                                    <!-- Embedded Iframe Loaded Dynamically -->
                                    <template x-if="activeVideoUrl">
                                        <iframe 
                                            :src="activeVideoUrl" 
                                            class="w-full h-full border-0" 
                                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" 
                                            allowfullscreen
                                        ></iframe>
                                    </template>
                                </div>
                                <span class="block text-center text-xs text-slate-500 dark:text-slate-400 mt-2">Video Demonstrasi Produk</span>
                            </div>

                            <!-- Text Details & CTA -->
                            <div class="flex flex-col h-full">
                                <h4 class="text-sm font-bold text-slate-400 dark:text-slate-400 uppercase tracking-wider mb-2">Tentang Produk</h4>
                                <div class="prose prose-slate dark:prose-invert max-w-none text-slate-600 dark:text-slate-300 text-sm leading-relaxed mb-6" x-html="selectedProduct.description"></div>
                                
                                <div class="mt-auto">
                                    <!-- Website CTA -->
                                    <template x-if="selectedProduct.category_slug === 'website' && selectedProduct.live_preview_url">
                                        <a 
                                            :href="selectedProduct.live_preview_url" 
                                            target="_blank" 
                                            class="inline-flex items-center gap-2 px-5 py-3 rounded-xl text-sm font-semibold text-white bg-emerald-600 hover:bg-emerald-500 transition-all shadow-md shadow-emerald-600/20"
                                        >
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                                            </svg>
                                            Kunjungi Live Preview
                                        </a>
                                    </template>
                                </div>
                            </div>
                        </div>

                        <!-- Gallery Slider -->
                        <template x-if="selectedProduct.images && selectedProduct.images.length > 0">
                            <div class="border-t border-slate-200 dark:border-slate-800/80 pt-8 mt-8">
                                <h4 class="text-sm font-bold text-slate-400 dark:text-slate-400 uppercase tracking-wider mb-4">Galeri Produk / Tangkapan Layar</h4>
                                
                                <!-- Slider Container -->
                                <div class="relative rounded-xl overflow-hidden bg-slate-100 dark:bg-slate-950 border border-slate-200 dark:border-slate-800 max-w-3xl mx-auto aspect-video">
                                    
                                    <!-- Slides -->
                                    <div class="relative h-full w-full">
                                        <template x-for="(img, index) in selectedProduct.images" :key="img.id">
                                            <div 
                                                x-show="currentSlide === index" 
                                                x-transition:enter="transition ease-out duration-300"
                                                x-transition:enter-start="opacity-0"
                                                x-transition:enter-end="opacity-100"
                                                class="absolute inset-0 flex items-center justify-center"
                                            >
                                                <img 
                                                    :src="'/storage/' + img.image_path" 
                                                    alt="Detail produk"
                                                    class="max-w-full max-h-full object-contain"
                                                    loading="lazy"
                                                >
                                            </div>
                                        </template>
                                    </div>

                                    <!-- Navigation Arrows (only if more than 1 image) -->
                                    <template x-if="selectedProduct.images.length > 1">
                                        <div>
                                            <!-- Prev -->
                                            <button 
                                                @click="currentSlide = currentSlide === 0 ? selectedProduct.images.length - 1 : currentSlide - 1"
                                                class="absolute left-4 top-1/2 -translate-y-1/2 h-10 w-10 rounded-full bg-white/80 dark:bg-slate-950/60 border border-slate-200 dark:border-slate-800 text-slate-700 dark:text-white hover:bg-slate-100 dark:hover:bg-slate-900 flex items-center justify-center transition-colors cursor-pointer"
                                            >
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                                                </svg>
                                            </button>
                                            
                                            <!-- Next -->
                                            <button 
                                                @click="currentSlide = currentSlide === selectedProduct.images.length - 1 ? 0 : currentSlide + 1"
                                                class="absolute right-4 top-1/2 -translate-y-1/2 h-10 w-10 rounded-full bg-white/80 dark:bg-slate-950/60 border border-slate-200 dark:border-slate-800 text-slate-700 dark:text-white hover:bg-slate-100 dark:hover:bg-slate-900 flex items-center justify-center transition-colors cursor-pointer"
                                            >
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                                </svg>
                                            </button>
                                        </div>
                                    </template>

                                    <!-- Bottom Dots Indicators (only if more than 1 image) -->
                                    <template x-if="selectedProduct.images.length > 1">
                                        <div class="absolute bottom-4 left-1/2 -translate-x-1/2 flex gap-1.5 z-10 px-3 py-1.5 rounded-full bg-white/80 dark:bg-slate-950/60 backdrop-blur-sm border border-slate-200 dark:border-slate-800/80">
                                            <template x-for="(img, index) in selectedProduct.images" :key="img.id">
                                                <button 
                                                    @click="currentSlide = index"
                                                    :class="currentSlide === index ? 'bg-indigo-600 w-4' : 'bg-slate-300 hover:bg-slate-400 dark:bg-slate-600 dark:hover:bg-slate-400 w-2'"
                                                    class="h-2 rounded-full transition-all duration-300 cursor-pointer"
                                                ></button>
                                            </template>
                                        </div>
                                    </template>
                                </div>
                            </div>
                        </template>
                    </div>
                </template>
            </div>
        </div>
    </div>

</body>
</html>
