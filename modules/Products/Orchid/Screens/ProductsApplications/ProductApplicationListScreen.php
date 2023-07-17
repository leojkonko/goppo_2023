<?php

namespace Ellite\Products\Orchid\Screens\ProductsApplications;

use Orchid\Screen\Screen;
use Ellite\Products\Models\ProductApplication;
use Orchid\Support\Facades\Layout;
use Orchid\Screen\TD;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\DropDown;
use Orchid\Support\Facades\Toast;
use App\Ellite\ElliteScreen;

class ProductApplicationListScreen extends ElliteScreen
{
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(): iterable
    {
        return [
            'lista' => ProductApplication::orderBy('order')
                ->paginate(),
        ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Lista de linhas';
    }

    /**
     * The screen's action buttons.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [
            parent::getCreateLink('platform.products_applications.create'),
        ];
    }

    /**
     * The screen's layout elements.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): iterable
    {
        return [
            Layout::table('lista', [
                TD::make()->sortable('products_applications'),
                TD::make("name", "Nome"),
                TD::make("active", "Ativo")->toggleActive('products_applications'),
                TD::make(__('Actions'))
                    ->align(TD::ALIGN_CENTER)
                    ->width('100px')
                    ->render(fn (ProductApplication $model) => DropDown::make()
                        ->icon('options-vertical')
                        ->list([
                            parent::getEditButton($model, 'platform.products_applications.edit', true),
                            parent::getRemoveButton($model, true),
                        ])),
            ]),
        ];
    }
    
    public function remove(ProductApplication $model)
    {
        return parent::delete($model, 'platform.products_applications.list');
    }

    public static function routes()
    {
        parent::routeList('linhas', 'products_applications');
    }
    
    public static function permissions()
    {
        return parent::crudPermissions('linhas', 'products_applications');
    }
}
