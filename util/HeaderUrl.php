<?php
class HeaderUrl
{
    public static function headerFunction($url)
    {
        $protocol = "http";
        if (isset($_SERVER["HTTPS"])) {
            $protocol = "https";
        }
        $host_name = "";
        if (array_key_exists("HTTP_HOST", $_SERVER)) {
            $host_name = $_SERVER["HTTP_HOST"];
        }
        $protocol_hostname = $protocol . "://{$host_name}";

        $header = $protocol_hostname . $url;
        header('location:' . $header);
        die();
    }
    public static function regularHeaderFunction($url){
        header('location:' . $url);
        die();
    }
    public static function getUrl($url)
    {
        $protocol = "http";
        if (isset($_SERVER["HTTPS"])) {
            $protocol = "https";
        }
        $host_name = "";
        if (array_key_exists("HTTP_HOST", $_SERVER)) {
            $host_name = $_SERVER["HTTP_HOST"];
        }
        $protocol_hostname = $protocol . "://{$host_name}";

        $header = $protocol_hostname . $url;
        return $header;
    }
}
