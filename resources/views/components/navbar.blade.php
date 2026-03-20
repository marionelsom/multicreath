<header class="sticky top-0 z-50 bg-background-light/80 dark:bg-background-dark/80 backdrop-blur-md border-b border-solid border-[#e7ebf3] dark:border-gray-800 px-6 lg:px-20 py-4">
    <div class="max-w-[1200px] mx-auto flex items-center justify-between whitespace-nowrap">
        <a href="{{ route('home') }}" class="flex items-center gap-3">
            <div class="text-primary">
                <svg class="size-7" fill="none" viewBox="0 0 48 48" xmlns="http://www.w3.org/2000/svg">
                    <path clip-rule="evenodd" d="M24 0.757355L47.2426 24L24 47.2426L0.757355 24L24 0.757355ZM21 35.7574V12.2426L9.24264 24L21 35.7574Z" fill="currentColor" fill-rule="evenodd"></path>
                </svg>
            </div>
            <h2 class="text-xl font-bold leading-tight tracking-tight uppercase">MULTICREATH</h2>
        </a>
        <div class="hidden md:flex flex-1 justify-end gap-10 items-center">
            <nav class="flex items-center gap-8">
                <a class="text-sm font-medium hover:text-primary transition-colors" href="{{ route('home') }}#servicios">Servicios</a>
                <a class="text-sm font-medium hover:text-primary transition-colors" href="{{ route('proyectos') }}">Proyectos</a>
                <a class="text-sm font-medium hover:text-primary transition-colors" href="{{ route('nosotros') }}">Sobre nosotros</a>
                <a class="text-sm font-medium hover:text-primary transition-colors" href="{{ route('home') }}#proceso">Proceso</a>
                <a class="text-sm font-medium hover:text-primary transition-colors" href="{{ route('home') }}#contacto">Contacto</a>
            </nav>
            <a href="{{ route('home') }}#contacto" class="flex min-w-[120px] cursor-pointer items-center justify-center rounded-full h-11 px-6 bg-[#0d121b] dark:bg-white text-white dark:text-black text-sm font-bold transition-transform hover:scale-105">
                Cotizar ahora
            </a>
        </div>
    </div>
</header>