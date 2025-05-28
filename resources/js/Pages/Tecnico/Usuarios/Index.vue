<template>
  <div class="max-w-6xl mx-auto p-6">
    <h1 class="text-2xl font-bold text-gray-800 mb-6">Controle de Usuários</h1>

    <div v-if="!users.length" class="text-center text-gray-500 py-10">
      Nenhum usuário cadastrado.
    </div>

    <table v-else class="min-w-full bg-white border border-gray-200 rounded shadow">
      <thead>
        <tr class="bg-gray-100 text-left text-gray-600 uppercase text-sm">
          <th class="py-3 px-6 border-b border-gray-300">Nome</th>
          <th class="py-3 px-6 border-b border-gray-300">Email</th>
          <th class="py-3 px-6 border-b border-gray-300">Perfil</th>
          <th class="py-3 px-6 border-b border-gray-300">Status</th>
          <th class="py-3 px-6 border-b border-gray-300 text-center">Ações</th>
        </tr>
      </thead>
      <tbody>
        <tr
          v-for="user in users"
          :key="user.id"
          class="border-b border-gray-200 hover:bg-gray-50"
        >
          <td class="py-4 px-6 text-gray-800 font-medium">{{ user.name }}</td>
          <td class="py-4 px-6 text-gray-600">{{ user.email }}</td>
          <td class="py-4 px-6 capitalize">{{ user.role }}</td>
          <td class="py-4 px-6">
            <span
              :class="user.active ? 'text-green-600 font-semibold' : 'text-red-600 font-semibold'"
            >
              {{ user.active ? 'Ativo' : 'Inativo' }}
            </span>
          </td>
          <td class="py-4 px-6 text-center space-x-2">
            <!-- Altera Status -->
            <button
              @click="toggleActive(user)"
              class="text-sm px-3 py-1 rounded border transition
                     hover:bg-gray-100
                     "
            >
              {{ user.active ? 'Desativar' : 'Ativar' }}
            </button>

            <!-- Alterna perfil -->
            <button
              @click="toggleRole(user)"
              class="text-sm px-3 py-1 rounded border transition hover:bg-gray-100"
            >
              {{ user.role === 'tecnico' ? 'Rebaixar' : 'Promover' }}
            </button>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script setup>
import { computed  } from 'vue'
import { usePage, router } from '@inertiajs/vue3';
import AppLayout from '@/Layouts/AppLayout.vue'

defineOptions({
  layout: AppLayout,
})

const users = computed(() => usePage().props.users);

function toggleActive(user) {
  router.patch(`/tecnico/usuarios/${user.id}/toggle-active`, {}, {
    onSuccess: () => {
      user.active = !user.active
    },
  })
}

function toggleRole(user) {
  router.patch(`/tecnico/usuarios/${user.id}/toggle-role`, {}, {
    onSuccess: () => {
      user.role = user.role === 'tecnico' ? 'colaborador' : 'tecnico'
    },
  })
}
</script>
