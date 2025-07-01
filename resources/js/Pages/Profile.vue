<script setup>
import { useForm, usePage } from '@inertiajs/vue3';
import { computed, ref } from 'vue';
import { toast } from 'vue3-toastify';

const status = computed(() => usePage().props.flash.status);
const page = usePage();
const user = computed(() => page.props.auth.user);

const preview = ref(null);
const fileInput = ref(null);

const form = useForm({
  profile: null
});

const formatDate = (dateStr) => {
  const date = new Date(dateStr);
  return date.toLocaleDateString('en-US', {
    year: 'numeric',
    month: 'long',
    day: 'numeric'
  });
};

const handleFileChange = (e) => {
  const file = e.target.files[0];
  if (!file) return;

  form.profile = file;

  const reader = new FileReader();
  reader.onload = () => {
    preview.value = reader.result;
  };
  reader.readAsDataURL(file);
};

const triggerFileSelect = () => {
  fileInput.value.click();
};

const submit = () => {
  form.post(route('profile'), {
    preserveScroll: true,
    onFinish: () => {
      toast.success(status.value, {
        autoClose: 3000
      });
      form.profile = null;
    }
  });
};

const removePreview = () => {
  form.profile = null;
  preview.value = null;
  fileInput.value.value = '';
}
</script>

<template>
  <div class="py-12 mt-20">
    <div class="bg-white rounded-2xl shadow-lg p-8 max-w-md w-full mx-auto">
      <div class="flex flex-col items-center">
        <div class="relative group cursor-pointer">

          <img v-if="preview" :src="preview" alt="Profile" class="w-24 h-24 rounded-full object-cover shadow-md" />
          <img v-else :src="user.profile ? `/storage/${user.profile}` : '/storage/profile/default.png'" alt="Profile"
            class="w-24 h-24 rounded-full object-cover shadow-md" />

          <div
            class="absolute inset-0 bg-black/40 bg-opacity-50 rounded-full flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity"
            @click="triggerFileSelect">
            <i class="fa-solid fa-camera text-white text-xl"></i>
          </div>

          <input ref="fileInput" type="file" accept="image/*" @change="handleFileChange" class="hidden" />
        </div>

        <h2 class="mt-4 text-2xl font-semibold text-sky-600">{{ user.name }}</h2>

        <hr class="w-full my-6 border-t border-gray-300" />

        <div class="w-full text-center">
          <p class="text-gray-600 font-medium">Joined on</p>
          <p class="text-sky-500 font-semibold">{{ formatDate(user.created_at) }}</p>
        </div>

        <hr class="w-full my-6 border-t border-gray-300" />


        <form v-if="form.profile" @submit.prevent="submit" class="flex items-center space-x-2">
          <button :disabled="form.processing"
            class="disabled:bg-sky-300 disabled:cursor-wait bg-sky-500 px-4 py-2 rounded-md text-sm font-semibold text-white hover:bg-sky-600">
            Save Profile
          </button>
          <button type="button" @click="removePreview"
            class="bg-red-500 px-4 py-2 rounded-md text-sm font-semibold text-white hover:bg-red-600">
            Remove Preview
          </button>
        </form>
      </div>
    </div>
  </div>
</template>
