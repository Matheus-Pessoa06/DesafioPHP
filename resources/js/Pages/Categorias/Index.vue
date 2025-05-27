<template>
  <div class="max-w-4xl mx-auto p-6">
    <h1 class="text-2xl font-bold mb-6">Categorias</h1>

    <div v-if="categorias.length" class="space-y-4">
      <div
        v-for="categoria in categorias"
        :key="categoria.id"
        class="flex justify-between items-center p-4 border rounded shadow-sm"
      >
        <span class="text-lg">{{ categoria.nome }}</span>
        <div class="space-x-2">
          <Link
            :href="`/categorias/${categoria.id}/edit`"
            class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded"
          >
            Editar
          </Link>
          <button
            @click="deletar(categoria.id)"
            class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded"
          >
            Excluir
          </button>
        </div>
      </div>
    </div>

    <div v-else class="text-gray-500">Nenhuma categoria cadastrada.</div>
  </div>
</template>

<script setup>
import { router } from '@inertiajs/vue3'
import { Link } from '@inertiajs/vue3'
import AppLayout from '@/Layouts/AppLayout.vue'

defineOptions({
  layout: AppLayout,
})

defineProps({ 
  categorias: Array,   
})

function deletar(id) {
  if (confirm('Tem certeza que deseja excluir esta categoria?')) {
    router.delete(`/categorias/${id}`)
  }
}
</script>
