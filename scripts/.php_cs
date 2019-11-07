<?php

return PhpCsFixer\Config::create()
    ->setRiskyAllowed(false)
    ->setRules(
        [
            '@PSR2' => true,
            '@Symfony' => true,
            '@PhpCsFixer' => true,
            'multiline_whitespace_before_semicolons' => [
                'strategy' => 'no_multi_line',
            ],
            'no_singleline_whitespace_before_semicolons' => true,
            'ordered_class_elements' => [
                'sortAlgorithm' => 'alpha',
            ],
        ]
    )
    ->setFinder(
        PhpCsFixer\Finder::create()
            ->in(realpath(__DIR__ . '/../var/www/app/src/'))
            ->notName('*.xml')
            ->notName('*.yml')
            ->notName('*.twig')
            ->notName('*.js')
    )
    ->setUsingCache(false);