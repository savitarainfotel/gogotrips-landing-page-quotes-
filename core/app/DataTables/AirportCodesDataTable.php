<?php

namespace App\DataTables;

use App\Models\AirportCode;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Illuminate\Http\JsonResponse;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Facades\DataTables;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Column;

class AirportCodesDataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', function (AirportCode $airportCode) {
                return view('airport-codes.action', compact('airportCode'))->render();
            })
            ->addColumn('created_at', function (AirportCode $airportCode) {
                return $airportCode->created_at->format('M d, Y h:i A');
            })
            ->rawColumns(['action'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(AirportCode $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return DataTables::getHtmlBuilder()
            ->setTableId('airport-codes-table')
            ->columns($this->getColumns())
            ->minifiedAjax(route('airport-codes.index'))
            ->orderBy(0, 'asc')
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
                ->width('4%')
                ->addClass('text-center'),
            Column::make('iata')
                ->title('IATA')
                ->width('6%')
                ->addClass('text-center'),
            Column::make('icao')
                ->title('ICAO')
                ->width('6%')
                ->addClass('text-center'),
            Column::make('airport')
                ->title('Airport')
                ->width('18%')
                ->addClass('text-start'),
            Column::make('city')
                ->title('City')
                ->width('12%')
                ->addClass('text-start'),
            Column::make('country')
                ->title('Country')
                ->width('12%')
                ->addClass('text-start'),
            Column::make('airport_type')
                ->title('Type')
                ->width('10%')
                ->addClass('text-start'),
            Column::make('faa')
                ->title('FAA')
                ->width('6%')
                ->addClass('text-center'),
            Column::make('created_at')
                ->title('Created')
                ->width('10%')
                ->addClass('text-center'),
            Column::computed('action')
                ->title('Actions')
                ->width('6%')
                ->exportable(false)
                ->printable(false)
                ->addClass('text-center'),
        ];
    }

    /**
     * Get the response for AJAX request.
     */
    public function ajax(): JsonResponse
    {
        return $this->dataTable($this->query(new AirportCode()))->make(true);
    }
}