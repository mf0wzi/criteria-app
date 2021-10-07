@props(['disabled' => false])

   <textarea
       {{ $disabled ? 'disabled' : '' }}
       {{ $attributes->except('class') }}
       {{ $attributes->merge(['class' => 'bla your-standard-input-classes']) }}
   ></textarea>
