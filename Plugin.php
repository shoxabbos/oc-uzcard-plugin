<?php namespace Shohabbos\Uzcard;

use Backend;
use System\Classes\PluginBase;

class Plugin extends PluginBase
{

    public function registerComponents()
    {
        return [
            \Shohabbos\Uzcard\Components\PayForm::class => 'uzcardPayForm',
        ];
    }

    public function registerReportWidgets()
    {
        return [
            'Shohabbos\Uzcard\ReportWidgets\Payment' => [
                'label' => 'Transactions of uzcard',
                'context' => 'dashboard'
            ],
        ];
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
                'permissions' => ['manage_uzcard_settings']
            ],
            'transactions' => [
                'category'    => 'UZCARD',
                'label'       => 'Transactions',
                'description' => 'History of transactions',
                'icon'        => 'icon-list-alt',
                'url'         => Backend::url('shohabbos/uzcard/transactions'),
                'order'       => 2,
                'permissions' => ['manage_uzcard_transactions']
            ],
        ];
    }

}
