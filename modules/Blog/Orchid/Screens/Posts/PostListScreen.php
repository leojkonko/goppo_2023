<?php

namespace Ellite\Blog\Orchid\Screens\Posts;

use Orchid\Screen\Screen;
use Ellite\Blog\Models\Post;
use Orchid\Support\Facades\Layout;
use Orchid\Screen\TD;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\DropDown;
use Orchid\Support\Facades\Toast;
use App\Ellite\ElliteScreen;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\DateRange;

class PostListScreen extends ElliteScreen
{
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(): iterable
    {
        return [
            'lista' => Post::orderBy('order')
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
        return 'Lista de artigos';
    }

    /**
     * The screen's action buttons.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [
            parent::getCreateLink('platform.posts.create'),
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
                TD::make("name", "Nome")->filter(Input::make()),
                TD::make("post_date", "Data")->render(fn($e) => $e->post_date?->format('d/m/Y'))->filter(DateRange::make()),
                // TD::make("categories", "Categoria")->relationsBadge("primary"),
                TD::make("active", "Ativo")->toggleActive('posts'),
                TD::make(__('Actions'))
                    ->align(TD::ALIGN_CENTER)
                    ->width('100px')
                    ->render(fn (Post $model) => DropDown::make()
                        ->icon('options-vertical')
                        ->list([
                            parent::getEditButton($model, 'platform.posts.edit', true),
                            parent::getRemoveButton($model, true),
                        ])),
            ]),
        ];
    }
    
    public function remove(Post $model)
    {
        return parent::delete($model, 'platform.posts.list');
    }

    public static function routes()
    {
        parent::routeList('artigos', 'posts');
    }
    
    public static function permissions()
    {
        return parent::crudPermissions('artigos', 'posts');
    }

    public static function metricsQuery()
    {
        return [
            'posts' => Post::count(),
        ];
    }
    
    public static function metricsLayout()
    {
        return [
            'Total de artigos' => 'metrics.posts',
        ];
    }
}
