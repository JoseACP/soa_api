<?php

namespace App\Http\Controllers;

use App\Models\Complemento;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ComplementoController extends Controller
{
    public function index(): Renderable
    {
        $complementos = Complemento::paginate(1);
        return view('complementos.index', compact('complementos'));
    }

    public function create(): Renderable
    {
        $complemento = new Complemento();
        $title = __('Crear complemento');
        $action = route('complementos.store');
        $buttonText = __('Crear complemento');
        return view('complementos.form', compact('complemento', 'title', 'action', 'buttonText'));
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required|unique:complementos,name|string|max:100',
            'description' => 'required|string|max:1000',
            'cost' => [
                'required',
                'numeric',
                'regex:/^\d+(\.\d{1,2})?$/'],
        ]);
        Complemento::create([
            'name' => $request->string('name'),
            'description' => $request->string('description'),
            'cost' => $request->input('cost'),
        ]);
        return redirect()->route('complementos.index');
    }

    public function show(Complemento $complemento): Renderable
    {
        $complemento->load('user:id,name');
        return view('complementos.show', compact('complemento'));
    }

    public function edit(Complemento $complemento): Renderable
    {
        $title = __('Editar complemento');
        $action = route('complementos.update', $complemento);
        $buttonText = __('Actualizar complemento');
        $method = 'PUT';
        return view('complementos.form', compact('complemento', 'title', 'action', 'buttonText', 'method'));
    }

    public function update(Request $request, Complemento $complemento): RedirectResponse
    {
        $request->validate([
            'name' => 'required|unique:complementos,name,' . $complemento->id . '|string|max:100',
            'description' => 'required|string|max:1000',
            'cost' => [
                'required',
                'numeric',
                'regex:/^\d+(\.\d{1,2})?$/'],
        ]);
        $complemento->update([
            'name' => $request->string('name'),
            'description' => $request->string('description'),
            'cost' => $request->input('cost'),
        ]);
        return redirect()->route('complementos.index');
    }

    public function destroy(Complemento $complemento): RedirectResponse
    {
        $complemento->delete();
        return redirect()->route('complementos.index');
    }
}