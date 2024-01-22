<?php

function getRoutes(): array
{
    return [
        '' => 'HomeHandler@index',
        'architects' => 'ArchitectHandler@index',
        'architects/detail' => 'ArchitectHandler@detail',
        'architects/create' => 'ArchitectHandler@create',
        'architects/edit' => 'ArchitectHandler@edit',
        'architects/delete' => 'ArchitectHandler@delete',
        'skyscrapers' => 'SkyscraperHandler@index',
        'skyscrapers/detail' => 'SkyscraperHandler@detail',
        'skyscrapers/create' => 'SkyscraperHandler@create',
        'skyscrapers/edit' => 'SkyscraperHandler@edit',
        'skyscrapers/delete' => 'SkyscraperHandler@delete',
        'usages' => 'UsageHandler@index',
        'usages/detail' => 'UsageHandler@detail',
        'usages/create' => 'UsageHandler@create',
        'usages/edit' => 'UsageHandler@edit',
        'usages/delete' => 'UsageHandler@delete',
        'user/login' => 'AccountHandler@login',
        'user/logout' => 'AccountHandler@logout',
        'user/register' => 'AccountHandler@register'
    ];
}
