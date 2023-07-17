<?php

declare(strict_types=1);

namespace Ellite\Brands\Orchid\Screens;

use Orchid\Screen\Screen;
use Ellite\Brands\Models\Brand;
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

class BrandEditScreen extends ElliteScreen
{
    protected $model;

    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(Brand $model): iterable
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
        return $this->model->exists ? "Editando marca" : "Criando marca";
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
            parent::getReturnLink('platform.brands.list'),
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
                        ->help("Se marcado, essa marca ficará visível ao acessar o site.")
                        ->canSee($language->code == 'pt')
                        ->checked($this->model->exists ? (bool)$this->model->active : true),
                    
                    Input::make('model.name')
                        ->type('text')
                        ->title("Nome")
                        ->required()
                        ->maxlength(150)
                        ->canSee($language->code == 'pt')
                        ->popover('Esse nome não aparecerá no site, é apenas um controle interno.'),

                    Input::make("model.$locale.title")
                        ->type('text')
                        ->title('Nome')
                        ->placeholder('Nome')
                        ->value($this->model->translate($locale)?->title)
                        ->canSee(languages()->otherLanguages()),
                    
                    Input::make("model.$locale.link")
                        ->type('text')
                        ->title('Link')
                        ->placeholder('Link')
                        ->value($this->model->translate($locale)?->link),
                ]),
            ];

            $language_fields[$language->name] = $fields;
        }

        $languages_panel = count($language_fields) > 1 ? Layout::tabs($language_fields) : array_values($language_fields)[0];

        /** @var ScreenService */

        $upload_panel = Layout::rows([
            Upload::make('model.attachment')
                ->groups('image_brand')
                ->acceptedFiles("image/*")
                ->maxFiles(1)
                ->multiple(false)
                ->maxFileSize(1)
                ->title("Imagem")
                ->help(screens()->getImageHelp('brand'))
                ->targetId(),
        ]);

        return [
            $languages_panel,
            $upload_panel,
        ];
    }

    protected function shouldTransferNameToTitle() : bool
    {
        return true;
    }

    public function save(Brand $model, Request $request)
    {
        return parent::createOrUpdate($model, 'platform.brands.list', [
            'model.name' => 'required',
        ]);
    }
    
    public function remove(Brand $model)
    {
        return parent::delete($model, 'platform.brands.list');
    }
    
    public function toogleField(Brand $model)
    {
        return parent::toggleField($model);
    }

    public function sort()
    {
        return parent::sortModel(Brand::class);
    }

    public static function routes()
    {
        parent::routeEdit('marcas', 'brands');     
        parent::routeCreate('marcas', 'brands');
    }
}
