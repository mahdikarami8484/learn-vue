<?php

namespace Tests\Unit;

use App\Helpers\ResponseHelper;
use Tests\TestCase;
use Illuminate\Http\Request;
use Illuminate\Contracts\Routing\ResponseFactory;

class ResponseHelperTest extends TestCase
{
    public function test_helper_response()
    {
        $message = "this is a test.";
        $statusCode = 404;

        $array = [
            "message" => $message,
            "statusCode" => $statusCode,
            "error" => true,
            "data" => []
        ];

        $response_test = Response()->json($array, $array['statusCode']);

        $response_with_helper_response = new ResponseHelper($message, $statusCode);
        
        $this->assertEquals($array, $response_with_helper_response->get());
        $this->assertEquals($response_test, $response_with_helper_response->send());
    }
}
