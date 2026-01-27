<div class="trips-container">
    @forelse($booking->trips as $index => $trip)
        <div class="mb-2 p-2 bg-light rounded small">
            @if($booking->trips->count() > 1)
                <div class="mb-1">
                    <span class="badge bg-secondary">Trip {{ $index + 1 }}</span>
                </div>
            @endif
            <div class="d-flex align-items-center gap-2 flex-wrap">
                <span class="badge bg-primary">
                    <i class="bi bi-geo-alt-fill me-1"></i>{{ $trip->departure ?? 'N/A' }}
                </span>
                <i class="bi bi-arrow-right text-muted"></i>
                <span class="badge bg-success">
                    <i class="bi bi-geo-alt-fill me-1"></i>{{ $trip->arrival ?? 'N/A' }}
                </span>
            </div>
            <div class="mt-1 text-muted">
                <small>
                    <i class="bi bi-calendar-event me-1"></i>
                    <strong>Departure:</strong> {{ $trip->departure_date ? $trip->departure_date->format('M d, Y') : 'N/A' }}
                    @if($trip->arrival_date)
                        <br>
                        <i class="bi bi-calendar-check me-1"></i>
                        <strong>Return:</strong> {{ $trip->arrival_date->format('M d, Y') }}
                    @endif
                </small>
            </div>
        </div>
    @empty
        <span class="text-muted small">No trips</span>
    @endforelse
</div>