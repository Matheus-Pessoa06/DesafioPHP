<template>
  <div class="max-w-xl mx-auto p-6">
    <h1 class="text-xl font-bold mb-4">Editar Categoria</h1>

    <Link href="/chamados/create" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded shadow">
        Novo Chamado
    </Link>

    <form @submit.prevent="submit" class="space-y-4">
      <div>
        <InputLabel for="nome" value="Nome" />
        <TextInput id="nome" v-model="form.nome" type="text" class="mt-1 block w-full" />
        <div v-if="form.errors.nome" class="text-red-600 text-sm mt-1">{{ form.errors.nome }}</div>
      </div>

      <button :disabled="form.processing" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded">
        Atualizar
      </button>
    </form>
  </div>
</template>

<script setup>
import { useForm } from '@inertiajs/vue3'
import AppLayout from '@/Layouts/AppLayout.vue'
import InputLabel from '@/Components/InputLabel.vue'; 
import TextInput from '@/Components/TextInput.vue';

defineOptions({
  layout: AppLayout,
})

const props = defineProps({ categoria: Object })

const form = useForm({ nome: props.categoria.nome })

function submit() {
  form.put(`/categorias/${props.categoria.id}`)
}
</script>