<template>
  <div class="max-w-6xl mx-auto p-6">
    <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6 gap-4">
      <h1 class="text-2xl font-bold text-gray-800">Chamados Técnicos</h1>
        <Link
          href="/tecnico/usuarios"
        >
          <PrimaryButton>
            Controle de Usuários
          </PrimaryButton>
        </Link>
      <div class="flex gap-4">
        <select v-model="filters.status" @change="applyFilters" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm px-3 py-2">
          <option value="">Todos os Status</option>
          <option>Aberto</option>
          <option>Em atendimento</option>
          <option>Resolvido</option>
          <option>Fechado</option>
        </select>

        <select v-model="filters.prioridade" @change="applyFilters" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm px-3 py-2">
          <option value="">Todas as Prioridades</option>
          <option>Baixa</option>
          <option>Média</option>
          <option>Alta</option>
        </select>
      </div>
    </div>

    <div v-if="chamados.length === 0" class="text-center text-gray-500 py-10">
      Nenhum chamado encontrado com os filtros aplicados.
    </div>

    <div v-else class="space-y-4">
      <div
        v-for="chamado in chamados"
        :key="chamado.id"
        class="bg-white border border-gray-100 p-4 rounded shadow hover:shadow-md transition"
      >
        <div class="flex justify-between items-center">
          <div>
            <h2 class="text-lg font-semibold text-gray-800">{{ chamado.titulo }}</h2>
            <p class="text-sm text-gray-500 mt-1">
              Categoria: {{ chamado.categoria }} | Prioridade: {{ chamado.prioridade }}
            </p>
            <p class="text-sm font-medium mt-1">Status: <span class="text-blue-600">{{ chamado.status }}</span></p>
          </div>
          <Link
            :href="`/tecnico/chamados/${chamado.id}`"
            class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150"
          >
            Ver Detalhes
          </Link>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { router, Link } from '@inertiajs/vue3'
import { ref } from 'vue';
import AppLayout from '@/Layouts/AppLayout.vue'
import PrimaryButton from '@/Components/PrimaryButton.vue';

defineOptions({
  layout: AppLayout,
})

const props = defineProps({
  chamados: Array,
  filters: Object,
})

const filters = ref({
  status: props.filters?.status ?? '',
  prioridade: props.filters?.prioridade ?? '',
})

function applyFilters() {
 router.get('/tecnico/chamados', {
  status: filters.value.status,
  prioridade: filters.value.prioridade,
 }, { preserveState: true })
}
</script>