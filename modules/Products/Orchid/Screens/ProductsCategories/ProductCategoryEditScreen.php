<?php

declare(strict_types=1);

namespace Ellite\Products\Orchid\Screens\ProductsCategories;

use Orchid\Screen\Screen;
use Ellite\Products\Models\ProductCategory;
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

class ProductCategoryEditScreen extends ElliteScreen
{
    protected $model;

    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(ProductCategory $model): iterable
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
        return $this->model->exists ? "Editando marca de produtos" : "Criando marca de produtos";
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
            parent::getReturnLink('platform.productscategories.list'),
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
                        ->help("Se marcado, essa linha ficará visível ao acessar o site.")
                        ->canSee($language->code == 'pt')
                        ->checked($this->model->exists ? (bool)$this->model->active : true),

                    Input::make('model.name')
                        ->type('text')
                        ->title("Nome")
                        ->required()
                        ->placeholder('Nome')
                        ->canSee($language->code == 'pt')
                        ->maxlength(150)
                        ->popover('Esse nome não aparecerá no site, é apenas um controle interno.'),

                    Input::make("model.$locale.title")
                        ->type('text')
                        ->title('Título')
                        ->placeholder('Título')
                        ->value($this->model->translate($locale)?->title),

                    Input::make("model.$locale.text_1")
                        ->type('text')
                        ->title('Resumo')
                        ->placeholder('Resumo da linha')
                        ->value($this->model->translate($locale)?->text_1),
                ]),
            ];

            $language_fields[$language->name] = $fields;
        }

        if (count($language_fields) === 1) {
            $languages_panel = [];
        } else {
            $languages_panel = count($language_fields) > 1 ? Layout::tabs($language_fields) : array_values($language_fields)[0];
        }

        /** @var ScreenService */

        $upload_panel = Layout::rows([
            Upload::make('model.attachment')
                ->groups('image_product_application')
                ->acceptedFiles("image/*")
                ->maxFiles(1)
                ->multiple(false)
                ->maxFileSize(1)
                ->title("Imagem")
                ->help(screens()->getImageHelp('category'))
                ->targetId(),
        ]);

        return [
            $language_fields,
            $languages_panel,
            $upload_panel,
        ];
    }

    public function save(ProductCategory $model, Request $request)
    {
        return parent::createOrUpdate($model, 'platform.productscategories.list', [
            'model.name' => 'required',
        ]);
    }

    public function remove(ProductCategory $model)
    {
        return parent::delete($model, 'platform.productscategories.list');
    }

    public function toogleField(ProductCategory $model)
    {
        return parent::toggleField($model);
    }

    public function sort()
    {
        return parent::sortModel(ProductCategory::class);
    }

    public static function routes()
    {
        parent::routeEdit('marcas de produtos', 'productscategories');
        parent::routeCreate('marcas de produtos', 'productscategories');
    }

    protected function shouldTransferNameToTitle(): bool
    {
        return true;
    }
}
