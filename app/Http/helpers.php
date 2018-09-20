<?php

use GuzzleHttp\Client;
use GuzzleHttp\Exception\BadResponseException;

function fetchApiResult($url, $method)
{
    $client = new Client();
    try {
        $res = $client->request($method, $url);
        $body = $res->getBody();
        $content = $body->getContents();
    } catch (BadResponseException $ex) {
        $response = $ex->getResponse();
        $content = (string) $response->getBody();
    }

    return json_decode($content, true);
}
