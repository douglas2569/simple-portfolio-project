@props(['text'])

<div x-data="{
    copyText: '{{$text}}',
    copyNotification: false,
    copyToClipboard() {
        navigator.clipboard.writeText(this.copyText);
        this.copyNotification = true;
        let that = this;
        setTimeout(function(){
            that.copyNotification = false;
        }, 3000);
    }
}" class="relative z-20 flex items-center">


    <div
        x-show="copyNotification"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 translate-x-2"
        x-transition:enter-end="opacity-100 translate-x-0"
        x-transition:leave="transition ease-in duration-300"
        x-transition:leave-start="opacity-100 translate-x-0"
        x-transition:leave-end="opacity-0 translate-x-2"
        class="absolute left-0"
        x-cloak>

        <div class="px-3 h-7 -ml-1.5 items-center flex text-xs bg-green-500 border-r border-green-500 -translate-x-full text-white rounded">
            <span>Copied!</span>
            <div class="absolute right-0 inline-block h-full -mt-px overflow-hidden translate-x-3 -translate-y-2 top-1/2">
                <div class="w-3 h-3 origin-top-left transform rotate-45 bg-green-500 border border-transparent"></div>
            </div>
        </div>
    </div>
    <button
        @click="copyToClipboard();"
        class="flex items-center justify-center h-8 text-xs bg-white border rounded-md cursor-pointer w-9 border-neutral-200/60 hover:bg-neutral-100 active:bg-white focus:bg-white focus:outline-none text-neutral-500 hover:text-neutral-600 group">
        <svg x-show="copyNotification" class="w-4 h-4 text-green-500 stroke-current" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" x-cloak>
            <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
        </svg>
        <svg x-show="!copyNotification" class="w-4 h-4 stroke-current" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <g fill="none" stroke="none">
                <path d="M7.75 7.757V6.75a3 3 0 0 1 3-3h6.5a3 3 0 0 1 3 3v6.5a3 3 0 0 1-3 3h-.992" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                </path>
                <path d="M3.75 10.75a3 3 0 0 1 3-3h6.5a3 3 0 0 1 3 3v6.5a3 3 0 0 1-3 3h-6.5a3 3 0 0 1-3-3v-6.5z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                </path>
            </g>
        </svg>
    </button>
</div>