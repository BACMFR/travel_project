<?php

namespace App\Http\Controllers;

use App\Http\Resources\TravelResource;
use App\Models\Travel;
use Illuminate\Http\Request;

class TravelController extends Controller
{
    public function index()
    {
        $travels = Travel::where('is_public', true)->paginate(5);

        return TravelResource::collection($travels);
    }

    public function create(Request $request)
    {
        $travel = Travel::create($request->all());
        if (! $travel) {
            return response()->json([
                'success' => false,
                'message' => 'Travel not created',
                'data' => null,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Travel created successfully',
                'data' => $travel,
            ]);
        }
    }

    public function update(Request $request, Travel $travel)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:travels,slug,'.$travel->id,
            'description' => 'required|string|max:255',
            'is_public' => 'required|boolean',
            'number_of_days' => 'required|integer|min:1',
        ]);

        $travel->update($validatedData);

        if (! $travel) {
            return response()->json([
                'success' => false,
                'message' => 'Travel not updated',
                'data' => null,
            ], 500);
        }

        return response()->json([
            'success' => true,
            'message' => 'Travel updated successfully',
            'data' => new TravelResource($travel),
        ], 200);
    }
}
