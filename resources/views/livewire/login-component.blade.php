<div class="flex flex-col items-center">
    <div class="flex justify-center md:w-4/12 w-full my-10">
        <form wire:submit.prevent="submitForm" class="space-y-2 border-2 border-gray-300 md:w-full w-full p-8 rounded">
            <div>
                <label for="name">Name</label>
                <input type="text" name="name" class="rounded w-full" wire:model.debounce.300ms="name">
                <div class="text-sm text-red-500">
                    @error('name')
                        {{$message}}
                    @enderror
                </div>
            </div> 

            <div>
                <label for="email">Email</label>
                <input type="text" name="email" class="rounded w-full" wire:model.debounce.300ms="email">
                <div class="text-sm text-red-500">
                    @error('email')
                        {{$message}}
                    @enderror
                </div>
            </div>

            <div>
                <label for="phone">Phone Number</label>
                <input type="number" name="phone" class="rounded w-full" wire:model.debounce.300ms="phone">
                <div class="text-sm text-red-500">
                    @error('phone')
                        {{$message}}
                    @enderror
                </div>
            </div>

            <div>
                <label for="message">Message</label>
                <textarea name="message" id="" rows="4" class="w-full rounded bg-slate-600" wire:model.debounce.300ms="message"></textarea>
                <div class="text-sm text-red-500">
                    @error('message')
                        {{$message}}
                    @enderror
                </div>
            </div>

            <div class="flex w-full justify-end ">
                <button wire:click="submitForm" type="submit" class="px-3 py-2 rounded bg-blue-500 mt-2 text-white hover:bg-blue-600 text-center">
                    Login
                    <div wire:loading>Loading...</div>
                </button>
              
            </div>
        </form>
    </div>
</div>
