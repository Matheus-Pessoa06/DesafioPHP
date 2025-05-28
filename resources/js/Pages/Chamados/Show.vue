<template>
  <div class="max-w-4xl mx-auto mt-10 p-6 bg-white rounded-2xl shadow-md">
    <SectionTitle>
      <template #title>
        Detalhes do Chamado
      </template>
      </SectionTitle>

    <div class="space-y-4 mt-6"> <p><strong>Categoria:</strong> {{ chamado.categoria }}</p>
      <p><strong>Descrição:</strong> {{ chamado.descricao }}</p>
      <p><strong>Status:</strong> {{ chamado.status }}</p>
      <p><strong>Responsável:</strong> {{ chamado.responsavel }}</p>
      <p><strong>Criado em:</strong> {{ chamado.created_at }}</p>
      <p><strong>Atualizado em:</strong> {{ chamado.updated_at }}</p>
    </div>

    <Link
      href="/chamados"
      class="mt-6 inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150"
    >
      ← Voltar
    </Link>
  </div>
</template>

<script setup>
import { Link } from '@inertiajs/vue3'
import AppLayout from '@/Layouts/AppLayout.vue'
import SectionTitle from '@/Components/SectionTitle.vue'; // Ajuste o caminho

defineOptions({
  layout: AppLayout,
})

const props = defineProps({
  chamado: Object
})
</script>