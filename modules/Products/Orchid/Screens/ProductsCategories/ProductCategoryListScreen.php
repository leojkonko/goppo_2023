<?php

namespace Ellite\Products\Orchid\Screens\ProductsCategories;

use Orchid\Screen\Screen;
use Ellite\Products\Models\ProductCategory;
use Orchid\Support\Facades\Layout;
use Orchid\Screen\TD;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\DropDown;
use Orchid\Support\Facades\Toast;
use App\Ellite\ElliteScreen;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\DateRange;

class ProductCategoryListScreen extends ElliteScreen
{
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(): iterable
    {
        return [
            'lista' => ProductCategory::orderBy('order')
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
        return 'Lista de marcas de produtos';
    }

    /**
     * The screen's action buttons.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [
            parent::getCreateLink('platform.productscategories.create'),
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
                TD::make()->sortable('productscategories'),
                TD::make("name", "Nome"),
                TD::make("active", "Ativo")->toggleActive('productscategories'),
                TD::make(__('Actions'))
                    ->align(TD::ALIGN_CENTER)
                    ->width('100px')
                    ->render(fn (ProductCategory $model) => DropDown::make()
                        ->icon('options-vertical')
                        ->list([
                            parent::getEditButton($model, 'platform.productscategories.edit', true),
                            parent::getRemoveButton($model, true),
                        ])),
            ]),
        ];
    }
    
    public function remove(ProductCategory $model)
    {
        return parent::delete($model, 'platform.productscategories.list');
    }

    public static function routes()
    {
        parent::routeList('marcas de produtos', 'productscategories');
    }
    
    public static function permissions()
    {
        return parent::crudPermissions('marcas de produtos', 'productscategories');
    }
}
