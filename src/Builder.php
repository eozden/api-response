<?php

namespace Eozden\ApiResponse;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Response;

class Builder
{
    protected $type;
    protected $success;
    protected $code;
    protected $locale;
    protected $message;
    protected $data;

    public function type(string $type)
    {
        $this->type = $type;

        return $this;
    }    

    public function data($data)
    {
        $this->data = $data;

        return $this;
    }

    public function code(int $code = null)
    {
        $this->code = $code;

        if(is_null($this->code)) {
            $this->code = config("api-response.default.{$this->type}");
        }

        return $this;
    }

    private function success()
    {
        if($this->type == 'error') {
            return false;
        }

        return true;
    }

    private function locale()
    {
        return App::getLocale();        
    }

    private function message()
    {
        $message = config("api-response.map.{$this->code}", null);

        return trans('api-response::apiresponse.'.$message);
    }    

    public function build()
    {
        return Response::json([
            'success' => $this->success(),
            'code'    => $this->code,
            'locale'  => $this->locale(),
            'message' => $this->message(),
            'data'    => $this->data
        ], $this->code);
    }

    public static function ok($data = null, int $code = null)
    {
        return (new self())
            ->type('ok')
            ->data($data)
            ->code($code)
            ->build();
    }

    public static function error($data = null, int $code = null)
    {
        return (new self())
            ->type('error')
            ->data($data)
            ->code($code)
            ->build();
    }
}