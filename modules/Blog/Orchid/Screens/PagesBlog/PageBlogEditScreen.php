<?php

declare(strict_types=1);

namespace Ellite\Blog\Orchid\Screens\PagesBlog;

use Orchid\Screen\Screen;
use Ellite\Blog\Models\PageBlog;
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

class PageBlogEditScreen extends ElliteScreen
{
    protected $model;

    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(PageBlog $model): iterable
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
        return $this->model->exists ? "Editando página de blog" : "Criando página de blog";
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
        $language_fields = [];

        foreach (languages()->languages() as $language) {
            $locale = $language->locale;
            
            $fields = [
                Layout::rows([
                    Quill::make("model.$locale.text")
                        ->title("Texto")
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
                        ->help("Separe os valores usando vírgulas. Exemplo: nome do seu produto, nome do seu serviço")
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

            $seo_fields['SEO ' . $language->name] = $fields;
        }

        $seo_panel = count($seo_fields) > 1 ? Layout::tabs($seo_fields) : array_values($seo_fields)[0];

        /** @var ScreenService */

        $upload_panel = Layout::rows([
            Upload::make('model.attachment')
                ->groups('image_page_blog')
                ->acceptedFiles("image/*")
                ->maxFiles(10)
                ->multiple(true)
                ->maxFileSize(1)
                ->title("Imagens")
                ->help("Proporção recomendada: 16x9 | Largura máxima recomendada: 1920px | Peso máximo: 200kb")
                ->targetId(),
        ]);

        return [
            // $languages_panel,
            $seo_panel,
            // $upload_panel,
        ];
    }

    public function save(PageBlog $model, Request $request)
    {
        $model = $model->firstOrNew();
        return parent::createOrUpdate($model, 'platform.pagesblog.edit', [
            
        ]);
    }

    public static function routes()
    {
        parent::routeSingle('página de blog', 'pagesblog');
    }
    
    public static function permissions()
    {
        return parent::editPermission('página de blog', 'pagesblog');
    }
}
