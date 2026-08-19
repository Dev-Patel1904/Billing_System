<?php

namespace App\Http\Controllers;

use App\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class TypeController extends Controller
{
    // Add New Type
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:100',
                'unique:types,name',
            ],
        ], [
            'name.required' => 'પ્રકાર દાખલ કરો.',
            'name.max'      => 'પ્રકાર ખૂબ લાંબો છે.',
            'name.unique'   => 'આ પ્રકાર પહેલેથી ઉમેરાયેલ છે.',
        ]);

        try {

            $type = Type::create([
                'name' => $validated['name'],
            ]);

            return response()->json([
                'status'  => true,
                'message' => 'પ્રકાર સફળતાપૂર્વક ઉમેરાયો.',
                'type'    => $type,
            ]);

        } catch (\Exception $e) {

            return response()->json([
                'status'  => false,
                'message' => 'પ્રકાર ઉમેરવામાં ભૂલ આવી.',
            ], 500);

        }
    }


    // Update Existing Type
    public function update(Request $request, Type $type)
    {
        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:100',
                Rule::unique('types', 'name')->ignore($type->id),
            ],
        ], [
            'name.required' => 'પ્રકાર દાખલ કરો.',
            'name.max'      => 'પ્રકાર ખૂબ લાંબો છે.',
            'name.unique'   => 'આ પ્રકાર પહેલેથી ઉમેરાયેલ છે.',
        ]);

        try {

            $type->update($validated);

            return response()->json([
                'status'  => true,
                'message' => 'પ્રકાર સફળતાપૂર્વક અપડેટ થયો.',
                'type'    => $type,
            ]);

        } catch (\Exception $e) {

            return response()->json([
                'status'  => false,
                'message' => 'પ્રકાર અપડેટ કરવામાં ભૂલ આવી.',
            ], 500);

        }
    }
}
