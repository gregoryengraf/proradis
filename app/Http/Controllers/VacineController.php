<?php

namespace App\Http\Controllers;

use App\Models\Vacine;
use Illuminate\Http\Request;

class VacineController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $vacines = Vacine::with('patients')->orderBy('manufacturer')->get();
        return response()->json($vacines, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $vacine = Vacine::create($request->all());
        return response()->json($vacine, 201);
    }
}
