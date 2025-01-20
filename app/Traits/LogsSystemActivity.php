<?php

namespace App\Traits;

use App\Models\SystemLog;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

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
        
        DB::table('system_logs')->insert([
            'entityName' => $entityName,
            'entityOperation' => $operation,
            'OperationDescription' => $description,
            'Datetime' => Carbon::now(),
        ]);

    }
}
