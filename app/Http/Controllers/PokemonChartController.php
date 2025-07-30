<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http; // Importa la fachada HTTP de Laravel

class PokemonChartController extends Controller
{
    /**
     * Muestra la vista con el gráfico de Pokémon.
     */
    public function index()
    {
        return view('pokemon.chart'); // Carga la vista que creamos
    }

    /**
     * Obtiene los datos de tipos de Pokémon de la PokeAPI.
     */
    public function getPokemonTypesData()
    {
        $pokeApiBaseUrl = 'https://pokeapi.co/api/v2/';
        $pokemonLimit = 150; // Puedes ajustar este número. Cuanto más alto, más lenta la carga.

        try {
            // 1. Obtener una lista de Pokémon desde la PokeAPI
            $response = Http::get($pokeApiBaseUrl . 'pokemon', [
                'limit' => $pokemonLimit, // Limita el número de Pokémon a obtener
            ]);

            // Si la petición a la PokeAPI falla
            if ($response->failed()) {
                \Log::error('Error al obtener lista de Pokémon de PokeAPI: ' . $response->body());
                return response()->json(['error' => 'No se pudo obtener la lista de Pokémon de la PokeAPI. Por favor, inténtelo de nuevo más tarde.'], 500);
            }

            $pokemonList = $response->json()['results'];
            $typeCounts = []; // Array para almacenar el conteo de cada tipo

            // 2. Iterar sobre cada Pokémon para obtener sus detalles y contar sus tipos
            foreach ($pokemonList as $pokemon) {
                $pokemonDetailsResponse = Http::get($pokemon['url']);

                // Si la petición de detalles de un Pokémon falla, loguear y continuar con el siguiente
                if ($pokemonDetailsResponse->failed()) {
                    \Log::warning('Error al obtener detalles del Pokémon: ' . $pokemon['name'] . '. Error: ' . $pokemonDetailsResponse->body());
                    continue; // Pasa al siguiente Pokémon
                }

                $pokemonDetails = $pokemonDetailsResponse->json();

                // Recorrer los tipos de cada Pokémon
                foreach ($pokemonDetails['types'] as $typeInfo) {
                    $typeName = $typeInfo['type']['name'];
                    // Incrementar el contador para este tipo
                    $typeCounts[$typeName] = ($typeCounts[$typeName] ?? 0) + 1;
                }
            }

            // Preparar los datos en el formato que espera Chart.js
            $labels = array_keys($typeCounts); // Nombres de los tipos (ej: 'fire', 'water')
            $data = array_values($typeCounts); // Cantidades de cada tipo (ej: 10, 15)

            // Devolver los datos como JSON
            return response()->json([
                'labels' => $labels,
                'data' => $data,
            ]);

        } catch (\Exception $e) {
            // Capturar cualquier otra excepción y loguearla
            \Log::error('Error general en PokemonChartController: ' . $e->getMessage());
            return response()->json(['error' => 'Ocurrió un error inesperado al procesar los datos.'], 500);
        }
    }
}