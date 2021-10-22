<?php

namespace App\Http\Controllers;

use App\Http\ServiceLayers\TaskService;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    private $service;
    public function __construct(TaskService $taskService)
    {
        $this->service = $taskService;
    }
    public function index(Request $request)
    {
        $tasks = $this->service->getAll();
        if ($request->wantsJson()) {
            return $tasks;
        } else {
            return view("tasks.list", ["tasks" => $tasks]);
        }
    }
    public function edit(Task $task)
    {
        return view("tasks.edit", ["task" => $task]);
    }
    public function store(Request $request)
    {
        $request->validate(['title' => 'required|min:3']);
        $id = $this->service->create($request->all(), false);
        if ($request->wantsJson()) {
            return response()->json([
                "data" => ["id"=>$id],
            ]);
        } else {
            return redirect()->route("tasks-index");
        }
    }
    public function updateTitle(Request $request)
    {
        $request->validate(['title' => 'required|min:3']);
        $this->service->updateTitle($request->all());
        return redirect()->route("tasks-index");
    }
    public function updateStatus(Request $request)
    {
        $request->validate(['status' => 'required|exists:status,title']);
        $result = $this->service->updateStatus($request->all());
        if ($request->wantsJson()) {
            return response()->json([
                "status" => $result,
            ]);
        }
    }
    public function destroy(Task $task, Request $request)
    {
        $result = $this->service->delete($task);
        if ($request->wantsJson()) {
            return response()->json([
                "status" => $result,
            ]);
        } else {
            return redirect()->route("tasks-index");
        }
    }
    public function show(Task $task)
    {
        return $task;
    }
    public function create()
    {
        return view("tasks.create");
    }
}
