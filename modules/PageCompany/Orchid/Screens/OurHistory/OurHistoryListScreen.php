<?php

namespace Ellite\PageCompany\Orchid\Screens\OurHistory;

use Orchid\Screen\Screen;
use Ellite\PageCompany\Models\OurHistory;
use Orchid\Support\Facades\Layout;
use Orchid\Screen\TD;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\DropDown;
use Orchid\Support\Facades\Toast;
use App\Ellite\ElliteScreen;

class OurHistoryListScreen extends ElliteScreen
{
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(): iterable
    {
        return [
            'lista' => OurHistory::orderBy('order')
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
        return 'Lista de linhas do tempo';
    }

    /**
     * The screen's action buttons.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [
            parent::getCreateLink('platform.ourhistory.create'),
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
                TD::make()->sortable('ourhistory'),
                TD::make("name", "Nome"),
                TD::make("active", "Ativo")->toggleActive('ourhistory'),
                TD::make(__('Actions'))
                    ->align(TD::ALIGN_CENTER)
                    ->width('100px')
                    ->render(fn (OurHistory $model) => DropDown::make()
                        ->icon('options-vertical')
                        ->list([
                            parent::getEditButton($model, 'platform.ourhistory.edit', true),
                            parent::getRemoveButton($model, true),
                        ])),
            ]),
        ];
    }
    
    public function remove(OurHistory $model)
    {
        return parent::delete($model, 'platform.ourhistory.list');
    }

    public static function routes()
    {
        parent::routeList('linhas do tempo', 'ourhistory');
    }
    
    public static function permissions()
    {
        return parent::crudPermissions('linhas do tempo', 'ourhistory');
    }
}
