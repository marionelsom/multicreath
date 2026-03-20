<div class="group p-10 rounded-2xl border border-gray-200 dark:border-gray-800 bg-white dark:bg-gray-900 hover:border-primary transition-all duration-300 flex flex-col gap-6 shadow-sm hover:shadow-xl">
    <div class="bg-gray-100 dark:bg-gray-800 w-16 h-16 rounded-xl flex items-center justify-center text-primary group-hover:bg-primary group-hover:text-white transition-colors">
        <span class="material-symbols-outlined !text-3xl">{{ $icon }}</span>
    </div>
    <div class="space-y-3">
        <h4 class="text-2xl font-bold">{{ $title }}</h4>
        <p class="text-gray-500 dark:text-gray-400 leading-relaxed">{{ $description }}</p>
    </div>
    {{-- <a class="mt-auto inline-flex items-center gap-2 text-sm font-bold uppercase tracking-wider text-primary" href="#">
    Saber más <span class="material-symbols-outlined !text-sm">arrow_forward</span>
</a> --}}
</div>