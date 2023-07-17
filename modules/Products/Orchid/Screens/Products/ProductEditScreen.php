<?php

declare(strict_types=1);

namespace Ellite\Products\Orchid\Screens\Products;

use Ellite\Products\Models\Product;
use Ellite\Products\Models\ProductCategory;
use Orchid\Support\Facades\Layout;
use Orchid\Screen\Fields\Switcher;
use Orchid\Screen\Fields\Input;
use Illuminate\Http\Request;
use Orchid\Screen\Fields\Upload;
use App\Ellite\ElliteScreen;
use Ellite\Products\Models\ProductApplication;
use Ellite\Products\Models\ProductTag;
use Orchid\Screen\Fields\Quill;
use Orchid\Screen\Fields\Relation;
use Orchid\Screen\Fields\TextArea;

class ProductEditScreen extends ElliteScreen
{
    protected $model;

    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(Product $model): iterable
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
        return $this->model->exists ? "Editando produto" : "Criando produto";
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
            parent::getReturnLink('platform.products.list'),
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
                        ->help("Se marcado, esse produto ficará visível ao acessar o site.")
                        ->checked($this->model->exists ? (bool)$this->model->active : true),

                    Switcher::make('model.featured')
                        ->sendTrueOrFalse()
                        ->title("Destaque")
                        ->help("Se marcado, esse produto ficará visível na área de destaque do site."),

                    Input::make('model.name')
                        ->type('text')
                        ->title("Nome")
                        ->required()
                        ->maxlength(150)
                        ->popover('Esse nome não aparecerá no site, é apenas um controle interno.'),

                    Input::make('model.code')
                        ->type('text')
                        ->title("Código")
                        ->maxlength(150),

                    // Input::make('model[categories]')->type('hidden'),

                    // Relation::make('model.categories')
                    //     // ->multiple()
                    //     ->title("Marcas do produto")
                    //     ->fromModel(ProductCategory::class, 'name', 'id'),

                    Input::make('model[applications]')->type('hidden'),

                    Relation::make('model.applications')
                        // ->multiple()
                        ->title("Linha do produto")
                        ->fromModel(ProductApplication::class, 'name', 'id'),

                    Input::make('model[tags]')->type('hidden'),

                    Relation::make('model.tags')
                        ->multiple()
                        ->title("Tags")
                        ->fromModel(ProductTag::class, 'name', 'id'),

                    Input::make('model[related]')->type('hidden'),

                    Relation::make('model.related')
                        ->multiple()
                        ->title("Produtos Relacionados")
                        ->fromModel(Product::class, 'name', 'id'),

                    Input::make("model.$locale.title")
                        ->type('text')
                        ->title('Nome')
                        ->placeholder('Nome')
                        ->value($this->model->translate($locale)?->title)
                        ->canSee(languages()->otherLanguages()),

                    /*Input::make("model.$locale.short_title")
                        ->type('text')
                        ->title('Nome abreviado')
                        ->placeholder('Nome abreviado')
                        ->value($this->model->translate($locale)?->title),*/
                    // Input::make("model.$locale.short_text")
                    //     ->type('text')
                    //     ->title('Resumo do texto')
                    //     ->placeholder('Resumo do texto')
                    //     ->value($this->model->translate($locale)?->short_text),
                    // Input::make("model.$locale.video")
                    //     ->type('text')
                    //     ->title('Video')
                    //     ->placeholder('Video')
                    //     ->value($this->model->translate($locale)?->video),
                    // Input::make("model.$locale.color")
                    //     ->type('text')
                    //     ->title('Cor')
                    //     ->placeholder('Cor')
                    //     ->value($this->model->translate($locale)?->color),
                    Quill::make("model.$locale.text")
                        ->type('textarea')
                        ->title('Descrição')
                        ->placeholder('Descrição')
                        ->value($this->model->translate($locale)?->text),
                    Quill::make("model.$locale.text_1")
                        ->type('textarea')
                        ->title('Especificações 1')
                        ->placeholder('Especificações 1')
                        ->value($this->model->translate($locale)?->text_1),
                    Quill::make("model.$locale.text_2")
                        ->type('textarea')
                        ->title('Especificações 2')
                        ->placeholder('Especificações 2')
                        ->value($this->model->translate($locale)?->text_2),
                ]),
            ];

            $language_fields[$language->name] = $fields;
        }

        $languages_panel = count($language_fields) > 1 ? Layout::tabs($language_fields) : array_values($language_fields)[0];

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
                ->groups('image_product')
                ->acceptedFiles("image/*")
                ->multiple(true)
                ->maxFileSize(1)
                ->title("Imagens")
                ->help(screens()->getImageHelp('product'))
                ->targetId(),
            Upload::make('model.attachment')
                ->groups('product_catalog')
                ->acceptedFiles("image/*, application/*")
                ->maxFileSize(5)
                ->title("Catálogo do produto")
                ->help(screens()->getImageHelp('catalogue'))
                ->targetId(),
        ]);

        return [
            $languages_panel,
            $upload_panel,
            $seo_panel,
        ];
    }

    public function save(Product $model, Request $request)
    {
        return parent::createOrUpdate($model, 'platform.products.list', [
            'model.name' => 'required',
        ]);
    }

    public function remove(Product $model)
    {
        return parent::delete($model, 'platform.products.list');
    }

    public function toogleField(Product $model)
    {
        return parent::toggleField($model);
    }

    public function sort()
    {
        return parent::sortModel(Product::class);
    }

    public static function routes()
    {
        parent::routeEdit('produtos', 'products');
        parent::routeCreate('produtos', 'products');
    }

    protected function shouldTransferNameToTitle(): bool
    {
        return true;
    }
}
