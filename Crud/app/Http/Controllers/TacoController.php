<?php

namespace App\Http\Controllers;

use App\Models\Taco;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class TacoController extends Controller
{
    public function index(): Renderable
    {
        $tacos = Taco::paginate(1);
        return view('tacos.index', compact('tacos'));
    }

    public function create(): Renderable
    {
        $taco = new Taco;
        $title = __('Crear taco');
        $action = route('tacos.store');
        $buttonText = __('Crear taco');
        return view('tacos.form', compact('taco', 'title', 'action', 'buttonText'));
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required|unique:tacos,name|string|max:100',
            'description' => 'required|string|max:1000',
            'cost' => [
                'required',
                'numeric',
                'regex:/^\d+(\.\d{1,2})?$/'],
        ]);
        Taco::create([
            'name' => $request->string('name'),
            'description' => $request->string('description'),
            'cost' => $request->input('cost'),
        ]);
        return redirect()->route('tacos.index');
    }

    public function show(Taco $taco): Renderable
    {
        $taco->load('user:id,name');
        return view('tacos.show', compact('taco'));
    }

    public function edit(Taco $taco): Renderable
    {
        $title = __('Editar taco');
        $action = route('tacos.update', $taco);
        $buttonText = __('Actualizar taco');
        $method = 'PUT';
        return view('tacos.form', compact('taco', 'title', 'action', 'buttonText', 'method'));
    }

    public function update(Request $request, Taco $taco): RedirectResponse
    {
        $request->validate([
            'name' => 'required|unique:tacos,name,' . $taco->id . '|string|max:100',
            'description' => 'required|string|max:1000',
            'cost' => [
                'required',
                'numeric',
                'regex:/^\d+(\.\d{1,2})?$/'],
        ]);
        $taco->update([
            'name' => $request->string('name'),
            'description' => $request->string('description'),
            'cost' => $request->input('cost'),
        ]);
        return redirect()->route('tacos.index');
    }

    public function destroy(Taco $taco): RedirectResponse
    {
        $taco->delete();
        return redirect()->route('tacos.index');
    }
}