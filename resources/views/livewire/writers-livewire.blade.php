<div>
    <div class="w-full flex justify-end">
        <div class="flex w-6/12 md:w-3/12">
            <form class="w-full" action="{{route('users.writers') ? route('users.writers') : (route('users.my-writers') ? route('users.my-writers') : route('users.invited-writers'))}}" method="GET">
                <input type="text" name="search" id="" placeholder="Search by Subjects / email / Name  " class="w-full h-5 bg-transparent rounded text-xs text-neutral-300">
             @csrf
            </form>
        </div>
    </div>

    @include('pages.writer-component')

</div>
