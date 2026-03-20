@extends('layouts.app')

@section('title', 'MULTICREATH | Portafolio de Diseño Web')

@section('content')

<!-- Hero Header -->
<header class="py-20 lg:py-32 bg-white dark:bg-background-dark">
    <div class="max-w-7xl mx-auto px-6 lg:px-12 text-center">
        <span class="inline-block px-4 py-1.5 mb-6 text-sm font-semibold tracking-wider text-primary uppercase bg-primary/10 rounded-full">
            Showcase Digital
        </span>
        <h1 class="text-5xl lg:text-7xl font-bold mb-8 tracking-tight">
            Portafolio de <span class="text-primary">Diseño Web</span>
        </h1>
        <p class="max-w-2xl mx-auto text-lg text-slate-600 dark:text-slate-400 leading-relaxed">
            Creamos experiencias digitales de alto rendimiento que fusionan estética minimalista con funcionalidad técnica impecable para marcas con visión de futuro.
        </p>
    </div>
</header>

<!-- Project Gallery -->
<main class="py-12 bg-background-light dark:bg-background-dark/50">
    <div class="max-w-7xl mx-auto px-6 lg:px-12">
        
        <!-- Filters -->
        <div class="flex flex-wrap gap-4 mb-16 justify-center">
            <button class="px-6 py-2 bg-primary text-white rounded-full">Todos</button>
            <button class="px-6 py-2 bg-white dark:bg-slate-800 border border-primary/10 rounded-full hover:border-primary transition-colors">E-commerce</button>
            <button class="px-6 py-2 bg-white dark:bg-slate-800 border border-primary/10 rounded-full hover:border-primary transition-colors">Corporativos</button>
            <button class="px-6 py-2 bg-white dark:bg-slate-800 border border-primary/10 rounded-full hover:border-primary transition-colors">Web Apps</button>
        </div>

        <!-- Grid de Proyectos -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-12 lg:gap-16">
            @include('components.portfolio-card', [
                'title' => 'Nexus Luxury',
                'category' => 'E-commerce / Retail',
                'description' => 'Plataforma E-commerce de alta gama para moda sostenible y minimalista.',
                'domain' => 'nexus-luxury.com',
                'year' => '2024',
                'image' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuAQwPfmTwT_kQVWTtUEPE8k9GIsY9GMItJoHV5iHYnRDfgqL_HoiMScoQT8sy7EIdfzmGw6BjEeAKzyfAGdtp6gzgCr3T_rWFWyM97lYlGt2sA-Rjwr-lRqd68erIh2egFsgzwKs0biNlNmz0T75OArcDxKxU5RFcAw_iAUI4nREDLNiMUjCiA89qJbIeU1tjUdkXd6j_zMpa5fSHjgIrNtpiQ5a5DZgbI43ytPCB8_LqiLDXOWDlgN4INz-43hkFCsTmzGO0hj3ZI'
            ])

            @include('components.portfolio-card', [
                'title' => 'Orbit Tech',
                'category' => 'SaaS / Web App',
                'description' => 'Software corporativo enfocado en análisis de datos e inteligencia artificial.',
                'domain' => 'orbit-tech.io',
                'year' => '2023',
                'image' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuBSH0TIpdmWzFZJhSl1f1des-6bNCCFhhhEoxJCGF_PfyirbcLoAQ2PTaUyaeDSSmny8HBkGcQdGwDm-2NOfC3ZrDqfiMqQlie5uA9QWQXhmG9tNK96hg-DYN8bcqtxJnGhycZ7iUf-03Ak2UxXAPoKK-8p8tfg6uom8ci-bnJ3Mm9XiVBivngnZ9-j7SP04WQz93XXRn4NCKgobqtxgP2ZMcGuq-YezqL-448IowrpH_9P-wolrLUZxrzB7EwJrmriJ4o1_slHViY'
            ])

            @include('components.portfolio-card', [
                'title' => 'Arqui Studio',
                'category' => 'Arquitectura / Portfolio',
                'description' => 'Portfolio dinámico para estudio de arquitectura galardonado.',
                'domain' => 'arqui-studio.com',
                'year' => '2024',
                'image' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuBzYVHauFrb1IUTEOp91aSJPanfr7vSAC3McrYBiue9c9ToL-1-sxccseJyA0R9Vn-4pZZ_tjRKyB0MGKs4PP3HlfdZAGcNhBz6ex5mnikTw5jrpGIX5O7_s5NE2F1WaQrkntr0Jb0tJNtgv041a8pdVgul5Ol54Tzc8w1wA92xhTN19gE7p9a-BbB63F9ViZHUyrjY6lb6pUZV19yaIcsV0c5IuA5XP0Yp2pB31nOE3Xb86y49FPspsqjuVX55Ffl0akJgHZPiPbY'
            ])

            @include('components.portfolio-card', [
                'title' => 'Zen Wellness',
                'category' => 'Salud / Booking App',
                'description' => 'Plataforma de bienestar integral con sistema de reservas personalizado.',
                'domain' => 'zen-wellness.app',
                'year' => '2023',
                'image' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuA-Eqr2CqNvRXtplDgnqGLmZ1qJS_yP-Ca9iQX9_zdaYthU71IVenCF-590uBqfenHfgD7117J7Fn8FCXxc9NAUldGFJiFxkCeBBXxVlVZcgKgnqJJZbfPlB-VxaqS6LrIZlquzymXSJCiHt1EVqIEOPkXk2kacLz7ijShEU1Jf0_cYmecTvzHlNCm4o6MttqnyYgxIGhcoNDe4qv4eTnJoatz_IO4GSERTxQG9KZINIf_EWEFK2cHY7EEPmw_y5FCPWCOGbQL4goQ'
            ])
        </div>
    </div>
</main>

<!-- Footer CTA -->
<section class="py-24 bg-white dark:bg-background-dark border-t border-primary/10">
    <div class="max-w-4xl mx-auto px-6 text-center">
        <h2 class="text-4xl lg:text-5xl font-bold mb-6">¿Tienes un proyecto en mente?</h2>
        <p class="text-xl text-slate-600 dark:text-slate-400 mb-10">
            Llevemos tu marca al siguiente nivel digital con una experiencia web diseñada para convertir.
        </p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a class="bg-primary text-white px-10 py-4 rounded-full font-bold text-lg hover:shadow-lg hover:shadow-primary/30 transition-all" href="#">
                Iniciar un proyecto
            </a>
            <a class="bg-slate-100 dark:bg-slate-800 text-slate-900 dark:text-white px-10 py-4 rounded-full font-bold text-lg hover:bg-slate-200 dark:hover:bg-slate-700 transition-all" href="#">
                Agendar Consultoría
            </a>
        </div>
    </div>
</section>

@endsection