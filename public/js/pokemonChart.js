document.addEventListener('DOMContentLoaded', async function () {
    const ctx = document.getElementById('pokemonTypesChart').getContext('2d');
    let pokemonChart; // Variable para almacenar la instancia de nuestro gráfico

    // Función asíncrona para obtener los datos de la API y dibujar el gráfico
    async function fetchAndDrawChart() {
        try {
            // Hacemos una petición a nuestra propia API de Laravel
            // que a su vez se comunicará con la PokeAPI
            const response = await fetch('/api/pokemon-types-data');

            // Si la respuesta no es exitosa, lanzamos un error
            if (!response.ok) {
                const errorData = await response.json();
                throw new Error(errorData.error || 'Error desconocido al obtener datos de Pokémon.');
            }

            const data = await response.json(); // Convertimos la respuesta a JSON

            // Si ya existe un gráfico, lo destruimos antes de crear uno nuevo
            if (pokemonChart) {
                pokemonChart.destroy();
            }

            // Creamos una nueva instancia del gráfico de barras con Chart.js
            pokemonChart = new Chart(ctx, {
                type: 'bar', // El tipo de gráfico que queremos (barras)
                data: {
                    labels: data.labels, // Los nombres de los tipos de Pokémon (ej: 'fire', 'water')
                    datasets: [{
                        label: 'Cantidad de Pokémon por Tipo', // Etiqueta del conjunto de datos
                        data: data.data, // Los números de Pokémon para cada tipo
                        backgroundColor: [ // Colores de las barras
                            'rgba(255, 99, 132, 0.6)', // Rojo
                            'rgba(54, 162, 235, 0.6)', // Azul
                            'rgba(255, 206, 86, 0.6)', // Amarillo
                            'rgba(75, 192, 192, 0.6)', // Verde azulado
                            'rgba(153, 102, 255, 0.6)', // Morado
                            'rgba(255, 159, 64, 0.6)', // Naranja
                            'rgba(199, 199, 199, 0.6)', // Gris
                            'rgba(83, 102, 255, 0.6)',  // Azul índigo
                            'rgba(255, 99, 71, 0.6)',   // Rojo tomate
                            'rgba(60, 179, 113, 0.6)',  // Verde mar medio
                            'rgba(128, 0, 128, 0.6)',   // Púrpura oscuro
                            'rgba(255, 165, 0, 0.6)',   // Naranja oscuro
                            'rgba(0, 128, 0, 0.6)',     // Verde oscuro
                            'rgba(0, 0, 128, 0.6)',     // Azul marino
                            'rgba(128, 128, 0, 0.6)',   // Oliva
                            'rgba(0, 128, 128, 0.6)',   // Verde azulado oscuro
                            'rgba(128, 0, 0, 0.6)',     // Granate
                            'rgba(210, 105, 30, 0.6)',  // Chocolate
                        ],
                        borderColor: [ // Colores del borde de las barras
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)',
                            'rgba(255, 159, 64, 1)',
                            'rgba(199, 199, 199, 1)',
                            'rgba(83, 102, 255, 1)',
                            'rgba(255, 99, 71, 1)',
                            'rgba(60, 179, 113, 1)',
                            'rgba(128, 0, 128, 1)',
                            'rgba(255, 165, 0, 1)',
                            'rgba(0, 128, 0, 1)',
                            'rgba(0, 0, 128, 1)',
                            'rgba(128, 128, 0, 1)',
                            'rgba(0, 128, 128, 1)',
                            'rgba(128, 0, 0, 1)',
                            'rgba(210, 105, 30, 1)',
                        ],
                        borderWidth: 1 // Ancho del borde de las barras
                    }]
                },
                options: {
                    responsive: true, // El gráfico se adaptará al tamaño del contenedor
                    scales: {
                        y: {
                            beginAtZero: true, // El eje Y comienza en cero
                            title: {
                                display: true,
                                text: 'Cantidad de Pokémon' // Etiqueta del eje Y
                            }
                        },
                        x: {
                            title: {
                                display: true,
                                text: 'Tipo de Pokémon' // Etiqueta del eje X
                            }
                        }
                    },
                    plugins: {
                        legend: {
                            display: false // No mostrar la leyenda del conjunto de datos
                        },
                        title: {
                            display: true,
                            text: 'Distribución de Tipos de Pokémon' // Título del gráfico
                        }
                    }
                }
            });

        } catch (error) {
            console.error('Error al obtener los datos del gráfico:', error);
            alert('No se pudieron cargar los datos del gráfico. Por favor, intente de nuevo más tarde.');
        }
    }

    // Llamamos a la función para cargar y dibujar el gráfico cuando el DOM esté listo
    fetchAndDrawChart();
});