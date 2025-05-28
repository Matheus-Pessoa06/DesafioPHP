<template>
  <div class="max-w-6xl mx-auto p-6">
    <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6 gap-4">
      <h1 class="text-2xl font-bold text-gray-800">Chamados Técnicos</h1>

      <Link href="/tecnico/usuarios">
        <PrimaryButton>Controle de Usuários</PrimaryButton>
      </Link>

      <div class="flex gap-4">
        <!-- Filtro Status -->
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

        <!-- Filtro Prioridade -->
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

    <!-- Mensagem de Sucesso -->
    <div
      v-if="showMessage"
      class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded"
    >
      {{ showMessage }}
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

            <!-- Select para técnico alterar o status -->
            <p class="text-sm font-medium mt-1">
              Status:
              <select
                v-model="chamado.status"
                @change="(e) => updateStatus(chamado.id, e.target.value)"
                :disabled="loadingChamadoId === chamado.id"
                class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm px-2 py-1 ml-2"
              >
                <option value="Aberto">Aberto</option>
                <option value="Em atendimento">Em atendimento</option>
                <option value="Resolvido">Resolvido</option>
                <option value="Fechado">Fechado</option>
              </select>

              <!-- Spinner loading -->
              <span
                v-if="loadingChamadoId === chamado.id"
                class="ml-2 inline-block w-4 h-4 border-2 border-indigo-500 border-t-transparent rounded-full animate-spin"
              ></span>
            </p>
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
import { ref } from 'vue'
import AppLayout from '@/Layouts/AppLayout.vue'
import PrimaryButton from '@/Components/PrimaryButton.vue'

defineOptions({
  layout: AppLayout,
})

const props = defineProps({
  chamados: Array,
  filters: Object,
  auth: Object,
})

const filters = ref({
  status: props.filters?.status ?? '',
  prioridade: props.filters?.prioridade ?? '',
})

const showMessage = ref('')
const loadingChamadoId = ref(null)

function applyFilters() {
  router.get(
    '/tecnico/chamados',
    {
      status: filters.value.status,
      prioridade: filters.value.prioridade,
    },
    { preserveState: true }
  )
}

function updateStatus(chamadoId, novoStatus) {
  loadingChamadoId.value = chamadoId

  router
    .patch(`/tecnico/chamados/${chamadoId}/status`, { status: novoStatus }, {
      preserveScroll: true,
      onSuccess: () => {
        showMessage.value = 'Status atualizado com sucesso!'
        loadingChamadoId.value = null
        setTimeout(() => (showMessage.value = ''), 3000)
      },
      onError: () => {
        alert('Erro ao atualizar status. Tente novamente.')
        loadingChamadoId.value = null
      },
    })
}
</script>
