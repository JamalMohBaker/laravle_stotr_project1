@props([
    // name of attributes can i accept
   
    'id' , 'name' , 'label' , 'value'=>'' ,
])

<div class=" mb-3">
    <label for="{{ $id }}">{{ $label }}</label>
    <div>
        <textarea class="form-control @error($name) is-invalid @enderror" id="{{ $id }}" name="{{ $name }}"  placeholder="{{ $label }}"> {{ old($name  , $value )  }} </textarea>
         <x-form.error name="{{ $name }}" />
    </div>
 </div>
