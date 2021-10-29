<?php

use PhpCsFixer\Finder;
use PhpCsFixer\Config;

$directories = ['storage/framework', 'vendor'];
$files = ['*.blade.php', '*.bc.php', '_ide_helper.php', '*.phar'];

$rules = [
    '@PSR2' => true,
];

$finder = Finder::create()
    ->in(__DIR__)
    ->exclude($directories);

foreach ($files as $file) {
    $finder->notName($file);
}
    
return (new Config())
    ->setRiskyAllowed(false)
    ->setRules($rules)
    ->setUsingCache(false)
    ->setFinder($finder);
