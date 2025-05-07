<?php

namespace App\Services\Ebay\Repositories;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Log;
use Throwable;

trait ErrorTrait
{
    protected string $errorMessage;

    /**
     * @return string
     */
    public function getErrorMessage(): string
    {
        return $this->errorMessage;
    }

    /**
     * @param Throwable $e
     * @param Response|null $response
     * @return bool
     */
    protected function handleError(Throwable $e, Response $response = null): bool
    {
        $message = !isset($response) ? $e->getMessage() : $response->body();
        Log::build([
            'driver' => 'single',
            'path' => storage_path('logs/ebay.log'),
        ])->error($this->errorMessage = $message, ['class' => get_class($e)]);
        return false;
    }
}
