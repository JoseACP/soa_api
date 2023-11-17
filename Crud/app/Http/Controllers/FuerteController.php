<?php

namespace App\Http\Controllers;

use App\Models\Fuerte;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class FuerteController extends Controller
{
    public function index(): Renderable
    {
        $fuertes = Fuerte::paginate(1);
        return view('fuertes.index', compact('fuertes'));
    }

    public function create(): Renderable
    {
        $fuerte = new Fuerte();
        $title = __('Crear fuerte');
        $action = route('fuertes.store');
        $buttonText = __('Crear fuerta');
        return view('fuertes.form', compact('fuerte', 'title', 'action', 'buttonText'));
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required|unique:fuertes,name|string|max:100',
            'description' => 'required|string|max:1000',
            'cost' => [
                'required',
                'numeric',
                'regex:/^\d+(\.\d{1,2})?$/'],
        ]);
        Fuerte::create([
            'name' => $request->string('name'),
            'description' => $request->string('description'),
            'cost' => $request->input('cost'),
        ]);
        return redirect()->route('fuertes.index');
    }

    public function show(Fuerte $fuerte): Renderable
    {
        $fuerte->load('user:id,name');
        return view('fuertes.show', compact('fuerte'));
    }

    public function edit(Fuerte $fuerte): Renderable
    {
        $title = __('Editar entrada');
        $action = route('entradas.update', $fuerte);
        $buttonText = __('Actualizar fuerte');
        $method = 'PUT';
        return view('fuertes.form', compact('fuerte', 'title', 'action', 'buttonText', 'method'));
    }

    public function update(Request $request, Fuerte $fuerte): RedirectResponse
    {
        $request->validate([
            'name' => 'required|unique:fuertes,name,' . $fuerte->id . '|string|max:100',
            'description' => 'required|string|max:1000',
            'cost' => [
                'required',
                'numeric',
                'regex:/^\d+(\.\d{1,2})?$/'],
        ]);
        $fuerte->update([
            'name' => $request->string('name'),
            'description' => $request->string('description'),
            'cost' => $request->input('cost'),
        ]);
        return redirect()->route('fuertes.index');
    }

    public function destroy(Fuerte $fuerte): RedirectResponse
    {
        $fuerte->delete();
        return redirect()->route('fuertes.index');
    }
}