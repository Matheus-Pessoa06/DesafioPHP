<template>
  <div class="max-w-5xl mx-auto p-6">
    <div class="flex justify-between items-center mb-6">
      <h1 class="text-2xl font-bold text-gray-800">Meus Chamados</h1>

      <div class="flex gap-3 items-center">
        <Link href="/chamados/create" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded shadow">
          Novo Chamado
        </Link>

        <Link href="/categorias/create" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded shadow">
          Nova Categoria
        </Link>
      </div>
    </div>

    <div v-if="showMessage" class="mb-4 p-4 bg-green-100 text-green-700 rounded shadow">
      {{ showMessage }}
    </div>

    <div v-if="chamados.length === 0" class="text-gray-500 text-center py-10">
      Nenhum chamado encontrado.
    </div>

    <div v-else class="grid gap-4">
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

defineOptions({
  layout: AppLayout,
})

defineProps({ chamados: Array })

const page = usePage()
const showMessage = ref(page.props.flash.success)

onMounted(() => {
  if (showMessage.value) {
    setTimeout(() => {
      showMessage.value = false
    }, 3000)
  }
})
</script>
