<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Technology;
use App\Models\Type;

class ProjectController extends Controller
{
  public function index() {
    $projects = Project::with('type', 'technologies')->paginate(20);
    return response()->json($projects);
  }

  public function types() {
    $types = Type::all();
    return response()->json($types);
  }

  public function technologies() {
    $types = Technology::all();
    return response()->json($types);
  }

  public function types_technogies($id) {
    $projects = Project::where('type_id', $id)
                      ->with('type', 'technologies')
                      ->paginate(20);
    return response()->json($projects);
  }
}
