<div class="h-full w-full space-y-1">

    <div class="flex justify-end px-2 mb-2 py-2 bg-slate-800">Wripper</div>

    <div class="flex items-center w-full hover:bg-slate-700 w-full pl-2">
        <select name="" id=""
            class="bg-transparent focus:ring-none w-full border-0 text-sm text-gray-400 text-sm font-medium"
            onchange="location = this.value">
            <option value="" class="bg-slate-700 mb-3" selected disabled>{{ \Illuminate\Support\Str::limit(strtoupper(auth()->user()->name), 15, '...') }}
            </option>
            <option value=""
                class="mb-3 bg-slate-700 text-gray-300 hover:bg-yellow-900 text-lg">My Profile</option>
            <option value="{{route('transaction-records.index')}}" class="mb-3 bg-slate-700 text-gray-300 text-lg hover:bg-yellow-900">Transactions</option>
            <option value="{{ route('logout') }}" class="mb-3 bg-slate-700 text-gray-300 hover:bg-yellow-900 text-lg">Logout</option>
        </select>
    </div>

    <div class="w-full border-b-2 border-slate-700"></div>



    <button wire:click="myProfileButton"
        class="flex justify-between items-center text-center w-full hover:bg-slate-700 text-neutral-300 px-3">
        <div class="flex space-x-1">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 ">
                <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0012 15.75a7.488 7.488 0 00-5.982 2.975m11.963 0a9 9 0 10-11.963 0m11.963 0A8.966 8.966 0 0112 21a8.966 8.966 0 01-5.982-2.275M15 9.75a3 3 0 11-6 0 3 3 0 016 0z" />
              </svg>
            <span>My Profile</span>
        </div>
    </button>





    @can('viewClient', \App\Models\User::class)
        <button wire:click="earningsButton"
            class="flex justify-between items-center text-center w-full hover:bg-slate-700 text-neutral-300 px-3  {{ request()->routeIs('earnings.index') || request()->routeIs('earnings.order') ? 'border-2 border-slate-700 bg-slate-700 hover:border-2 hover:border-slate-500' : '' }}">
            <div class="flex space-x-1">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M12 6v12m-3-2.818l.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span>Earnings</span>
            </div>
            <span class="px-2 font-bold text-xs rounded-full text-green-400">{{$wallet==null ? '$0.00 USD' : '$'.$wallet.' USD'}}</span>
        </button>
    @endcan

    @can('viewAny', \App\Models\User::class)
        <button wire:click="paymentsButton"
            class="flex justify-between items-center text-center w-full hover:bg-slate-700 text-neutral-300 px-3 {{ request()->routeIs('payments.index') || Request()->routeIs('payments.show') ? 'border-2 border-slate-700 bg-slate-700 hover:border-2 hover:border-slate-500' : '' }}">
            <div class="flex space-x-1">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M12 6v12m-3-2.818l.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span>Payments</span>
            </div>
            <span class="px-2 font-bold text-xs rounded-full text-green-400">{{$wallet==null ? '$0.00 USD' : '$'.$wallet.' USD'}}</span>
        </button>
    @endcan


    <button wire:click="notificationButton"
        class="flex justify-between items-center text-center w-full hover:bg-slate-700 text-neutral-300 px-3 py-1 {{ request()->routeIs('notification') ? 'border-2 border-slate-700 bg-slate-700 hover:border-2 hover:border-slate-500' : '' }}">
        <div class="flex space-x-1">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
            </svg>
            <span>Notification</span>
        </div>
        <span
            class="px-2 font-semibold rounded-full text-sm text-white bg-red-500">{{ $alerts == 0 ? '' : $alerts }}</span>
    </button>

    <div class="w-full border-b-2 border-slate-700"></div>


    <button wire:click="ordersButton"
        class="flex justify-between items-center text-center w-full hover:bg-slate-700 text-neutral-300 px-3 py-1
    {{ request()->routeIs('orders.index') || request()->routeIs('orders.show-my-writers') || request()->routeIs('orders.create') || request()->routeIs('orders.show-all-writers') || request()->routeIs('orders.show-shortlisted-writers') || request()->routeIs('orders.all') || request()->routeIs('orders.invited') ? 'border-2 border-slate-700 bg-slate-700 hover:border-2 hover:border-slate-500' : '' }}">
        <div class="flex space-x-1">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
            </svg>
            <span>Orders</span>
        </div>
        <span
            class="bg-slate-500 px-2 font-bold text-sm rounded-full">{{ $orders == 0 ? '' : ($orders > 99 ? '99+' : $orders) }}</span>
    </button>


    @cannot('viewAny', \App\Models\User::class)
        <button wire:click="bidsButton"
            class="flex justify-between items-center text-center w-full hover:bg-slate-700 text-neutral-300 px-3 py-1 {{ request()->routeIs('bids.index') ? 'border-2 border-slate-700 bg-slate-700' : '' }}">
            <div class="flex space-x-1">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mt-1" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                </svg>
                <span>My Bids</span>
            </div>
        </button>
    @endcannot

    <button wire:click="assignedButton"
        class="flex justify-between items-center text-center w-full hover:bg-slate-700 text-neutral-300 px-3 py-1  {{ request()->routeIs('assigned.index') || request()->routeIs('assigned.show') ? 'border-2 border-slate-700 bg-slate-700 hover:border-2 hover:border-slate-500' : '' }}">
        <div class="flex space-x-1">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mt-1" fill="none" viewBox="0 0 24 24"
                stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M12 8v13m0-13V6a2 2 0 112 2h-2zm0 0V5.5A2.5 2.5 0 109.5 8H12zm-7 4h14M5 12a2 2 0 110-4h14a2 2 0 110 4M5 12v7a2 2 0 002 2h10a2 2 0 002-2v-7" />
            </svg>
            <span>Assigned</span>
        </div>
        <span class="bg-slate-500 px-2 font-bold text-sm rounded-full">{{ $assigned == 0 ? '' : $assigned }}</span>
    </button>


    <button wire:click="completedButton"
        class="flex justify-between items-center text-center w-full hover:bg-slate-700 text-neutral-300 px-3 py-1 {{ request()->routeIs('completed.index') || request()->routeIs('completed.show') || request()->routeIs('completed.refund') || request()->routeIs('completed.aproved') ? 'border-2 border-slate-700 bg-slate-700 hover:border-2 hover:border-slate-500' : '' }}">
        <div class="flex space-x-1">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mt-1" fill="none" viewBox="0 0 24 24"
                stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
            </svg>
            <span>Completed</span>
        </div>
        <span class="bg-slate-500 px-2 font-bold text-sm rounded-full">{{ $pending == 0 ? '' : $pending }}</span>
    </button>


    <button wire:click="revisionButton"
        class="flex justify-between items-center text-center w-full hover:bg-slate-700 text-neutral-300 px-3  py-1 {{ request()->routeIs('revision.index') || request()->routeIs('revision.show') ? 'border-2 border-slate-700 bg-slate-700 hover:border-2 hover:border-slate-500' : '' }}">
        <div class="flex space-x-1">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="w-5 h-5 mt-1">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M9.879 7.519c1.171-1.025 3.071-1.025 4.242 0 1.172 1.025 1.172 2.687 0 3.712-.203.179-.43.326-.67.442-.745.361-1.45.999-1.45 1.827v.75M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9 5.25h.008v.008H12v-.008z" />
            </svg>
            <span>Revision</span>
        </div>
        <span class="bg-slate-500 px-2 font-bold text-sm rounded-full">{{ $revision == 0 ? '' : $revision }}</span>
    </button>

    <button wire:click="rejectedButton"
        class="flex justify-between items-center text-center w-full hover:bg-slate-700 text-neutral-300 px-3 py-1  {{ request()->routeIs('rejected.index') || request()->routeIs('rejected.show') ? 'border-2 border-slate-700 bg-slate-700 hover:border-2 hover:border-slate-500' : '' }}">
        <div class="flex space-x-1">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="w-5 h-5 mt-1">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M7.5 15h2.25m8.024-9.75c.011.05.028.1.052.148.591 1.2.924 2.55.924 3.977a8.96 8.96 0 01-.999 4.125m.023-8.25c-.076-.365.183-.75.575-.75h.908c.889 0 1.713.518 1.972 1.368.339 1.11.521 2.287.521 3.507 0 1.553-.295 3.036-.831 4.398C20.613 14.547 19.833 15 19 15h-1.053c-.472 0-.745-.556-.5-.96a8.95 8.95 0 00.303-.54m.023-8.25H16.48a4.5 4.5 0 01-1.423-.23l-3.114-1.04a4.5 4.5 0 00-1.423-.23H6.504c-.618 0-1.217.247-1.605.729A11.95 11.95 0 002.25 12c0 .434.023.863.068 1.285C2.427 14.306 3.346 15 4.372 15h3.126c.618 0 .991.724.725 1.282A7.471 7.471 0 007.5 19.5a2.25 2.25 0 002.25 2.25.75.75 0 00.75-.75v-.633c0-.573.11-1.14.322-1.672.304-.76.93-1.33 1.653-1.715a9.04 9.04 0 002.86-2.4c.498-.634 1.226-1.08 2.032-1.08h.384" />
            </svg>
            <span>Rejected</span>
        </div>
    </button>


    <div class="w-full border-b-2 border-slate-700"></div>


    @cannot('viewAny', \App\Models\User::class)
        <button wire:click="invitationButton"
            class="flex justify-between items-center text-center w-full hover:bg-slate-700 text-neutral-300 px-3  {{ request()->routeIs('invitation') ? 'border-2 border-slate-700 bg-slate-700 hover:border-2 hover:border-slate-500' : '' }}">
            <div class="flex space-x-1">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-5 h-5 mt-1">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M9 9V4.5M9 9H4.5M9 9L3.75 3.75M9 15v4.5M9 15H4.5M9 15l-5.25 5.25M15 9h4.5M15 9V4.5M15 9l5.25-5.25M15 15h4.5M15 15v4.5m0-4.5l5.25 5.25" />
                </svg>
                <span>Invitations</span>
            </div>
            <span
                class="bg-slate-500 px-2 font-bold text-sm rounded-full">{{ $invites == 0 ? '' : ($invites > 99 ? '99+' : $invites) }}</span>
        </button>

        <button wire:click="clientsButton"
            class="flex justify-between items-center text-center w-full hover:bg-slate-700 text-neutral-300 px-3  {{ request()->routeIs('users.clients') ? 'border-2 border-slate-700 bg-slate-700 hover:border-2 hover:border-slate-500' : '' }}">
            <div class="flex space-x-1">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mt-1" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                </svg>
                <span>Employers</span>
            </div>
        </button>
    @endcannot

    @can('viewAny', \App\Models\User::class)
        <button wire:click="invokeButton"
            class="flex justify-between items-center text-center w-full hover:bg-slate-700 text-neutral-300 px-3  {{ request()->routeIs('invoked') ? 'border-2 border-slate-700 bg-slate-700 hover:border-2 hover:border-slate-500' : '' }}">
            <div class="flex space-x-1">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-5 h-5 mt-1">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M9 9V4.5M9 9H4.5M9 9L3.75 3.75M9 15v4.5M9 15H4.5M9 15l-5.25 5.25M15 9h4.5M15 9V4.5M15 9l5.25-5.25M15 15h4.5M15 15v4.5m0-4.5l5.25 5.25" />
                </svg>
                <span>Invokes</span>
            </div>
            <span
                class="bg-slate-500 px-2 font-bold text-sm rounded-full">{{ $invokes == 0 ? '' : ($invokes > 99 ? '99+' : $invokes) }}</span>
        </button>


        <button wire:click="writersButton"
            class="flex justify-between items-center text-center w-full hover:bg-slate-700 text-neutral-300 px-3  {{ request()->routeIs('users.writers') || request()->routeIs('users.my-writers') ? 'border-2 border-slate-700 bg-slate-700 hover:border-2 hover:border-slate-500' : '' }}">
            <div class="flex space-x-1">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mt-1" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                </svg>
                <span>Writers</span>
            </div>
        </button>

        <button wire:click="trushButton"
            class="flex justify-between items-center text-center w-full hover:bg-slate-700 text-neutral-300 px-3 {{ request()->routeIs('trash') ? 'border-2 border-slate-700 bg-slate-700 hover:border-2 hover:border-slate-500' : '' }}">
            <div class="flex space-x-1">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-5 h-5 mt-1">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                </svg>
                <span>Trash</span>
            </div>
        </button>
    @endcan

    <div class="w-full border-b-2 border-slate-700"></div>

    <button wire:click="rewardsButton"
        class="flex justify-between items-center text-center w-full hover:bg-slate-700 text-neutral-300 px-3  {{ request()->routeIs('reward.index') ? 'border-2 border-slate-700 bg-slate-700 hover:border-2 hover:border-slate-500' : '' }}">
        <div class="flex space-x-1">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="w-5 h-5 mt-1">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M12 3.75v16.5M2.25 12h19.5M6.375 17.25a4.875 4.875 0 004.875-4.875V12m6.375 5.25a4.875 4.875 0 01-4.875-4.875V12m-9 8.25h16.5a1.5 1.5 0 001.5-1.5V5.25a1.5 1.5 0 00-1.5-1.5H3.75a1.5 1.5 0 00-1.5 1.5v13.5a1.5 1.5 0 001.5 1.5zm12.621-9.44c-1.409 1.41-4.242 1.061-4.242 1.061s-.349-2.833 1.06-4.242a2.25 2.25 0 013.182 3.182zM10.773 7.63c1.409 1.409 1.06 4.242 1.06 4.242S9 12.22 7.592 10.811a2.25 2.25 0 113.182-3.182z" />
            </svg>
            <span>Rewards</span>
        </div>
    </button>

    <button wire:click="unlocksButton"
        class="flex justify-between items-center text-center w-full hover:bg-slate-700 text-neutral-300 px-3  {{ request()->routeIs('unlocks.index') || request()->routeIs('unlocks.in-progress') || request()->routeIs('unlocks.completed') || request()->routeIs('unlocks.refund') || request()->routeIs('unlocks.draft') ? 'border-2 border-slate-700 bg-slate-700 hover:border-2 hover:border-slate-500' : '' }}">
        <div class="flex space-x-1">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="w-5 h-5">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z" />
            </svg>
            <span>Unlocks</span>
        </div>
    </button>

    <div class="w-full border-b-2 border-slate-700"></div>


    @can('viewAny', \App\Models\User::class)
        <button wire:click=""
            class="flex justify-between items-center text-center w-full hover:bg-slate-700 text-neutral-300 px-3 {{ request()->routeIs('donate.index') ? 'border-2 border-slate-700 bg-slate-700 hover:border-2 hover:border-slate-500' : '' }}">
            <div class="flex space-x-1">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mt-1" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span>Donate</span>
            </div>
        </button>
    @endcan



    @cannot('viewAny', \App\Models\User::class)
        <button wire:click="subscriptionButton"
            class="flex justify-between items-center text-center w-full hover:bg-slate-700 text-neutral-300 px-3 {{ request()->routeIs('orders-subscription.index') ? 'border-2 border-slate-700 bg-slate-700 hover:border-2 hover:border-slate-500' : '' }}">
            <div class="flex space-x-1">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mt-1" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span class="">Subscription</span>
            </div>
        </button>
    @endcannot


    <button wire:click="helpCenterButton"
        class="flex justify-between text-sm items-center text-center w-full hover:bg-slate-700 text-neutral-300 px-3 {{ request()->routeIs('helpcenter.index') ? 'border-2 border-slate-700 bg-slate-700 hover:border-2 hover:border-slate-500' : '' }}">
        <div class="flex space-x-1">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mt-1" fill="none" viewBox="0 0 24 24"
                stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <span>Help Center</span>
        </div>
    </button>

</div>
