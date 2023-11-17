<?php

namespace App\Http\Controllers;

use App\Models\Bebida;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class BebidaController extends Controller
{
    public function index(): Renderable
    {
        $bebidas = Bebida::paginate(1);
        return view('bebidas.index', compact('bebidas'));
    }

    public function create(): Renderable
    {
        $bebida = new Bebida();
        $title = __('Crear bebida');
        $action = route('bebidas.store');
        $buttonText = __('Crear bebida');
        return view('bebidas.form', compact('bebida', 'title', 'action', 'buttonText'));
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required|unique:bebidas,name|string|max:100',
            'description' => 'required|string|max:1000',
            'cost' => [
                'required',
                'numeric',
                'regex:/^\d+(\.\d{1,2})?$/'],
        ]);
        Bebida::create([
            'name' => $request->string('name'),
            'description' => $request->string('description'),
            'cost' => $request->input('cost'),
        ]);
        return redirect()->route('bebidas.index');
    }

    public function show(Bebida $bebida): Renderable
    {
        $bebida->load('user:id,name');
        return view('bebidas.show', compact('bebida'));
    }

    public function edit(Bebida $bebida): Renderable
    {
        $title = __('Editar bebida');
        $action = route('bebidas.update', $bebida);
        $buttonText = __('Actualizar bebida');
        $method = 'PUT';
        return view('bebidas.form', compact('bebida', 'title', 'action', 'buttonText', 'method'));
    }

    public function update(Request $request, Bebida $bebida): RedirectResponse
    {
        $request->validate([
            'name' => 'required|unique:bebidas,name,' . $bebida->id . '|string|max:100',
            'description' => 'required|string|max:1000',
            'cost' => [
                'required',
                'numeric',
                'regex:/^\d+(\.\d{1,2})?$/'],
        ]);
        $bebida->update([
            'name' => $request->string('name'),
            'description' => $request->string('description'),
            'cost' => $request->input('cost'),
        ]);
        return redirect()->route('bebidas.index');
    }

    public function destroy(Bebida $bebida): RedirectResponse
    {
        $bebida->delete();
        return redirect()->route('bebidas.index');
    }
}