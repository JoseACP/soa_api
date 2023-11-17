<?php

namespace App\Http\Controllers;

use App\Models\Sopa;
use App\Models\Taco;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class SopaController extends Controller
{
    public function index(): Renderable
    {
        $sopas = Sopa::paginate(1);
        return view('sopas.index', compact('sopas'));
    }

    public function create(): Renderable
    {
        $sopa = new Sopa;
        $title = __('Crear sopa');
        $action = route('sopas.store');
        $buttonText = __('Crear sopa');
        return view('sopas.form', compact('sopa', 'title', 'action', 'buttonText'));
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required|unique:sopas,name|string|max:100',
            'description' => 'required|string|max:1000',
            'cost' => [
                'required',
                'numeric',
                'regex:/^\d+(\.\d{1,2})?$/'],
        ]);
        Sopa::create([
            'name' => $request->string('name'),
            'description' => $request->string('description'),
            'cost' => $request->input('cost'),
        ]);
        return redirect()->route('sopas.index');
    }

    public function show(Sopa $sopa): Renderable
    {
        $sopa->load('user:id,name');
        return view('sopas.show', compact('sopa'));
    }

    public function edit(Sopa $sopa): Renderable
    {
        $title = __('Editar sopa');
        $action = route('sopas.update', $sopa);
        $buttonText = __('Actualizar sopa');
        $method = 'PUT';
        return view('sopa.form', compact('sopa', 'title', 'action', 'buttonText', 'method'));
    }

    public function update(Request $request, Sopa $sopa): RedirectResponse
    {
        $request->validate([
            'name' => 'required|unique:sopas,name,' . $sopa->id . '|string|max:100',
            'description' => 'required|string|max:1000',
            'cost' => [
                'required',
                'numeric',
                'regex:/^\d+(\.\d{1,2})?$/'],
        ]);
        $sopa->update([
            'name' => $request->string('name'),
            'description' => $request->string('description'),
            'cost' => $request->input('cost'),
        ]);
        return redirect()->route('sopas.index');
    }

    public function destroy(Sopa $sopa): RedirectResponse
    {
        $sopa->delete();
        return redirect()->route('sopas.index');
    }
}