<template>
  <div class="max-w-4xl mx-auto p-6">
    <h1 class="text-2xl font-bold mb-6">Categorias</h1>

    <div v-if="categorias.length" class="space-y-4">
      <div
        v-for="categoria in categorias"
        :key="categoria.id"
        class="flex justify-between items-center p-4 border rounded shadow-sm"
      >
        <span class="text-lg">{{ categoria.nome }}</span>
        <div class="space-x-2">
          <Link
            :href="`/categorias/${categoria.id}/edit`"
            class="inline-flex items-center px-3 py-1 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150"
          >
            Editar
          </Link>
          <DangerButton @click="confirmarDelecao(categoria.id)">
            Excluir
          </DangerButton>
        </div>
      </div>
    </div>

    <div v-else class="text-gray-500">Nenhuma categoria cadastrada.</div>

    <ConfirmationModal :show="showingConfirmationModal" @close="closeConfirmationModal">
      <template #title>
        Excluir Categoria
      </template>
      <template #content>
        Tem certeza de que deseja excluir esta categoria? Esta ação não pode ser desfeita.
      </template>
      <template #footer>
        <SecondaryButton @click="closeConfirmationModal">
          Cancelar
        </SecondaryButton>
        <DangerButton class="ms-3" @click="executarDelecao">
          Confirmar Exclusão
        </DangerButton>
      </template>
    </ConfirmationModal>
  </div>
</template>

<script setup>
import { ref } from 'vue';
import { router, Link } from '@inertiajs/vue3'
import AppLayout from '@/Layouts/AppLayout.vue'
import DangerButton from '@/Components/DangerButton.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue'; 
import ConfirmationModal from '@/Components/ConfirmationModal.vue';

defineOptions({
  layout: AppLayout,
})

defineProps({
  categorias: Array,
})

const showingConfirmationModal = ref(false);
const categoriaToDeleteId = ref(null);

const confirmarDelecao = (id) => {
  categoriaToDeleteId.value = id;
  showingConfirmationModal.value = true;
};

const closeConfirmationModal = () => {
  showingConfirmationModal.value = false;
  categoriaToDeleteId.value = null;
};

const executarDelecao = () => {
  if (categoriaToDeleteId.value) {
    router.delete(`/categorias/${categoriaToDeleteId.value}`, {
      onSuccess: () => closeConfirmationModal(),
      onError: () => closeConfirmationModal(),
    });
  }
};
</script>