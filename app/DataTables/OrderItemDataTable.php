<?php

namespace App\DataTables;

use App\Models\OrderItem;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class OrderItemDataTable extends DataTable
{
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('order_id_display', function ($row) {
                return '#' . $row->order_id;
            })
            ->addColumn('product_name', function ($row) {
                return $row->product->name;
            })
            ->addColumn('subtotal', function ($row) {
                return '$' . number_format($row->unit_price * $row->quantity, 2);
            })
            ->editColumn('unit_price', function ($row) {
                return '$' . number_format($row->unit_price, 2);
            })
            ->rawColumns([]);
    }

    public function query(OrderItem $model): QueryBuilder
    {
        return $model->newQuery()->with('product', 'order');
    }

    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('orderitems-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom('Bfrtip')
            ->orderBy(1)
            ->buttons(
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
            Column::make('order_id_display'),
            Column::make('product_name'),
            Column::make('quantity'),
            Column::make('unit_price'),
            Column::make('subtotal'),
            Column::make('created_at'),
        ];
    }

    protected function filename(): string
    {
        return 'OrderItems_' . date('Y-m-d_H-i-s');
    }
}
