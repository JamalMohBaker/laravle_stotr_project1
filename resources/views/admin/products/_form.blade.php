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
        <div class=" mb-3">
            <label for="name">Product Name </label>
            <div>
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name' , $product->name )  }}" placeholder="Product Name">
                 @error('name')
                 <p class="text-danger">{{ $message }}</p>
                 @enderror
            </div>
         </div>
        <div class=" mb-3">
            <label for="slug">Url Slug</label>
            <div>
                <input type="text" class="form-control @error('slug') is-invalid @enderror" id="slug" name="slug" value="{{ old('slug' , $product->slug ) }}" placeholder="Url Slug">
                @error('slug')
                <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
        </div>
        <div class=" mb-3">
            <label for="description">Description</label>
            <div>
                <textarea type="text" class="form-control @error('description') is-invalid @enderror" id="description" name="description" placeholder="Description"> {{old('description',$product->description)  }}</textarea>
                @error('description')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
        </div>
        <div class=" mb-3">
            <label for="short_description">Short Description</label>
            <div>
                <textarea type="text" class="form-control @error('short_description') is-invalid @enderror" id="short_description"  name="short_description" placeholder="Short Description">{{old('short_description',$product->short_description)  }} </textarea>
                @error('short_description')
                <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
        </div>

    </div>
    <div class="col-md-4">
        <div class="mb-3">
            <label for="status">status</label>
            <div>
                @foreach ($status_option as $value => $label)
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
        <div class=" mb-3">
            <label for="category_id">category_id</label>
            <div>
                <select id="category_id" name="category_id" class="form-select form-control @error('category_id') is-invalid @enderror" >
                    <option></option>
                    @foreach ($categories as $category)
                    <option @selected($category->id == old('category_id' , $product->category_id)) value="{{  $category->id }} " >
                        {{ $category->name }}
                    </option>

                    @endforeach

                </select>
                @error('category_id')
                <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
        </div>


        <div class="mb-3">
            <label for="price">Price</label>
            <div>
                <input type="number" class="form-control @error('price') is-invalid @enderror" step="0.1" min="0" id="price" value="{{ old('price', $product->price )}}"  name="price" placeholder="Price">
                @error('price')
                <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
        </div>
        <div class="mb-3">
            <label for="compare_price">Compare Price</label>
            <div>
                <input type="number" step="0.1" min="0" class="form-control @error('compare_price') is-invalid @enderror" id="compare_price" value="{{ old('compare_price', $product->compare_price )}}" name="compare_price" placeholder="Compare Price">
                @error('compare_price')
                <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
        </div>
        <div class="mb-3">
            <label for="image">Product Image</label>
            <input type="file" class="form-control" id="image" name="image" placeholder="Image ">

        </div>
    </div>
</div>

<button type="submit" class="btn btn-primary">{{ $submit_label ?? save }}</button>
