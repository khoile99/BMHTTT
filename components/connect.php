<?php
error_reporting(E_ERROR | E_PARSE);
function connect_orc($user_name = "Shop", $password = "shop")
{
    $url = "bmhttt1.cwxb69gela3k.ap-northeast-1.rds.amazonaws.com";
    $port = 1521;
    $service_name = "SHOP";

    $conn = oci_connect(
        username: $user_name,
        password: $password,
        connection_string: "$url:$port/$service_name",
        session_mode: OCI_DEFAULT
    );
    return $conn;
}
