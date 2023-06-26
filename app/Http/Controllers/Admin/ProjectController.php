<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProjectRequest;
use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Technology;
use App\Models\Type;
use Illuminate\Support\Facades\Storage;
use App\Helpers\CustomHelper;


class ProjectController extends Controller
{
    public function index()
    {
      $direction = 'asc';
      $projects = Project::paginate(20);
      return view('admin.projects.index', compact('projects', 'direction'));
    }



    public function create()
    {
      $types        = Type::all();
      $technologies = Technology::all();
      return view('admin.projects.create', compact('types', 'technologies'));
    }



    public function store(ProjectRequest $request)
    {
      $form_data        = $request->all();
      $form_data['slug']= CustomHelper::generateSlug(new Project, $form_data['title']);

      if (array_key_exists('image', $form_data)) {
        $form_data['image_name'] = $request->file('image')->getClientOriginalName();
        $form_data['image_path'] = Storage::put('uploads', $form_data['image']);
      }

      $new_project = Project::create($form_data);

      if (array_key_exists('technologies', $form_data)) {
        $new_project->technologies()->attach($form_data['technologies']);
      }

      return redirect()->route('admin.projects.show', $new_project);
    }



    public function show(Project $project)
    {
      return view('admin.projects.show', compact('project'));
    }



    public function edit(Project $project)
    {
      $types        = Type::all();
      $technologies = Technology::all();
      return view('admin.projects.edit', compact('project', 'types', 'technologies'));
    }



    public function update(ProjectRequest $request, Project $project)
    {
      $form_data = $request->all();

      if ($form_data['title'] != $project->title) {
        $form_data['slug'] = CustomHelper::generateSlug(new Project() , $form_data['title']);
      } else {
        $form_data['slug'] = $project->slug;
      }

      if (array_key_exists('image', $form_data)) {
        if ($project->image_path) {
          Storage::disk('public')->delete($project->image_path);
        }
        $form_data['image_name'] = $request->file('image')->getClientOriginalName();
        $form_data['image_path'] = Storage::put('uploads', $form_data['image']);
      }

      if (array_key_exists('technologies', $form_data)) {
        $project->technologies()->sync($form_data['technologies']);
      } else {
        $project->technologies()->detach();
      }

      $project->update($form_data);
      return redirect()->route('admin.projects.show', $project);
    }



    public function destroy(Project $project)
    {
      if ($project->image_path) {
        Storage::disk('public')->delete($project->image_path);
      }

      $project->delete();
      return redirect()->route('admin.projects.index', $project)
                       ->with('deleted', 'The project has been cancelled');
    }



    public function orderBy($direction)
    {
      $direction = $direction === 'asc' ? 'desc' : 'asc';
      $projects = Project::orderBy('id', $direction)->paginate(20);
      return view('admin.projects.index', compact('projects', 'direction'));
    }
}
