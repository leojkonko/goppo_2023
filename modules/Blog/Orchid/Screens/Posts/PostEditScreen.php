<?php

declare(strict_types=1);

namespace Ellite\Blog\Orchid\Screens\Posts;

use Orchid\Screen\Screen;
use Ellite\Blog\Models\Post;
use Ellite\Blog\Models\PostCategory;
use Orchid\Support\Facades\Layout;
use Orchid\Screen\Fields\Switcher;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Quill;
use Orchid\Screen\Fields\TextArea;
use Orchid\Screen\Fields\Relation;
use Orchid\Screen\Fields\DateTimer;
use Orchid\Screen\Actions\Button;
use Illuminate\Http\Request;
use App\Services\LogsService;
use Orchid\Support\Facades\Toast;
use Orchid\Screen\Fields\Upload;
use Illuminate\Support\Facades\Route;
use Tabuna\Breadcrumbs\Trail;
use App\Ellite\ElliteScreen;

class PostEditScreen extends ElliteScreen
{
    protected $model;

    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(Post $model): iterable
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
        return $this->model->exists ? "Editando artigo" : "Criando artigo";
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
            parent::getReturnLink('platform.posts.list'),
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
                        ->help("Se marcado, esse artigo ficará visível ao acessar o site.")
                        ->canSee($language->code == "pt")
                        ->checked($this->model->exists ? (bool)$this->model->active : true),

                    Input::make('model.name')
                        ->type('text')
                        ->title("Nome")
                        ->required()
                        ->maxlength(150)
                        ->canSee($language->code == "pt")
                        ->popover('Esse nome não aparecerá no site, é apenas um controle interno.'),

                    Input::make('model.publish_date_field_value')
                        ->type('date')
                        ->title("Data de publicação do artigo")
                        ->canSee($language->code == "pt")
                        ->help("O artigo ficará disponível a partir desta data. Deixe vazio para o artigo ficar sempre disponível."),

                    Input::make('model[categories]')->type('hidden'),

                    Relation::make('model.categories.')
                        ->multiple()
                        ->title("Categorias do artigo")
                        ->canSee($language->code == "pt")
                        ->fromModel(PostCategory::class, 'name', 'id'),

                    /** @var LanguagesService */

                    Input::make("model.$locale.title")
                        ->type('text')
                        ->title('Nome')
                        ->placeholder('Nome')
                        ->value($this->model->translate($locale)?->title)
                        ->canSee(languages()->otherLanguages()),

                    Input::make("model.$locale.short_title")
                        ->type('text')
                        ->title('Nome curto')
                        ->placeholder('Nome curto')
                        ->value($this->model->translate($locale)?->short_title)
                        ->maxlength(30)
                        ->popover("Irá aparecer no breadcrumb, um título muito grande irá quebrar em resoluções menores.")
                        ->help("Recomenda-se usar no máximo 3 palavras"),

                    TextArea::make("model.$locale.short_text")
                        ->title('Resumo')
                        ->placeholder('Resumo')
                        ->value($this->model->translate($locale)?->short_text)
                        ->help("Esse resumo aparecerá na lista de artigos do site"),

                    Quill::make("model.$locale.text")
                        ->title("Descrição")
                        ->value($this->model->translate($locale)?->text),
                ]),
            ];

            $language_fields[$language->name] = $fields;
        }

        $languages_panel = count($language_fields) > 1 ? Layout::tabs($language_fields) : array_values($language_fields)[0];

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
                        ->maxlength(160)
                        ->popover('Meta Description é o pequeno texto que aparece logo abaixo do título e do link de uma página quando se faz uma pesquisa no Google.'),
                ]),
            ];

            $seo_fields[$language->name] = $fields;
        }

        $seo_panel = count($seo_fields) > 1 ? Layout::tabs($seo_fields) : array_values($seo_fields)[0];

        /** @var ScreensService */

        $upload_panel = Layout::rows([
            Upload::make('model.attachment')
                ->groups('image_post')
                ->acceptedFiles("image/*")
                ->maxFiles(10)
                ->multiple(true)
                ->maxFileSize(1)
                ->title("Imagens")
                ->help(screens()->getImageHelp('post'))
                ->targetId(),
        ]);

        return [
            $languages_panel,
            $upload_panel,
            $seo_panel,
        ];
    }

    protected function shouldTransferNameToTitle(): bool
    {
        return true;
    }

    public function save(Post $model, Request $request)
    {
        return parent::createOrUpdate($model, 'platform.posts.list', [
            'model.name' => 'required',
        ]);
    }

    public function remove(Post $model)
    {
        return parent::delete($model, 'platform.posts.list');
    }

    public function toogleField(Post $model)
    {
        return parent::toggleField($model);
    }

    public function sort()
    {
        return parent::sortModel(Post::class);
    }

    public static function routes()
    {
        parent::routeEdit('artigos', 'posts');
        parent::routeCreate('artigos', 'posts');
    }

    protected function preProcessData(array $data): array
    {
        return $data;
    }
}
