<div class="relative">
    <label for="{{$name}}" class="pl-1 absolute text-sm text-gray-500 duration-300 transform -translate-y-4 scale-75 top-4 z-10 origin-[0] start-2.5 peer-focus:text-passou-magenta peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-4 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto">{{$label}}</label>
    <div class="absolute inset-y-0 right-0 flex items-center px-2 pointer-events-none">
        <svg class="w-4 h-4 text-gray-400" viewBox="0 0 20 20" fill="none" stroke="currentColor">
            <path d="M7 7l3-3 3 3m0 6l-3 3-3-3" />
        </svg>
    </div>
    <select
        id="{{$name}}"
        name="{{$name}}"
        class="block px-2.5 pb-2.5 pt-5 w-full text-sm text-gray-900 bg-gray-50 border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-passou-magenta peer">
        @if($wireModel) wire:model.defer="{{$wireModel}}" @endif
        <option value="" selected disabled>{{$placeholder}}</option>
        @foreach ($options as $option)
            <option value="{{$option}}">{{$option}}</option>
        @endforeach
    </select>
    @error($name) <span class="text-red-700 text-sm">{{ $message }}</span> @enderror
</div>
