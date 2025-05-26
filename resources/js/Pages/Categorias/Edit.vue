<template>
  <div class="max-w-xl mx-auto p-6">
    <h1 class="text-xl font-bold mb-4">Editar Categoria</h1>

    <form @submit.prevent="submit" class="space-y-4">
      <div>
        <label class="block mb-1 font-medium">Nome</label>
        <input v-model="form.nome" type="text" class="w-full border p-2 rounded" />
        <div v-if="form.errors.nome" class="text-red-600 text-sm mt-1">{{ form.errors.nome }}</div>
      </div>

      <button :disabled="form.processing" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded">
        Atualizar
      </button>
    </form>
  </div>
</template>

<script setup>
import { useForm } from '@inertiajs/vue3'

const props = defineProps({ categoria: Object })

const form = useForm({ nome: props.categoria.nome })

function submit() {
  form.put(`/categorias/${props.categoria.id}`)
}
</script>
