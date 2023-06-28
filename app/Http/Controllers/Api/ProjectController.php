<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Project;
use App\Models\Technology;
use App\Models\Type;

class ProjectController extends Controller
{
  public function index() {
    $projects = Project::with('type', 'technologies')->paginate(20);
    $types = Type::all();
    $technologies = Technology::all();
    return response()->json(compact('projects', 'types', 'technologies'));
  }

  public function getTypes($id) {
    $projects = Project::where('type_id', $id)
    ->with('type', 'technologies')
                      ->paginate(20);
    $types = Type::all();
    $technologies = Technology::all();
    return response()->json(compact('projects', 'types', 'technologies'));
  }

  public function getTechnologies($id) {
    $projects = Project::whereHas('technologies', function(Builder $query) use($id) {
      $query->where('technology_id', $id);
    })
                          ->with('type', 'technologies')
                          ->paginate(20);
    $types = Type::all();
    $technologies = Technology::all();
    return response()->json(compact('projects', 'types', 'technologies'));
  }

  public function getProject($slug) {
    $projects = Project::where('slug', $slug)
                        ->with('type', 'technologies')
                        ->first();
    if ($projects->image_path) $projects->image_path = asset('storage/' . $projects->image_path);
    return response()->json($projects);
  }
}
