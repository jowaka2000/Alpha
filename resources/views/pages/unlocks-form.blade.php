
                            <div>
                                <label for="unlock_type" class="text-neutral-400 font-semibold">Unlocks type</label>
                                <select name="unlock_type" id="unlock_type"
                                    class="w-full bg-transparent rounded text-sm text-neutral-300 @error('unlock_type') border border-red-500 @enderror">
                                    <option value="" disabled selected>Choose Unlocks Type</option>
                                    <option value="chegg" {{old('unlock_type')==='chegg' ? 'selected' : ''}} class="bg-slate-700">Chegg Unlocks (Ksh. 50)</option>
                                    <option value="studypool" {{old('unlock_type')==='studypool' ? 'selected' : ''}} class="bg-slate-700">Studypool Unlocks (Ksh. 100)</option>
                                    <option value="coursehero" {{old('unlock_type')==='coursehero' ? 'selected' : ''}} class="bg-slate-700">Course Hero Unlocks (Ksh. 50)</option>
                                    <option value="" class="bg-slate-700">This is new</option>
                                    <option value="" class="bg-slate-700">And this one</option>
                                </select>

                                @error('unlock_type')
                                    <div class="text-sm text-red-500">{{ $message }}</div>
                                @enderror
                            </div>

                            <div>
                                <label for="unlock_link" class="text-neutral-400 font-semibold">Link(Optional)</label>
                                <input type="text" name="unlock_link" id="unlock_link"
                                    class="w-full bg-transparent text-sm text-neutral-300 rounded"
                                    placeholder="Link of your question from unlocks website" value="{{old('unlock_link')}}">
                            </div>
                            <div>
                                <label for="question" class="text-neutral-400 font-semibold">Question</label>
                                <textarea name="question" id="question" rows="5" class="w-full text-sm text-neutral-300 bg-transparent rounded @error('question') border border-red-500 @enderror"
                                    placeholder="Type your question here">{{old('question')}}</textarea>
                                @error('question')
                                    <div class="text-sm text-red-500">{{ $message }}</div>
                                @enderror
                            </div>

                            <div>
                                <label for="instructions" class="text-neutral-400 font-semibold">Instructions
                                    (Optional)</label>
                                <textarea name="instructions" id="instructions" rows="3"
                                    class="w-full bg-transparent rounded text-sm text-neutral-300" placeholder="Type instrucions to be followed">{{old('instructions')}}</textarea>
                            </div>

                            <div>
                                <label for="files" class="text-neutral-400 font-semibold mb-1"> Upload Files
                                    (Optional)</label>
                                <input type="file" name="files[]" multiple id="files"
                                    class="w-full bg-transparent rounded text-neutral-300 text-sm border border-slate-600"
                                    multiple>
                            </div>
