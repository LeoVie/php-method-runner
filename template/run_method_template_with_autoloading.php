<?php /** @noinspection ALL */

declare(strict_types=1);

require_once '#BOOTSTRAP_SCRIPT#';

$class = new #CLASS_NAME#(unserialize(#CLASS_PARAMS#));

print(serialize($class->#FUNCTION_NAME#(#FUNCTION_PARAMS#)));