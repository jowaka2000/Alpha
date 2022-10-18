<div class="space-y-4">
    <div class="hidden md:flex text-sm justify-start text-gray-400 font-semibold">{{Illuminate\Support\Str::limit($order->topic,70)}}</div>
    <div class="flex md:hidden justify-start text-sm text-gray-400 font-semibold">{{Illuminate\Support\Str::limit($order->topic,40)}}</div>
    <div class="flex items-center space-x-1 md:space-x-2 text-sm text-gray-400">
        <span class=""><span class="text-green-500">#</span><span>{{$order->id}}</span><span class="pl-1">|</span></span>
        <span class="">{{$order->pages}} {{$order->pages>1 ? 'Pages' : 'Page'}} <span class="pl-1">|</span></span>
        <span class="">{{$order->words}} Words<span class="pl-1">|</span></span>
        <span class="hidden md:flex"> {{$order->service}} <span class="pl-1">|</span></span>
        <span class="hidden md:flex">{{$order->subject}}</span>
    </div>
</div>
<div class="space-y-4 ">
        <div class="flex justify-end text-gray-400 font-semibold pt-3 md:pt-0">{{$order->bids}} {{$order->bids>1 ? 'Bids' : 'Bid'}}</div>
        <div class="text-sm text-red-500 font-semibold">{{(new \Carbon\Carbon($order->deadline))->diffForHumans()}}</div>
</div>

