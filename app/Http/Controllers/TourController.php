<?php

namespace App\Http\Controllers;

use App\Http\Resources\TourResource;
use App\Models\Tour;
use App\Models\Travel;
use Illuminate\Http\Request;

class TourController extends Controller
{
    public function index(Request $request, Travel $travel)
    {
        $query = $travel->tour()->orderBy('starting_date', 'asc');

        if ($request->has('priceFrom')) {
            $query->where('price', '>=', $request->input('priceFrom'));
        }
        if ($request->has('priceTo')) {
            $query->where('price', '<=', $request->input('priceTo'));
        }
        if ($request->has('dateFrom')) {
            $query->where('starting_date', '>=', $request->input('dateFrom'));
        }
        if ($request->has('dateTo')) {
            $query->where('starting_date', '<=', $request->input('dateTo'));
        }

        if ($request->has('sortByPrice')) {
            $query->orderBy('price', $request->input('sortByPrice'));
        }

        $tour = $query->paginate(1);

        return TourResource::collection($tour);
    }

    public function create(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'starting_date' => 'required|date',
            'ending_date' => 'required|date|after_or_equal:starting_date',
            'price' => 'required|numeric|min:0',
            'travel_id' => 'required|exists:travels,id',
        ]);

        $tour = Tour::create($validatedData);

        if (! $tour) {
            return response()->json([
                'success' => false,
                'message' => 'Tour not created',
                'data' => null,
            ], 500);
        }

        return response()->json([
            'success' => true,
            'message' => 'Tour created successfully',
            'data' => new TourResource($tour),
        ], 201);
    }

    public function update(Request $request, Tour $tour)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'travel_id' => 'required|exists:travels,id',
            'starting_date' => 'required|date',
            'ending_date' => 'required|date|after_or_equal:starting_date',
            'price' => 'required|numeric|min:0',
        ]);

        $tour->update($validatedData);

        if (! $tour) {
            return response()->json([
                'success' => false,
                'message' => 'Tour not updated',
                'data' => null,
            ], 500);
        }

        return response()->json([
            'success' => true,
            'message' => 'Tour updated successfully',
            'data' => new TourResource($tour),
        ], 200);
    }
}
