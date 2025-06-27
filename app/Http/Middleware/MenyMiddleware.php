<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Inertia\Middleware;

class MenyMiddleware extends Middleware
{
    private array $meny;

    public function __construct()
    {
        $this->meny = [
            'events' => [
                'access' => false,
                'name' => 'Календарь выплат',
                'route' => 'payments.events.index',
                'method' => 'get'
            ],
            'glossary' => [
                'name' => 'Справочники',
                'access' => user()->hasPermission('edit_glossary'),
                'childrens' => [
                    'banks' => [
                        'name' => 'Банки',
                        'route' => 'glossary.banks.index',
                        'method' => 'get'
                    ],
                    'divisions' => [
                        'name' => 'Подразделения',
                        'route' => 'glossary.divisions.index',
                        'method' => 'get'
                    ],
                    'laws' => [
                        'name' => 'Законы',
                        'route' => 'glossary.laws.index',
                        'method' => 'get'
                    ],
                    'banks' => [
                        'name' => 'Выплаты',
                        'route' => 'glossary.payments.index',
                        'method' => 'get'
                    ],
                ]
            ],
            'users' => [
                'access' => user()->hasPermission('edit_users'),
                'name' => 'Пользователи',
                'route' => 'main.users.index',
                'method' => 'get'
            ],
            'logout' => [
                'access' => true,
                'name' => 'Выход',
                'route' => 'logout',
                'method' => 'post'
            ],
        ];
    }

    public function generateMeny(array $meny)
    {
        if (array_key_exists('access', $meny) and $meny['access'])
            return $meny;
        else
            return null;
        if (array_key_exists('childrens', $meny))
            foreach ($meny['childrens'] as $children) {
                return $this->generateMeny($children);
            }
    }

    public function share(Request $request): array
    {
        $shared = parent::share($request);

        foreach ($this->meny as $key => $item) {
            $list = $this->generateMeny($item);
            if ($list !== null)
                $shared['meny'][] = $list;
        }

        return $shared;
    }
}
