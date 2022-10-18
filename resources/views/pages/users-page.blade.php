@if (session()->has('invite_message'))
    <div class="w-full flex justify-center ">
        <div class="w-11/12 bg-green-500 py-1 flex justify-center text-sm text-green-900 md:w-7/12">{{session('invite_message')}}</div>
    </div>
@endif

@if (session()->has('remove_message'))
    <div class="w-full flex justify-center ">
        <div class="w-11/12 bg-red-500 py-1 flex justify-center text-sm text-red-900 md:w-7/12">{{session('remove_message')}}</div>
    </div>
@endif


<div class="w-full md:pt-4 md:px-10 px-5">
    <div class="w-full flex items-center text-center py-6">
        <span class="text-4xl text-neutral-400 font-semibold"> Writers  </span>
    </div>

    <div class="flex space-x-3 border-b border-slate-500 text-neutral-300 font-semibold mt-5">
        <a href="{{route('users.my-writers')}}" class="hover:text-neutral-100 hover:font-bold @if(request()->routeIs('users.my-writers')) border-b-4 border-slate-400 @endif">My Writers</a>
        <a href="{{route('users.writers')}}" class="hover:text-neutral-100 hover:font-bold @if(request()->routeIs('users.writers')) border-b-4 border-slate-400 @endif">All Writers</a>
    </div>
</div>
