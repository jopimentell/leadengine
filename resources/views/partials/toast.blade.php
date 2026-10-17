<div x-data="{ show: false, message: '', type: 'success' }"
     x-on:notify.window="show = true; message = $event.detail.message; type = $event.detail.type || 'success'; setTimeout(() => show = false, 4000)"
     x-show="show"
     x-transition:enter="transform ease-out duration-300"
     x-transition:enter-start="translate-y-2 opacity-0"
     x-transition:enter-end="translate-y-0 opacity-100"
     x-transition:leave="transform ease-in duration-200"
     x-transition:leave-start="translate-y-0 opacity-100"
     x-transition:leave-end="translate-y-2 opacity-0"
     class="fixed bottom-6 right-6 z-50 max-w-md w-full"
     style="display: none;">
    <div class="rounded-xl shadow-soft border border-gray-200 bg-white p-4 flex items-center gap-3"
         :class="type === 'success' ? 'border-l-4 border-l-[#05b169]' : 'border-l-4 border-l-[#cf202f]'">
        <div :class="type === 'success' ? 'text-[#05b169]' : 'text-[#cf202f]'">
            <i class="fa-solid" :class="type === 'success' ? 'fa-check-circle' : 'fa-exclamation-circle'"></i>
        </div>
        <span class="text-sm text-ink flex-1" x-text="message"></span>
        <button @click="show = false" class="text-muted-soft hover:text-ink transition-soft">
            <i class="fa-solid fa-xmark"></i>
        </button>
    </div>
</div>
