<?php namespace Shohabbos\Uzcard;

use Backend;
use System\Classes\PluginBase;

class Plugin extends PluginBase
{
    public function registerComponents()
    {
    }

    public function registerSettings()
    {
        return [
            'settings' => [
                'category'    => 'UZCARD',
                'label'       => 'Settings',
                'description' => 'PIXEL SHOP',
                'icon'        => 'icon-cog',
                'class'       => 'Shohabbos\Uzcard\Models\Settings',
                'order'       => 1,
                'keywords'    => 'uzcard woywoo',
            ],
            'transactions' => [
                'category'    => 'UZCARD',
                'label'       => 'Transactions',
                'description' => 'History of transactions',
                'icon'        => 'icon-list-alt',
                'url'         => Backend::url('shohabbos/uzcard/transactions'),
                'order'       => 2,
                'permissions' => ['shohabbos.uzcard.manage_transactions']
            ],
        ];
    }

}
