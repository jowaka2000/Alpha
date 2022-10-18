<div class="space-y-3">
    @foreach ($orders as $order)
    <a href="" class="flex w-full">
        <div class="flex justify-between border border-slate-800 w-full hover:border-slate-500 bg-slate-800 hover:bg-slate-900 p-2 rounded">
            @include('pages.order-view')
        </div>
    </a>
    @endforeach
</div>
