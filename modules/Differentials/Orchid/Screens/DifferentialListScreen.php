<?php

namespace Ellite\Differentials\Orchid\Screens;

use Orchid\Screen\Screen;
use Ellite\Differentials\Models\Differential;
use Orchid\Support\Facades\Layout;
use Orchid\Screen\TD;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\DropDown;
use Orchid\Support\Facades\Toast;
use App\Ellite\ElliteScreen;

class DifferentialListScreen extends ElliteScreen
{
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(): iterable
    {
        return [
            'lista' => Differential::orderBy('order')
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
        return 'Lista de diferenciais';
    }

    /**
     * The screen's action buttons.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [
            parent::getCreateLink('platform.differentials.create'),
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
                TD::make()->sortable('differentials'),
                TD::make("name", "Nome"),
                TD::make("active", "Ativo")->toggleActive('differentials'),
                TD::make(__('Actions'))
                    ->align(TD::ALIGN_CENTER)
                    ->width('100px')
                    ->render(fn (Differential $model) => DropDown::make()
                        ->icon('options-vertical')
                        ->list([
                            parent::getEditButton($model, 'platform.differentials.edit', true),
                            parent::getRemoveButton($model, true),
                        ])),
            ]),
        ];
    }
    
    public function remove(Differential $model)
    {
        return parent::delete($model, 'platform.differentials.list');
    }

    public static function routes()
    {
        parent::routeList('diferenciais', 'differentials');
    }
    
    public static function permissions()
    {
        return parent::crudPermissions('diferenciais', 'differentials');
    }
}
