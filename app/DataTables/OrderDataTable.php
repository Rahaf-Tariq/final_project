<?php

namespace App\DataTables;

use App\Models\Order;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class OrderDataTable extends DataTable
{
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('user_name', function ($row) {
                return $row->user->name;
            })
            ->addColumn('action', 'admin.orders.action')
            ->editColumn('status', function ($row) {
                $colors = [
                    'pending' => 'warning',
                    'processing' => 'info',
                    'shipped' => 'primary',
                    'delivered' => 'success',
                    'cancelled' => 'danger',
                ];
                return '<span class="badge bg-' . $colors[$row->status] . '">' . ucfirst($row->status) . '</span>';
            })
            ->editColumn('total_amount', function ($row) {
                return '$' . number_format($row->total_amount, 2);
            })
            ->rawColumns(['status', 'action']);
    }

    public function query(Order $model): QueryBuilder
    {
        return $model->newQuery()->with('user');
    }

    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('orders-table')
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
            Column::make('user_name'),
            Column::make('total_amount'),
            Column::make('status'),
            Column::make('payment_method'),
            Column::make('created_at'),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(100)
                ->addClass('text-center'),
        ];
    }

    protected function filename(): string
    {
        return 'Orders_' . date('Y-m-d_H-i-s');
    }
}
