

<div class="md:flex justify-between md:space-x-6 space-y-3">


    <!--Left elements-->
    <div class="w-full md:w-[50%] px-4 py-3 border border-slate-600 rounded space-y-3">
        <div class="">
            <label for="assignment_type" class="font-medium text-sm text-gray-300 dark:text-gray-400 @error('assignment_type') text-red-700 @enderror">Assignment Type<span class="text-orange-600">*</span></label>
            <input class="w-full bg-transparent text-slate-300 text-sm text-gray-400 rounded @error('assignment_type') border-red-500 @enderror" value="{{old('assignment_type') ?? $order->assignment_type}}" type="text" name="assignment_type"  list="assignment-type" placeholder="Assignment type">
            <datalist id="assignment-type">
                <option value="Essay">
                <option value="Annotation Bibiography">
                <option value="Powerpoint presentation">
                <option value="Artical/Book review">
                <option value="Artical Writting">
                <option value="Business Proposal">
                <option value="Business Plan">
                <option value="Capstone Project">
                <option value="Discusion Post">
                <option value="Lab report">
                <option value="Report">
                <option value="Reasearch paper">
                <option value="Research Proposal">
                <option value="Calculations">
                <option value="SWOT Analysis">
                <option value="Physiscs Assignments">
                <option value="Calculations">
                <option value="Thesis/Dessertation">
                <option value="Others">
            </datalist>

            @error('assignment_type')
                <div class="text-xs text-red-500">{{$message}}</div>
            @enderror
        </div>
        <div>
            <label for="subject" class="font-medium text-sm text-gray-300 dark:text-gray-400 @error('subject') text-red-700 @enderror">Subject<span class="text-orange-600">*</span></label>
            <input  class="w-full bg-transparent rounded text-sm text-gray-400 @error('assignment_type') border-red-500 @enderror" value="{{old('subject') ?? $order->subject}}" type="text" list="subject" name="subject" placeholder="subject">
            <datalist id="subject">
                <option value="Any" >
                @foreach ($subjects as $item)
                <option value="{{$item->subject}}" >
                @endforeach
            </datalist>
            @error('subject')
                <div class="text-xs text-red-500">{{$message}}</div>
            @enderror
        </div>


        <div>
            <label for="service" class="font-medium text-sm text-gray-300 dark:text-gray-400 @error('service') text-red-700 @enderror">Service<span class="text-orange-600">*</span></label>
            <input  class="w-full bg-transparent rounded text-sm text-gray-400 @error('service') border-red-500 @enderror" value="{{old('service') ?? $order->service}}" type="text" list="service" name="service" placeholder="Service">
            <datalist id="service">
                <option value="Any" >
                <option value="Writing" >
                <option value="Rewriting" >
                <option value="Editing" >
                <option value="Proofreading" >
                <option value="Calculation" >
                <option value="Problem Solving" >
                <option value="Other" >
            </datalist>
            @error('service')
                 <div class="text-xs text-red-500">{{$message}}</div>
            @enderror
        </div>


        <div class="pt-3">
            <span class="font-medium text-gray-300 text-sm dark:text-gray-400">Assignment Length</span>
            <div class="flex items-center space-x-1">
                <div>
                    <label for="pages" class="text-xs text-gray-300 @error('pages') text-red-700 @enderror">Pages<span class="text-orange-600">*</span></label>
                    <input class="w-20 bg-transparent rounded text-sm text-gray-400 @error('pages') border-red-500 @enderror" value="{{old('pages') ?? $order->pages ?? '1'}}" type="number" name="pages" placeholder="pages">
                </div>

                <div>
                    <label for="words" class="text-xs text-gray-300 @error('words') text-red-700 @enderror">Words<span class="text-orange-600">*</span></label>
                    <input class="w-24 bg-transparent rounded text-sm text-gray-400 @error('words') border-red-500 @enderror" value="{{old('words') ?? $order->words ?? '275'}}" type="number" name="words" step="275" placeholder="words">
                </div>

                <div>
                    <label for="spacing" class="text-xs  text-gray-300 @error('spacing') text-red-700 @enderror">Spacing</label>
                    <select class="w-24 sm:w-20 rounded text-sm text-gray-400 bg-transparent @error('spacing') border-red-500 @enderror" name="spacing" id="">
                        <option class="bg-slate-700" value="Double Spacing" {{old('spacing')==='Double Spacing' || $order->spacing==='Double Spacing' ? 'selected' : ''}}>Double</option>
                        <option class="bg-slate-700" value="Single Spacing" {{old('spacing')==='Single Spacing' || $order->spacing==='Single Spacing' ? 'selected' : ''}}>Single</option>
                        <option class="bg-slate-700" value="1.5 Spacing" {{old('spacing')==='1.5 Spacing' || $order->spacing==='1.5 Spacing' ? 'selected' : ''}}>1.5 Spacing</option>
                        <option class="bg-slate-700" value="Other" {{old('spacing')==='Other' || $order->spacing==='Other' ? 'selected' : ''}}>Other</option>
                    </select>
                </div>
            </div>
            @error('pages','words','spacing')
                 <div class="text-xs text-red-500">{{$message}}</div>
            @enderror
        </div>

        <div>
            <label for="order_visibility" class="text-sm  text-gray-300 @error('order_visibility') text-red-700 @enderror">Order Visibility</label>
            <select class="w-full rounded text-sm text-gray-400 bg-transparent @error('order_visibility') border-red-500 @enderror" name="order_visibility" id="">
                <option class="bg-slate-700" value="public" {{old('order_visibility')==='public' || $order->order_visibility==='public' ? 'selected' : ''}}>Public(Viewed by Everyone)</option>
                <option class="bg-slate-700" value="private" {{old('order_visibility')==='private' || $order->order_visibility==='private' ? 'selected' : ''}}>Private(viewed by your writers)</option>
            </select>
        </div>

    </div>



    <!--Right elements-->
    <div class="w-full md:w-[50%] px-4 py-4 border border-slate-600 rounded space-y-3">
        <div class="">
            <label for="sources" class="font-medium mb-1 text-sm text-gray-300 dark:text-gray-400 @error('sources') text-red-700 @enderror">Sources Required<span class="text-orange-600">*</span></label>
            <input  class="w-full bg-transparent rounded text-sm text-gray-400 @error('sources') border-red-500 @enderror" value="{{old('sources') ?? $order->service}}" type="text" list="sources" name="sources" placeholder="Sources">
            <datalist id="sources">
                <option value="Any" >
                <option value="1 source required" >
                <option value="2 source required" >
                <option value="3 source required" >
                <option value="4 source required" >
                <option value="5 source required" >
                <option value="6 source required" >
                <option value="7 source required" >
                <option value="8 source required" >
                <option value="9 source required" >
                <option value="11 source required" >
                <option value="12 source required" >
                <option value="13 source required" >
                <option value="14 source required" >
                <option value="15 source required" >
                <option value="Other" >
            </datalist>
            @error('sources')
                 <div class="text-xs text-red-500">{{$message}}</div>
            @enderror
        </div>


        <div>
            <label for="citation" class="font-medium mb-1 text-sm text-gray-300 dark:text-gray-400 @error('citation') text-red-700 @enderror">Citation<span class="text-orange-600">*</span></label>
            <input  class="w-full bg-transparent rounded text-sm text-gray-400 @error('citation') border-red-500 @enderror" type="text" list="citation" value="{{old('citation') ?? $order->citation}}" name="citation" placeholder="Citation Style">
            <datalist id="citation">
                <option value="Any" >
                <option value="APA 7th Edition" >
                <option value="APA 8th Edition" >
                <option value="MLA" >
                <option value="Harvard" >
                <option value="IEEE" >
                <option value="Chicago" >
                <option value="Other" >
            </datalist>
            @error('citation')
                 <div class="text-xs text-red-500">{{$message}}</div>
            @enderror
        </div>


        <div>
            <label for="deadline" class="font-medium mb-1 text-sm text-gray-300 dark:text-gray-400 @error('deadline') text-red-700 @enderror">Assignment Deadline<span class="text-orange-600">*</span></label>
            <input class="w-full bg-transparent text-gray-300 text-sm text-gray-400 rounded @error('deadline') border-red-500 @enderror" value="{{old('deadline') ?? $order->deadline}}"  name="deadline" type="datetime-local">
            @error('deadline')
                 <div class="text-xs text-red-500">{{$message}}</div>
            @enderror
        </div>

        <div>
            <label for="language" class="font-medium mb-1 text-sm text-gray-300 dark:text-gray-400 @error('language') text-red-700 @enderror">Assignment Language</label>
            <input  class="w-full bg-transparent rounded text-sm text-gray-400 @error('language') border-red-500 @enderror" type="text" value="{{old('language') ?? $order->language ?? 'English(US)' }}" list="language" name="language">
            <datalist id="language">
                <option selected value="English(US)" >
                <option value="English(UK)" >
                <option value="French" >
                <option value="Spanish" >
                <option value="Others" >
            </datalist>
            @error('language')
              <div class="text-xs text-red-500">{{$message}}</div>
            @enderror
        </div>

        <div>
            <label for="pay_day" class="font-medium mb-1 text-sm text-gray-300 dark:text-gray-400 @error('pay_day') text-red-700 @enderror">Pay Day<span class="text-orange-600">*</span></label>
            <input class="w-full bg-transparent text-gray-300 text-sm text-gray-400 rounded @error('pay_day') border-red-500 @enderror" value="{{old('pay_day') ?? $order->pay_day}}"  name="pay_day" type="datetime-local">
            @error('pay_day')
                 <div class="text-xs text-red-500">{{$message}}</div>
            @enderror
        </div>

    </div>
</div>


<div class="w-full space-y-5 py-4">
    <div class="">
        <label for="topic" class="font-medium mb-1 text-gray-300 dark:text-gray-400 @error('topic') text-red-700 @enderror">Assignment Topic<span class="text-orange-600">*</span></label>
        <input class="w-full bg-transparent text-sm rounded focus:ring-blue-500 focus:border-blue-500 text-gray-400 @error('topic') border-red-500 @enderror" value="{{old('topic') ?? $order->topic}}" type="text" name="topic" placeholder="Assignment Topic">
        @error('topic')
            <div class="text-xs text-red-500">{{$message}}</div>
        @enderror
    </div>

    <div>
        <label for="description"
        class="block mb-1  font-medium text-gray-300 dark:text-gray-400">Assignment Description</label>
        <textarea id="description" name="description" rows="8" class="bg-transparent text-sm text-gray-400 block p-2.5 w-full text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Assignment instraction...">{{old('description') ?? $order->description}}</textarea>
    </div>

    <div>
        <div class="flex justify-center items-center w-full bg-transparent">
            <label for="dropzone-file" class="flex flex-col justify-center items-center w-full h-32 rounded-lg border-2 border-gray-300 border-dashed cursor-pointer  dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600">
                <div class="flex flex-col justify-center items-center pt-5 pb-6">
                    <svg aria-hidden="true" class="mb-3 w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path></svg>
                    <p class="mb-2 text-sm text-gray-500 dark:text-gray-400"><span class="font-semibold">Click to upload Files</p>
                    <p class="text-xs text-gray-500 dark:text-gray-400">pdf,docx,txt,jpeg,svg,png,gif,docm,odt,xlsx,xlsm,xlsb,xltx,dotm, svg, png, jpg or gif</p>
                    <input class="border-none" name="docs[]" style="display: none;"  id="dropzone-file" type="file" multiple accept=".pdf, .docx, .txt, .jpeg, .svg, .png, .gif, .docm, .odt, .xlsx, .xlsm, .xlsb, .xltx, .dotm, .svg, .png, .jpg,.gif">
                </div>
            </label>
        </div>
    </div>


    <div class="">
        <label for="price" class="font-medium mb-1 text-gray-300 dark:text-gray-400 @error('price') text-red-700 @enderror">Budjet($)<span class="text-orange-600">*</span></label><br>
        <input class="bg-transparent rounded text-sm text-gray-400" type="number" step="any"  value="{{old('price') ?? $order->price}}" name="price" placeholder="$0.00">
        @error('price')
             <div class="text-xs text-red-500">{{$message}}</div>
        @enderror
        <div class="text-xs text-orange-600">{{'$1 USD = Ksh. '.$exchangeRate}}</div>
    </div>
</div>

@csrf
