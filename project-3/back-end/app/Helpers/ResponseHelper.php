<?php

namespace App\Helpers;

class ResponseHelper {

    private array $response;

    public function __construct(
        private string $message,
        private int $statusCode,
        private bool $error = true,
        private array $data = []
    )
    {
        $this->response = [
            'message' => $this->message,
            'statusCode' => $this->statusCode,
            'error' => $this->error,
            'data' => $this->data
        ];
    }

    public function get()
    {
        return $this->response;
    }

    public function send()
    {
        return Response()->json($this->response, $this->response['statusCode']); 
    }

}