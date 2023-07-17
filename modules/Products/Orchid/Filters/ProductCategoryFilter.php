<?php

namespace Ellite\Products\Orchid\Filters;

use Ellite\Products\Models\ProductCategory;
use Illuminate\Database\Eloquent\Builder;
use Orchid\Filters\Filter;
use Orchid\Screen\Field;
use Orchid\Screen\Fields\Select;

class ProductCategoryFilter extends Filter
{
    /**
     * The displayable name of the filter.
     *
     * @return string
     */
    public function name(): string
    {
        return 'Marcas';
    }

    /**
     * The array of matched parameters.
     *
     * @return array|null
     */
    public function parameters(): ?array
    {
        return [
            'category'
        ];
    }

    /**
     * Apply to a given Eloquent query builder.
     *
     * @param Builder $builder
     *
     * @return Builder
     */
    public function run(Builder $builder): Builder
    {
        $category_id = $this->request->get('category');

        return $builder->whereRelation('categories', 'id', '=', $category_id);
    }

    /**
     * Get the display fields.
     *
     * @return Field[]
     */
    public function display(): iterable
    {
        return [
            Select::make('category')
                ->value($this->request->get('category'))
                ->fromModel(ProductCategory::class, 'name', 'id')
                ->placeholder('Pesquise por Marca...')
                ->empty('Pesquise por Marca'),
        ];
    }
}
