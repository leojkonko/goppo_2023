<?php

namespace Ellite\Products\Orchid\Screens\ProductsTags;

use Orchid\Screen\Screen;
use Ellite\Products\Models\ProductTag;
use Orchid\Support\Facades\Layout;
use Orchid\Screen\TD;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\DropDown;
use Orchid\Support\Facades\Toast;
use App\Ellite\ElliteScreen;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\DateRange;

class ProductTagListScreen extends ElliteScreen
{
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(): iterable
    {
        return [
            'lista' => ProductTag::orderBy('order')
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
            parent::getCreateLink('platform.productstags.create'),
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
                TD::make()->sortable('productstags'),
                TD::make("name", "Nome"),
                TD::make("active", "Ativo")->toggleActive('productstags'),
                TD::make(__('Actions'))
                    ->align(TD::ALIGN_CENTER)
                    ->width('100px')
                    ->render(fn (ProductTag $model) => DropDown::make()
                        ->icon('options-vertical')
                        ->list([
                            parent::getEditButton($model, 'platform.productstags.edit', true),
                            parent::getRemoveButton($model, true),
                        ])),
            ]),
        ];
    }
    
    public function remove(ProductTag $model)
    {
        return parent::delete($model, 'platform.productstags.list');
    }

    public static function routes()
    {
        parent::routeList('marcas de produtos', 'productstags');
    }
    
    public static function permissions()
    {
        return parent::crudPermissions('marcas de produtos', 'productstags');
    }
}
