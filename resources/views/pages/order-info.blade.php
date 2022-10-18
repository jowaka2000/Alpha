<div class="w-full bg-slate-800 mt-5 p-4 text-neutral-400">

    <div class="grid grid-cols-2 md:grid-cols-4 gat-0 md:gap-4 space-y-3 md:space-y-0">
        <span class="font-bold">Assignment Type:------</span>
        <span class="text-sm">{{$order->assignment_type}}</span>

        <span class="font-bold">Service:------------------</span>
        <span class="text-sm">{{$order->service}}</span>

        <span class="font-bold">Pages:-------------------</span>
        <span class="text-sm">{{$order->pages===1 ? $order->pages.' Page' : $order->pages.' Pages'}}</span>

        <span class="font-bold">Words:------------------</span>
        <span class="text-sm">{{$order->words}} ({{$order->spacing}})</span>

        <span class="font-bold">Sources:-----------------</span>
        <span class="text-sm">{{$order->sources}}</span>

        <span class="font-bold">Citation:----------------</span>
        <span class="text-sm">{{$order->citation}}</span>

        <span class="font-bold">Deadline:----------------</span>
        <span class="flex text-sm items-center"><span>{{(new \Carbon\Carbon($order->deadline))->format('D, M y H:i')}}</span><span class="text-xs items-center text-orange-500">({{(new \Carbon\Carbon($order->deadline))->diffForHumans()}})</span></span></span>

        <span class="font-bold">Pay Day:-----------------</span>
        <span class="text-sm">{{(new \Carbon\Carbon($order->pay_day))->format('D , M  Y')}}</span>


    </div>


    <div class="py-4 mt-5">
        <div class="flex font-semibold">Assignment Topic</div>
        <div class="">{{$order->topic}}</div>
    </div>


    @if ($order->description!=null)
        <div class="py-2">
            <div class="flex font-semibold">Description</div>
            <div>
                <textarea id="description" rows="8" disabled class="border-none bg-transparent text-sm text-gray-400 block p-2.5 w-full text-sm">{{$order->description}}</textarea>
            </div>
        </div>
    @endif

    <div class="py-2 mt-5">
        <div class="px-2 md:px-3 flex md:w-2/12 font-semibold mb-3">Files ({{count($files)}})</div>
        <div class="px-2 md:px-3 space-y-3">

            @foreach ($files as $file)
                <a href="{{route('file.download',$file)}}" class="flex text-sm justify-between border underline text-green-400 border-slate-800 hover:border-slate-600 rounded">
                    <div>{{$file->file_original_name}}</div>
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-7" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M6 2a2 2 0 00-2 2v12a2 2 0 002 2h8a2 2 0 002-2V7.414A2 2 0 0015.414 6L12 2.586A2 2 0 0010.586 2H6zm5 6a1 1 0 10-2 0v3.586l-1.293-1.293a1 1 0 10-1.414 1.414l3 3a1 1 0 001.414 0l3-3a1 1 0 00-1.414-1.414L11 11.586V8z" clip-rule="evenodd" />
                        </svg>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
</div>
