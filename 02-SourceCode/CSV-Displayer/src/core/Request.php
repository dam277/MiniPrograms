<?php
class Request
{
    public static function getRequest(): array
    {
        $request = [];
        $request['method'] = $_SERVER['REQUEST_METHOD'];
        $request['action'] = $_GET['action'] ?? null;
        return $request;
    }
}
?>