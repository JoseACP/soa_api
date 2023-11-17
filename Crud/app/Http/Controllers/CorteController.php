<?php

namespace App\Http\Controllers;

use App\Models\Corte;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class CorteController extends Controller
{
    public function index(): Renderable
    {
        $cortes = Corte::paginate(1);
        return view('cortes.index', compact('cortes'));
    }

    public function create(): Renderable
    {
        $corte = new Corte();
        $title = __('Crear corte');
        $action = route('cortes.store');
        $buttonText = __('Crear corte');
        return view('cortes.form', compact('corte', 'title', 'action', 'buttonText'));
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required|unique:cortes,name|string|max:100',
            'description' => 'required|string|max:1000',
            'cost' => [
                'required',
                'numeric',
                'regex:/^\d+(\.\d{1,2})?$/'],
        ]);
        corte::create([
            'name' => $request->string('name'),
            'description' => $request->string('description'),
            'cost' => $request->input('cost'),
        ]);
        return redirect()->route('cortes.index');
    }

    public function show(Corte $corte): Renderable
    {
        $corte->load('user:id,name');
        return view('cortes.show', compact('corte'));
    }

    public function edit(Corte $corte): Renderable
    {
        $title = __('Editar corte');
        $action = route('cortes.update', $corte);
        $buttonText = __('Actualizar corte');
        $method = 'PUT';
        return view('cortes.form', compact('corte', 'title', 'action', 'buttonText', 'method'));
    }

    public function update(Request $request, Corte $corte): RedirectResponse
    {
        $request->validate([
            'name' => 'required|unique:cortes,name,' . $corte->id . '|string|max:100',
            'description' => 'required|string|max:1000',
            'cost' => [
                'required',
                'numeric',
                'regex:/^\d+(\.\d{1,2})?$/'],
        ]);
        $corte->update([
            'name' => $request->string('name'),
            'description' => $request->string('description'),
            'cost' => $request->input('cost'),
        ]);
        return redirect()->route('cortes.index');
    }

    public function destroy(Corte $corte): RedirectResponse
    {
        $corte->delete();
        return redirect()->route('cortes.index');
    }
}