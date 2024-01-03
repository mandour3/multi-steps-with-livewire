<?php

namespace App\Http\Controllers;

use App\Models\worker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class WorkerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        worker::create($request->all());

        return redirect()->back()
            ->with('message', 'Record added successfully!');   }

    /**
     * Display the specified resource.
     */
    public function show(worker $worker)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(worker $worker)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, worker $worker)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(worker $worker)
    {
        //
    }
}
