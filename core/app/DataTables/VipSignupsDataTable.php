<?php

namespace App\DataTables;

use App\Models\VipSignup;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Illuminate\Http\JsonResponse;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Facades\DataTables;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Column;

class VipSignupsDataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('phone_display', function (VipSignup $vipSignup) {
                $parts = array_filter([$vipSignup->country_code, $vipSignup->phone]);
                return implode(' ', $parts) ?: '—';
            })
            /* ->addColumn('action', function (VipSignup $vipSignup) {
                return view('vip-signups.action', compact('vipSignup'))->render();
            }) */
            ->addColumn('created_at', function (VipSignup $vipSignup) {
                return $vipSignup->created_at->format('M d, Y h:i A');
            })
            ->rawColumns(['action'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(VipSignup $model): QueryBuilder
    {
        return $model->newQuery()->orderByDesc('created_at');
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return DataTables::getHtmlBuilder()
            ->setTableId('vip-signups-table')
            ->columns($this->getColumns())
            ->minifiedAjax(route('vip-signups.index'))
            ->orderBy(0, 'desc')
            ->selectStyleSingle()
            ->parameters([
                'dom' => 'Bfrtip',
                'responsive' => true,
                'pageLength' => 25,
                'lengthMenu' => [[10, 25, 50, 100, -1], [10, 25, 50, 100, 'All']],
                'language' => [
                    'search' => 'Search:',
                    'lengthMenu' => 'Show _MENU_ entries',
                    'info' => 'Showing _START_ to _END_ of _TOTAL_ entries',
                    'infoEmpty' => 'Showing 0 to 0 of 0 entries',
                    'infoFiltered' => '(filtered from _MAX_ total entries)',
                    'zeroRecords' => 'No matching records found',
                    'paginate' => [
                        'first' => 'First',
                        'last' => 'Last',
                        'next' => 'Next',
                        'previous' => 'Previous',
                    ],
                ],
            ]);
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::make('id')
                ->title('ID')
                ->width('5%')
                ->addClass('text-center'),
            Column::make('name')
                ->title('Name')
                ->width('18%')
                ->addClass('text-start'),
            Column::make('email')
                ->title('Email')
                ->width('20%')
                ->addClass('text-start'),
            Column::computed('phone_display')
                ->title('Phone')
                ->width('18%')
                ->addClass('text-start')
                ->orderable(false)
                ->searchable(false),
            Column::make('created_at')
                ->title('Signed Up')
                ->width('15%')
                ->addClass('text-center'),
            /* Column::computed('action')
                ->title('Actions')
                ->width('8%')
                ->exportable(false)
                ->printable(false)
                ->addClass('text-center'), */
        ];
    }

    /**
     * Get the response for AJAX request.
     */
    public function ajax(): JsonResponse
    {
        return $this->dataTable($this->query(new VipSignup()))->make(true);
    }
}