<?php

const TYPE_ARRAY = 1;
const TYPE_BOOL = 2;
const TYPE_INT = 4;
const TYPE_STRING = 8;
const TYPE_FLOAT = 16;

$names = [
    TYPE_ARRAY => 'array',
    TYPE_INT => 'int',
    TYPE_STRING => 'string',
    TYPE_BOOL => 'bool',
    TYPE_FLOAT => 'float',
];

$array = [
];

foreach ($array as $k => $v) {

    if (is_numeric($v)) {
        $v = $names[$v];
    }

    echo(' * @method $this set' . snakeToCamel($k) . '(' . $v . ' $' . snakeToVariable($k) . ')' . "\n");
    echo(' * @method ' . $v . '|null get' . snakeToCamel($k) . '()' . "\n");

}

function snakeToVariable($string)
{
    $string = snakeToCamel($string);
    $string[0] = strtolower($string[0]);
    return $string;
}

function snakeToCamel($string)
{
    return str_replace(' ', '', ucwords(str_replace('_', ' ', $string)));
}
