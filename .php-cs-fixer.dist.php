<?php

$finder = (new PhpCsFixer\Finder())
    ->in(__DIR__)
    ->exclude('vendor')
    ->exclude('var')
    ->exclude('public/bundles')
    ->exclude('public/build')
    ->exclude('node_modules')
    ->exclude('config')
    ->exclude('bin')
    ->exclude('assets')
    ->notPath('src/Kernel.php')
    ->notPath('public/css/admin.css')
    ->notPath('public/index.php')
    ->notName('deploy.php')
    ->notName('.php-cs-fixer')
    ->name('*.php')
    ->ignoreDotFiles(true)
;

return (new PhpCsFixer\Config())
    ->setRules([
        '@PhpCsFixer' => true,
        '@Symfony' => true,
        '@PHP80Migration' => true,
        '@DoctrineAnnotation' => true,
    ])
    ->setFinder($finder)
;
