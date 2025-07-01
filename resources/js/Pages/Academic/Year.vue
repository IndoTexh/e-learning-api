<script setup>
import { router, useForm, usePage } from '@inertiajs/vue3';
import { computed, ref } from 'vue';
import DialogConfirm from '../Components/DialogConfirm.vue';
import { toast } from 'vue3-toastify';

const status = computed(() => usePage().props.flash.status);
const showDeleteModal = ref(false);
const show = ref(false);
const deleteId = ref(null);

const closeDeleteModal = () => {
  showDeleteModal.value = false;
  deleteId.value = null;
}
const openDeleteModal = (id) => {
  showDeleteModal.value = true;
  deleteId.value = id;
};
const props = defineProps({
  academic_years: Object
});
const form = useForm({
  academic_year: "",
});
const confirmDelete = () => {
  router.delete(route('destroy', deleteId.value));
  closeDeleteModal();
  toast.warning(status, {
    autoClose: 3000
  });
};
const submit = () => {
  form.post(route('acacdemic_year'), {
    onFinish: () => form.academic_year = ""
  });
  toast.success(status, {
    autoClose: 3000
  });
};
</script>

<template>
  <div class="w-full mt-25 pb-[100px]">
    <div class="flex items-center gap-5 fixed ">
      <p class="text-gray-400 font-medium text-2xl">Academic Year</p>

      <button v-if="!show" @click="show = !show"
        class="border border-sky-500 text-sky-500 px-4 py-1 rounded-lg flex items-center gap-2 hover:cursor-pointer hover:bg-sky-500 hover:text-white">
        <i class="fa-solid fa-plus"></i>
        <span class="font-medium">New</span>
      </button>

      <button v-if="show" @click="show = false"
        class="border border-sky-500 text-sky-500 px-4 py-1 rounded-lg flex items-center gap-2 hover:cursor-pointer hover:bg-sky-500 hover:text-white">
        <i class="fa-solid fa-arrow-left"></i>
        <span class="font-medium">Back</span>
      </button>
    </div>

    <div v-if="show" class="max-w-4xl mx-auto mt-10">
      <div class="bg-white rounded-xl shadow p-4">
        <div class="flex justify-between items-center border-b border-sky-500 pb-2">
          <h2 class="text-lg font-medium text-sky-500">Academic Year</h2>
        </div>
        <form class="mt-4 space-x-4" @submit.prevent="submit">
          <input type="text" placeholder="Ex: 2025-2026" v-model="form.academic_year"
            class="bg-gray-200 rounded-lg w-full h-12 px-4 focus:outline-none focus:ring-2 focus:ring-sky-400" />
          <p v-if="form.errors.academic_year" class="text-sm text-red-500 mt-1">
            {{ form.errors.academic_year }}
          </p>
          <button :disabled="form.processing"
            class="bg-sky-500 disabled:bg-sky-300 disabled:cursor-wait text-white px-2 py-2 rounded-lg mt-2 w-1/5">Create</button>
        </form>
      </div>
    </div>

    <div v-if="!show"
      class="max-w-4xl mx-auto mt-5 bg-white shadow-lg px-4 py-2 rounded-2xl flex items-center justify-between hover:border hover:border-sky-500"
      v-for="academic_year in props.academic_years" :key="academic_year.id">
      <div>
        <p class="text-gray-400 font-medium">Created by</p>
        <p class="text-sm text-sky-500 font-medium">{{ academic_year.created_by }}</p>
      </div>
      <div>
        <p class="text-gray-400 font-medium">Academic Year</p>
        <p class="text-sm text-sky-500 font-medium">{{ academic_year.academic_year }}</p>
      </div>
      <div class="flex items-center gap-5">
        <button class="bg-sky-500 text-white text-sm font-medium px-4 py-1 rounded-lg cursor-pointer">
          <i class="fa-solid fa-pen-to-square"></i>
          Edit
        </button>
        <button @click="openDeleteModal(academic_year.id)"
          class="bg-red-500 text-white text-sm font-medium px-4 py-1 rounded-lg cursor-pointer">
          <i class="fa-solid fa-trash"></i>
          Delete
        </button>
      </div>
    </div>

    <DialogConfirm :showDeleteModal="showDeleteModal" title="Confirm Deletetion"
      message="Are you sure you want to delete this academic year?" @cancel="closeDeleteModal" @confirm="confirmDelete">
    </DialogConfirm>
  </div>

</template>