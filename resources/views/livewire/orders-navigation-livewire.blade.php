<div class="flex space-x-4 text-lg text-neutral-300 border-b-2 border-slate-500">

    <button class="hover:text-neutral-400 {{request()->routeIs('orders.index') ? 'border-b-4 border-slate-800 font-bold' : ''}}" wire:click="myOrders" title="This are all orders your clients has posted">My Orders</button>

    @cannot('viewAny', \App\Models\Order::class)
        <button href="" class="hover:text-neutral-400 {{request()->routeIs('orders.all') ? 'border-b-4 border-slate-800 font-bold' : ''}}" wire:click="allOrders">All Orders</button>

        <!--This is invited button, fixed it-->
        <!--
<button class="hover:text-neutral-400 {{request()->routeIs('orders.invited') ? 'border-b-4 border-slate-800 font-bold' : ''}}" wire:click="invitedOrders">Invited</button>
        -->
    @endcannot
</div>
