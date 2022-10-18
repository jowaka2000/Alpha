<div>
    <div class="{{$isOpen ? '' : 'hidden'}} absolute md:hidden w-48 h-full bg-slate-600 text-base space-y-1">

        @include('pages.side-nav-bar')

    </div>

    <div class="flex md:hidden justify-between bg-gray-500 p-2">
        <button wire:click="openSideBar">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
        </button>

        <div>
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
        </div>
    </div>
</div>
