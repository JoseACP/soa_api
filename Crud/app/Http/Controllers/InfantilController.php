<?php

namespace App\Http\Controllers;

use App\Models\Infantil;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class InfantilController extends Controller
{
    public function index(): Renderable
    {
        $infantils = Infantil::paginate(1);
        return view('infantils.index', compact('infantils'));
    }

    public function create(): Renderable
    {
        $infantil = new Infantil();
        $title = __('Crear infantil');
        $action = route('infantils.store');
        $buttonText = __('Crear fuerta');
        return view('infantils.form', compact('infantil', 'title', 'action', 'buttonText'));
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required|unique:infantils,name|string|max:100',
            'description' => 'required|string|max:1000',
            'cost' => [
                'required',
                'numeric',
                'regex:/^\d+(\.\d{1,2})?$/'],
        ]);
        infantil::create([
            'name' => $request->string('name'),
            'description' => $request->string('description'),
            'cost' => $request->input('cost'),
        ]);
        return redirect()->route('infantils.index');
    }

    public function show(Infantil $infantil): Renderable
    {
        $infantil->load('user:id,name');
        return view('infantils.show', compact('infantil'));
    }

    public function edit(Infantil $infantil): Renderable
    {
        $title = __('Editar entrada');
        $action = route('entradas.update', $infantil);
        $buttonText = __('Actualizar infantil');
        $method = 'PUT';
        return view('infantils.form', compact('infantil', 'title', 'action', 'buttonText', 'method'));
    }

    public function update(Request $request, Infantil $infantil): RedirectResponse
    {
        $request->validate([
            'name' => 'required|unique:infantils,name,' . $infantil->id . '|string|max:100',
            'description' => 'required|string|max:1000',
            'cost' => [
                'required',
                'numeric',
                'regex:/^\d+(\.\d{1,2})?$/'],
        ]);
        $infantil->update([
            'name' => $request->string('name'),
            'description' => $request->string('description'),
            'cost' => $request->input('cost'),
        ]);
        return redirect()->route('infantils.index');
    }

    public function destroy(Infantil $infantil): RedirectResponse
    {
        $infantil->delete();
        return redirect()->route('infantils.index');
    }
}