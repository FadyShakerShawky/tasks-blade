<?php

namespace App\Http\ServiceLayers;

use App\Http\RepositoryLayers\StatusRepo;
use App\Http\RepositoryLayers\TaskRepo;

class TaskService
{
    private $repository;
    private $statusRepo;
    public function __construct(TaskRepo $taskRepo, StatusRepo $statusRepo)
    {
        $this->repository = $taskRepo;
        $this->statusRepo = $statusRepo;
    }
    public function getAll()
    {
        return $this->repository->getAllwithStatus();
    }
    public function create($data, $getId)
    {
        $data["status_id"] = $this->statusRepo->findBy("title", "added")->first()->id;
        return $this->repository->save($data, $getId);
    }
    public function updateStatus($data)
    {
        $status_id = $this->statusRepo->findBy("title", $data["status"])->first()->id;
        $task = $this->repository->findById($data["id"]);
        return $this->repository->updateByAttribute($task, "status_id", $status_id);
    }
    public function updateTitle($data)
    {
        $title = $data["title"];
        $task = $this->repository->findById($data["id"]);
        return $this->repository->updateByAttribute($task, "title", $title);
    }
    public function delete($task)
    {
        return $this->repository->delete($task);
    }

}
