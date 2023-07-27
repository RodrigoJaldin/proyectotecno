<!-- resources/views/grafico/graficolicencia.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="chart-row">
        <div class="chart-container">
            <canvas id="myBarChart"></canvas>
        </div>

        <div class="chart-container">
            <canvas id="myPieChart"></canvas>
        </div>
    </div>

    <div class="chart-row">
        <div class="chart-container">
            <canvas id="myCustomChart"></canvas>
        </div>

        <div class="chart-container">
            <canvas id="myGroupedBarChart"></canvas>
        </div>
    </div>

    <!-- Importar las librerías necesarias para Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        // Obtener los datos pasados desde el controlador
        var users = @json($users);
        var cantidadLicencias = @json($cantidadLicencias);

        // Crear el gráfico de barras usando Chart.js
        var ctxBar = document.getElementById('myBarChart').getContext('2d');
        var myBarChart = new Chart(ctxBar, {
            type: 'bar',
            data: {
                labels: users,
                datasets: [{
                    label: 'Licencias por usuario (Gráfico de barras)',
                    data: cantidadLicencias,
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        // Crear el gráfico de pastel usando Chart.js
        var ctxPie = document.getElementById('myPieChart').getContext('2d');
        var myPieChart = new Chart(ctxPie, {
            type: 'pie',
            data: {
                labels: users,
                datasets: [{
                    label: 'Licencias por usuario (Gráfico de pastel)',
                    data: cantidadLicencias,
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        // Puedes agregar más colores si hay más datos
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        // Puedes agregar más colores si hay más datos
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                }
            }
        });

        // Crear un gráfico personalizado usando Chart.js
        var ctxCustom = document.getElementById('myCustomChart').getContext('2d');
        var myCustomChart = new Chart(ctxCustom, {
            type: 'line', // Puedes cambiar el tipo de gráfico aquí (line, bar, pie, etc.)
            data: {
                labels: users,
                datasets: [{
                    label: 'Licencias por usuario (Gráfico personalizado)',
                    data: cantidadLicencias,
                    fill: false,
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 2
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        // Crear un segundo gráfico personalizado usando Chart.js
        var ctxGroupedBar = document.getElementById('myGroupedBarChart').getContext('2d');
        var myGroupedBarChart = new Chart(ctxGroupedBar, {
            type: 'bar', // Cambiado a gráfico de barras agrupadas
            data: {
                labels: users,
                datasets: [{
                    label: 'Licencias por usuario (Gráfico de barras agrupadas)',
                    data: cantidadLicencias,
                    backgroundColor: 'rgba(255, 255, 0, 0.2)', // Amarillo con transparencia
                    borderColor: 'rgba(255, 255, 0, 1)', // Amarillo
                    borderWidth: 1
                }]
            },
            options: {
                indexAxis: 'y', // Para que las barras estén alineadas horizontalmente
                responsive: true,
                scales: {
                    x: {
                        beginAtZero: true
                    },
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
@endsection

<style>
    .chart-row {
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between;
        margin-bottom: 20px;
    }

    .chart-container {
        flex-basis: 48%;
        margin-bottom: 10px;
        padding: 10px;
        background-color: rgba(255, 255, 255, 0.8);
        border-radius: 8px;
        box-shadow: 0 0 8px rgba(0, 0, 0, 0.2);
    }
</style>
