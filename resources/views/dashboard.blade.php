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

    

</x-app-layout>
<div>
    <img style="position: absolute;left: 40%; top: 30%; height: 60%; width: 40%;" src="https://scontent.flpb3-1.fna.fbcdn.net/v/t39.30808-6/273825073_360684779214440_8375043239309205996_n.jpg?_nc_cat=106&cb=99be929b-59f725be&ccb=1-7&_nc_sid=09cbfe&_nc_ohc=S1VJ73J_FScAX-F1HRc&_nc_ht=scontent.flpb3-1.fna&oh=00_AfAyPzmxizAn80vJuxpgP7_XGZBLw2vPDPsx8vnBNmkcqg&oe=64DA22C8">
</div>
<div class="row">
    <div class="col">
        <div style="position: fixed; bottom: 10px; right: 10px;">
            <h2 style="font-size: 17px;">Visitas</h2>
            <div class="card" style="width: 60px; height: 70px; font-size: 18px; background-color: #31525B;">
                <div class="card-body">
                    <p style="color: #fff" class="card-text">{{ session('contadorVisitasHome') }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
