<?php

namespace App\Services;

use App\Models\Log;
use App\Ellite\ElliteModel;

class LogsService
{
    public function __construct()
    {

    }

    public function logCreated(ElliteModel $model)
    {

    }
    
    public function logEdited(ElliteModel $model)
    {

    }
    
    public function logDeleted(ElliteModel $model)
    {

    }

    public function insertLog(string $message, string $action, string $entity_model, int $entity_id = 0)
    {
        $log = new Log();

        $log->message = $message;
        $log->action = $action;
        $log->entity_model = $entity_model;
        $log->entity_id = $entity_id;

        $log->user_id = auth()->user()->id;
        $log->user_name = auth()->user()->name;

        $log->save();
    }
}
