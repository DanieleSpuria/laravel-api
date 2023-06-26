@extends('layouts.app')

@section('content')
  <div class="container my-5">
    <h2>{{ $project->title }}</h2>
    <span class="badge text-bg-info">{{ $project->type?->name }}</span>

    @foreach ($project->technologies as $technology)
      <span class="badge text-bg-warning">
        {{ $technology->name }}
      </span>
    @endforeach

    <span class="d-block my-2">Date: {{ $project->date }}</span>
    <img
      class="w-75 my-2"
      src="{{ asset('storage/' . $project->image_path) }}"
      alt="{{ $project->image_name }}"
    >
    <p>{{ $project->description }}</p>
    <span class="d-block my-2">Created: {{ $project->created_at }}</span>

    @if ($project->created_at != $project->updated_at)
     <span class="d-block my-2">Last edit: {{ $project->updated_at }}</span>
    @endif

    <a
      class="btn btn-success text-white"
      href="{{ route('admin.projects.index') }}"
    >
      <i class="fa-regular fa-hand-point-left"></i>
    </a>

    <a
      class="btn btn-success text-white"
      href="{{ route('admin.projects.edit', $project) }}"
    >
      <i class="fa-regular fa-keyboard"></i>
    </a>

    <form
      class="d-inline"
      action="{{ route('admin.projects.destroy', $project) }}"
      method="POST"
      onsubmit="return confirm('Are you sure you want to delete this project?')"
    >

      @csrf
      @method('DELETE')

      <button class="btn btn-success text-white">
        <i class="fa-solid fa-eraser"></i>
      </button>
    </form>
  </div>
@endsection
