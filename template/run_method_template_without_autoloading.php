<?php /** @noinspection ALL */

declare(strict_types=1);

$functionName = '#FUNCTION_NAME#';
$params = '#PARAMS#';

class Context
{
static #FUNCTION_CONTENT#
}

ob_start();
$result = serialize(Context::$functionName(...unserialize($params)));
ob_end_clean();

print($result);
