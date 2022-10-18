<div>
    <label for="answer_type" class="text-neutral-400 font-medium @error('answer_type') text-red-500  @enderror">Answers Type</label>
    <select name="answer_type" id="" class="w-full bg-transparent rounded text-sm text-gray-300 @error('answer_type') border-red-600  @enderror">
        <option value="" class="bg-slate-700" disabled selected>Select Answers Type</option>
        <option value="Draft" {{$completed->answer_type==='Draft' ? 'selected' : ''}} class="bg-slate-700">Draft</option>
        <option value="Final Draft" {{$completed->answer_type==='Final Draft' ? 'selected' : ''}} class="bg-slate-700">Final Draft</option>
    </select>
    @error('answer_type')
        <div class="text-xs text-red-500">{{$message}}</div>
    @enderror
</div>


<div>
    <label for="message" class="text-neutral-400 font-medium">Message(optional)</label>
    <textarea name="message" id="message" rows="3" class="bg-transparent text-sm text-gray-400 block p-2.5 w-full text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">{{old('message') ?? $completed->message}}</textarea>
</div>


<div>
    <label for="additional_information" class="text-neutral-400 font-medium">Answers</label>
    <textarea name="additional_information" id="information" rows="7" class="bg-transparent text-sm text-gray-400 block p-2.5 w-full text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">{{old('additional_information') ?? $completed->additional_information}}</textarea>
</div>

<div>
    <label for="answers" class="text-neutral-400 font-medium @error('answers') text-red-500  @enderror">Upload file(s)</label>
    <input type="file" name="answers[]" id="answers"  multiple class="w-full border rounded border-slate-500 text-neutral-300 @error('answers') border-red-600  @enderror">
    @error('answers')
      <div class="text-xs text-red-500">{{$message}}</div>
    @enderror
</div>


@csrf
