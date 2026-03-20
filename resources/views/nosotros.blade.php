@extends('layouts.app')

@section('title', 'MULTICREATH | Sobre Nosotros')

@section('content')

<!-- Hero Section -->
<section class="relative py-20 lg:py-32 px-6 overflow-hidden">
    <div class="max-w-7xl mx-auto grid lg:grid-cols-2 gap-16 items-center">
        <div class="z-10">
            <span class="text-primary font-bold tracking-widest uppercase text-sm mb-4 block">Nuestra Identidad</span>
            <h1 class="text-5xl lg:text-7xl font-bold leading-tight mb-6 text-slate-900 dark:text-slate-50">
                Sobre Nosotros
            </h1>
            <p class="text-xl text-slate-600 dark:text-slate-400 leading-relaxed max-w-xl">
                Multiservicios Creativos Torres Hernández: Innovación y creatividad salvadoreña diseñada para el mundo digital.
            </p>
            <div class="mt-10 flex gap-4">
                <button class="bg-primary text-white px-8 py-4 rounded-xl font-bold hover:shadow-lg transition-all">Ver Servicios</button>
                <button class="border border-slate-300 dark:border-slate-700 px-8 py-4 rounded-xl font-bold hover:bg-slate-50 dark:hover:bg-slate-800 transition-all">Contáctanos</button>
            </div>
        </div>
        <div class="relative">
            <div class="aspect-square rounded-3xl overflow-hidden shadow-2xl bg-slate-200 dark:bg-slate-800">
                <img alt="Oficina Creativa" class="w-full h-full object-cover" src="https://lh3.googleusercontent.com/aida-public/AB6AXuBeFgTHns38TCC1qlSklfhPQt7UFsYBRK2a_tf-PFeQY0LyxvFvK_gB86w_WBUjftqjXk9E2ifX-MZb0BdQ6IaZLvMaj6wmEm6cK1lCTzlp26qII0O4vSC3m0bQv7fP_4MdV6PVoyjCeoFJkX2WfIypa2gwoxHlvtAYGGnAtB6d5JeidbWZ536kqDhtfNn03AFcsobz74903RJUaPvL6iXrMxWQPgg2ZVlisCXRQ-x_oBC886K_tqIq4QqT9eSvCS5ofSq1uBA7L7Q"/>
            </div>
            <div class="absolute -bottom-6 -left-6 bg-white dark:bg-slate-800 p-8 rounded-2xl shadow-xl hidden md:block">
                <div class="flex items-center gap-4">
                    <span class="material-symbols-outlined text-primary text-4xl">verified</span>
                    <div>
                        <p class="text-2xl font-bold">100%</p>
                        <p class="text-sm text-slate-500">Salvadoreño</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Who We Are & History -->
<section class="py-24 bg-white dark:bg-slate-900/50 px-6">
    <div class="max-w-5xl mx-auto">
        <div class="grid md:grid-cols-2 gap-20">
            <div>
                <h2 class="text-3xl font-bold mb-6 flex items-center gap-3">
                    <span class="material-symbols-outlined text-primary">diversity_3</span>
                    ¿Quiénes Somos?
                </h2>
                <p class="text-lg text-slate-600 dark:text-slate-400 leading-relaxed">
                    Somos una empresa 100% salvadoreña dedicada a ofrecer soluciones creativas y tecnológicas integrales. En MULTICREATH, transformamos ideas en realidades digitales con un enfoque profesional y elegante, adaptándonos a las necesidades cambiantes del mercado global.
                </p>
            </div>
            <div>
                <h2 class="text-3xl font-bold mb-6 flex items-center gap-3">
                    <span class="material-symbols-outlined text-primary">history_edu</span>
                    Nuestra Historia
                </h2>
                <p class="text-lg text-slate-600 dark:text-slate-400 leading-relaxed">
                    Lo que comenzó como un emprendimiento familiar basado en la pasión por el diseño y la tecnología, ha evolucionado en una firma multidisciplinaria. Nuestra trayectoria está marcada por el compromiso con la excelencia y el deseo constante de elevar el estándar creativo en El Salvador.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Mission & Vision -->
<section class="py-24 px-6">
    <div class="max-w-7xl mx-auto grid md:grid-cols-2 gap-8">
        <div class="bg-primary p-12 rounded-[2rem] text-white">
            <span class="material-symbols-outlined text-5xl mb-6">rocket_launch</span>
            <h3 class="text-3xl font-bold mb-4">Misión</h3>
            <p class="text-lg opacity-90 leading-relaxed">
                Proveer servicios integrales de alta calidad que impulsen el crecimiento de nuestros clientes, combinando la innovación tecnológica con el ingenio creativo para superar todas las expectativas.
            </p>
        </div>
        <div class="bg-slate-100 dark:bg-slate-800 p-12 rounded-[2rem]">
            <span class="material-symbols-outlined text-primary text-5xl mb-6">visibility</span>
            <h3 class="text-3xl font-bold mb-4">Visión</h3>
            <p class="text-lg text-slate-600 dark:text-slate-400 leading-relaxed">
                Convertirnos en el referente líder de soluciones creativas en la región, siendo reconocidos por nuestra integridad, excelencia operativa y la capacidad de transformar digitalmente cualquier negocio.
            </p>
        </div>
    </div>
</section>

<!-- Values Grid -->
<section class="py-24 bg-white dark:bg-slate-900 px-6">
    <div class="max-w-7xl mx-auto">
        <div class="text-center mb-16">
            <h2 class="text-4xl font-bold mb-4">Nuestros Valores</h2>
            <p class="text-slate-500 max-w-2xl mx-auto">Los pilares que sostienen cada proyecto que emprendemos y cada relación que construimos.</p>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @include('components.value-card', ['icon' => 'verified_user', 'title' => 'Responsabilidad', 'description' => 'Asumimos cada compromiso con seriedad, garantizando resultados en tiempo y forma.'])
            @include('components.value-card', ['icon' => 'lightbulb', 'title' => 'Creatividad', 'description' => 'Pensamos fuera de la caja para encontrar soluciones únicas y memorables.'])
            @include('components.value-card', ['icon' => 'handshake', 'title' => 'Compromiso', 'description' => 'Nos involucramos en los objetivos de nuestros clientes como si fueran propios.'])
            @include('components.value-card', ['icon' => 'fact_check', 'title' => 'Honestidad', 'description' => 'Transparencia total en nuestros procesos, costos y comunicaciones.'])
            @include('components.value-card', ['icon' => 'psychology', 'title' => 'Innovación', 'description' => 'Búsqueda constante de las últimas tecnologías y tendencias del mercado.'])
            @include('components.value-card', ['icon' => 'trending_up', 'title' => 'Mejora Continua', 'description' => 'Evolucionamos cada día para ofrecer siempre un servicio superior al anterior.'])
        </div>
    </div>
</section>

<!-- What We Do (SEO Summary) -->
<section class="py-24 px-6 bg-background-light dark:bg-background-dark">
    <div class="max-w-4xl mx-auto text-center">
        <h2 class="text-3xl font-bold mb-8">Nuestras Áreas de Expertise</h2>
        <div class="flex flex-wrap justify-center gap-4">
            <span class="px-6 py-2 bg-white dark:bg-slate-800 shadow-sm rounded-full text-sm font-medium border border-slate-200 dark:border-slate-700">Diseño Gráfico</span>
            <span class="px-6 py-2 bg-white dark:bg-slate-800 shadow-sm rounded-full text-sm font-medium border border-slate-200 dark:border-slate-700">Desarrollo Web</span>
            <span class="px-6 py-2 bg-white dark:bg-slate-800 shadow-sm rounded-full text-sm font-medium border border-slate-200 dark:border-slate-700">Marketing Digital</span>
            <span class="px-6 py-2 bg-white dark:bg-slate-800 shadow-sm rounded-full text-sm font-medium border border-slate-200 dark:border-slate-700">Branding</span>
            <span class="px-6 py-2 bg-white dark:bg-slate-800 shadow-sm rounded-full text-sm font-medium border border-slate-200 dark:border-slate-700">Soluciones IT</span>
            <span class="px-6 py-2 bg-white dark:bg-slate-800 shadow-sm rounded-full text-sm font-medium border border-slate-200 dark:border-slate-700">E-commerce</span>
        </div>
        <p class="mt-10 text-slate-500 italic">
            En Multiservicios Creativos Torres Hernández, integramos cada una de estas disciplinas para ofrecer un servicio 360° que potencie su presencia de marca y eficiencia operativa.
        </p>
    </div>
</section>

@endsection