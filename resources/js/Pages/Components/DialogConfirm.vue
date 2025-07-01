<script setup>
defineProps({
  showDeleteModal: Boolean,
  title: String,
  message: String
});
defineEmits(['confirm', 'cancel']);
</script>

<template>
  <div v-if="showDeleteModal" class="fixed inset-0 bg-black/50 bg-opacity-50 flex items-center justify-center z-50">
    <div class="bg-white rounded-xl p-6 w-full max-w-md shadow-lg">
      <h2 class="text-xl font-semibold text-gray-700 mb-4">{{ title }}</h2>
      <p class="text-sm text-gray-600 mb-6">{{ message }}</p>
      <div class="flex justify-end space-x-4">
        <button @click="$emit('cancel')" class="bg-gray-200 text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-300">
          Cancel
        </button>
        <button @click="$emit('confirm')"
          class="bg-red-500 text-white text-sm font-medium px-4 py-1 rounded-lg cursor-pointer">
          <i class="fa-solid fa-trash"></i>
          Delete
        </button>
      </div>
    </div>
  </div>
</template>