<?php

namespace App\Services;

use Exception;
use Illuminate\Support\Facades\DB;

abstract class AbstractService
{
    /**
     * Start a database transaction.
     *
     * @throws Exception
     */
    protected function beginTransaction()
    {
        DB::beginTransaction();
    }

    /**
     * Commit a database transaction.
     */
    protected function commit()
    {
        DB::commit();
    }

    /**
     * Cancel any database changes made during the current transaction.
     */
    protected function rollback()
    {
        DB::rollBack();
    }
}
