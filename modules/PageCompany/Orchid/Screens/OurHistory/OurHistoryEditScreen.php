<?php

declare(strict_types=1);

namespace Ellite\PageCompany\Orchid\Screens\OurHistory;

use Orchid\Screen\Screen;
use Ellite\PageCompany\Models\OurHistory;
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
use Orchid\Screen\Fields\Quill;

class OurHistoryEditScreen extends ElliteScreen
{
    protected $model;

    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(OurHistory $model): iterable
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
        return $this->model->exists ? "Editando linha do tempo" : "Criando linha do tempo";
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
            parent::getReturnLink('platform.ourhistory.list'),
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
        $language_fields = [];

        foreach (languages()->languages() as $language) {
            $locale = $language->locale;
            
            $fields = [
                Layout::rows([
                    Switcher::make('model.active')
                        ->sendTrueOrFalse()
                        ->title("Ativo")
                        ->help("Se marcado, esse cadastro ficará visível ao acessar o site.")
                        ->checked($this->model->exists ? (bool)$this->model->active : true)
                        ->canSee($language->code == 'pt'),
                
                    Input::make('model.name')
                        ->type('text')
                        ->title("Nome")
                        ->required()
                        ->maxlength(150)
                        ->canSee($language->code == 'pt')
                        ->popover('Esse nome não aparecerá no site, é apenas um controle interno.'),

                    Input::make("model.$locale.title_1")
                        ->type('text')
                        ->title('Ano')
                        ->placeholder('Ano')
                        ->value($this->model->translate($locale)?->title_1),

                    Quill::make("model.$locale.text_1")
                        ->type('text')
                        ->title('Descrição')
                        ->placeholder('Descrição')
                        ->value($this->model->translate($locale)?->text_1),
                    
                    // Input::make("model.$locale.text_2")
                    //     ->type('text')
                    //     ->title('Frase 2')
                    //     ->placeholder('Frase 2')
                    //     ->value($this->model->translate($locale)?->text_2),
                ]),
            ];

            $language_fields[$language->name] = $fields;
        }

        $languages_panel = count($language_fields) > 1 ? Layout::tabs($language_fields) : array_values($language_fields)[0];

        /** @var ScreenService */

        $upload_panel = Layout::rows([
            Upload::make('model.attachment')
                ->groups('image_ourhistory')
                ->acceptedFiles("image/*")
                ->maxFiles(1)
                ->multiple(false)
                ->maxFileSize(1)
                ->title("Imagem")
                ->help(screens()->getImageHelp('OurHistory'))
                ->targetId(),
        ]);

        return [
            $languages_panel,
            $upload_panel,
        ];
    }

    public function save(OurHistory $model, Request $request)
    {
        return parent::createOrUpdate($model, 'platform.ourhistory.list', [
            'model.name' => 'required',
        ]);
    }
    
    public function remove(OurHistory $model)
    {
        return parent::delete($model, 'platform.ourhistory.list');
    }
    
    public function toogleField(OurHistory $model)
    {
        return parent::toggleField($model);
    }

    public function sort()
    {
        return parent::sortModel(OurHistory::class);
    }

    public static function routes()
    {
        parent::routeEdit('linhas do tempo', 'ourhistory');     
        parent::routeCreate('linhas do tempo', 'ourhistory');
    }
}
