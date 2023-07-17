<?php

declare(strict_types=1);

namespace Ellite\PageCompany\Orchid\Screens;

use Orchid\Screen\Screen;
use Ellite\PageCompany\Models\PageCompany;
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
use Orchid\Screen\Fields\Matrix;

class PageCompanyEditScreen extends ElliteScreen
{
    protected $model;

    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(PageCompany $model): iterable
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
        return $this->model->exists ? "Editando página de empresa" : "Criando página de empresa";
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
                        ->title("Texto 1")
                        ->value($this->model->translate($locale)?->text),
                    Quill::make("model.$locale.text_1")
                        ->title("Texto 2")
                        ->value($this->model->translate($locale)?->text_1),
                    Input::make("model.$locale.text_2")
                        ->title("Frase do botão")
                        ->value($this->model->translate($locale)?->text_2),
                    Input::make("model.$locale.text_3")
                        ->title("Link do botão")
                        ->value($this->model->translate($locale)?->text_3),
                    // Matrix::make("model.$locale.count_up")
                    //     ->title('Contadores')
                    //     ->columns([
                    //         'Valor final' => 'num_target',
                    //         'Unidade (%, pessoas)' => 'num_unity',
                    //         'Frase abaixo' => 'num_subject',
                    //     ])
                    //     ->value($this->model->translate($locale)?->count_up ?: [[]])
                    //     ->maxRows(4),
                    // Quill::make("model.$locale.text_4")
                    //     ->title("Texto (da imagem solo)")
                    //     ->value($this->model->translate($locale)?->text_4),
                    // Input::make("model.$locale.video")
                    //     ->title("URL do vídeo")
                    //     ->type('url')
                    //     ->value($this->model->translate($locale)?->video),

                    // Quill::make("model.$locale.text_mission")
                    //     ->title('Missão')
                    //     ->placeholder('Missão')
                    //     ->value($this->model->translate($locale)?->text_mission)
                    //     ->height('230px'),

                    // Quill::make("model.$locale.text_vision")
                    //     ->title('Visão')
                    //     ->placeholder('Visão')
                    //     ->value($this->model->translate($locale)?->text_vision)
                    //     ->height('230px'),

                    // Quill::make("model.$locale.text_values")
                    //     ->title('Valores')
                    //     ->placeholder('Valores')
                    //     ->value($this->model->translate($locale)?->text_values)
                    //     ->height('230px'),
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

        /** @var ScreenService */

        $upload_panel = Layout::rows([
            Upload::make('model.attachment')
                ->groups('image_page_company')
                ->acceptedFiles("image/*")
                ->maxFiles(10)
                ->multiple(true)
                ->maxFileSize(1)
                ->title("Imagens 1")
                ->help(screens()->getImageHelp('company'))
                ->targetId(),

            Upload::make('model.attachment')
                ->groups('image_page_company_v2')
                ->acceptedFiles("image/*")
                ->maxFiles(10)
                ->multiple(true)
                ->maxFileSize(1)
                ->title("Imagens 2")
                ->help(screens()->getImageHelp('company'))
                ->targetId(),

            // Upload::make('model.attachment')
            //     ->groups('image_page_company_brief2')
            //     ->acceptedFiles("image/*")
            //     ->multiple(false)
            //     ->maxFileSize(1)
            //     ->title("Imagem solo")
            //     ->help(screens()->getImageHelp('company2'))
            //     ->targetId(),

            Upload::make('model.attachment')
                ->groups('image_page_company_gallery')
                ->acceptedFiles("image/*")
                ->maxFiles(10)
                ->multiple(true)
                ->maxFileSize(1)
                ->title("Imagens (Última galeria)")
                ->help(screens()->getImageHelp('company3'))
                ->targetId(),

            // Upload::make('model.attachment')
            //     ->groups('image_page_company_thumbnail')
            //     ->acceptedFiles("image/*")
            //     ->maxFiles(10)
            //     ->multiple(true)
            //     ->maxFileSize(1)
            //     ->title("Thumbnail do vídeo")
            //     ->help(screens()->getImageHelp('company'))
            //     ->targetId(),

        ]);

        return [
            $languages_panel,
            $upload_panel,
            $seo_panel,
        ];
    }

    public function save(PageCompany $model, Request $request)
    {
        $model = $model->firstOrNew();
        return parent::createOrUpdate($model, 'platform.pagescompanies.edit', []);
    }

    public static function routes()
    {
        parent::routeSingle('página de empresa', 'pagescompanies');
    }

    public static function permissions()
    {
        return parent::editPermission('página de empresa', 'pagescompanies');
    }
}
