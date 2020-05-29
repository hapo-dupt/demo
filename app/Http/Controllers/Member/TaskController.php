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
        $taskByProject = auth()->user()->projects()->paginate(config('app.pagination'));
        return view('members.tasks.index', ['data' => $taskByProject, 'id' => Member::ID]);
    }

    /**
     * Show Tasks from id project.
     * @param $id
     * @return Factory|View
     */
    public function show($id)
    {
        $listTask = auth()->user()->tasks()->where('project_id', $id)->paginate(config('app.pagination'));
        return view('members.tasks.tasks', ['data' => $listTask, 'project_id' => $id, 'orderId' => Member::ID]);
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
