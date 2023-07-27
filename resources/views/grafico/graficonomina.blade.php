@extends('layouts.app')

@section('content')
    <div class="chart-container">
        <canvas id="myGroupedBarChart"></canvas>
    </div>

    <!-- Importar las librerías necesarias para Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        // Obtener los datos pasados desde el controlador
        var users = @json($users);
        var montoAPagar = @json($montoAPagar);

        // Crear el gráfico de barras agrupadas usando Chart.js
        var ctxGroupedBar = document.getElementById('myGroupedBarChart').getContext('2d');
        var myGroupedBarChart = new Chart(ctxGroupedBar, {
            type: 'bar',
            data: {
                labels: users,
                datasets: [{
                    label: 'Monto a Pagar',
                    data: montoAPagar,
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                indexAxis: 'y', // Para que las barras estén alineadas horizontalmente
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    x: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Monto a Pagar'
                        }
                    },
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Usuarios'
                        }
                    }
                }
            }
        });
    </script>

@endsection

<style>
    .chart-container {
        max-width: 600px;
        margin: 0 auto;
        background-color: #ffffff;
    }
</style>
