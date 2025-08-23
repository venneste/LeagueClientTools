<?php

declare(strict_types=1);

namespace lct\client\http;

enum RequestMethod : string{
    
    case GET = "GET";
    case POST = "POST";
    case PUT = "PUT";
    case DELETE = "DELETE";
}