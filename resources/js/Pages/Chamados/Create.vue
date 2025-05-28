<template>
  <div class="max-w-3xl mx-auto p-6 bg-white rounded shadow">
    <h1 class="text-2xl font-bold text-gray-800 mb-6">Abrir Novo Chamado</h1>

    <form @submit.prevent="submit" class="space-y-5">
      <div>
        <InputLabel for="titulo" value="Título" />
        <TextInput id="titulo" v-model="form.titulo" type="text" class="mt-1 block w-full" />
        <InputError :message="form.errors.titulo" class="mt-2" />
      </div>

      <div>
        <InputLabel for="descricao" value="Descrição" />
        <textarea
          id="descricao"
          v-model="form.descricao"
          rows="4"
          class="w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1"
        />
        <InputError :message="form.errors.descricao" class="mt-2" />
      </div>

      <div>
        <InputLabel for="responsavel" value="Responsavel" />
        <TextInput id="responsavel" v-model="form.responsavel" type="text" class="mt-1 block w-full" />
        <InputError :message="form.errors.responsavel" class="mt-2" />
      </div>

      <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div>
          <InputLabel for="categoria" value="Categoria" />
          <select
            id="categoria"
            v-model="form.categoria"
            class="w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1"
          >
            <option disabled value="">Selecione uma categoria</option>
            <option v-for="categoria in categorias" :key="categoria.id" :value="categoria.nome">
              {{ categoria.nome }}
            </option>
          </select>
          <InputError :message="form.errors.categoria" class="mt-2" />
        </div>

        <div>
          <InputLabel for="prioridade" value="Prioridade" />
          <select
            id="prioridade"
            v-model="form.prioridade"
            class="w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1"
          >
            <option>Baixa</option>
            <option>Média</option>
            <option>Alta</option>
          </select>
          <InputError :message="form.errors.prioridade" class="mt-2" />
        </div>
      </div>

      <div>
        <InputLabel for="anexo" value="Anexo (opcional)" />
        <input
          id="anexo"
          type="file"
          @change="handleFile"
          class="w-full border rounded px-3 py-2 mt-1"
        />
        <InputError :message="form.errors.anexo" class="mt-2" />
      </div>

      <div class="flex items-center justify-end">
        <ActionMessage :on="form.recentlySuccessful" class="me-3">
          Chamado Salvo!
        </ActionMessage>

        <PrimaryButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
          Salvar Chamado
        </PrimaryButton>
      </div>
    </form>
  </div>
</template>

<script setup>
import { useForm } from '@inertiajs/vue3'
import AppLayout from '@/Layouts/AppLayout.vue'
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import InputError from '@/Components/InputError.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import ActionMessage from '@/Components/ActionMessage.vue'; // Ajuste o caminho

defineOptions({
  layout: AppLayout,
})

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
    preserveScroll: true,
    onSuccess: () => form.reset('anexo'), // Reseta todos os campos, exceto o anexo, se necessário. Ou apenas form.reset()
  })
}
</script>