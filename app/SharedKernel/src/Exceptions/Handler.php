<?php

declare(strict_types=1);

namespace App\SharedKernel\Exceptions;

use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

final class Handler extends ExceptionHandler
{
    public function render($request, Throwable $e): Response
    {
        if ($this->isJsonRpc2Dot0($request) && $e instanceof ValidationException) {
            $content = $this->convertValidationExceptionToResponse($e, $request)->getContent();
            $content = json_decode($content);

            return $this->renderJsonRpc2Dot0($request, -32602, $content->error, (object) $content->details);
        }

        if ($this->isJsonRpc2Dot0($request) && $e instanceof AuthenticationException) {
            return $this->renderJsonRpc2Dot0($request, -32001, $this->prepareException($e)->getMessage(), null);
        }

        if ($this->isJsonRpc2Dot0($request)) {
            return $this->renderJsonRpc2Dot0($request, -32603, $this->prepareException($e)->getMessage(), null);
        }

        return parent::render($request, $e);
    }

    private function isJsonRpc2Dot0($request): bool
    {
        return $request->wantsJson() && '2.0' === $request->input('jsonrpc');
    }

    private function renderJsonRpc2Dot0($request, int $code, string $message, ?object $data): Response
    {
        return response()->json(
            [
                'id' => (string) $request->input('id'),
                'error' => [
                    'code' => $code,
                    'message' => $message,
                    'data' => $data,
                ],
                'jsonrpc' => '2.0',
            ],
            Response::HTTP_OK
        );
    }
}
