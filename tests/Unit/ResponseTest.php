<?php

namespace Eozden\ApiResponse\Tests\Unit;

use Illuminate\Http\JsonResponse;
use Eozden\ApiResponse\Tests\TestCase;
use Illuminate\Support\Facades\Response;

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
}