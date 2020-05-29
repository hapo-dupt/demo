<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\Member;
use App\Models\Project as Project;
use App\Models\Task;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProjectController extends Controller
{
    /**
     * Return view projects
     */
    public function index()
    {
        $listProject = auth()->user()->projects()->paginate(config('app.pagination'));
        return view('members.projects.projects', ['projects' => $listProject, 'id' => Member::ID]);
    }

    /**
     * Show details of projects
     * @param $id
     * @return Factory|View
     */
    public function show($id)
    {
        $tasksProject = Project::find($id)->tasks;
        $numberOfTaskFinished = $tasksProject->where('status', Member::STATUS_CLOSE)->count();
        $projectDetail = Project::findorFail($id);
        $customer = Project::find($id)->customers;
        $member = Project::find($id)->members;
        if ($tasksProject && $numberOfTaskFinished != null) {
            $process = number_format(($numberOfTaskFinished / count($tasksProject)) * 100, 1, '.', ',');
        } else {
            $process = 0;
        }
        $contentProject = array(
            'process' => $process,
            'projectDetail' => $projectDetail,
            'customer' => $customer,
            'member' => $member
        );
        return view('members.projects.details')->with('contentProject', $contentProject);
    }
}
