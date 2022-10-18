<div class="w-full md:p-10 px-4 py-2 space-y-4">
    <div class="text-neutral-300 text-4xl font-semibold">@yield('tittle','writers')</div>
 
    <div class="flex text-neutral-300 space-x-4 text-lg border-b-2 border-slate-500">
       <button wire:click="allButton" class="hover:text-neutral-400 {{request()->routeIs('writers') || request()->routeIs('clients') ? 'border-b-4 border-slate-800 font-bold' : ''}}">{{request()->routeis('writers') ? 'All Writers' : 'All Clients'}}</button>
       <button wire:click="myButton" class="hover:text-neutral-400 {{request()->routeIs('my-writers') || request()->routeIs('my-clients') ? 'border-b-4 border-slate-800 font-bold' : ''}}">{{request()->routeis('my-writers') ? 'My Writers' : 'My Clients'}}</button>
       <button wire:click="blockedButton" class="hover:text-neutral-400 {{request()->routeIs('blocked-writers') || request()->routeIs('blocked-clients') ? 'border-b-4 border-slate-800 font-bold' : ''}}">{{request()->routeis('blocked-writers') ? 'blocked Writers' : 'Blocked Clients'}}</button>
    </div>
 
    @yield('content')
</div>