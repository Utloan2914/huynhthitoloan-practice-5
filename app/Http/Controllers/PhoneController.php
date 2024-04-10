<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Phone;
use App\Models\User;

class PhoneController extends Controller
{
    public function index()
    {
        $phones = Phone::all();
        return response()->json($phones, 200);
    }

    public function store(Request $request)
    {
        $user = User::findOrFail($request->user_id);

        $phone = Phone::create([
            'number' => $request->number,
            'user_id' => $request->user_id,
        ]);

        return response()->json($phone, 201);
    }

    public function show($id)
    {
        $phone = Phone::findOrFail($id);
        return response()->json($phone, 200);
    }

    public function update(Request $request, $id)
    {
        $phone = Phone::findOrFail($id);

        if ($request->has('user_id')) {
            $user = User::findOrFail($request->user_id);
        }

        $phone->update([
            'number' => $request->number,
            'user_id' => $request->user_id ?? $phone->user_id,
        ]);

        return response()->json($phone, 200);
    }

    public function destroy($id)
    {
        $phone = Phone::findOrFail($id);
        $phone->delete();
        return response()->json(null, 204);
    }
}
