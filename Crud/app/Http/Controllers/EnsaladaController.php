<?php

namespace App\Http\Controllers;

use App\Models\Ensalada;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class EnsaladaController extends Controller
{
    public function index(): Renderable
    {
        $ensaladas = Ensalada::paginate(1);
        return view('ensaladas.index', compact('ensaladas'));
    }

    public function create(): Renderable
    {
        $ensalada = new Ensalada();
        $title = __('Crear ensalada');
        $action = route('ensaladas.store');
        $buttonText = __('Crear ensalada');
        return view('ensaladas.form', compact('ensalada', 'title', 'action', 'buttonText'));
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required|unique:ensaladas,name|string|max:100',
            'description' => 'required|string|max:1000',
            'cost' => [
                'required',
                'numeric',
                'regex:/^\d+(\.\d{1,2})?$/'],
        ]);
        Ensalada::create([
            'name' => $request->string('name'),
            'description' => $request->string('description'),
            'cost' => $request->input('cost'),
        ]);
        return redirect()->route('ensaladas.index');
    }

    public function show(Ensalada $ensalada): Renderable
    {
        $ensalada->load('user:id,name');
        return view('ensaladas.show', compact('ensalada'));
    }

    public function edit(Ensalada $ensalada): Renderable
    {
        $title = __('Editar ensalada');
        $action = route('ensaladas.update', $ensalada);
        $buttonText = __('Actualizar ensalada');
        $method = 'PUT';
        return view('ensaladas.form', compact('ensalada', 'title', 'action', 'buttonText', 'method'));
    }

    public function update(Request $request, Ensalada $ensalada): RedirectResponse
    {
        $request->validate([
            'name' => 'required|unique:ensaladas,name,' . $ensalada->id . '|string|max:100',
            'description' => 'required|string|max:1000',
            'cost' => [
                'required',
                'numeric',
                'regex:/^\d+(\.\d{1,2})?$/'],
        ]);
        $ensalada->update([
            'name' => $request->string('name'),
            'description' => $request->string('description'),
            'cost' => $request->input('cost'),
        ]);
        return redirect()->route('ensaladas.index');
    }

    public function destroy(Ensalada $ensalada): RedirectResponse
    {
        $ensalada->delete();
        return redirect()->route('ensaladas.index');
    }
}