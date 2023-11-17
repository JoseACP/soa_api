<?php

namespace App\Http\Controllers;

use App\Models\Entrada;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class EntradaController extends Controller
{
    public function index(): Renderable
    {
        $entradas = Entrada::paginate(1);
        return view('entradas.index', compact('entradas'));
    }

    public function create(): Renderable
    {
        $entrada = new Entrada();
        $title = __('Crear entrada');
        $action = route('entradas.store');
        $buttonText = __('Crear entrada');
        return view('entradas.form', compact('entrada', 'title', 'action', 'buttonText'));
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required|unique:entradas,name|string|max:100',
            'description' => 'required|string|max:1000',
            'cost' => [
                'required',
                'numeric',
                'regex:/^\d+(\.\d{1,2})?$/'],
        ]);
        Entrada::create([
            'name' => $request->string('name'),
            'description' => $request->string('description'),
            'cost' => $request->input('cost'),
        ]);
        return redirect()->route('entradas.index');
    }

    public function show(Entrada $entrada): Renderable
    {
        $entrada->load('user:id,name');
        return view('entradas.show', compact('entrada'));
    }

    public function edit(Entrada $entrada): Renderable
    {
        $title = __('Editar entrada');
        $action = route('entradas.update', $entrada);
        $buttonText = __('Actualizar entrada');
        $method = 'PUT';
        return view('entradas.form', compact('entrada', 'title', 'action', 'buttonText', 'method'));
    }

    public function update(Request $request, Entrada $entrada): RedirectResponse
    {
        $request->validate([
            'name' => 'required|unique:entradas,name,' . $entrada->id . '|string|max:100',
            'description' => 'required|string|max:1000',
            'cost' => [
                'required',
                'numeric',
                'regex:/^\d+(\.\d{1,2})?$/'],
        ]);
        $entrada->update([
            'name' => $request->string('name'),
            'description' => $request->string('description'),
            'cost' => $request->input('cost'),
        ]);
        return redirect()->route('entradas.index');
    }

    public function destroy(Entrada $entrada): RedirectResponse
    {
        $entrada->delete();
        return redirect()->route('entradas.index');
    }
}