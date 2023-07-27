<!-- resources/views/grafico/graficoasistencia.blade.php -->

@extends('layouts.app')

@section('content')
    @if ($asistenciasPorMes->count() > 0)
        <div class="chart-container" style="max-width: 600px; margin: 0 auto; background-color: #ffffff;">
            <!-- Gráfico de líneas -->
            <canvas id="myLineChart"></canvas>
        </div>

        <div class="chart-container" style="max-width: 600px; margin: 30px auto; background-color: #ffffff;">
            <!-- Gráfico de barras -->
            <canvas id="myBarChart"></canvas>
        </div>

        <!-- Importar las librerías necesarias para Chart.js -->
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

        <script>
            // Obtener los datos pasados desde el controlador
            var meses = @json($asistenciasPorMes->pluck('mes'));
            var asistencias = @json($asistenciasPorMes->pluck('total'));

            // Crear el gráfico de líneas usando Chart.js
            var ctxLine = document.getElementById('myLineChart').getContext('2d');
            var myLineChart = new Chart(ctxLine, {
                type: 'line',
                data: {
                    labels: meses,
                    datasets: [{
                        label: 'Asistencias por mes',
                        data: asistencias,
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 1,
                        pointRadius: 4, // Tamaño de los puntos
                        pointHoverRadius: 6, // Tamaño de los puntos al pasar el ratón por encima
                        pointBackgroundColor: 'rgba(75, 192, 192, 1)', // Color de los puntos
                        pointHoverBackgroundColor: 'rgba(255, 99, 132, 1)', // Color de los puntos al pasar el ratón por encima
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false, // Para ajustar el tamaño del gráfico
                    scales: {
                        x: {
                            display: true,
                            title: {
                                display: true,
                                text: 'Mes'
                            }
                        },
                        y: {
                            display: true,
                            title: {
                                display: true,
                                text: 'Cantidad de asistencias'
                            },
                            beginAtZero: true
                        }
                    }
                }
            });

            // Crear el gráfico de barras usando Chart.js
            var ctxBar = document.getElementById('myBarChart').getContext('2d');
            var myBarChart = new Chart(ctxBar, {
                type: 'bar',
                data: {
                    labels: meses,
                    datasets: [{
                        label: 'Asistencias por mes',
                        data: asistencias,
                        backgroundColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 1,
                        barPercentage: 0.7, // Controla el ancho de las barras (0.1 - 1)
                        categoryPercentage: 0.8, // Controla el ancho de las categorías (0.1 - 1)
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false, // Para ajustar el tamaño del gráfico
                    scales: {
                        x: {
                            display: true,
                            title: {
                                display: true,
                                text: 'Mes'
                            }
                        },
                        y: {
                            display: true,
                            title: {
                                display: true,
                                text: 'Cantidad de asistencias'
                            },
                            beginAtZero: true
                        }
                    },
                    plugins: {
                        legend: {
                            display: false // Ocultar leyendas del gráfico de barras
                        },
                    }
                }
            });
        </script>
    @else
        <p>No se encontraron datos de asistencias para el usuario autenticado.</p>
    @endif
@endsection
