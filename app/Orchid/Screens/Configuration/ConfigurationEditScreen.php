<?php

declare(strict_types=1);

namespace App\Orchid\Screens\Configuration;

use Orchid\Screen\Screen;
use App\Models\Configuration;
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
use Illuminate\Support\Facades\Auth;

class ConfigurationEditScreen extends ElliteScreen
{
    protected $model;

    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(Configuration $model): iterable
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
        return $this->model->exists ? "Editando configurações do site" : "Criando configurações do site";
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
        $email_panel = Layout::rows([
            Switcher::make('model.email_authenticated')
                ->sendTrueOrFalse()
                ->title("E-mail autenticado")
                ->help("Se marcado, os dados preenchidos no DSN serão usados para enviar e-mails do site."),
            
            Input::make('model.email_from')
                ->type('text')
                ->title("Email 'from'")
                ->help('Esse e-mail é usado como remetente dos e-mails do site quando o envio autenticado está desabilitado.'),

            Input::make('model.email_dsn')
                ->type('text')
                ->title("DSN de e-mail")
                ->help('Formato: smtp://my@gmail.com:secret@smtp.gmail.com:587?tls=true'),
                //Somente o usuario ellite1 pode ver
        ])->canSee(Auth::id() == 1);

        $language_fields = [];

        foreach (languages()->languages() as $language) {
            $locale = $language->locale;
            
            $fields = [
                Layout::rows([
                    /*Quill::make("model.$locale.text")
                        ->title("Texto")
                        ->value($this->model->translate($locale)?->text),*/
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
                    TextArea::make("model.$locale.custom_js_head")
                        ->title('Código javascript na tag <head>')
                        ->value($this->model->translate($locale)?->custom_js_head)
                        ->help(e("Esse código será adicionado no início da tag <HEAD>. Insira apenas o código JavaScript, sem as tags <script> e </script>.")),

                    TextArea::make("model.$locale.custom_js_body")
                        ->title('Código javascript na tag <body>')
                        ->value($this->model->translate($locale)?->custom_js_body)
                        ->help(e("Esse código será adicionado no início da tag <BODY>. Insira apenas o código JavaScript, sem as tags <script> e </script> | <noscript> e </noscript>.")),

                    /*TextArea::make("model.$locale.keywords")
                        ->title('Palavras-chave (Google)')
                        ->placeholder('Palavras-chave (Google)')
                        ->value($this->model->translate($locale)?->keywords)
                        ->help(" Separe os valores usando vírgulas. Exemplo: nome do seu produto, nome do seu serviço"),*/

                    /*TextArea::make("model.$locale.description")
                        ->title('Description (Google)')
                        ->placeholder('Description (Google)')
                        ->value($this->model->translate($locale)?->description)
                        ->help("Esse texto é exibido pelos resultados da pesquisa feita")
                        ->maxlength(160),*/
                ]),
            ];

            $seo_fields['SEO ' . $language->name] = $fields;
        }

        $seo_panel = count($seo_fields) > 1 ? Layout::tabs($seo_fields) : array_values($seo_fields)[0];

        $upload_panel = Layout::rows([
            Upload::make('model.attachment')
                ->groups('image_page_configuration')
                ->acceptedFiles("image/*")
                ->maxFiles(10)
                ->multiple(true)
                ->maxFileSize(1)
                ->title("Imagens")
                ->help("Proporção recomendada: 16x9 | Largura máxima recomendada: 1920px | Peso máximo: 200kb")
                ->targetId(),
        ]);

        return [
            $email_panel,
            // $languages_panel,
            $seo_panel,
            // $upload_panel,
        ];
    }

    public function save(Configuration $model, Request $request)
    {
        $model = $model->firstOrNew();
        return parent::createOrUpdate($model, 'platform.configurations.edit', [
            
        ]);
    }

    public static function routes()
    {
        parent::routeSingle('configurações', 'configurations');
    }
    
    public static function permissions()
    {
        return parent::editPermission('configurações', 'configurations');
    }
}
