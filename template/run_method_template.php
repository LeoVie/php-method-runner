<?php /** @noinspection ALL */

declare(strict_types=1);

$functionName = '#FUNCTION_NAME#';
$params = '#PARAMS#';

class Context
{
static #FUNCTION_CONTENT#
}

print(serialize(Context::$functionName(...unserialize($params))));