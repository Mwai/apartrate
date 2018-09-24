<?php

use GuzzleHttp\Client;
use GuzzleHttp\Exception\BadResponseException;

function fetchApiResult($url, $method, $options = [])
{
    $client = new Client();
    try {
        $res = $client->request($method, $url, $options);
        $body = $res->getBody();
        $content = $body->getContents();
    } catch (BadResponseException $ex) {
        $response = $ex->getResponse();

        dd($response);
        $content = (string) $response->getBody();
    }

    return json_decode($content, true);
}
