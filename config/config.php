<?php

return [

    "default" => [
		"ok" => \Eozden\ApiResponse\ResponseStatus::OK,
		"error" => \Eozden\ApiResponse\ResponseStatus::UNPROCESSABLE_ENTITY,
    ],
    
    "force" => true,
    
    "map" => [
        \Eozden\ApiResponse\ResponseStatus::OK => "ok",
        \Eozden\ApiResponse\ResponseStatus::CREATED => "created",
        \Eozden\ApiResponse\ResponseStatus::ACCEPTED => "accepted",
        \Eozden\ApiResponse\ResponseStatus::NO_CONTENT => "no_content",
        \Eozden\ApiResponse\ResponseStatus::NOT_MODIFIED => "not_modified",
        \Eozden\ApiResponse\ResponseStatus::BAD_REQUEST => "bad_request",
        \Eozden\ApiResponse\ResponseStatus::UNAUTHORIZED => "unauthorized",
        \Eozden\ApiResponse\ResponseStatus::FORBIDDEN => "forbidden",
        \Eozden\ApiResponse\ResponseStatus::NOT_FOUND => "not_found",
        \Eozden\ApiResponse\ResponseStatus::CONFLICT => "conflict",
        \Eozden\ApiResponse\ResponseStatus::UNPROCESSABLE_ENTITY => "unprocessable_entity",
        \Eozden\ApiResponse\ResponseStatus::INTERNAL_SERVER_ERROR => "internal_server_error"
	]
];