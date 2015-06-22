<?php

namespace DCN\Http\Controllers\Admin;

use DCN\Project;
use Illuminate\Http\Request;

use DCN\Http\Requests;
use DCN\Http\Controllers\Controller;

class ProjectController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getIndex()
    {
        //Display Latest User Actions Etc.
        $history = Project::classRevisionHistory();
        return view('backend.project.index',compact('history'));
    }
    public function getCreate()
    {
        return view('backend.project.create');
    }
    public function getList()
    {
        $projects = Project::paginate(10);
        return view('backend.project.list',compact('projects'));
    }
    public function getEdit(Project $project)
    {
        return view('backend.project.edit',compact('project'));
    }

    public function getEditInline(Project $project)
    {
        return view('backend.project.editInline',compact('project'));
    }

}
