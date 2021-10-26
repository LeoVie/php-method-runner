<?php /** @noinspection ALL */

declare(strict_types=1);

$functionName = '#FUNCTION_NAME#';
$params = '#PARAMS#';

#FUNCTION_CONTENT#

print(serialize($functionName(...unserialize($params))));