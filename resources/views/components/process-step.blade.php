<div class="relative z-10 flex flex-col items-center text-center gap-6">
    <div class="w-20 h-20 rounded-full bg-gray-900 border-2 {{ $isPrimary ?? false ? 'border-primary shadow-[0_0_20px_rgba(19,91,236,0.3)]' : 'border-gray-800' }} flex items-center justify-center text-2xl font-bold">
        {{ $number }}
    </div>
    <div class="space-y-2">
        <h4 class="text-xl font-bold">{{ $title }}</h4>
        <p class="text-gray-400 text-sm">{{ $description }}</p>
    </div>
</div>