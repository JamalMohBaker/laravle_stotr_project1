<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Products </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
  </head>
  <body>
   <div class="container">
    <h2 class="mb-4 fs-3">New Product</h2>

    <form action="<?=  route('products.store') ?>" method="post">
        <?= csrf_field() ?>
        <!-- override up to down -->
        <input type="hidden" name="_token" value="<?= csrf_token() ?>" id="">
        <div class="form-floating mb-3">
            <input type="text" class="form-control" id="name" name="name" placeholder="Product Name">
            <label for="name">Product Name </label>
         </div>
        <div class="form-floating mb-3">
            <input type="text" class="form-control" id="slug" name="slug" placeholder="Url Slug">
            <label for="slug">Url Slug</label>
        </div>
        <div class="form-floating mb-3">
            <textarea type="text" class="form-control" id="description" name="description" placeholder="Description"> </textarea>
            <label for="description">Description</label>
        </div>
        <div class="form-floating mb-3">
            <textarea type="text" class="form-control" id="short_description" name="short_description" placeholder="Short Description"> </textarea>
            <label for="short_description">Short Description</label>
        </div>
        <div class="form-floating mb-3">
            <input type="number" class="form-control" id="price" name="price" placeholder="Price">
            <label for="price">Price</label>
        </div>
        <div class="form-floating mb-3">
            <input type="number" class="form-control" id="compare_price" name="compare_price" placeholder="Compare Price">
            <label for="compare_price">Compare Price</label>
        </div>
        <div class="form-floating mb-3">
            <input type="file" class="form-control" id="image" name="image" placeholder="Image ">
            <label for="image">Product Image</label>
        </div>
        <button type="submit" class="btn btn-primary">Save</button>
    </form>
    
   </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
  </body>
 </html>

