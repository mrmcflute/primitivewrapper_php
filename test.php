<?php
declare(strict_types=1);

use PrimitiveWrapper\ComposerTransformerBootstrapper;
use PrimitiveWrapper\Wrappers\WrapperFactory;

/*
$testNumber = WrapperFactory::number(12);

echo $testNumber->times(4)->toString() . "\n";


$testString = WrapperFactory::string('This is a test string');

echo $testString->pad(50, '___', STR_PAD_BOTH)
    ->reverse()
    ->toUpper()
    ->toLower();

echo "\n\n";

$formattedString = WrapperFactory::string("Hello {{ name }}. I'm building a cool {{ thing }}");

$returnedString = $formattedString->format()
    ->setVariableValue('name', 'Chat GPT!!!!!')
    ->setVariableValue('thing', 'Primitive Wrapper')
    ->render()
    ->reverse();

echo $returnedString . "\n";

$array = $returnedString->split()
    ->reverse();

var_dump($array->unwrap());

echo $array->reverse()->join(' ') . "\n";

echo $array->join('-')->reverse()->pad(1000, '*');

echo "\n\n";
*/

require_once 'vendor/autoload.php';

ComposerTransformerBootstrapper::boot();

$replaceableString = WrapperFactory::string("This is a test");

echo $replaceableString. "\n";

echo $replaceableString->replace(11, 'not a drill');

