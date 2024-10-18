<script>
import { Head, Link } from '@inertiajs/vue3';
import InputLabel from "@/Components/InputLabel.vue";
import TextInput from "@/Components/TextInput.vue";
import ListPokemonLayout from "@/Layouts/ListPokemonLayout.vue";
import axios from "axios";

export default {
    components: { ListPokemonLayout, InputLabel, TextInput },
    data() {
        return {
            pokemons: [],
            name: '',
        };
    },
    created() {
        this.fetchPokemons();
    },
    methods: {
        async fetchPokemons() {
            try {
                const response = await axios.get('/pokemons');  // Fetch para pegar todos os Pokémon
                this.pokemons = response.data;
            } catch (error) {
                console.error('Erro ao buscar Pokémon:', error);
            }
        },
        async getPokemonByName() {
            try {
                const response = await axios.get('/pokemon/' + this.name);
                this.pokemons = response.data;
            } catch (error) {
                console.error('Erro ao buscar Pokémon:', error);
            }
        }
    }
};
</script>

<template>
    <div id="listPokemons" class="flex flex-col items-center justify-center min-h-screen bg-gray-100">
        <div class="w-full bg-white rounded-lg shadow-lg">
            <InputLabel class="text-center text-xl font-semibold text-indigo-600 mb-4">
                Nome do Pokémon
            </InputLabel>
            <input
                v-model="name"
                @input="getPokemonByName"
                id="name"
                placeholder="Digite o nome do Pokémon..."
                class="w-full px-4 py-2 mb-4 border border-indigo-500 rounded-lg shadow-md focus:outline-none focus:ring-2 focus:ring-indigo-400 focus:border-transparent transition duration-300"
            />
            <ListPokemonLayout :pokemons="pokemons" class="w-full"/>
        </div>
    </div>
</template>
