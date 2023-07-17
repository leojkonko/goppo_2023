<?php

declare(strict_types=1);

namespace Ellite\Products\Orchid\Screens\Catalogs;

use Orchid\Screen\Screen;
use Ellite\Products\Models\Catalog;
use Orchid\Support\Facades\Layout;
use Orchid\Screen\Fields\Switcher;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Quill;
use Orchid\Screen\Fields\TextArea;
use Orchid\Screen\Actions\Button;
use Illuminate\Http\Request;
use App\Services\LogsService;
use Orchid\Support\Facades\Toast;
use Orchid\Screen\Fields\Upload;
use Illuminate\Support\Facades\Route;
use Tabuna\Breadcrumbs\Trail;
use App\Ellite\ElliteScreen;

class CatalogEditScreen extends ElliteScreen
{
    protected $model;

    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(Catalog $model): iterable
    {
        $this->model = $model->firstOrNew();

        return [
            'model' => $this->model,
        ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return $this->model->exists ? "Editando catálogo" : "Criando catálogo";
    }

    /**
     * The screen's action buttons.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [
            parent::getSaveButton($this->model, true),
        ];
    }

    /**
     * The screen's layout elements.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): iterable
    {        
        /** @var ScreenService */
        
        $upload_panel = Layout::rows([
            Input::make('model.name')
                ->type('text')
                ->title("Nome")
                ->required()
                ->value($this->model->name)
                ->maxlength(150)
                ->popover('Esse nome não aparecerá no site, é apenas um controle interno.'),
            Upload::make('model.attachment')
                ->groups('file_catalogs')
                ->multiple(false)
                ->title("Arquivo")
                ->required()
                ->maxFiles(1)
                ->storage('public')
                ->targetId()
                ->help(screens()->getImageHelp('catalog')),
        ]);

        return [
            $upload_panel
        ];
    }

    public function save(Catalog $model, Request $request)
    {
        $model = $model->firstOrNew();
        return parent::createOrUpdate($model, 'platform.catalogs.edit', [
            
        ]);
    }

    public static function routes()
    {
        parent::routeSingle('arquivos de catálogos', 'catalogs');
    }
    
    public static function permissions()
    {
        return parent::editPermission('edição de arquivos de catálogos', 'catalogs');
    }
}
