<template>
  <div class="max-w-5xl mx-auto p-6">
    <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6 gap-4">
      <h1 class="text-2xl font-bold text-gray-800">Meus Chamados</h1>

      <div class="flex gap-3 items-center">
        <Link href="/chamados/create">
          <PrimaryButton>
            Novo Chamado
          </PrimaryButton>
        </Link>

        <Link href="/categorias/create">
          <PrimaryButton>
            Nova Categoria
          </PrimaryButton>
        </Link>

        <PrimaryButton
          class="bg-red-600 hover:bg-red-700"
          @click="exportPdf"
        >
          📄 PDF
        </PrimaryButton>

        <PrimaryButton
          class="bg-green-600 hover:bg-green-700"
          @click="exportExcel"
        >
          📥 Excel
        </PrimaryButton>
      </div>

      <div class="flex gap-4">
        <select
          v-model="filters.status"
          @change="applyFilters"
          class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm px-3 py-2"
        >
          <option value="">Todos os Status</option>
          <option>Aberto</option>
          <option>Em atendimento</option>
          <option>Resolvido</option>
          <option>Fechado</option>
        </select>

        <select
          v-model="filters.prioridade"
          @change="applyFilters"
          class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm px-3 py-2"
        >
          <option value="">Todas as Prioridades</option>
          <option>Baixa</option>
          <option>Média</option>
          <option>Alta</option>
        </select>
      </div>
    </div>

    <div v-if="showMessage" class="mb-4 p-4 bg-green-100 text-green-700 rounded shadow">
      {{ showMessage }}
    </div>

    <div v-if="chamados.length === 0" class="text-gray-500 text-center py-10">
      Nenhum chamado encontrado com os filtros aplicados.
    </div>

    <div
      v-else
      class="grid gap-4"
    >
      <div
        v-for="chamado in chamados"
        :key="chamado.id"
        class="bg-white shadow rounded p-4 border border-gray-100 hover:shadow-md transition"
      >
        <div class="flex justify-between items-center">
          <div>
            <h2 class="text-lg font-semibold text-gray-800">{{ chamado.titulo }}</h2>
            <p class="text-sm text-gray-500">
              Categoria: {{ chamado.categoria }} | Prioridade: {{ chamado.prioridade }}
            </p>
            <p class="text-sm font-medium mt-1">
              Status: <span class="text-blue-600">{{ chamado.status }}</span>
            </p>
          </div>
          <Link
            :href="`/chamados/${chamado.id}`"
            class="text-sm bg-blue-100 text-blue-700 hover:bg-blue-200 px-3 py-1 rounded font-medium transition"
          >
            Visualizar
          </Link>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import { Link, usePage, router } from '@inertiajs/vue3'
import AppLayout from '@/Layouts/AppLayout.vue'
import PrimaryButton from '@/Components/PrimaryButton.vue'

defineOptions({
  layout: AppLayout,
})

const props = defineProps({
  chamados: Array,
  filters: Object,
})

const page = usePage()
const showMessage = ref(page.props.flash.success)

const filters = ref({
  status: props.filters?.status ?? '',
  prioridade: props.filters?.prioridade ?? '',
})

function applyFilters() {
  router.get(
    '/chamados',
    {
      status: filters.value.status,
      prioridade: filters.value.prioridade,
    },
    { preserveState: true }
  )
}

const exportPdf = () => {
  const params = new URLSearchParams({
    status: filters.value.status,
    prioridade: filters.value.prioridade,
  })
  window.open(`/export/pdf?${params.toString()}`, '_blank');
}

const exportExcel = () => {
  const params = new URLSearchParams({
    status: filters.value.status,
    prioridade: filters.value.prioridade,
  })
  window.open(`/export/excel?${params.toString()}`, '_blank');
}

onMounted(() => {
  if (showMessage.value) {
    setTimeout(() => {
      showMessage.value = false
    }, 3000)
  }
})
</script>
