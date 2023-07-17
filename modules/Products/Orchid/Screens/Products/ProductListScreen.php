<?php

namespace Ellite\Products\Orchid\Screens\Products;

use Orchid\Screen\Screen;
use Ellite\Products\Models\Product;
use Ellite\Products\Models\ProductCategory;
use Orchid\Support\Facades\Layout;
use Orchid\Screen\TD;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\DropDown;
use Orchid\Support\Facades\Toast;
use App\Ellite\ElliteScreen;
use Ellite\Products\Orchid\Filters\ProductCategoryFilter;
use Orchid\Screen\Fields\Input;

class ProductListScreen extends ElliteScreen
{
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(): iterable
    {
        return [
            'lista' => Product::orderBy('name')
                ->filtersApply([ProductCategoryFilter::class])
                ->with('categories')
                ->filters()
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
        return 'Lista de produtos';
    }

    /**
     * The screen's action buttons.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [
            parent::getCreateLink('platform.products.create'),
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
            Layout::selection([
                ProductCategoryFilter::class,
            ]),
            Layout::table('lista', [
                // TD::make()->sortable('products'),
                TD::make("name", "Nome")->filter(Input::make()),
                TD::make("code", "Código")->filter(Input::make()),
                TD::make("categories", "Marca")->relationsBadge("primary"),
                TD::make("active", "Ativo")->toggleActive('products'),
                TD::make("featured", "Destaque")->toggleFeatured('products'),
                TD::make(__('Actions'))
                    ->align(TD::ALIGN_CENTER)
                    ->width('100px')
                    ->render(fn (Product $model) => DropDown::make()
                        ->icon('options-vertical')
                        ->list([
                            parent::getEditButton($model, 'platform.products.edit', true),
                            parent::getRemoveButton($model, true),
                        ])),
            ]),
        ];
    }

    public function remove(Product $model)
    {
        return parent::delete($model, 'platform.products.list');
    }

    public static function routes()
    {
        parent::routeList('produtos', 'products');
    }

    public static function permissions()
    {
        return parent::crudPermissions('produtos', 'products');
    }

    public static function metricsQuery()
    {
        return [
            'products' => Product::count(),
        ];
    }

    public static function metricsLayout()
    {
        return [
            'Total de produtos' => 'metrics.products',
        ];
    }
}
