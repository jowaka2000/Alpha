@extends('layouts.minor-layout')

@section('title','Edit My Profile')

@section('content')
    <div class="w-full  flex justify-center pt-5 md:pt-8">
        <div class="w-11/12 md:w-8/12 flex items-center text-neutral-400 font-semibold space-x-3">
            <a href="{{ route('employer-profile',$user) }}" class="border rounded border-gray-500">
                 <svg xmlns="http://www.w3.org/2000/svg" class="h-9 w-9" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                    stroke-width="3">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                </svg>
            </a>
            <span class="text-4xl">Edit Profile</span>
        </div>
    </div>
    <div class="w-full  flex justify-center py-10 h-full scroll-y-auto">
        <div class="w-11/12 md:w-7/12 flex">

            <form action="{{ route('employer-profile.edit', $user) }}" method="POST"
                class="block space-y-3 md:flex w-full justify-between p-3 md:p-6" enctype="multipart/form-data">
                <div class="w-full flex md:block justify-center">
                    <div class="relative">
                        <div class="absolute left-16 rounded-full  md:left-28 w-3 h-3 {{$user->online ? 'bg-green-600' : 'bg-red-400'}}"></div>
                        <img src="{{ $user->image==null ? asset('images/user.png') : asset('images/'.$user->image) }}" alt="" class="rounded-full w-20 md:w-32"
                            id="output">
                        <div class="absolute bottom-1 left-20 md:left-32 text-gray-400">
                            <label for="profile-upload">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                </svg>
                                <input type="file" name="profile" id="profile-upload" accept="png,jpg,svg" class="hidden"
                                    onChange="loadFile(event)">
                            </label>
                        </div>
                    </div>
                </div>

                <div class="w-full space-y-3 md:space-y-5">
                    <div>
                        <label for="name" class="font-medium text-neutral-400">Full Name</label>
                        <input type="text" class="w-full bg-transparent rounded text-sm text-neutral-400" name="name"
                            id="name" value="{{ old('name') ?? $user->name }}" placeholder="Full Name">

                        @error('name')
                            <div class="text-xs text-red-500">{{ $message }}</div>
                        @enderror
                    </div>

                    <div>
                        <label for="number" class="font-medium text-neutral-400">Tel Phone</label>
                        <input type="number" class="w-full bg-transparent rounded text-sm text-neutral-400" name="number"
                            id="number" value="{{ old('number') ?? $user->number }}" placeholder="eg. 254799999999">
                        @error('number')
                            <div class="text-xs text-red-500">{{ $message }}</div>
                        @enderror
                    </div>

                    @can('viewAny', \App\Models\User::class)
                        <div>
                            <label for="chanel" class="font-medium text-neutral-400">Chanel Name</label>
                            <input type="text" class="w-full bg-transparent rounded text-sm text-neutral-400" name="chanel"
                                value="{{ old('chanel') ?? $user->chanel }}" placeholder="eg. Writers Gallo">

                            @error('chanel')
                                <div class="text-xs text-red-500">{{ $message }}</div>
                            @enderror
                        </div>
                    @endcan

                    <div>
                        <label for="availability" class="font-medium text-neutral-400">Availlability</label>
                        <select name="availability" id="availability"
                            class="w-full text-neutral-400 bg-transparent rounded text-sm">
                            <option value="Part-Time"
                                {{ old('availability') === 'Part-Time' || $user->availability === 'Part-Time' ? 'selected' : '' }}
                                class="bg-slate-700">Part-time</option>
                            <option value="Full-Time"
                                {{ old('availability') === 'Full-Time' || $user->availability === 'Full-Time' ? 'selected' : '' }}
                                class="bg-slate-700">Full-Time</option>
                        </select>
                        @error('availability')
                            <div class="text-xs text-red-500">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="flex w-full justify-end pt-4">
                        <button type="submit" class="px-4 py-2 bg-green-500 text-gray-300 rounded">Save</button>
                    </div>
                </div>
                @csrf
            </form>

        </div>
    </div>

    <script>
        var loadFile = function(event) {
            var output = document.getElementById('output');
            output.src = URL.createObjectURL(event.target.files[0]);
        }
    </script>
@endsection
