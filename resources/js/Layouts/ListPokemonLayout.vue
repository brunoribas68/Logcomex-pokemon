<template>
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-2 xl:grid-cols-3 gap-8">
        <div class="bg-white rounded-lg overflow-hidden shadow-md hover:shadow-lg transition-shadow duration-300" v-for="(pokemon, index) in pokemons" :key="index">
            <img :src="pokemon.image" alt="Imagem do Pokémon" class="w-full h-64 object-cover"/>
            <div class="px-6 py-4">
                <h2 class="text-xl font-semibold text-indigo-600 mb-2">{{ pokemon.name }}</h2>
                <button
                    class="w-full bg-indigo-600 text-white font-bold py-2 px-4 rounded-lg hover:bg-indigo-700 transition-colors duration-300"
                    @click="toggleDetails(index)">
                    Detalhes
                </button>
                <div v-if="showDetails[index]" class="mt-4">
                    <h3 class="text-lg font-semibold text-gray-800">Tipo:</h3>
                    <ul class="list-disc list-inside text-gray-600">
                        <li v-for="(typePokemon, idx) in pokemon.type" :key="idx">
                            {{ typePokemon.type.name }}
                        </li>
                    </ul>
                    <h3 class="text-lg font-semibold text-gray-800 mt-2">Altura:</h3>
                    <p class="text-gray-600">{{ pokemon.height }} m</p>
                    <h3 class="text-lg font-semibold text-gray-800 mt-2">Peso:</h3>
                    <p class="text-gray-600">{{ pokemon.weight }} kg</p>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: ['pokemons'],
    data() {
        return {
            showDetails: []
        };
    },
    methods: {
        toggleDetails(index) {
            // Alterna o estado de exibição dos detalhes
            this.showDetails[index] = !this.showDetails[index];
        }
    },
    mounted() {
        // Inicializa o array showDetails com 'false' para ocultar detalhes por padrão
        this.showDetails = Array(this.pokemons.length).fill(false);
    }
};
</script>
