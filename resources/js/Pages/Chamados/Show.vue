<template>
  <div class="max-w-4xl mx-auto mt-10 p-6 bg-white rounded-2xl shadow-md">
    <h1 class="text-2xl font-bold mb-4">Detalhes do Chamado</h1>

    <div class="space-y-4">
      <p><strong>Categoria:</strong> {{ chamado.categoria }}</p>
      <p><strong>Descrição:</strong> {{ chamado.descricao }}</p>
      <p><strong>Status:</strong> {{ chamado.status }}</p>
      <p><strong>Responsável:</strong> {{ chamado.responsavel }}</p>
      <p><strong>Criado em:</strong> {{ chamado.created_at }}</p>
      <p><strong>Atualizado em:</strong> {{ chamado.updated_at }}</p>
    </div>

    <Link href="/chamados" class="mt-6 inline-block text-blue-600 hover:underline">← Voltar</Link>
  </div>
</template>

<script setup>
import { Link } from '@inertiajs/vue3'

const props = defineProps({
  chamado: Object
})

</script>
