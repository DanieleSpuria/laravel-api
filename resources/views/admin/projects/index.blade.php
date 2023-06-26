@extends('layouts.app')

@section('content')
  <div class="container m-4">
    <h2 class="mb-4">Projects</h2>

    @if (session('deleted'))
      <div class="alert alert-danger">
        {{ session('deleted') }}
      </div>
    @endif

    <table class="table table-hover">
      <thead>
        <tr>
          <th scope="col">
            <a href="{{ route('admin.orderBy', ['direction' => $direction]) }}">Id</a>
          </th>
          <th scope="col">Title</th>
          <th scope="col">Category</th>
          <th scope="col">Technologies</th>
          <th scope="col">Date</th>
          <th scope="col">Action</th>
        </tr>
      </thead>
      <tbody>

        @foreach ($projects as $project)
          <tr>
            <td>{{ $project->id }}</td>
            <td>{{ $project->title }}</td>
            <td>

              @if ($project->type?->name)
                <span class="badge text-bg-info">
                  {{ $project->type?->name }}
                </span>
              @endif

            </td>
            <td>

              @foreach ($project->technologies as $technology)
                <span class="badge text-bg-warning">
                  {{ $technology->name }}
                </span>
              @endforeach

            </td>
            <td>{{ $project->date }}</td>
            <td>
              <a
                class="btn btn-success text-white"
                href="{{ route('admin.projects.show', $project) }}"
              >
                <i class="fa-solid fa-binoculars"></i>
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
            </td>
          </tr>
        @endforeach

      </tbody>
    </table>
    <div class="ds-link">
      {{ $projects->links() }}
    </div>
  </div>
@endsection
