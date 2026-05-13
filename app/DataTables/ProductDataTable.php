<?php

namespace App\DataTables;

use App\Models\Product;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class ProductDataTable extends DataTable
{
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', 'admin.products.action')
            ->editColumn('image', function ($row) {
                return '<img src="' . $row->image . '" width="50" />';
            })
            ->editColumn('is_featured', function ($row) {
                return $row->is_featured ? '<span class="badge bg-success">Featured</span>' : '<span class="badge bg-secondary">Not Featured</span>';
            })
            ->rawColumns(['image', 'is_featured', 'action']);
    }

    public function query(Product $model): QueryBuilder
    {
        return $model->newQuery();
    }

    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('products-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom('Bfrtip')
            ->orderBy(1)
            ->buttons(
                Button::make('create'),
                Button::make('excel'),
                Button::make('csv'),
                Button::make('pdf'),
                Button::make('print'),
                Button::make('reset'),
                Button::make('reload')
            );
    }

    protected function getColumns(): array
    {
        return [
            Column::make('id'),
            Column::make('image'),
            Column::make('name'),
            Column::make('category'),
            Column::make('price'),
            Column::make('stock'),
            Column::make('is_featured'),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(100)
                ->addClass('text-center'),
        ];
    }

    protected function filename(): string
    {
        return 'Products_' . date('Y-m-d_H-i-s');
    }
}
