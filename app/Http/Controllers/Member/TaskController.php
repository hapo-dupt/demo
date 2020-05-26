<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\Member;
use App\Models\Task;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TaskController extends Controller
{
    /**
     * Show Select Project to view tasks.
     */
    public function index()
    {
        $listProject = auth()->user()->projects;
        return view('members.tasks.index', ['listProject' => $listProject, 'id' => Member::ID]);
    }

    /**
     * Show Tasks from id project.
     * @param $id
     * @return Factory|View
     */
    public function show($id)
    {
        $listTask = Task::all()->where('project_id', $id)->where('member_id', auth()->user()->id);
        return view('members.tasks.tasks', ['data' => $listTask, 'id' => $id, 'orderId' => Member::ID]);
    }

    /**
     * Complete Tasks
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request)
    {
        Task::findorFail($request->id)->update(['status' => Member::STATUS_CLOSE]);
        return redirect()->route('tasks.show', $request->projects)->with('success', trans('message.task_success'));
    }
}
