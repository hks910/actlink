<?php

namespace App\Traits;

use App\Models\systemLog;
use Illuminate\Support\Carbon;

trait LogsSystemActivity
{
    /**
     * Log a system activity.
     *
     * @param string $entityName
     * @param string $operation
     * @param string $description
     */
    public function logActivity($entityName, $operation, $description)
    {
        systemLog::create([
            'entityName' => $entityName,
            'entityOperation' => $operation,
            'OperationDescription' => $description,
            'Datetime' => Carbon::now(),
        ]);
    }
}
