<?php

namespace Eozden\ApiResponse\Tests\Unit;

use Eozden\ApiResponse\Tests\TestCase;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Response;
use Illuminate\Validation\ValidationException;

class ResponseTest extends TestCase
{
    public function test_default_success_response()
    {
        $ok = Response::ok();

        $this->assertInstanceOf(JsonResponse::class, $ok);

        $content = json_decode($ok->content());

        $this->assertTrue($content->success);
        $this->assertEquals(200, $content->code);
        $this->assertEquals('en', $content->locale);
        $this->assertEquals('OK', $content->message);
        $this->assertEquals(null, $content->data);
    }

    public function test_default_error_response()
    {
        $error = Response::error();

        $this->assertInstanceOf(JsonResponse::class, $error);

        $content = json_decode($error->content());

        $this->assertFalse($content->success);
        $this->assertEquals(422, $content->code);
        $this->assertEquals('en', $content->locale);
        $this->assertEquals('UNPROCESSABLE ENTITY', $content->message);
        $this->assertEquals(null, $content->data);
    }

    public function test_string_error_response()
    {
        $error = Response::error('Model not found');

        $content = json_decode($error->content());

        $this->assertEquals('Model not found', $content->data->error->general);
    }

    public function test_array_error_response()
    {
        $error = Response::error(['model' => 'Model not found']);

        $content = json_decode($error->content());

        $this->assertEquals('Model not found', $content->data->error->model);
    }

    public function test_validation_error_response()
    {
        $exception = ValidationException::withMessages([
            'one' => ['Validation Message #1'],
            'two' => ['Validation Message #2'],
        ]);

        $error = Response::error($exception);

        $content = json_decode($error->content());

        $this->assertEquals('Validation Message #1', $content->data->error->one);
        $this->assertEquals('Validation Message #2', $content->data->error->two);
    }
}
