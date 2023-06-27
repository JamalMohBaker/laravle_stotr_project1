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

<div class=" mb-3">
    <label for="name">Product Name </label>
    <div>
        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ $product->name }}" placeholder="Product Name">
         @error('name')
         <p class="text-danger">{{ $message }}</p>
         @enderror
    </div>
 </div>
<div class="form-floating mb-3">
    <input type="text" class="form-control" id="slug" name="slug" value="{{ $product->slug }}" placeholder="Url Slug">
    <label for="slug">Url Slug</label>
</div>

<div class="form-floating mb-3">
    <select id="category_id" name="category_id" class="form-select form-control" >
        <option></option>
        @foreach ($categories as $category)
        <option @selected($category->id == $product->category_id) value="{{ $category->id }} " >
            {{ $category->name }}
        </option>

        @endforeach

    </select>
    <label for="category_id">category_id</label>
</div>

<div class="form-floating mb-3">
    <textarea type="text" class="form-control" id="description" name="description" placeholder="Description"> {{ $product->description }}</textarea>
    <label for="description">Description</label>
</div>
<div class="form-floating mb-3">
    <textarea type="text" class="form-control" id="short_description"  name="short_description" placeholder="Short Description">{{ $product->short_description }} </textarea>
    <label for="short_description">Short Description</label>
</div>
<div class="form-floating mb-3">
    <input type="number" class="form-control" id="price" value="{{ $product->price }}"  name="price" placeholder="Price">
    <label for="price">Price</label>
</div>
<div class="form-floating mb-3">
    <input type="number" class="form-control" id="compare_price" value="{{ $product->compare_price }}" name="compare_price" placeholder="Compare Price">
    <label for="compare_price">Compare Price</label>
</div>
<div class="form-floating mb-3">
    <input type="file" class="form-control" id="image" name="image" placeholder="Image ">
    <label for="image">Product Image</label>
</div>
<button type="submit" class="btn btn-primary">{{ $submit_label ?? save }}</button>
