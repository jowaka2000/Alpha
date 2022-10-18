<div class="flex space-x-4 text-lg text-neutral-300 border-b-2 border-slate-500">
    <button class="hover:text-neutral-400 {{request()->routeIs('orders') ? 'border-b-4 border-slate-800 font-bold' : ''}}" wire:click="allOrdersButton">All</button>
    <button class="hover:text-neutral-400 {{request()->routeIs('my-orders') ? 'border-b-4 border-slate-800 font-bold' : ''}}" wire:click="myOrdersButton" title="This are all orders your clients has posted">My Orders</button>
    <button class="hover:text-neutral-400 {{request()->routeIs('invited-orders') ? 'border-b-4 border-slate-800 font-bold' : ''}}" wire:click="invitedOrdersButton">Invited</button>
</div>
