<div class="flex space-x-4 text-lg text-neutral-300 border-b-2 border-slate-500 font-semibold">
    <button class="hover:text-neutral-400 {{request()->routeIs('assigned') ? 'border-b-4 border-slate-800 font-bold' : ''}}" wire:click="assignedButton">In progress</button>
    <button class="hover:text-red-600 text-red-500 {{request()->routeIs('canceled') ? 'border-b-4 border-slate-800 font-bold' : ''}}" wire:click="canceledButton">Canceled</button>
</div>
