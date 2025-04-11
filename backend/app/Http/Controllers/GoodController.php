<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Good;

class GoodController extends Controller
{
    public function index(Request $request)
    {
        // Otrzymujemy wszystkie towary
        $goods = Good::all();

        return response()->json($goods);
    }

    public function show($id)
    {
        // Otrzymujemy towar o danym ID
        // Jeśli towar nie istnieje, zwracamy 404
        $good = Good::findOrFail($id);

        return response()->json($good);
    }
}
