<?php

namespace DCN\Http\Controllers\Api;

use DCN\Project;
use Illuminate\Http\Request;

use DCN\Http\Requests;
use DCN\Http\Requests\ProjectRequest;
use DCN\Http\Controllers\Controller;
use Illuminate\Support\Facades\Response;

class ApiProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $projects = Project::paginate(10);
        return Response::json(array(
            'success' => true,
            'projects'   => $projects->toArray()
        ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('api.project.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ProjectRequest $request
     * @return Response
     */
    public function store(ProjectRequest $request)
    {
        try{
            if(Auth::user()->can('project.create')) {
                $project = Project::create($request->all());
            }
            return Response::json(array(
                'success' => true,
                'project'   => $project
            ));
        }
        catch(\Exception $e){
            return Response::json(array(
                'success' => false,
                'error'   => $e
            ));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param Project $project
     * @return Response
     * @internal param int $id
     */
    public function show(Project $project)
    {
        return Response::json(array(
            'success' => true,
            'project'   => $project
        ));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Project $project
     * @return Response
     * @internal param int $id
     */
    public function edit(Project $project)
    {
        return view('api.project.edit', compact('project'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Project $project
     * @param ProjectRequest $request
     * @return Response
     * @internal param int $id
     */
    public function update(Project $project, ProjectRequest $request)
    {
        try
        {
            $project->update($request->all());

            return Response::json(array(
                'success' => true,
                'project'   => $project
            ));
        }
        catch(\Exception $e)
        {
            return Response::json(array(
                'success' => false,
                'error'   => $e
            ));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Project $project
     * @return Response
     * @internal param int $id
     */
    public function destroy(Project $project)
    {
        try{
            $project->delete();
            return Response::json(array(
                'completed' => true
            ));
        }
        catch(\Exception $e){
            return Response::json(array(
                'success' => false,
                'error'   => $e
            ));
        }
    }
}
