@extends('layouts.parent')

@section('content')
    <div class="container">

        {{-- alert --}}
        @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle me-1"></i>
            {!! \Session::get('success') !!}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
        @elseif(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="bi bi-exclamation-octagon me-1"></i>
            {!! \Session::get('success') !!}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
        @endif

        <div class="card">
            <div class="card-body">
                <h5 class="card-title">
                    Update Category
                </h5>
              
                <!-- Vertical Form -->
              <form class="row g-3" action="{{ route('dashboard.category.update', $category->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('put')
                <div class="col-12">
                  <label for="inputNanme4" class="form-label">Name Category</label>
                  <input type="text" class="form-control" id="inputNanme4" name="name" value="{{ $category->name }}">
                </div>
                <div class="text-end">
                  <button type="submit" class="btn btn-primary">Submit</button>
                  <a href="{{ route('dashboard.category.index') }}" class="btn btn-secondary">
                    <i class="bi bi-arrow-left"></i>
                    Back
                </a>
                </div>
              </form><!-- Vertical Form -->

            </div>
        </div>
    </div>
@endsection