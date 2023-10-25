<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Models\Project;
use App\Models\Type;

use Illuminate\Http\Request;
use Illuminate\Support\Str;


class ProjectController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $projects = Project::orderByDesc('id')->paginate(12);
    return view('admin.projects.index', compact('projects'));
  }

  /**
   * Show the form for creating a new resource.
   *
   * * @return \Illuminate\Http\Response
   */
  public function create()
  {
    $types = Type::all();
    return view('admin.projects.create', compact('types'));
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * * @return \Illuminate\Http\Response
   */
  public function store(StoreProjectRequest $request)
  {
    $data = $request->validated();

    $project = new Project();

    // $project->title = $data['title'];
    // $project->content = $data['content'];

    $project->fill($data);

    $project->slug = Str::slug($project->title);
    $project->save();

    return redirect()->route('admin.projects.show', $project);

  }

  /**
   * Display the specified resource.
   *
   * @param  Project $project
   * * @return \Illuminate\Http\Response
   */
  public function show(Project $project)
  {
    return view('admin.projects.show', compact('project'));
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  Project $project
   * * @return \Illuminate\Http\Response
   */
  public function edit(Project $project)
  {
    $types = Type::all();
    return view('admin.projects.edit', compact('project', 'types'));
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  Project $project
   * * @return \Illuminate\Http\Response
   */
  public function update(UpdateProjectRequest $request, Project $project)
  {
    $data = $request->validated();

    $project->fill($data);
    $project->slug = Str::slug($project->title);
    $project->save();

    return redirect()->route('admin.projects.show', $project);
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  Project $project
   * * @return \Illuminate\Http\Response
   */
  public function destroy(Project $project)
  {
    $project->delete();
    return redirect()->route('admin.projects.index');
  }
}