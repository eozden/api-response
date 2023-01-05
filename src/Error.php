<?php

namespace Eozden\ApiResponse;

use Illuminate\Validation\ValidationException;

class Error
{
    protected $error;

    public function __construct($error)
    {
        $this->error = $error;
    }

    private function pack()
    {
        $data = $this->error;

        if (is_string($this->error)) {
            $data = ['all' => $this->error];
        }

        if ($this->error instanceof ValidationException) {
            $data = $this->createFromValidationException();
        }

        return $data;
    }

    public function toArray()
    {
        $pack = $this->pack();

        if (is_null($pack)) {
            return null;
        }

        return [
            'error' => $pack,
        ];
    }

    public function createFromValidationException()
    {
        $response = [];
        foreach ($this->error->errors() as $key => $error) {
            $response = array_merge($response, [
                $key => array_shift($error),
            ]);
        }

        return $response;
    }
}
