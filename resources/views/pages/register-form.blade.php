<div>
    <label for="name" class="font-medium text-sm text-gray-400 mb-1 @error('name') text-red-700 @enderror">Name<span class="text-orange-600">*</span></label>
    <input name="name" value="{{old('name')}}" class="w-full bg-transparent text-sm text-gray-400 rounded @error('name') border-red-600 @enderror" type="text" placeholder="First name , Last name">
    <div>
        @error('name')
          <span class="text-xs text-red-500">{{$message}}</span>
        @enderror
    </div>
</div>

 <div>
    <label for="email" class="font-medium text-gray-400 text-sm mb-1 @error('email') text-red-700 @enderror">Email<span class="text-orange-600">*</span></label>
    <input name="email" value="{{old('email')}}" class="w-full bg-transparent text-sm text-gray-400 rounded @error('email') border-red-600 @enderror" type="email" placeholder="eg. someone@example.com">
    <div>
        @error('email')
          <span class="text-xs text-red-500">{{$message}}</span>
        @enderror
    </div>
</div>

 <div>
    <label for="number" class="font-medium text-gray-400 mb-1 text-sm @error('number') text-red-700 @enderror">Phone Number<span class="text-orange-600">*</span></label>
    <input name="number" value="{{old('number') ?? '254'}}" class="w-full bg-transparent text-sm text-gray-400 rounded @error('number') border-red-600 @enderror" type="number" placeholder="eg. 254...">
    <div>
        @error('number')
          <span class="text-xs text-red-500">{{$message}}</span>
        @enderror
    </div>
</div>

 @if(request()->routeIs('register.writer'))
    <div>
        <label for="availability" class="font-medium text-gray-400 mb-1 text-sm @error('availability') text-red-700 @enderror">Availability</label>
        <select name="availability" id="" class="w-full bg-transparent text-sm text-gray-400 rounded @error('availability') border-red-600 @enderror">
            <option value="" class="bg-slate-700" selected disabled>Choose Availbility<span class="text-orange-600">*</span></option>
            <option value="Part-Time" {{old('availability')==='Part-Time' ? 'selected' : ''}} class="bg-slate-700">Part-Time</option>
            <option value="Full-Time" {{old('availability')==='Full-Time' ? 'selected' : ''}} class="bg-slate-700">Full Time</option>
        </select>
        <div>
            @error('availability')
              <span class="text-xs text-red-500">{{$message}}</span>
            @enderror
        </div>
    </div>
 @endif


 @if(request()->routeIs('register.client'))
    <div>
        <label for="chanel" class="font-medium text-gray-400 mb-1 text-sm @error('chanel') text-red-700 @enderror">Chanel Name<span class="text-orange-600">*</span></label>
        <input name="chanel" value="{{old('chanel')}}" class="w-full bg-transparent text-sm text-gray-400 rounded @error('chanel') border-red-600 @enderror" type="text" placeholder="eg. Writersgallo">
        <div>
            @error('chanel')
              <span class="text-xs text-red-500">{{$message}}</span>
            @enderror
        </div>
    </div>
 @endif


 <div>
    <label for="code" class="font-medium text-gray-400 text-sm mb-1">Referral Code (Optional)</label>
    <input name="code" value="{{old('code')}}" class="w-full bg-transparent text-sm text-gray-400 rounded" type="text" placeholder="Enter refferal code">
</div>


<div>
    <label for="password" class="font-medium text-gray-400 mb-1 text-sm @error('password') text-red-700 @enderror">Password</label>
    <input name="password" class="w-full bg-transparent text-sm text-gray-400 rounded @error('password') border-red-600 @enderror" type="password" placeholder="********">
    <div>
        @error('password')
          <span class="text-xs text-red-500">{{$message}}</span>
        @enderror
    </div>
</div>


 <div>
    <label for="password_confirmation" class="font-medium text-gray-400 text-sm mb-1">Confirm Password</label>
    <input name="password_confirmation" class="w-full bg-transparent text-sm text-gray-400 rounded" type="password" placeholder="********">
    <div>
        @error('password')
          <span class="text-xs text-red-500">{{$message}}</span>
        @enderror
    </div>
</div>


 <div class="flex justify-end w-full py-3">
    <button class="px-3 py-1 bg-blue-700 rounded text-gray-300 hover:bg-blue-900 border border-blue-700 hover:border hover:border-blue-700 hover:text-white font-semibold">Register</button>
 </div>

 <div class="flex w-full justify-center">
    <a href="{{route('login')}}" class="text-sm"><span class="text-gray-300">Already have an account?</span> <span class="text-blue-500 font-semibold hover:underline">Login</span></a>
 </div>


 @csrf
