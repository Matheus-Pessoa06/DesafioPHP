<template>
  <div class="max-w-xl mx-auto p-6">
    <div class="flex justify-between items-center mb-4">
      <h1 class="text-xl font-bold">Nova Categoria</h1>
      <Link
        href="/chamados"
        class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded shadow"
      >
        Chamados
      </Link>
    </div>

    <form @submit.prevent="submit" class="space-y-4">
      <div>
        <label class="block mb-1 font-medium">Nome</label>
        <input
          v-model="form.nome"
          type="text"
          class="w-full border border-gray-300 p-2 rounded"
        />
        <div v-if="form.errors.nome" class="text-red-600 text-sm mt-1">
          {{ form.errors.nome }}
        </div>
      </div>

      <button
        :disabled="form.processing"
        class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded shadow disabled:opacity-50"
      >
        Salvar
      </button>
    </form>
  </div>
</template>

<script setup>
import { useForm, Link } from '@inertiajs/vue3'
import AppLayout from '@/Layouts/AppLayout.vue'

defineOptions({
  layout: AppLayout,
})

const form = useForm({ nome: '' })

function submit() {
  form.post('/categorias')
}
</script>
