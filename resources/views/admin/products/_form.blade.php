@if($errors->any())
<div class="alert alert-danger">
    you have some errors:
    <ul>
        @foreach($errors->all() as $error)
        <li> {{ $error }} </li>
        @endforeach
    </ul>
</div>
@endif


<div class="row">
    <div class="col-md-8">
        <x-form.input label="product name" id="name" name="name" value="{{ $product->name }}" />
        <x-form.input label="Url Slug" id="slug" name="slug" value="{{ $product->slug }}" />
        <x-form.textarea   id="description" name="description" label="Description" value="{{ $product->description }}" />
        <x-form.textarea   id="short_description" name="short_description" label="Short Description" value="{{ $product->short_description }}" />
        <div class="mb-3">
            <label for="gallery">Product Gallery</label>
            <div>
                <input type="file" class="form-control" id="gallery" name="gallery[]" multiple placeholder="Image Gallery ">
            </div>
            @if($gallery ?? false)
            <div class="row">
                @foreach($gallery as $image)
                <div class="col-md-3 mt-2">
                    <img src="{{ $image->url }}" class="image-fluid" width="100" height="70" alt="">


                </div>
                @endforeach
            </div>
            @endif
        </div>
    </div>
    <div class="col-md-4">
        <div class="mb-3">
            <label for="status">status</label>
            <div>
                @foreach ($status_options as $value => $label)
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="status" id="status_{{ $value }}" value="{{ $value }} " @checked($value == old('status',$product->status))>
                        <label class="form-check-label" for="status_{{ $value }}">
                            {{ $label }}
                        </label>
                    </div>
                @endforeach
                @error('status')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
        </div>
         <x-form.select label="Category" id="category_id" name="category_id" :value="$product->category_id" :options="$categories->pluck('name', 'id')" /> {{-- pluck() return array for single value   --}}
            <x-form.input type="number" label="Price" id="price" name="price" value="{{ $product->price }}" />
        <x-form.input type="number" label="Compare Price" id="compare_price" name="compare_price" value="{{ $product->compare_price }}" />



        <div class="mb-3">

            <img src="{{ asset( $product->image_url ) }}" width="100" alt="">

            <label for="image">Product Image</label>
            <input type="file" class="form-control" id="image" name="image" placeholder="Image ">
            @error('image')
                <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>
    </div>
</div>

<button type="submit" class="btn btn-primary">{{ $submit_label ?? save }}</button>
