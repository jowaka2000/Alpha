<div>
    <div class="w-full flex justify-end">
        <form action="{{route('users.my-writers')}}" method="GET">
            <input type="text" name="search" id="" placeholder="Seach email, name..." class="h-5 bg-transparent rounded text-sm text-neutral-300">
         @csrf
        </form>
    </div>

    @include('pages.writer-component')

     <!--End-->

</div>
