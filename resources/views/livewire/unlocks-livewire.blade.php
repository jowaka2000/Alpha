<div class="w-full">
    <div class="p-5 md:p-8 flex justify-between items-center">
        <div class="text-2xl md:text-3xl text-neutral-300 font-semibold">
            {{ request()->routeIs('unlocks.index') ? 'Unlocks Home' : (request()->routeIs('unlocks.in-progress') ? 'Unlocks In Progress' : 'Unlocks Completed') }}
        </div>

        <a href="{{route('withdraw.mpesa',auth()->user())}}" class="flex font-medium text-normal gap-2 md:text-lg text-neutral-400">
            <span>My Wallet:</span>
            <span class="text-green-500 font-bold underline">{{$wallet==null ? '$0.0 USD' : '$'.$wallet.' USD'}}</span>
        </a>
    </div>

    <div class="px-4 md:px-8 flex justify-between w-full items-center">
        <div class="">

            <div class="flex items-center gap-2">
                <span class="text-neutral-300 text-lg font-semibold">Pending</span><span
                class=" underline text-gray-400"><a class="opacity-75"
                    href="{{route('withdraw.unlocks.payments',auth()->user())}}">{{ $pending == 0 ? 'Ksh. 0.00' : 'Ksh. ' . $pending }}</a></span>
            </div>

            <div class="">
            <span class="text-orange-500 text-xs font-semibold">Pending amount will be availlable after 12hrs</span>

            </div>
        </div>

        <div>
            <a href="{{ route('unlocks.create') }}"
                class="bg-green-700 text-white px-2 md:px-3 py-1 hover:bg-green-600 text-sm md:text-normal rounded">Add Unlock</a>
        </div>
    </div>

    <div class="px-5 md:px-8 py-3">

        <div class="w-full">
            <nav class="flex gap-4 border-b border-slate-400">
                <button wire:click="homeButton"
                    class="text-neutral-300  hover:font-bold font-semibold {{ request()->routeIs('unlocks.index') ? 'border-b-4 border-slate-500 font-bold' : '' }}">Home</button>
                <button wire:click="inProgressButton"
                    class="font-semibold flex items-center hover:font-bold text-neutral-300 {{ request()->routeIs('unlocks.in-progress') ? 'border-b-4 border-slate-500 font-bold' : '' }}">
                    <span>In Progress </span>
                    @if ($inProgress > 0)
                        <span>({{ $inProgress }})</span>
                    @endif
                </button>
                <button wire:click="completedButton"
                    class="text-neutral-300 font-semibold hover:font-bold {{ request()->routeIs('unlocks-completed.index') ? 'border-b-4 border-slate-500 font-bold' : '' }}">Completed</button>
                <button wire:click="refundsButton"
                    class="text-neutral-300 flex items-center font-semibold hover:font-bold {{ request()->routeIs('unlock-refund.index') ? 'border-b-4 border-slate-500 font-bold' : '' }}">
                    <span>Refund</span>
                    @if ($refunds > 0)
                        <span>({{ $refunds }})</span>
                    @endif
                </button>
                </button>
                <button wire:click="draftButton"
                    class="text-neutral-300 font-semibold hover:font-bold {{ request()->routeIs('unlocks-draft') ? 'border-b-4 border-slate-500 font-bold' : '' }}">
                    <span>Draft</span>
                    @if ($draft > 0)
                        <span>({{ $draft }})</span>
                    @endif
                </button>
            </nav>
        </div>
    </div>

</div>
