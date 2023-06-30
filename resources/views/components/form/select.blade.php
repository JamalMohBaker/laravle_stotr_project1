@props([
    
    'id' , 'name' , 'label' , 'value'=>'' , 'options'
])  

<div class=" mb-3">
    <label for="{{ $name }}">{{ $label }}</label>
    <div>
        <select class="form-select form-control @error($name) is-invalid @enderror" id="{{ $id }}" name="{{ $name }}">
            <option></option>
            @foreach ($options as $option_value => $option_text)
            <option @selected($option_value == old($name , $value)) value="{{  $option_value }} " >
                {{ $option_text}}
            </option>
            @endforeach
        </select>
       <x-form.error name="{{ $name }}" />
    </div>
 </div>
