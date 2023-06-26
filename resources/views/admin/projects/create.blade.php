@extends('layouts.app')

@section('content')
  <div class="container m-4">
    <h2 class="mb-4">New project</h2>

    @if ($errors->any())
      <div class="alert alert-danger" role="alert">
        <ul>

          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach

        </ul>
      </div>
    @endif

    <form
      action="{{ route('admin.projects.store') }}"
      method="POST"
      enctype="multipart/form-data"
    >

      @csrf

      <div class="mb-3">
        <label for="title" class="form-label">Title</label>
        <input
          type="text"
          class="form-control @error('title') is-invalid @enderror"
          id="title"
          name="title"
          placeholder="Enter title..."
          value="{{ old('title') }}"
        >

        @error('title')
          <div class="text-danger">{{ $message }}</div>
			  @enderror

      </div>

      <div class="mb-3">
        <label for="type" class="form-label">Type</label>
        <select
          class="form-select"
          aria-label="Default select example"
          name="type_id"
          id="type_id"
        >
          <option
            value=""
            selected
          >Choose the type of project</option>

          @foreach ($types as $type)
            <option
              value="{{ $type->id }}"
              @if ($type->id == old('type_id')) selected @endif
            >
              {{ $type->name }}
            </option>
          @endforeach

        </select>
      </div>

      <div class="mb-3">
        <label for="technology" class="form-label d-block">Technologies</label>
        <div class="btn-group" role="group">

          @foreach ($technologies as $technology)
           <input
             type="checkbox"
             class="btn-check"
             name="technologies[]"
             value="{{ $technology->id }}"
             id="{{ $technology->id }}"
             autocomplete="off"
             @if (in_array($technology->id, old('technologies', []))) checked @endif
           >
           <label class="btn btn-outline-dark" for="{{ $technology->id }}">{{ $technology->name }}</label>
          @endforeach

        </div>
      </div>

      <div class="mb-3">
        <label for="date" class="form-label">Date</label>
        <input
          type="date"
          class="form-control @error('date') is-invalid @enderror"
          id="date"
          name="date"
          value="{{ old('date') }}"
        >

        @error('date')
          <div class="text-danger">{{ $message }}</div>
			  @enderror

      </div>

      <div class="mb-3">
        <label for="image" class="form-label">Image</label>
        <input
          type="file"
          class="form-control"
          id="image"
          name="image"
          onchange="showImage(event)"
        >
        <img
          width="500"
          id="prev-image"
          src=""
          class="my-4"
        >
      </div>

      <div class="mb-3">
        <label for="description" class="form-label">Description</label>
        <textarea
          class="form-control @error('description') is-invalid @enderror"
          name="description"
          id="description"
          cols="30"
          rows="10"
          placeholder="Write a description of your project..."
        >{{ old('description') }}</textarea>

        @error('description')
          <div class="text-danger">{{ $message }}</div>
			  @enderror

      </div>

      <a
        class="btn btn-success text-white"
        href="{{ route('admin.projects.index') }}"
      >
        <i class="fa-regular fa-hand-point-left"></i>
      </a>

      <button type="submit" class="btn btn-primary">Submit</button>
    </form>
  </div>

  <script>
    ClassicEditor
      .create( document.querySelector( '#descriprion' ) )
      .catch( error => {
          console.error( error );
      } );

    function showImage(event) {
      const tagImage = document.getElementById('prev-image');
      tagImage.style.display = 'block';
      tagImage.src = URL.createObjectURL(event.target.files[0]);

    }
  </script>

@endsection
