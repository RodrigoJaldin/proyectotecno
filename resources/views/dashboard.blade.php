<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>


    
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <x-welcome />
            </div>
        </div>
    </div>

    <div style="position: fixed; bottom: 10px; right: 10px;">
        <div class="card" style="width: 60px; height: 70px; font-size: 18px; background-color: #31525B;">
            <div class="card-body">
                <h2 style="font-size: 17px; color: #fff;">Visitas</h2>
                <p style="color: #fff" class="card-text">{{ session('contadorVisitasHome') }}</p>
            </div>
        </div>
    </div>

</x-app-layout>
