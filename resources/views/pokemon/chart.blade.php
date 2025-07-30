@extends('layouts.app') {{-- Asegúrate de que 'layouts.app' sea el nombre de tu plantilla base --}}

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Tipos de Pokémon más Comunes</div>

                <div class="card-body">
                    <canvas id="pokemonTypesChart"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Incluimos Chart.js desde un CDN para que no tengas que instalarlo manualmente --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

{{-- Incluimos nuestro script personalizado para el gráfico --}}
<script src="{{ asset('js/pokemonChart.js') }}"></script>
@endsection