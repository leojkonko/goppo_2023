<?php

declare(strict_types=1);

namespace Ellite\Contact\Orchid\Screens\SiteEmails;

use Orchid\Screen\Screen;
use Ellite\Contact\Models\SiteEmail;
use Orchid\Support\Facades\Layout;
use Orchid\Screen\Fields\Switcher;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Actions\Button;
use Illuminate\Http\Request;
use App\Services\LogsService;
use Orchid\Support\Facades\Toast;
use Orchid\Screen\Fields\Upload;
use Illuminate\Support\Facades\Route;
use Tabuna\Breadcrumbs\Trail;
use App\Ellite\ElliteScreen;
use Orchid\Screen\Sight;

class SiteEmailsViewScreen extends ElliteScreen
{
    protected $model;

    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(SiteEmail $model): iterable
    {
        $this->model = $model;
        
        return [
            'model' => $model,
        ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Visualizando mensagem do site';
    }

    /**
     * The screen's action buttons.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [
            parent::getRemoveButton($this->model, $this->model->exists),
            parent::getReturnLink('platform.siteemails.list'),
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
            Layout::legend('model', [
                Sight::make('form_name', 'Formulário'),
                Sight::make('name', 'Nome'),
                Sight::make('email', 'E-mail'),
                Sight::make('phone', 'Telefone'),
                Sight::make('created_at', 'Data')->render(fn($e) => $e->created_at?->format('d/m/Y H:i')),
                Sight::make('message', 'Mensagem'),
            ])->title('Mensagem'),
        ];
    }

    public function remove(SiteEmail $model)
    {
        return parent::delete($model, 'platform.siteemails.list');
    }
    
    public static function routes()
    {
        parent::routeView('mensagem do site', 'siteemails');
    }
}
