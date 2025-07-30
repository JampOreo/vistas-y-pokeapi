@extends('layouts.app')

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

{{-- **IMPORTANTE:** Mueve estas líneas de script a la sección 'body_scripts' --}}
@endsection

@section('body_scripts') {{-- Esta es la sección donde deben ir los scripts --}}
    {{-- Incluimos Chart.js desde un CDN --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    {{-- Incluimos nuestro script personalizado para el gráfico --}}
    <script src="{{ asset('js/pokemonChart.js') }}"></script>
@endsection