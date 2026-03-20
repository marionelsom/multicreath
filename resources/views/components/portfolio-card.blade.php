<div class="group project-card cursor-pointer">
    <div class="browser-mockup relative bg-white dark:bg-slate-800 rounded-xl overflow-hidden shadow-2xl border border-primary/5">
        
        <!-- Browser Header -->
        <div class="flex items-center gap-2 px-4 py-3 bg-slate-100 dark:bg-slate-900 border-b border-primary/5">
            <div class="flex gap-1.5">
                <div class="w-3 h-3 rounded-full bg-red-400"></div>
                <div class="w-3 h-3 rounded-full bg-amber-400"></div>
                <div class="w-3 h-3 rounded-full bg-emerald-400"></div>
            </div>
            <div class="mx-auto bg-white/50 dark:bg-white/10 px-4 py-0.5 rounded text-[10px] text-slate-400 font-mono">
                {{ $domain }}
            </div>
        </div>

        <!-- Browser Content -->
        <div class="relative aspect-[16/10] overflow-hidden">
            <img alt="{{ $title }}" class="w-full h-full object-cover" src="{{ $image }}"/>
            
            <!-- Overlay on Hover -->
            <div class="project-overlay absolute inset-0 bg-primary/90 flex flex-col justify-center items-center text-center p-8">
                <h3 class="text-white text-3xl font-bold mb-4">{{ $title }}</h3>
                <p class="text-white/80 mb-8 max-w-sm">{{ $description }}</p>
                <button class="bg-white text-primary px-8 py-3 rounded-full font-bold hover:bg-slate-100 transition-colors flex items-center gap-2">
                    Ver sitio en vivo 
                    <span class="material-icons text-sm">open_in_new</span>
                </button>
            </div>
        </div>
    </div>

    <!-- Project Info -->
    <div class="mt-6">
        <div class="flex justify-between items-start">
            <div>
                <h4 class="text-xl font-bold">{{ $title }}</h4>
                <p class="text-slate-500 dark:text-slate-400">{{ $category }}</p>
            </div>
            <span class="text-primary font-semibold">{{ $year }}</span>
        </div>
    </div>
</div>