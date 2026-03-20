@extends('layouts.app')

@section('title', 'MULTICREATH | Soluciones Creativas y Tecnológicas')

@section('content')

<!-- Hero Section -->
<section class="relative px-6 lg:px-20 py-20 lg:py-32 bg-[#f0f1f4] dark:bg-gray-900/50">
    <div class="max-w-[1200px] mx-auto">
        <div class="grid lg:grid-cols-2 gap-12 items-center">
            <div class="flex flex-col gap-8">
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-primary/10 text-primary text-xs font-bold uppercase tracking-wider w-fit">
                    <span class="relative flex h-2 w-2">
                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-primary opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-2 w-2 bg-primary"></span>
                    </span>
                    Agencia Creativa & IT
                </div>
                <h1 class="text-5xl lg:text-7xl font-bold leading-[1.1] tracking-tighter text-[#0d121b] dark:text-white">
                    Soluciones creativas y tecnológicas <span class="text-primary">en un solo lugar</span>
                </h1>
                <p class="text-lg lg:text-xl text-gray-600 dark:text-gray-400 max-w-[500px] leading-relaxed">
                    Impulsamos tu marca con diseño de vanguardia, impresión de alta calidad y soluciones IT a medida para el mundo digital.
                </p>
                <div class="flex flex-wrap gap-4">
                    <button class="h-14 px-10 bg-[#0d121b] dark:bg-white text-white dark:text-black font-bold rounded-lg hover:bg-gray-800 dark:hover:bg-gray-200 transition-all">
                        Ver servicios
                    </button>
                    <button class="h-14 px-10 border-2 border-[#0d121b] dark:border-white font-bold rounded-lg hover:bg-[#0d121b] hover:text-white dark:hover:bg-white dark:hover:text-black transition-all">
                        Nuestro portafolio
                    </button>
                </div>
            </div>
            <div class="relative">
                <div class="aspect-square w-full rounded-2xl bg-gray-200 dark:bg-gray-800 overflow-hidden shadow-2xl">
                    <img alt="Modern minimalist creative agency workspace" class="w-full h-full object-cover grayscale hover:grayscale-0 transition-all duration-700" src="https://lh3.googleusercontent.com/aida-public/AB6AXuD5sD_USXmiR3zb06xQS5hMbu24Ys-8ZjwJdNc0OANormyiY1HkCPzdpUxTNUUWvsvhgti6UuWpXfBzsj8TQH98cZqg3UDIOKZaCozKiH_u3y0Ykkll-i4B1jLPzX-1vQdlu445W86OFeprzOg-m5U8FSlwRsJOalWUHSuVmbv4N0os2uusf39GGGM4skLR3aUiHKyD-eHR5q9--bAxr9scEGYL5TApgEMOok_xf6n5TfPVsN_HnPW3bXljzSJ8S02y-2r_V82twkE"/>
                </div>
                <div class="absolute -bottom-6 -left-6 bg-white dark:bg-gray-800 p-6 rounded-xl shadow-xl hidden md:block">
                    <div class="flex items-center gap-4">
                        <div class="bg-primary/20 p-3 rounded-lg text-primary">
                            <span class="material-symbols-outlined">rocket_launch</span>
                        </div>
                        <div>
                            <p class="text-2xl font-bold text-[#0d121b] dark:text-white">500+</p>
                            <p class="text-sm text-gray-500 uppercase font-medium">Proyectos Finalizados</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Services Section -->
<section class="px-6 lg:px-20 py-24 bg-background-light dark:bg-background-dark" id="servicios">
    <div class="max-w-[1200px] mx-auto">
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 mb-16">
            <div class="max-w-[600px]">
                <h2 class="text-sm font-bold text-primary uppercase tracking-[0.2em] mb-4">Servicios Integrales</h2>
                <h3 class="text-4xl lg:text-5xl font-bold leading-tight tracking-tight">Especialistas en transformar ideas en realidad</h3>
            </div>
            <p class="text-gray-500 dark:text-gray-400 max-w-[400px]">
                Ofrecemos una amplia gama de servicios diseñados para satisfacer todas tus necesidades creativas y técnicas bajo un mismo techo.
            </p>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @include('components.service-card', ['icon' => 'palette', 'title' => 'Diseño Gráfico', 'description' => 'Identidad visual, logotipos y branding profesional que capturan la esencia de tu negocio.'])
            @include('components.service-card', ['icon' => 'print', 'title' => 'Impresión', 'description' => 'Material publicitario, papelería corporativa y acabados premium de alta resolución.'])
            @include('components.service-card', ['icon' => 'content_cut', 'title' => 'Corte de Vinil', 'description' => 'Rotulación vehicular, señalética y decoración de espacios con la mejor precisión del mercado.'])
            @include('components.service-card', ['icon' => 'terminal', 'title' => 'Servicios IT', 'description' => 'Soporte técnico especializado, redes, desarrollo de software y mantenimiento preventivo.'])
            @include('components.service-card', ['icon' => 'inventory_2', 'title' => 'Productos Personalizados', 'description' => 'Merchandising exclusivo, regalos corporativos y artículos promocionales únicos.'])
            
            <div class="p-10 rounded-2xl bg-primary flex flex-col justify-center items-center text-center text-white gap-6">
                <h4 class="text-2xl font-bold">¿Tienes un proyecto especial?</h4>
                <p class="text-white/80">Estamos listos para afrontar nuevos retos creativos.</p>
                <button class="w-full h-12 bg-white text-primary font-bold rounded-lg hover:bg-gray-100 transition-colors">
                    Contáctanos hoy
                </button>
            </div>
        </div>
    </div>
</section>

<!-- Projects Section -->
<section class="px-6 lg:px-20 py-24 bg-white dark:bg-[#0a0f18]" id="proyectos">
    <div class="max-w-[1200px] mx-auto">
        <div class="text-center mb-16">
            <h2 class="text-sm font-bold text-primary uppercase tracking-[0.2em] mb-4">Nuestro Trabajo</h2>
            <h3 class="text-4xl lg:text-5xl font-bold tracking-tight mb-8">Nuestros Proyectos</h3>
            <div class="flex flex-wrap justify-center gap-4 text-sm font-bold uppercase tracking-wider">
                <button class="px-6 py-2 bg-primary text-white rounded-full">Todos</button>
                <button class="px-6 py-2 text-gray-400 hover:text-[#0d121b] dark:hover:text-white transition-colors">Diseño Gráfico</button>
                <button class="px-6 py-2 text-gray-400 hover:text-[#0d121b] dark:hover:text-white transition-colors">Branding</button>
                <button class="px-6 py-2 text-gray-400 hover:text-[#0d121b] dark:hover:text-white transition-colors">Web & IT</button>
            </div>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @include('components.project-card', ['category' => 'Branding', 'title' => 'Identidad Corporativa Nexus', 'aspect' => 'aspect-[4/5]', 'image' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuD0oY-djCxV4nHUQDdSzg1kGP6sqrGBn1ReBPu-VHxk2ZoYehtwD1fi3JZFpiJI7BNeAhJcqvanFdjd3OjvZNsa44xaq-vzYjptQjEVmrqFLj29l5XirjcgNNQWXRG9z1aCuCUcaqkZbQBjtNQnaxwxGlJo24YZ16P39aDXPiuK2i9pIm4nfIm874uBIsLsUg91o85G3L21PcezSy6c9o3BKhHF0-0mJq8c5PxyFsCNbdCToBnuz-5Mrzogi9QutDqotRYK6OOy-Oc'])
            @include('components.project-card', ['category' => 'Web & IT', 'title' => 'Plataforma E-commerce V1', 'aspect' => 'aspect-square', 'image' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuAV46NlycoPcm5kVwepIT6ILY7EOhmnF6sLrguuo0ApGpNRwA0pBWa-6AVuySPL-CTYBtaRLgtmKJHe_lNjWDTlRJLOntd1-YfLDX0OralcVF0W6qEqvvuR7LNGNmezWwgx6a1jVvHb_Tq7CfC3OClJDtLSBnzIjcuPK-4ojNhkTxqldR5dKiWILXUkfR8Xfd8D835HKBcTju1BfCI2b6sxflYtohJasXcdE0d8qwyQRTIEw_c7bH9TE6-SPZ6MSg1pQ2ent8byN0c'])
            @include('components.project-card', ['category' => 'Diseño Gráfico', 'title' => 'Packaging Premium Artesanal', 'aspect' => 'aspect-[4/3]', 'image' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuAlcp3z1g62e-IFCWyEzc6m_JRveI07to93oBJ-Lj4Q6mh3n95rshaLLgKMF0EKoW-UpFZLdBTEoj8JzPIwIrxYgPv2w2AHeV1SmllEQYhesHYNbRKHD4nbth4v-tkE0uV_hlZ2MvocAsuwrmgre6Oe7MeavG-v_mSQPsWbHYQ4lkxzT6qnQSAf_MqNrZ-HSHkIKjHC7WujN00ZHve_h_c4w-5mzPRVjCawwSXfcx_tERmNxSpG9uNcbgBy9llwm5tzcMnkPBbONFU'])
            @include('components.project-card', ['category' => 'Rotulación', 'title' => 'Flotilla Empresarial Logística', 'aspect' => 'lg:col-span-2 lg:aspect-video', 'image' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuC2ax9rySJvO-Tp6H02UaLoL0eYY5GeTG6tHPBja6zYnHGtVcwcZtyMTz01-r4yl_04_YFdp_tNlu2y8ZcmscKaqYw5bfj3D2cz2Li2zxiRZFx4z9YG-0qKG2vvK0ameDPzAbKAwQ6enr_U3_zcr58FN7z95gF4NC7OE1vLll3MIGffN0HftYqTlPzov0aWrLkpAHhPSk9FLaMKjO3WcrkiGBGYOH0aQjqxbadIu0ooX1dBmF-6FvPr0UkaP8LBrQzyX0vTqIWowzs'])
            @include('components.project-card', ['category' => 'Impresión', 'title' => 'Papelería Premium Soft-Touch', 'aspect' => 'aspect-square', 'image' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuDtTtQYERlld6mgUApCMRatedyXFKiHYH9LUJYc0M7J7T2CsIKkH6D_zHPXdzHiw7-g3JvWBug8Yz15GKHkzej1Ufqbm-6h6TQJdkrWANHRFu0xUDcvaiknI8yHCaOf2Dwfx3M8p1iUBf2k3cJokvtMROccThK4DHxWaOAi9O4bT_Xj0WnCRgkNbmd1xaMqpYO2Ol8FCyhRN5oTt1V5MH7H0hjO0zKMR3GQE3x96eA2TlXLJuZ7Sk3Nj0WVQID8e86Tdn77pn9DftY'])
        </div>
        <div class="mt-16 text-center">
            <button class="px-10 h-14 border border-[#0d121b] dark:border-white text-[#0d121b] dark:text-white font-bold rounded-lg hover:bg-[#0d121b] hover:text-white dark:hover:bg-white dark:hover:text-black transition-all">
                Ver más proyectos
            </button>
        </div>
    </div>
</section>

<!-- Process Section -->
<section class="px-6 lg:px-20 py-24 bg-[#0d121b] text-white" id="proceso">
    <div class="max-w-[1200px] mx-auto">
        <div class="text-center mb-20">
            <h2 class="text-primary text-sm font-bold uppercase tracking-[0.2em] mb-4">Nuestro Proceso</h2>
            <h3 class="text-4xl lg:text-5xl font-bold tracking-tight">Cómo trabajamos juntos</h3>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-4 gap-12 relative">
            <div class="hidden md:block absolute top-[50px] left-[10%] right-[10%] h-[1px] bg-gray-800 z-0"></div>
            @include('components.process-step', ['number' => '01', 'title' => 'Descubrimiento', 'description' => 'Entendemos tus objetivos, audiencia y los desafíos de tu marca.', 'isPrimary' => true])
            @include('components.process-step', ['number' => '02', 'title' => 'Estrategia', 'description' => 'Trazamos el plan creativo y tecnológico ideal para tu caso.'])
            @include('components.process-step', ['number' => '03', 'title' => 'Producción', 'description' => 'Ejecutamos el diseño o desarrollo con estándares de alta calidad.'])
            @include('components.process-step', ['number' => '04', 'title' => 'Entrega', 'description' => 'Lanzamos tu proyecto y brindamos el soporte necesario.'])
        </div>
    </div>
</section>

<!-- Contact Section -->
<section class="px-6 lg:px-20 py-24 bg-background-light dark:bg-background-dark" id="contacto">
    <div class="max-w-[1200px] mx-auto bg-[#0d121b] rounded-3xl overflow-hidden shadow-2xl flex flex-col lg:flex-row">
        <div class="flex-1 p-12 lg:p-20 text-white flex flex-col justify-center gap-8">
            <h2 class="text-4xl lg:text-6xl font-bold leading-tight tracking-tighter">¿Listo para elevar <br/><span class="text-primary">tu marca?</span></h2>
            <p class="text-xl text-gray-400 leading-relaxed max-w-[450px]">
                Hablemos sobre cómo nuestras soluciones pueden transformar tu presencia digital y física.
            </p>
            <div class="flex flex-col gap-4">
                <div class="flex items-center gap-4 text-gray-400">
                    <span class="material-symbols-outlined text-primary">mail</span>
                    <span class="text-lg">info@multicreath.com</span>
                </div>
                <div class="flex items-center gap-4 text-gray-400">
                    <span class="material-symbols-outlined text-primary">call</span>
                    <span class="text-lg">+503 7918-9561</span>
                </div>
                <div class="flex items-center gap-4 text-gray-400">
                    <span class="material-symbols-outlined text-primary">location_on</span>
                    <span class="text-lg">San Miguel, El Salvador</span>
                </div>
            </div>
        </div>
        <div class="flex-1 bg-white dark:bg-gray-900 p-12 lg:p-20">
    <form id="contactForm" class="flex flex-col gap-6">
        @csrf
        <div class="grid md:grid-cols-2 gap-6">
            <div class="flex flex-col gap-2">
                <label class="text-sm font-bold uppercase tracking-wider text-gray-500">Nombre</label>
                <input 
                    id="nombre"
                    name="nombre"
                    class="h-12 px-4 rounded-lg bg-gray-100 dark:bg-gray-800 border-none focus:ring-2 focus:ring-primary outline-none text-[#0d121b] dark:text-white" 
                    placeholder="Tu nombre" 
                    type="text"
                    required
                />
                <span class="error-nombre text-red-500 text-sm hidden"></span>
            </div>
            <div class="flex flex-col gap-2">
                <label class="text-sm font-bold uppercase tracking-wider text-gray-500">Email</label>
                <input 
                    id="email"
                    name="email"
                    class="h-12 px-4 rounded-lg bg-gray-100 dark:bg-gray-800 border-none focus:ring-2 focus:ring-primary outline-none text-[#0d121b] dark:text-white" 
                    placeholder="email@ejemplo.com" 
                    type="email"
                    required
                />
                <span class="error-email text-red-500 text-sm hidden"></span>
            </div>
        </div>
        <div class="flex flex-col gap-2">
            <label class="text-sm font-bold uppercase tracking-wider text-gray-500">Servicio de Interés</label>
            <select 
                id="servicio"
                name="servicio"
                class="h-12 px-4 rounded-lg bg-gray-100 dark:bg-gray-800 border-none focus:ring-2 focus:ring-primary outline-none text-[#0d121b] dark:text-white"
                required
            >
                <option value="">Selecciona un servicio</option>
                <option value="Diseño Gráfico">Diseño Gráfico</option>
                <option value="Impresión / Corte">Impresión / Corte</option>
                <option value="Servicios IT">Servicios IT</option>
                <option value="Otros">Otros</option>
            </select>
            <span class="error-servicio text-red-500 text-sm hidden"></span>
        </div>
        <div class="flex flex-col gap-2">
            <label class="text-sm font-bold uppercase tracking-wider text-gray-500">Mensaje</label>
            <textarea 
                id="mensaje"
                name="mensaje"
                class="p-4 rounded-lg bg-gray-100 dark:bg-gray-800 border-none focus:ring-2 focus:ring-primary outline-none text-[#0d121b] dark:text-white" 
                placeholder="Cuéntanos más sobre tu proyecto..." 
                rows="4"
                required
            ></textarea>
            <span class="error-mensaje text-red-500 text-sm hidden"></span>
        </div>
        <button 
            id="submitBtn"
            type="submit"
            class="h-14 bg-primary text-white font-bold rounded-lg hover:bg-blue-700 transition-colors shadow-lg shadow-primary/20 disabled:opacity-50"
        >
            Enviar Mensaje
        </button>
        <div id="successMessage" class="hidden p-4 bg-green-100 text-green-700 rounded-lg"></div>
        <div id="errorMessage" class="hidden p-4 bg-red-100 text-red-700 rounded-lg"></div>
    </form>
</div>

<script>
document.getElementById('contactForm').addEventListener('submit', async function(e) {
    e.preventDefault();
    
    const submitBtn = document.getElementById('submitBtn');
    const successMessage = document.getElementById('successMessage');
    const errorMessage = document.getElementById('errorMessage');
    
    // Limpiar mensajes previos
    successMessage.classList.add('hidden');
    errorMessage.classList.add('hidden');
    document.querySelectorAll('.error-nombre, .error-email, .error-servicio, .error-mensaje').forEach(el => {
        el.classList.add('hidden');
    });
    
    // Deshabilitar botón
    submitBtn.disabled = true;
    submitBtn.textContent = 'Enviando...';
    
    const formData = new FormData(this);
    
    try {
        const response = await fetch('/api/contact', {
            method: 'POST',
            body: formData,
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        });
        
        const data = await response.json();
        
        if (data.success) {
            successMessage.textContent = data.message;
            successMessage.classList.remove('hidden');
            document.getElementById('contactForm').reset();
        } else {
            errorMessage.textContent = data.message;
            errorMessage.classList.remove('hidden');
        }
    } catch (error) {
        errorMessage.textContent = 'Error al enviar el mensaje. Por favor, intenta de nuevo.';
        errorMessage.classList.remove('hidden');
    } finally {
        submitBtn.disabled = false;
        submitBtn.textContent = 'Enviar Mensaje';
    }
});
</script>
    </div>
</section>

@endsection