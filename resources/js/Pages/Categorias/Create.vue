<template>
  <div class="max-w-xl mx-auto p-6">
    <div class="flex justify-between items-center mb-4">
      <h1 class="text-xl font-bold">Nova Categoria</h1>
      <Link
        href="/chamados"
        class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150"
      >
        Chamados
      </Link>
    </div>

    <form @submit.prevent="submit" class="space-y-4">
      <div>
        <InputLabel for="nome" value="Nome" />
        <TextInput id="nome" v-model="form.nome" type="text" class="mt-1 block w-full" />
        <InputError :message="form.errors.nome" class="mt-2" />
      </div>

      <PrimaryButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
        Salvar
      </PrimaryButton>
    </form>
  </div>
</template>

<script setup>
import { useForm, Link } from '@inertiajs/vue3'
import AppLayout from '@/Layouts/AppLayout.vue'
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import InputError from '@/Components/InputError.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';

defineOptions({
  layout: AppLayout,
})

const form = useForm({ nome: '' })

function submit() {
  form.post('/categorias')
}
</script>