@extends('layouts.app')

@section('content')
    <h1>Gráfico de Retrasos por Persona</h1>

    <!-- Formulario para seleccionar el mes -->
    <form action="{{ route('graficoretrasos') }}" method="get">
        @csrf
        <label for="mes">Seleccione un mes:</label>
        <select name="mes" id="mes">
            <option value="1">Enero</option>
            <option value="2">Febrero</option>
            <option value="3">Marzo</option>
            <option value="4">Abril</option>
            <option value="5">Mayo</option>
            <option value="6">Junio</option>
            <option value="7">Julio</option>
            <option value="8">Agosto</option>
            <option value="9">Septiembre</option>
            <option value="10">Octubre</option>
            <option value="11">Noviembre</option>
            <option value="12">Diciembre</option>
            <!-- Agregar opciones para los otros meses -->
        </select>
        <button type="submit">Mostrar Gráfico</button>
    </form>

    <div class="chart-container">
        <canvas id="myGroupedBarChart"></canvas>
    </div>

    <!-- Importar las librerías necesarias para Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        // Obtener los datos pasados desde el controlador
        var asistenciasPorPersona = @json($asistenciasPorPersona);

        // Preparar datos para el gráfico
        var personas = [];
        var minutosTotales = [];

        asistenciasPorPersona.forEach(function(asistencia) {
            personas.push(asistencia.persona);
            minutosTotales.push(asistencia.total_minutos);
        });

        // Crear el gráfico de barras agrupadas usando Chart.js
        var ctxGroupedBar = document.getElementById('myGroupedBarChart').getContext('2d');
        var myGroupedBarChart = new Chart(ctxGroupedBar, {
            type: 'bar',
            data: {
                labels: personas,
                datasets: [{
                    label: 'Minutos Totales',
                    data: minutosTotales,
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                indexAxis: 'x', // Cambio de 'y' a 'x' para orientación horizontal
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    x: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Personas' // Cambio de etiqueta del eje X
                        }
                    },
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Minutos Totales'
                        }
                    }
                }
            }
        });
    </script>

    <style>
        .chart-container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
        }
    </style>
@endsection
