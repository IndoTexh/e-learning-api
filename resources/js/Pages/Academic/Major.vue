<script setup>
import { useForm, usePage } from '@inertiajs/vue3';
import Echo from 'laravel-echo';
import { computed, onMounted, ref } from 'vue';
import { toast } from 'vue3-toastify';
import ProgressSpinner from 'primevue/progressspinner';


const status = computed(() => usePage().props.flash.status);
const fileInput = ref(null);
const isHasFile = ref(false);
const show = ref(false);


defineProps({
  majors: Object
});

const submit_major_form = () => {
  major_form.post(route('major.store'), {
    onFinish: () => {
      major_form.major_in_kh = null;
      major_form.major_in_en = null;
      major_form.tuition_fee_total = null;
      major_form.tuition_per_semster = null;
      major_form.no_of_semester = null;
      major_form.no_of_course = null;
      major_form.no_of_subject_per_semester = null;
      toast.success(status.value, {
        autoClose: 3000
      });
    }
  });
};

const major_form = useForm({
  major_in_kh: "",
  major_in_en: "",
  tuition_fee_total: null,
  tuition_per_semster: "",
  no_of_semester: null,
  no_of_course: null,
  no_of_subject_per_semester: null,
});


const import_form = useForm({
  excel_file: null
});

const submit_import = () => {
  import_form.post(route('major.import'), {
    onFinish: () => {
      import_form.reset();
      isHasFile.value = false;
      if (fileInput.value) {
        fileInput.value.value = null;
      }
      toast.info(status.value, {
        autoClose: 3000
      });
    }
  });
};

const handleFileChange = (e) => {
  const file = e.target.files[0];
  import_form.excel_file = file;
  isHasFile.value = true;
};

const triggerFileSelect = () => {
  fileInput.value.click();
};
</script>

<template>
  <div class="w-full mt-25 pb-[50px]">
    <div class="flex items-center gap-5 fixed ">
      <p class="text-gray-400 font-medium text-2xl">Academic Major</p>

      <button @click="triggerFileSelect"
        class="border border-sky-500 text-sky-500 px-4 py-1 rounded-lg flex items-center gap-2 hover:cursor-pointer hover:bg-sky-500 hover:text-white">
        <i class="fa-solid fa-file"></i>
        <span class="font-medium">Import Excel</span>
      </button>

      <input ref="fileInput" type="file" @change="handleFileChange" class="hidden">

      <form v-if="isHasFile" @submit.prevent="submit_import">
        <button :disabled="import_form.processing"
          class="disabled:bg-sky-300 disabled:cursor-wait disabled:text-white border border-sky-500 text-sky-500 px-4 py-1 rounded-lg flex items-center gap-2 hover:cursor-pointer hover:bg-sky-500 hover:text-white">
          <i class="fa-solid fa-cloud"></i>
          <span class="font-medium">Save Excel</span>
        </button>
      </form>

      <button v-if="!show" @click="show = !show"
        class="border border-sky-500 text-sky-500 px-4 py-1 rounded-lg flex items-center gap-2 hover:cursor-pointer hover:bg-sky-500 hover:text-white">
        <i class="fa-solid fa-plus"></i>
        <span class="font-medium">New</span>
      </button>


      <div v-if="import_form.processing"
        class="fixed inset-0 z-50 bg-black/30 bg-opacity-50 flex items-center justify-center">
        <div class="flex flex-col gap-2">
          <ProgressSpinner style="width: 50px; height: 50px" strokeWidth="8" fill="transparent" animationDuration=".5s"
            aria-label="Importing..." />
          <span class="text-white font-medium text-2xl">Importing...</span>
        </div>
      </div>

      <div v-if="major_form.processing"
        class="fixed inset-0 z-50 bg-black/30 bg-opacity-50 flex items-center justify-center">
        <div class="flex flex-col gap-2">
          <ProgressSpinner style="width: 50px; height: 50px" strokeWidth="8" fill="transparent" animationDuration=".5s"
            aria-label="Importing..." />
          <span class="text-white font-medium text-2xl">Submitting...</span>
        </div>
      </div>


      <button v-if="show" @click="show = false"
        class="border border-sky-500 text-sky-500 px-4 py-1 rounded-lg flex items-center gap-2 hover:cursor-pointer hover:bg-sky-500 hover:text-white">
        <i class="fa-solid fa-arrow-left"></i>
        <span class="font-medium">Back</span>
      </button>

    </div>
  </div>

  <div v-if="show" class="max-w-4xl mx-auto">
    <div class="bg-white rounded-xl shadow p-4">
      <div class="flex justify-between items-center border-b border-sky-500 pb-2">
        <h2 class="text-lg font-medium text-sky-500">Academic Major</h2>
      </div>
      <form class="mt-4 space-x-4 flex flex-col gap-2" @submit.prevent="submit_major_form">
        <div class="grid grid-cols-2 gap-2">
          <div>
            <input type="text" placeholder="Major in Khmer" v-model="major_form.major_in_kh"
              class="bg-gray-200 rounded-lg w-full h-12 px-4 focus:outline-none focus:ring-2 focus:ring-sky-400" />
            <p v-if="major_form.errors.major_in_kh" class="text-sm text-red-500 mt-1">
              {{ major_form.errors.major_in_kh }}
            </p>
          </div>
          <div>
            <input type="text" placeholder="Major in English" v-model="major_form.major_in_en"
              class="bg-gray-200 rounded-lg w-full h-12 px-4 focus:outline-none focus:ring-2 focus:ring-sky-400" />
            <p v-if="major_form.errors.major_in_en" class="text-sm text-red-500 mt-1">
              {{ major_form.errors.major_in_en }}
            </p>
          </div>

        </div>

        <div class="grid grid-cols-2 gap-2">
          <div>
            <input type="number" placeholder="Tuition Fees Total" v-model="major_form.tuition_fee_total"
              class="bg-gray-200 rounded-lg w-full h-12 px-4 focus:outline-none focus:ring-2 focus:ring-sky-400" />
            <p v-if="major_form.errors.tuition_fee_total" class="text-sm text-red-500 mt-1">
              {{ major_form.errors.tuition_fee_total }}
            </p>
          </div>
          <div>
            <input type="number" placeholder="Tutition Per Semester" v-model="major_form.tuition_per_semster"
              class="bg-gray-200 rounded-lg w-full h-12 px-4 focus:outline-none focus:ring-2 focus:ring-sky-400" />
            <p v-if="major_form.errors.tuition_per_semster" class="text-sm text-red-500 mt-1">
              {{ major_form.errors.tuition_per_semster }}
            </p>
          </div>
          <div>
            <input type="number" placeholder="No of Semester" v-model="major_form.no_of_semester"
              class="bg-gray-200 rounded-lg w-full h-12 px-4 focus:outline-none focus:ring-2 focus:ring-sky-400" />
            <p v-if="major_form.errors.no_of_semester" class="text-sm text-red-500 mt-1">
              {{ major_form.errors.no_of_semester }}
            </p>
          </div>
          <div>
            <input type="number" placeholder="No of Course" v-model="major_form.no_of_course"
              class="bg-gray-200 rounded-lg w-full h-12 px-4 focus:outline-none focus:ring-2 focus:ring-sky-400" />
            <p v-if="major_form.errors.no_of_course" class="text-sm text-red-500 mt-1">
              {{ major_form.errors.no_of_course }}
            </p>
          </div>
        </div>

        <div class="grid grid-cols-2 gap-2">
          <div>
            <input type="number" placeholder="No of Course Per Semester" v-model="major_form.no_of_subject_per_semester"
              class="bg-gray-200 rounded-lg w-full h-12 px-4 focus:outline-none focus:ring-2 focus:ring-sky-400" />
            <p v-if="major_form.errors.no_of_subject_per_semester" class="text-sm text-red-500 mt-1">
              {{ major_form.errors.no_of_subject_per_semester }}
            </p>
          </div>
        </div>



        <button class="bg-sky-500 disabled:cursor-wait text-white px-2 py-2 rounded-lg mt-2 w-1/5">Create</button>
      </form>
    </div>
  </div>

  <div v-if="!show"
    class="max-w-4xl mx-auto mt-5 bg-white shadow-lg px-4 py-2 rounded-2xl flex items-center justify-between hover:border hover:border-sky-500"
    v-for="major in majors" :key="major.id">
    <div>
      <p class="text-gray-400 font-medium text-lg">Major</p>
      <p class="text-sm text-sky-500 font-medium">{{ major.major_en }}</p>
    </div>

    <div class="flex items-center gap-5">
      <Link :href="route('major.detail', `${major.major_en}`)" class="bg-orange-500 text-white text-sm font-medium px-4 py-1 rounded-lg cursor-pointer">
        <i class="fa-solid fa-book"></i>
        Detail
      </Link>
      <button class="bg-sky-500 text-white text-sm font-medium px-4 py-1 rounded-lg cursor-pointer">
        <i class="fa-solid fa-pen-to-square"></i>
        Edit
      </button>
      <button class="bg-red-500 text-white text-sm font-medium px-4 py-1 rounded-lg cursor-pointer">
        <i class="fa-solid fa-trash"></i>
        Delete
      </button>
    </div>
  </div>

</template>