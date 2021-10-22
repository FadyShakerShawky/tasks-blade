<?php
namespace App\Http\RepositoryLayers;

use App\Models\Task;

class TaskRepo extends Repository
{
    public function __construct()
    {
        parent::__construct(new Task());
    }

    public function save($data)
    {
        $this->model->create($data);
    }
    public function getAllwithStatus()
    {
        $tasks = parent::getAll();
        foreach ($tasks as $task) {
            $task->status;
        }
        return $tasks;
    }
    public function delete($tasks)
    {
        return $tasks->delete();
    }

}
