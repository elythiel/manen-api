<?php

$finder = (new PhpCsFixer\Finder())
    ->in(__DIR__)
    ->exclude('vendor')
    ->exclude('var')
    ->notPath('src/Kernel.php')
    ->exclude('public/bundles')
    ->exclude('public/build')
    ->notPath('public/css/admin.css')
    ->notPath('public/index.php')
    ->exclude('node_modules')
    ->exclude('config')
    ->exclude('bin')
    ->exclude('assets')
    ->name('*.php')
    ->ignoreDotFiles(true)
;

return (new PhpCsFixer\Config())
    ->setRules([
        '@PhpCsFixer' => true,
        '@Symfony' => true,
        '@PHP80Migration' => true,
        '@DoctrineAnnotation' => true
    ])
    ->setFinder($finder)
;
