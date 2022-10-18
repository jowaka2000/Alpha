<div class="flex space-x-4 text-lg border-b-2 border-slate-500">
    <button class="text-neutral-300 hover:text-neutral-400 {{request()->routeIs('bids.my-bids') ? 'border-b-4 border-slate-800 font-bold' : ''}}" wire:click="myBids" title="This are all orders your clients has posted">My Bids</button>
    <button class="hover:text-red-600 text-red-500 {{request()->routeIs('bids.rejected-bids') ? 'border-b-4 border-slate-800 font-bold' : ''}}" wire:click="rejectedBids">Rejected Bids</button>
</div>

