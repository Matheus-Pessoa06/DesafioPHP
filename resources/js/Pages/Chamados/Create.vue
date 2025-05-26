<template>
  <div class="max-w-3xl mx-auto p-6 bg-white rounded shadow">
    <h1 class="text-2xl font-bold text-gray-800 mb-6">Abrir Novo Chamado</h1>

    <form @submit.prevent="submit" class="space-y-5">
      <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Título</label>
        <input v-model="form.titulo" class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" />
        <p v-if="form.errors.titulo" class="text-red-500 text-sm mt-1">{{ form.errors.titulo }}</p>
      </div>

      <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Descrição</label>
        <textarea v-model="form.descricao" rows="4" class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" />
        <p v-if="form.errors.descricao" class="text-red-500 text-sm mt-1">{{ form.errors.descricao }}</p>
      </div>

      <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Responsavel</label>
        <input v-model="form.responsavel" class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" />
        <p v-if="form.errors.responsavel" class="text-red-500 text-sm mt-1">{{ form.errors.responsavel }}</p>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">Categoria</label>
          <select v-model="form.categoria" class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
            <option disabled value="">Selecione uma categoria</option>
            <option v-for="categoria in categorias" :key="categoria.id" :value="categoria.nome">
              {{ categoria.nome }}
            </option>
          </select>

          <p v-if="form.errors.categoria" class="text-red-500 text-sm mt-1">{{ form.errors.categoria }}</p>
        </div>

        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">Prioridade</label>
          <select v-model="form.prioridade" class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
            <option>Baixa</option>
            <option>Média</option>
            <option>Alta</option>
          </select>
          <p v-if="form.errors.prioridade" class="text-red-500 text-sm mt-1">{{ form.errors.prioridade }}</p>
        </div>
      </div>

      <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Anexo (opcional)</label>
        <input type="file" @change="handleFile" class="w-full border rounded px-3 py-2" />
        <p v-if="form.errors.anexo" class="text-red-500 text-sm mt-1">{{ form.errors.anexo }}</p>
      </div>

      <div class="flex justify-end">
        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded shadow">
          Salvar Chamado
        </button>
      </div>
    </form>
  </div>
</template>

<script setup>
import { useForm } from '@inertiajs/vue3'

const { categorias } = defineProps(['categorias'])

const form = useForm({
  titulo: '',
  descricao: '',
  responsavel: '',
  categoria: '',
  prioridade: 'Média',
  anexo: null,
})

function handleFile(e) {
  form.anexo = e.target.files[0]
}

function submit() {
  form.post('/chamados', {
    forceFormData: true,
  })
}
</script>