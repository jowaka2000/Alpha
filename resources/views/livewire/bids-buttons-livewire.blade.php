<div class="flex space-x-4 text-lg text-neutral-300 border-b-2 border-slate-500">
    <button class="hover:text-neutral-400 {{request()->routeIs('orders.show-my-writers') ? 'border-b-4 border-slate-800 font-bold' : ''}}" wire:click="myWriters" title="This are all orders your clients has posted">My Writers</button>
    <a href="" class="hover:text-neutral-400 {{request()->routeIs('bid.all') ? 'border-b-4 border-slate-800 font-bold' : ''}}" wire:click="all">All Writers</a>
    <button class="hover:text-neutral-400 {{request()->routeIs('bid.shortlisted') ? 'border-b-4 border-slate-800 font-bold' : ''}}" wire:click="shortlisted">Shortlisted Invited</button>
</div>
