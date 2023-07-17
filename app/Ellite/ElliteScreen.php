<?php

namespace App\Ellite;

use App\Repositories\LogRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Toast;
use Orchid\Platform\ItemPermission;
use Orchid\Support\Color;
use Tabuna\Breadcrumbs\Trail;

abstract class ElliteScreen extends Screen
{
    /**
     * Função que executa antes de fazer o fill salvar
     * Pode ser usada para alterar campos antes de salvar
     */
    protected function preProcessData(array $data): array
    {
        return $data;
    }

    protected function shouldTransferNameToTitle(): bool
    {
        return false;
    }

    protected function createOrUpdate(ElliteModel $model, string $route, array $validation = [])
    {
        $is_new = empty($model->id);

        request()->validate($validation);

        // $model->fill($request->collect('model')->toArray());
        // $model->save();
        $data = request()->collect('model')->toArray();

        if ($this->shouldTransferNameToTitle()) {
            foreach (languages()->languages() as $language) {
                $data_array = &$data[$language->locale];

                if (empty($data_array['title'])) {
                    $data_array['title'] = $data['name'];
                }
            }
        }

        $data = $this->preProcessData($data);

        $model->checkAndSave($data);

        logsRestrita()->insertLog(
            sprintf(
                "%s %s %s %s",
                $is_new ? 'Cadastrou' : 'Editou',
                $model->getArticle(),
                $model->getEntityNameSingular(),
                $model->getLogName(),
            ),
            $is_new ? "create" : "edit",
            $model::class,
            $model->id,
        );

        Toast::info(sprintf(
            "%s salv%s com sucesso.",
            ucfirst($model->getEntityNameSingular()),
            $model->getArticle(),
        ));

        return redirect()->route($route);
    }

    protected function delete(ElliteModel $model, string $rota)
    {
        // $model->delete();
        $model->unlinkAndDelete();

        logsRestrita()->insertLog(
            sprintf("Deletou %s %s %s", $model->getArticle(), $model->getEntityNameSingular(), $model->getLogName()),
            "delete",
            $model::class,
            $model->id,
        );

        Toast::info(
            sprintf(
                '%s deletad%s com sucesso',
                ucfirst($model->getEntityNameSingular()),
                $model->getArticle(),
            )
        );

        return redirect()->route($rota);
    }

    public static function getEditButton(ElliteModel $model, string $link, bool $canSee)
    {
        return Link::make(__('Edit'))
            ->route($link, $model->id)
            ->icon('pencil')
            ->canSee($canSee);
    }

    public static function getViewButton(ElliteModel $model, string $link, bool $canSee)
    {
        return Link::make(__('Visualizar'))
            ->route($link, $model->id)
            ->icon('eye')
            ->canSee($canSee);
    }

    public static function getRemoveButton(ElliteModel $model, bool $canSee)
    {
        return
            Button::make('Remover')
            ->method('remove')
            ->icon('trash')
            ->canSee($canSee)
            ->novalidate(true)
            ->confirm("Ao remover esse registro, todas informações relacionadas à ele serão deletadas e não poderão ser recuperadas. Deseja continuar?")
            ->class('btn btn-default text-danger')
            ->method('remove', [
                'id' => $model->id,
            ]);
    }

    public static function getSaveButton(ElliteModel $model, bool $canSee)
    {
        return
            Button::make('Salvar')
            ->method('save')
            ->type(Color::SUCCESS())
            ->icon('save')
            ->canSee($canSee);
    }

    public static function getCreateLink(string $route)
    {
        return
            Link::make('Adicionar')
            ->type(Color::SUCCESS())
            ->icon('plus')
            ->route($route);
    }

    public static function getReturnLink(string $route)
    {
        return
            Link::make('Voltar')
            ->icon('action-undo')
            ->route($route)
            ->class('btn btn-default');
    }

    protected static function crudPermissions(string $name, ?string $slug = null)
    {
        if (!$slug) {
            $slug = $name;
        }

        return ItemPermission::group(ucfirst($name))
            ->addPermission("platform.$slug.list", "Listar $name")
            ->addPermission("platform.$slug.create", "Cadastrar $name")
            ->addPermission("platform.$slug.edit", "Editar $name")
            ->addPermission("platform.$slug.delete", "Deletar $name");
    }

    protected static function editPermission(string $name, ?string $slug = null)
    {
        if (!$slug) {
            $slug = $name;
        }

        return ItemPermission::group(ucfirst($name))
            ->addPermission("platform.$slug.edit", "Editar $name");
    }

    protected static function listViewDeletePermission(string $name, ?string $slug = null)
    {
        if (!$slug) {
            $slug = $name;
        }

        return ItemPermission::group(ucfirst($name))
            ->addPermission("platform.$slug.list", "Listar $name")
            ->addPermission("platform.$slug.view", "Visualizar $name")
            ->addPermission("platform.$slug.delete", "Deletar $name");
    }

    protected static function routeList(string $name, ?string $slug = null)
    {
        if (!$slug) {
            $slug = $name;
        }

        Route::screen($slug, static::class)
            ->name("platform.$slug.list")
            ->breadcrumbs(fn (Trail $trail) => $trail
                ->parent('platform.index')
                ->push("Listagem de $name", "platform.$slug.list"));
    }

    protected static function routeCreate(string $name, ?string $slug = null)
    {
        if (!$slug) {
            $slug = $name;
        }

        Route::screen("$slug/create", static::class)
            ->name("platform.$slug.create")
            ->breadcrumbs(fn (Trail $trail) => $trail
                ->parent('platform.index')
                ->parent("platform.$slug.list")
                ->push("Cadastrar $name"));
    }

    protected static function routeEdit(string $name, ?string $slug = null)
    {
        if (!$slug) {
            $slug = $name;
        }

        Route::screen("$slug/{model}/edit", static::class)
            ->name("platform.$slug.edit")
            ->breadcrumbs(fn (Trail $trail) => $trail
                ->parent('platform.index')
                ->parent("platform.$slug.list")
                ->push("Editar $name"));
    }

    protected static function routeSingle(string $name, ?string $slug = null)
    {
        if (!$slug) {
            $slug = $name;
        }

        Route::screen("$slug/edit", static::class)
            ->name("platform.$slug.edit")
            ->breadcrumbs(fn (Trail $trail) => $trail
                ->parent('platform.index')
                ->push("Alterar $name"));
    }

    protected static function routeView(string $name, ?string $slug = null)
    {
        if (!$slug) {
            $slug = $name;
        }

        Route::screen("$slug/{model}/view", static::class)
            ->name("platform.$slug.view")
            ->breadcrumbs(fn (Trail $trail) => $trail
                ->parent('platform.index')
                ->parent("platform.$slug.list")
                ->push("Visualizar $name"));
    }

    protected function toggleField(ElliteModel $model)
    {
        $column = request()->input('params.column');
        $status = request()->input('params.status');

        $model->fill([
            $column => $status,
        ]);

        $model->save();

        logsRestrita()->insertLog(
            sprintf(
                "Alterou %s d%s %s %s para %s",
                $column,
                $model->getArticle(),
                $model->getEntityNameSingular(),
                $model->getLogName(),
                intval($status),
            ),
            "toggleField",
            $model::class,
            $model->id,
        );

        return response()->json([
            'error' => null,
            'message' => 'Status alterado com sucesso',
        ]);
    }

    protected function sortModel($class)
    {
        $data = request()->input('params.data');

        foreach ($data as $id => $new_order) {
            $model = $class::where('id', $id)->first();
            if ($model) {
                $model->order = $new_order;
                $model->save();
            }
        }

        return '';
    }
}
