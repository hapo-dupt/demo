<?php

namespace App\Http\Controllers\General;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SearchController extends Controller
{
    protected $optionProject = 1;

    /**
     * Search result by key word
     * @param Request $request
     * @return Factory|View
     */
    public function search(Request $request)
    {
        $keyword = $request->keyword;
        if ($request->filter == $this->optionProject) {
            $project = auth()->user()->projects()->where('title', 'like', "%$keyword%")
                                                 ->orWhere('description', 'like', "%$keyword%")
                                                 ->paginate(5);
            return view('generals.resultSearch', ['data' => $project, 'searchFor' => 'Project', 'oldData' => $request]);
        } else {
            $task = auth()->user()->tasks()->where('title', 'like', "%$keyword%")
                                           ->orWhere('description', 'like', "%$keyword%")
                                           ->paginate(3);
            return view('generals.resultSearch', ['data' => $task, 'searchFor' => 'Task', 'oldData' => $request]);
        }
    }

    /**
     * Show details Task of Result
     * @param $id
     * @return
     */
    public function show($id)
    {
        //This part will complete later.
        return $id;
    }
}
