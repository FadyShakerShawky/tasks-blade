<?php
namespace App\Http\RepositoryLayers;

use App\Models\Status;

class StatusRepo extends Repository
{
    public function __construct()
    {
        parent::__construct(new Status());
    }

}
