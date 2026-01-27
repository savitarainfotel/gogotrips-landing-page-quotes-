<?php

namespace App\DataTables;

use App\Models\Booking;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Illuminate\Http\JsonResponse;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Facades\DataTables;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;

class BookingsDataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', function (Booking $booking) {
                return view('bookings.action', compact('booking'))->render();
            })
            ->addColumn('trips', function (Booking $booking) {
                return view('bookings.trips', compact('booking'))->render();
            })
            ->addColumn('contact', function (Booking $booking) {
                return view('bookings.contact', compact('booking'))->render();
            })
            ->addColumn('booking_type', function (Booking $booking) {
                $badgeClass = match($booking->booking_type) {
                    'One Way' => 'bg-primary',
                    'Round Trip' => 'bg-success',
                    'Multi City' => 'bg-warning',
                    default => 'bg-secondary'
                };
                return '<span class="badge ' . $badgeClass . '">' . $booking->booking_type . '</span>';
            })
            ->addColumn('created_at', function (Booking $booking) {
                return $booking->created_at->format('M d, Y h:i A');
            })
            ->rawColumns(['action', 'trips', 'contact', 'booking_type'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Booking $model): QueryBuilder
    {
        return $model->newQuery()->with('trips');
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return DataTables::getHtmlBuilder()
            ->setTableId('bookings-table')
            ->columns($this->getColumns())
            ->minifiedAjax(route('dashboard'))
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
                        'previous' => 'Previous'
                    ]
                ]
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
            Column::make('full_name')
                ->title('Full Name')
                ->width('12%')
                ->addClass('text-start'),
            Column::make('contact')
                ->title('Contact')
                ->width('15%')
                ->addClass('text-start')
                ->orderable(false)
                ->searchable(false),
            Column::make('booking_type')
                ->title('Type')
                ->width('10%')
                ->addClass('text-center'),
            Column::make('passengers')
                ->title('Passengers')
                ->width('8%')
                ->addClass('text-center'),
            Column::make('trips')
                ->title('Trips')
                ->width('30%')
                ->addClass('text-start')
                ->orderable(false)
                ->searchable(false),
            Column::make('created_at')
                ->title('Created At')
                ->width('12%')
                ->addClass('text-center'),
            Column::computed('action')
                ->title('Actions')
                ->width('8%')
                ->exportable(false)
                ->printable(false)
                ->addClass('text-center')
        ];
    }

    /**
     * Get filename for export.
     */
    protected function filename(): string
    {
        return 'Bookings_' . date('YmdHis');
    }

    /**
     * Get the response for AJAX request.
     */
    public function ajax(): JsonResponse
    {
        return $this->dataTable($this->query(new Booking()))->make(true);
    }
}
