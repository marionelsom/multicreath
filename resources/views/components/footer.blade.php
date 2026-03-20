<footer class="bg-slate-900 text-white py-16 px-6">
    <div class="max-w-7xl mx-auto grid md:grid-cols-3 gap-12 border-b border-slate-800 pb-12 mb-12">
        <div>
            <div class="flex items-center gap-3 text-primary mb-6">
                <div class="size-6">
                    <svg fill="none" viewBox="0 0 48 48" xmlns="http://www.w3.org/2000/svg">
                        <path clip-rule="evenodd" d="M24 0.757355L47.2426 24L24 47.2426L0.757355 24L24 0.757355ZM21 35.7574V12.2426L9.24264 24L21 35.7574Z" fill="currentColor" fill-rule="evenodd"></path>
                    </svg>
                </div>
                <h2 class="text-xl font-bold text-white">MULTICREATH</h2>
            </div>
            <p class="text-slate-400">Transformando el panorama digital de El Salvador con creatividad y tecnología de punta.</p>
        </div>
        <div>
            <h4 class="font-bold mb-6">Navegación</h4>
            <ul class="space-y-4 text-slate-400">
                <li><a class="hover:text-primary transition-colors" href="{{ route('home') }}">Inicio</a></li>
                <li><a class="hover:text-primary transition-colors" href="{{ route('home') }}#servicios">Servicios</a></li>
                <li><a class="hover:text-primary transition-colors" href="{{ route('proyectos') }}">Proyectos</a></li>
                <li><a class="hover:text-primary transition-colors" href="{{ route('home') }}#contacto">Contacto</a></li>
            </ul>
        </div>
        <div>
            <h4 class="font-bold mb-6">Ubicación</h4>
            <div class="flex gap-4 items-start text-slate-400 mb-4">
                <span class="material-symbols-outlined text-primary">location_on</span>
                <p>San Miguel, El Salvador</p>
            </div>
            <div class="flex gap-4 items-start text-slate-400">
                <span class="material-symbols-outlined text-primary">mail</span>
                <p>info@multicreath.com</p>
            </div>
        </div>
    </div>
    <div class="max-w-7xl mx-auto flex flex-col md:flex-row justify-between items-center text-slate-500 text-sm">
        <p>© 2024 Multiservicios Creativos Torres Hernández. Todos los derechos reservados.</p>
        <div class="flex gap-6 mt-4 md:mt-0">
            <a class="hover:text-white transition-colors" href="#">Privacidad</a>
            <a class="hover:text-white transition-colors" href="#">Términos</a>
        </div>
    </div>
</footer>