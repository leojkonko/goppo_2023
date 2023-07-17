<?php

namespace Ellite\Blog\Orchid\Screens\PostsCategories;

use Orchid\Screen\Screen;
use Ellite\Blog\Models\PostCategory;
use Orchid\Support\Facades\Layout;
use Orchid\Screen\TD;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\DropDown;
use Orchid\Support\Facades\Toast;
use App\Ellite\ElliteScreen;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\DateRange;

class PostCategoryListScreen extends ElliteScreen
{
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(): iterable
    {
        return [
            'lista' => PostCategory::orderBy('order')
                ->filters()
                ->paginate(),
        ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Lista de categorias de artigos';
    }

    /**
     * The screen's action buttons.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [
            parent::getCreateLink('platform.postscategories.create'),
        ];
    }

    /**
     * The screen's layout elements.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): iterable
    {
        return [
            Layout::table('lista', [
                TD::make()->sortable('postscategories'),
                TD::make("name", "Nome"),
                TD::make("active", "Ativo")->toggleActive('postscategories'),
                TD::make(__('Actions'))
                    ->align(TD::ALIGN_CENTER)
                    ->width('100px')
                    ->render(fn (PostCategory $model) => DropDown::make()
                        ->icon('options-vertical')
                        ->list([
                            parent::getEditButton($model, 'platform.postscategories.edit', true),
                            parent::getRemoveButton($model, true),
                        ])),
            ]),
        ];
    }
    
    public function remove(PostCategory $model)
    {
        return parent::delete($model, 'platform.postscategories.list');
    }

    public static function routes()
    {
        parent::routeList('categorias de artigos', 'postscategories');
    }
    
    public static function permissions()
    {
        return parent::crudPermissions('categorias de artigos', 'postscategories');
    }
}
