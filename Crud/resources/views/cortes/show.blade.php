<x-app-layout>
    <!-- detalle del proyecto con título, descripción y autor -->
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detalle del proyecto') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h1 class="text-2xl font-bold mb-4">{{ $corte->name }}</h1>
                    <p class="text-gray-700 mb-4">
                        {{ __('Autor') }}: {{ $corte->user->name }}
                    </p>
                    <p class="text-gray-700 mb-4">{{ $corte->description }}</p>
                    <p class="text-gray-700 mb-4">{{ __('Costo') }}: {{ $corte->cost }}</p>
                    <p class="text-gray-700">{{ $corte->created_at->diffForHumans() }}</p>
                </div>
            </div>
        </div>

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-4">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <a href="{{ route('cortes.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded ml-2">{{ __('Volver') }}</a>
                    <a href="{{ route('cortes.edit', $corte) }}" class="bg-indigo-500 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded">{{ __('Editar') }}</a>
                    <form action="{{ route('cortes.destroy', $corte) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded ml-2">{{ __('Eliminar') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>