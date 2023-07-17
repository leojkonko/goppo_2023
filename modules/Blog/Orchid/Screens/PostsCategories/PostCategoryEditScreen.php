<?php

declare(strict_types=1);

namespace Ellite\Blog\Orchid\Screens\PostsCategories;

use Orchid\Screen\Screen;
use Ellite\Blog\Models\PostCategory;
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

class PostCategoryEditScreen extends ElliteScreen
{
    protected $model;

    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(PostCategory $model): iterable
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
        return $this->model->exists ? "Editando categoria de artigos" : "Criando categoria de artigos";
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
            parent::getReturnLink('platform.postscategories.list'),
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
        $main_panel = Layout::rows([
            Switcher::make('model.active')
                ->sendTrueOrFalse()
                ->title("Ativo")
                ->help("Se marcado, essa categoria de artigo ficará visível ao acessar o site.")
                ->checked($this->model->exists ? (bool)$this->model->active : true),
            
            Input::make('model.name')
                ->type('text')
                ->title("Nome")
                ->required()
                ->maxlength(150),
        ]);

        $language_fields = [];

        foreach (languages()->languages() as $language) {
            $locale = $language->locale;
            /** @var LanguagesService */
            $fields = [
                Layout::rows([
                    Input::make("model.$locale.title")
                        ->type('text')
                        ->title('Nome')
                        ->placeholder('Nome')
                        ->value($this->model->translate($locale)?->title)
                        ->canSee(languages()->otherLanguages()),
                ]),
            ];

            $language_fields[$language->name] = $fields;
        }

        if (count($language_fields) === 1) {
            $languages_panel = [];
        }
        else {
            $languages_panel = count($language_fields) > 1 ? Layout::tabs($language_fields) : array_values($language_fields)[0];
        }
        
        $seo_fields = [];

        foreach (languages()->languages() as $language) {
            $locale = $language->locale;
            
            $fields = [
                Layout::rows([
                    TextArea::make("model.$locale.keywords")
                        ->title('Palavras-chave (Google)')
                        ->placeholder('Palavras-chave (Google)')
                        ->value($this->model->translate($locale)?->keywords)
                        ->help(" Separe os valores usando vírgulas. Exemplo: nome do seu produto, nome do seu serviço")
                        ->popover('Palavras ou frases que descrevem seu produto ou serviço selecionadas para determinar quando e onde seu anúncio pode ser exibido. As palavras-chave que você escolhe são usadas para exibir seus anúncios para as pessoas.'),

                    TextArea::make("model.$locale.description")
                        ->title('Description (Google)')
                        ->placeholder('Description (Google)')
                        ->value($this->model->translate($locale)?->description)
                        ->help("Esse texto é exibido pelos resultados da pesquisa feita")
                        ->popover('Meta Description é o pequeno texto que aparece logo abaixo do título e do link de uma página quando se faz uma pesquisa no Google.')
                        ->maxlength(160),
                ]),
            ];

            $seo_fields[$language->name] = $fields;
        }

        $seo_panel = count($seo_fields) > 1 ? Layout::tabs($seo_fields) : array_values($seo_fields)[0];

        $return = [
            $main_panel,
            $languages_panel,
            $seo_panel,
        ];

        return array_values($return);
    }

    protected function shouldTransferNameToTitle() : bool
    {
        return true;
    }

    public function save(PostCategory $model, Request $request)
    {
        return parent::createOrUpdate($model, 'platform.postscategories.list', [
            'model.name' => 'required',
        ]);
    }
    
    public function remove(PostCategory $model)
    {
        return parent::delete($model, 'platform.postscategories.list');
    }
    
    public function toogleField(PostCategory $model)
    {
        return parent::toggleField($model);
    }

    public function sort()
    {
        return parent::sortModel(PostCategory::class);
    }

    public static function routes()
    {
        parent::routeEdit('categorisa de artigos', 'postscategories');     
        parent::routeCreate('categorias de artigos', 'postscategories');
    }
}
