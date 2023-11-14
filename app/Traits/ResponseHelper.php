<?php

namespace App\Traits;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Response;
use Exception;

trait ResponseHelper
{
    public function safeResponse(callable $callback, bool $isTransaction = false, int $httpStatus = Response::HTTP_OK): Response
    {
        try {

            $result = $isTransaction ? $this->transactionWrapper($callback) : $callback();

            return response([
                ...$result
            ], $httpStatus);

        } catch (Exception $e)
        {
            if($isTransaction)
                DB::rollback();

            return response([
                'status' => false,
                'message' => "Something went wrong",
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    private function transactionWrapper(callable $callback) : array
    {
        DB::beginTransaction();
        $result = $callback();
        DB::commit();

        return $result;
    }
}
