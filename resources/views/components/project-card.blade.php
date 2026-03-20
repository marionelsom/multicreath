<div class="group relative overflow-hidden rounded-2xl bg-gray-100 dark:bg-gray-800 border border-gray-100 dark:border-gray-800 shadow-sm transition-all hover:-translate-y-1 {{ $aspect ?? 'aspect-square' }} w-full">
    <div class="w-full h-full overflow-hidden">
        <img alt="{{ $title }}" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110" src="{{ $image }}"/>
    </div>
    <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex flex-col justify-end p-8 text-white">
        <span class="text-xs font-bold uppercase tracking-widest text-primary mb-2">{{ $category }}</span>
        <h4 class="text-2xl font-bold">{{ $title }}</h4>
    </div>
    <div class="p-6 md:hidden">
        <span class="text-xs font-bold uppercase tracking-widest text-primary mb-1 block">{{ $category }}</span>
        <h4 class="text-xl font-bold">{{ $title }}</h4>
    </div>
</div>