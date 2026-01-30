<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use App\Models\AirportCode;

class BookingController extends Controller
{
    /**
     * Store a new booking with trips.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        $rules = [
            'bookingType' => ['required', 'string', 'in:One Way,Round Trip,Multi City'],
            'fullName' => ['required', 'string', 'max:255'],
            'countryCode' => ['required', 'string', 'max:10', 'regex:/^\+?\d+$/'],
            'phone' => ['required', 'numeric', 'digits_between:7,15'],
            'email' => ['required', 'email', 'max:255'],
            'passengers' => ['required', 'integer', 'min:1', 'max:100'],
            'message' => ['nullable', 'string', 'max:5000']
        ];

        $messages = [
            'bookingType.required' => 'Booking type is required.',
            'bookingType.in' => 'Booking type must be one of: One Way, Round Trip or Multi City.',
            'fullName.required' => 'Full name is required.',
            'countryCode.required' => 'Country code is required.',
            'countryCode.regex' => 'Country code must be a valid format (e.g., +1).',
            'phone.required' => 'Phone number is required.',
            'phone.numeric' => 'Phone number must be numeric.',
            'phone.digits_between' => 'Phone number must be between 7 and 15 digits.',
            'email.required' => 'Email is required.',
            'email.email' => 'Email must be a valid email address.',
            'passengers.required' => 'Number of passengers is required.',
            'passengers.integer' => 'Number of passengers must be an integer.',
            'passengers.min' => 'Number of passengers must be at least 1.',
            'passengers.max' => 'Number of passengers cannot exceed 100.'
        ];

        $bookingType = $request->input('bookingType');

        switch ($bookingType) {
            case 'Round Trip':
                $rules['departure'] = ['required', 'string', 'max:255'];
                $rules['arrival'] = ['required', 'string', 'max:255'];
                $rules['departureDate'] = ['required', 'string', 'date', 'after_or_equal:today'];
                $rules['arrivalDate'] = ['required', 'string', 'date', 'after_or_equal:departureDate'];
                break;

            case 'Multi City':
                $rules['trips'] = ['required', 'array', 'min:1'];
                $rules['trips.*.from'] = ['required', 'string', 'max:255'];
                $rules['trips.*.to'] = ['required', 'string', 'max:255'];
                $rules['trips.*.date'] = ['required', 'string', 'after_or_equal:today'];

                $messages['trips.required'] = 'At least one trip is required.';
                $messages['trips.array'] = 'Trips must be an array.';
                $messages['trips.min'] = 'At least one trip is required.';
                $messages['trips.*.from.required'] = 'From location is required for each trip.';
                $messages['trips.*.to.required'] = 'To location is required for each trip.';
                $messages['trips.*.date.required'] = 'Date is required for each trip.';
                break;

            default:
                $rules['departure'] = ['required', 'string', 'max:255'];
                $rules['arrival'] = ['required', 'string', 'max:255'];
                $rules['departureDate'] = ['required', 'string', 'after_or_equal:today'];
                break;
        }

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed.',
                'errors' => $validator->errors(),
            ], 422);
        }

        switch ($bookingType) {
            case 'Round Trip':
                $request->merge([
                    'trips' => [[
                        'arrivalDate'   => $request->arrivalDate,
                        'departureDate' => $request->departureDate,
                        'arrival'       => $request->arrival,
                        'departure'     => $request->departure
                    ]]
                ]);
                break;

            case 'One Way':
                $request->merge([
                    'trips' => [[
                        'departureDate' => $request->departureDate,
                        'arrival'       => $request->arrival,
                        'departure'     => $request->departure
                    ]]
                ]);
                break;
        }

        $trips = $request->input('trips', []);

        try {
            DB::beginTransaction();

            // Create the booking
            $booking = Booking::create([
                'full_name' => $request->input('fullName'),
                'country_code' => $request->input('countryCode'),
                'phone' => (string) $request->input('phone'),
                'email' => $request->input('email'),
                'passengers' => $request->input('passengers'),
                'message' => $request->input('message'),
                'booking_type' => $bookingType,
            ]);

            // Create the trips
            foreach ($trips as $trip) {
                $booking->trips()->create([
                    'departure_date' => $trip['departureDate'] ?? ($trip['date'] ?? null),
                    'arrival_date'   => $trip['arrivalDate'] ?? null,
                    'arrival'        => $trip['arrival'] ?? ($trip['to'] ?? null),
                    'departure'      => $trip['departure'] ?? ($trip['from'] ?? null)
                ]);
            }

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Booking created successfully.'
            ], 201);

        } catch (\Exception $e) {
            DB::rollBack();
            
            Log::error('Booking creation failed', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'request_data' => $request->except(['password', 'token']),
            ]);

            return response()->json([
                'success' => false,
                'message' => 'An error occurred while creating the booking. Please try again later.',
            ], 500);
        }
    }

    /**
     * Search Airport Codes.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function searchAirportCodes(Request $request): JsonResponse
    {
        $airportCodes = [];

        if($request->q) {
            $airportCodes = AirportCode::select([
                'id',
                'airport',
                'iata_code AS airport_code',
                'city',
                'iso_country AS country_code'
            ])->whereAny([
                'airport',
                'iata_code',
                'city',
            ], 'LIKE', "%{$request->q}%")->limit($request->limit ?? 10)->get();
        }

        return response()->json($airportCodes, 200);
    }
}