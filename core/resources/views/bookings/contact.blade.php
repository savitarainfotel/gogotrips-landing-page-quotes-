<div class="contact-info">
    <div class="mb-1">
        <i class="bi bi-envelope me-1"></i>
        <a href="mailto:{{ $booking->email }}" class="text-decoration-none">{{ $booking->email }}</a>
    </div>
    <div class="text-muted small">
        <i class="bi bi-telephone me-1"></i>
        {{ $booking->country_code }} {{ $booking->phone }}
    </div>
</div>