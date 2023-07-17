<?php

namespace App\Orchid\Screens\Log;

use Orchid\Screen\Screen;
use App\Models\Log;
use Orchid\Support\Facades\Layout;
use Orchid\Screen\TD;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\DateRange;

class LogListScreen extends Screen
{
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(): iterable
    {
        return [
            'logs' => Log::orderByDesc('id')
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
        return 'Lista de logs de usuários';
    }

    /**
     * The screen's action buttons.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [];
    }

    /**
     * The screen's layout elements.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): iterable
    {
        return [
            Layout::table('logs', [
                TD::make("user_name", "Usuário")->filter(Input::make()),
                TD::make("message", "Ação")->filter(Input::make()),
                TD::make("created_at", "Data")->render(fn($e) => $e->created_at?->format('d/m/Y H:i'))->filter(DateRange::make()),
            ]),
        ];
    }
    
    /**
     * @return iterable|null
     */
    public function permission(): ?iterable
    {
        return [
            'platform.systems.logs',
        ];
    }
}
