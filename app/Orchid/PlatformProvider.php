<?php

declare(strict_types=1);

namespace App\Orchid;

use Orchid\Platform\Dashboard;
use Orchid\Platform\ItemPermission;
use Orchid\Platform\OrchidServiceProvider;
use Orchid\Screen\Actions\Menu;
use Orchid\Support\Color;

class PlatformProvider extends OrchidServiceProvider
{
    /**
     * @param Dashboard $dashboard
     */
    public function boot(Dashboard $dashboard): void
    {
        parent::boot($dashboard);

        // ...
    }

    /**
     * @return Menu[]
     */
    public function registerMainMenu(): array
    {
        return [
            Menu::make('DashBoard')
                ->icon('bar-chart')
                ->route('platform.main'),

            Menu::make('Página Home')
                ->icon('menu')
                ->permission([
                    'platform.banners.list',
                    'platform.differentials.list',
                    'platform.brands.list',
                    'platform.pageshome.list',
                    'platform.pageshome.edit',
                ])
                ->list([
                    Menu::make('Banners')
                        ->route('platform.banners.list')
                        ->permission('platform.banners.list'),

                    // Menu::make('Diferenciais')
                    //     ->route('platform.differentials.list')
                    //     ->permission('platform.differentials.list'),

                    // Menu::make('Marcas')
                    //     ->route('platform.brands.list')
                    //     ->permission('platform.brands.list'),

                    Menu::make('Conteúdo e SEO')
                        ->route('platform.pageshome.edit')
                        ->permission('platform.pageshome.edit'),
                ]),

            Menu::make('Empresa')
                ->icon('building')
                ->permission([
                    'platform.pagescompanies.edit',
                ])
                ->list([
                    Menu::make('Linha do tempo')
                    ->route('platform.ourhistory.list')
                    ->permission('platform.ourhistory.list'),
                    Menu::make('Conteúdo e SEO')
                        ->route('platform.pagescompanies.edit')
                        ->permission('platform.pagescompanies.edit'),
                ]),

            Menu::make('Produtos')
                ->icon('modules')
                ->permission([
                    'platform.products_applications.list', 'platform.productscategories.list',
                    'platform.products.list', 'platform.catalogs.edit', 'platform.pagesproducts.edit',
                ])
                ->list([
                    Menu::make('Linhas')
                        ->route('platform.products_applications.list')
                        ->permission('platform.products_applications.list'),
                    Menu::make('Tags')
                        ->route('platform.productstags.list')
                        ->permission('platform.productstags.list'),
                    // Menu::make('Marcas')
                    //     ->route('platform.productscategories.list')
                    //     ->permission('platform.productscategories.list'),
                    Menu::make('Produtos')
                        ->route('platform.products.list')
                        ->permission('platform.products.list'),
                    // Menu::make('Catálogos')
                    //     ->route('platform.catalogs.edit')
                    //     ->permission('platform.catalogs.edit'),
                    Menu::make('Conteúdo e SEO')
                        ->route('platform.pagesproducts.edit')
                        ->permission('platform.pagesproducts.edit'),
                ]),

            // Menu::make('Treinamentos')
            //     ->icon('target')
            //     ->route('platform.pagestrainings.edit')
            //     ->permission('platform.pagestrainings.edit'),

            // Menu::make('Blog')
            //     ->icon('note')
            //     ->permission([
            //         'platform.posts.list', 'platform.postscategories.list',
            //         'platform.pagesblog.edit',
            //     ])
            //     ->list([
            //         Menu::make('Artigos')
            //             ->route('platform.posts.list')
            //             ->permission('platform.posts.list'),
            //         Menu::make('Categorias')
            //             ->route('platform.postscategories.list')
            //             ->permission('platform.postscategories.list'),
            //         Menu::make('Conteúdo e SEO')
            //             ->route('platform.pagesblog.edit')
            //             ->permission('platform.pagesblog.edit'),

            //     ]),

            Menu::make('Contato')
                ->icon('bubbles')
                ->permission([
                    'platform.siteemails.list', 'platform.pagescontact.edit',
                ])
                ->list([
                    Menu::make('Mensagens Recebidas')
                        ->route('platform.siteemails.list')
                        ->permission('platform.siteemails.list'),

                    Menu::make('Conteúdo')
                        ->route('platform.pagescontact.edit')
                        ->permission('platform.pagescontact.edit'),
                ]),

            Menu::make('Política de privacidade')
                ->icon('shield')
                ->route('platform.pagesprivacy.edit')
                ->permission('platform.pagesprivacy.edit'),

            Menu::make('Administração')
                ->icon('settings')
                ->permission([
                    'platform.configurations.edit', 'platform.systems.users',
                    'platform.systems.roles', 'platform.systems.logs',
                ])
                ->list([
                    Menu::make("Configurações")
                        ->route('platform.configurations.edit')
                        ->permission('platform.configurations.edit'),

                    Menu::make(__('Users'))
                        ->route('platform.systems.users')
                        ->permission('platform.systems.users'),

                    Menu::make(__('Níveis'))
                        ->route('platform.systems.roles')
                        ->permission('platform.systems.roles'),

                    Menu::make("Logs")
                        ->route('platform.systems.logs')
                        ->permission('platform.systems.logs'),
                ]),

        ];
    }

    /**
     * @return Menu[]
     */
    public function registerProfileMenu(): array
    {
        return [
            Menu::make(__('Profile'))
                ->route('platform.profile')
                ->icon('user'),
        ];
    }

    /**
     * @return ItemPermission[]
     */
    public function registerPermissions(): array
    {
        $permissions = [
            ItemPermission::group(__('System'))
                ->addPermission('platform.systems.roles', __('Roles'))
                ->addPermission('platform.systems.users', __('Users'))
                ->addPermission('platform.systems.logs', __('Logs')),
        ];

        foreach (screens()->permissions() as $permission) {
            $permissions[] = $permission;
        }

        return $permissions;
    }
}
