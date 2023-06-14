@extends('layouts.parent')

@section('content')
<div class="container">

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">
                Show Product
            </h5>

            <!-- Vertical Form -->
            
                <div class="col-12">
                    <label for="inputNanme4" class="form-label">Name Product</label>
                    <input type="text" class="form-control" id="inputNanme4" name="name" value="{{ $product->name }}" disabled>
                </div>

                <div class="col-12">
                    <label for="inputNanme4" class="form-label">Price Product</label>
                    <input type="number" class="form-control" id="inputNanme4" name="price" min="0" value="{{ $product->price }}" disabled>
                </div>

                {{-- select category --}}
                <div class="col-12">
                    <label for="inputNanme4" class="form-label">Category Product</label>
                    <input type="text" class="form-control" id="inputNanme4" name="category_id" value="{{ $product->category->name }}" disabled>
                </div>

                <div class="col-12">
                    <label for="inputNanme4" class="form-label mt-2">Description Product</label>
                    <textarea name="description" id="description" cols="30" rows="10" disabled>{!! $product->description !!}</textarea>
                </div>

                <div class="text-end">
                    <a href="{{ route('dashboard.product.index') }}" class="btn btn-secondary">
                    <i class="bi bi-arrow-left">
                        Back
                    </i>
                    </a>
                </div>

        </div>
    </div>
</div>

<script src="https://cdn.ckeditor.com/4.21.0/standard/ckeditor.js"></script>
<script>
    CKEDITOR.replace( 'description' );
</script>

@endsection