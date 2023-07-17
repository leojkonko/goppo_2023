<?php

declare(strict_types=1);

namespace Ellite\Banners\Orchid\Screens;

use Orchid\Screen\Screen;
use Ellite\Banners\Models\Banner;
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

class BannerEditScreen extends ElliteScreen
{
    protected $model;

    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(Banner $model): iterable
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
        return $this->model->exists ? "Editando banner" : "Criando banner";
    }

    /**
     * The screen's action buttons.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [
            parent::getReturnLink('platform.banners.list'),
            parent::getRemoveButton($this->model, $this->model->exists),
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

        foreach (languages()->languages() as $language) {
            $locale = $language->locale;

            $fields = [
                Layout::rows([
                    Switcher::make('model.active')
                        ->sendTrueOrFalse()
                        ->title("Ativo")
                        ->help("Se marcado, esse banner ficará visível ao acessar o site.")
                        ->checked($this->model->exists ? (bool)$this->model->active : true)
                        ->canSee($language->code == "pt"),

                    Input::make('model.name')
                        ->type('text')
                        ->title("Nome")
                        ->required()
                        ->maxlength(150)
                        ->popover('Esse nome não aparecerá no site, é apenas um controle interno.')
                        ->canSee($language->code == "pt"),
                    Quill::make("model.$locale.text_1")
                        ->type('text')
                        ->title('Frase')
                        ->placeholder('Frase')
                        ->value($this->model->translate($locale)?->text_1),
                    
                    Input::make("model.$locale.text_2")
                        ->type('text')
                        ->title('Frase do botão')
                        ->placeholder('Saiba mais')
                        ->value($this->model->translate($locale)?->text_2),
                    
                    /*Input::make("model.$locale.text_3")
                        ->type('text')
                        ->title('Frase 3')
                        ->placeholder('Frase 3')
                        ->value($this->model->translate($locale)?->text_3),
                        
                    Input::make("model.$locale.text_4")
                        ->type('text')
                        ->title('Frase 4')
                        ->placeholder('Frase 4')
                        ->value($this->model->translate($locale)?->text_4),*/

                    Input::make("model.$locale.link_1")
                        ->type('text')
                        ->title('Link')
                        ->placeholder('link')
                        ->value($this->model->translate($locale)?->link_1),

                    /*Input::make("model.$locale.link_2")
                        ->type('text')
                        ->title('Link 2')
                        ->placeholder('Link 2')
                        ->value($this->model->translate($locale)?->link_2),
                    
                    Input::make("model.$locale.link_3")
                        ->type('text')
                        ->title('Link 3')
                        ->placeholder('Link 3')
                        ->value($this->model->translate($locale)?->link_3),
                        
                    Input::make("model.$locale.link_4")
                        ->type('text')
                        ->title('Link 4')
                        ->placeholder('Link 4')
                        ->value($this->model->translate($locale)?->link_4),

                    Input::make("model.$locale.text_link_1")
                        ->type('text')
                        ->title('Texto do link 1')
                        ->placeholder('Texto do link 1')
                        ->value($this->model->translate($locale)?->text_link_1),
                    
                    Input::make("model.$locale.text_link_2")
                        ->type('text')
                        ->title('Texto do link 2')
                        ->placeholder('Texto do link 2')
                        ->value($this->model->translate($locale)?->text_link_2),
                    
                    Input::make("model.$locale.text_link_3")
                        ->type('text')
                        ->title('Texto do link 3')
                        ->placeholder('Texto do link 3')
                        ->value($this->model->translate($locale)?->text_link_3),
                        
                    Input::make("model.$locale.text_link_4")
                        ->type('text')
                        ->title('Texto do link 4')
                        ->placeholder('Texto do link 4')
                        ->value($this->model->translate($locale)?->text_link_4),*/
                ]),
            ];

            $language_fields[$language->name] = $fields;
        }

        $languages_panel = count($language_fields) > 1 ? Layout::tabs($language_fields) : array_values($language_fields)[0];

        $upload_panel = Layout::rows([
            /** @var ScreenService */

            Upload::make('model.attachment')
                ->groups('desktop_banner')
                ->acceptedFiles("image/*")
                ->maxFiles(1)
                ->multiple(false)
                ->maxFileSize(1)
                ->title("Banner Desktop")
                ->help(screens()->getImageHelp('banner-desktop'))
                ->targetId(),

            Upload::make('model.attachment')
                ->groups('mobile_banner')
                ->acceptedFiles("image/*")
                ->maxFiles(1)
                ->multiple(false)
                ->maxFileSize(1)
                ->title("Banner Mobile")
                ->help(screens()->getImageHelp('banner-mobile'))
                ->targetId(),
        ]);

        return [
            $languages_panel,
            $upload_panel,
        ];
    }

    public function save(Banner $model, Request $request)
    {
        return parent::createOrUpdate($model, 'platform.banners.list', [
            'model.name' => 'required',
        ]);
    }

    public function remove(Banner $model)
    {
        return parent::delete($model, 'platform.banners.list');
    }

    public function toogleField(Banner $model)
    {
        return parent::toggleField($model);
    }

    public function sort()
    {
        return parent::sortModel(Banner::class);
    }

    public static function routes()
    {
        parent::routeEdit('banners');
        parent::routeCreate('banners');
    }
}
