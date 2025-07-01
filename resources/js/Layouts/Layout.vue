<script setup>
import { computed, ref } from 'vue';
import { useForm, usePage } from '@inertiajs/vue3';

const currentYear = new Date().getFullYear();
const show = ref(false);
const page = usePage();
const user = computed(() => page.props.auth.user);
const showDeleteModal = ref(false);
const form = useForm();

const logout = () => {
  form.post(route('logout'), {
    onFinish: () => showDeleteModal.value = false
  });
}

</script>

<template>
  <div class="min-h-screen flex flex-col bg-gray-50">
    <!-- Header -->
    <header class="fixed top-0 w-full bg-sky-500 p-5 flex items-center space-x-5 shadow-md">
      <nav class="flex items-center justify-between w-full text-white">
        <div class="flex items-center gap-2">
          <Link v-if="user" :href="route('dashboard')">
          <img src="../Assets/logo.png" class="w-12" alt="Logo">
          </Link>

          <img v-else src="../Assets/logo.png" class="w-12" alt="Logo">

          <h1 v-if="$page.props.auth.user" class="text-white font-bold text-2xl">
            <!-- Faculty of Information and Technology -->
            FIT, E-learning platform
          </h1>
          <h1 v-else class="text-white text-2xl">
            Welcome to BELTEI E-Learning
          </h1>
        </div>
        <div v-if="!$page.props.auth.user" class="flex items-center gap-3">
          <Link :href="route('login')" class="text-white hover:underline">Login</Link>
          <Link :href="route('register')" class="text-white hover:underline">Register</Link>
        </div>

        <div v-else class="relative hover:cursor-pointer bg-white px-2 py-2" @click="show = !show">
          <div class="rounded-t-md">
            <p v-if="user" class="text-sm font-medium text-sky-500">
              <!-- Aadmin, --> {{ user.name }}
            </p>
          </div>

          <div v-if="show"
            class="flex flex-col space-y-2 bg-white py-1 absolute left-0 top-9 w-full shadow-lg rounded-b-md border-t-2 border-sky-500">
            <Link :href="route('profile')"
              class="text-sm font-medium text-sky-500 px-2 py-2 flex items-center gap-2 hover:bg-gray-300 w-full">
            <i class="fa-solid fa-user"></i>
            <span>My Profile</span>
            </Link>

            <Link class="text-sm font-medium text-sky-500 px-2 py-2 flex items-center gap-2 hover:bg-gray-300 w-full">
            <i class="fa-solid fa-key"></i>
            <span>Change Password</span>
            </Link>

            <Link @click="showDeleteModal = !showDeleteModal"
              class="text-sm font-medium text-sky-500 px-2 py-2 text-left hover:cursor-pointer flex items-center gap-2 hover:bg-gray-300 w-full">
            <i class="fa-solid fa-right-from-bracket"></i>
            <span>Logout</span>
            </Link>
          </div>
        </div>
      </nav>
    </header>

    <!-- Main Content -->
    <main v-if="$page.component == 'Home'" class="mt-[150px] flex flex-col items-center justify-center text-center">
      <div class="max-w-3xl">
        <h2 class="text-4xl font-extrabold text-sky-500 mb-4">What is E-Learning?</h2>
        <p class="text-gray-700 text-lg leading-relaxed">
          <strong class="text-sky-500">BELTEI E-Learning</strong> is an innovative digital platform designed to deliver
          quality education online.
          It allows students to access course materials.
          Our goal is to make learning more flexible, accessible, and effective by integrating modern technology with
          traditional education.
        </p>
      </div>
    </main>


    <main v-else class="w-full p-5">
      <div v-if="showDeleteModal" class="fixed inset-0 bg-black/50 bg-opacity-50 flex items-center justify-center z-50">
        <div class="bg-white rounded-xl p-6 w-full max-w-md shadow-lg">
          <h2 class="text-xl font-semibold text-gray-700 mb-4">Logout</h2>
          <p class="text-sm text-gray-600 mb-6">Are you sure want to logout?</p>
          <div class="flex justify-end space-x-4">
            <button @click="showDeleteModal = false"
              class="bg-gray-200 text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-300">
              No
            </button>
            <button @click="logout" :disabled="form.processing"
              class="bg-red-500 text-white text-sm font-medium px-4 py-1 rounded-lg cursor-pointer disabled:bg-red-300 disabled:cursor-wait">
              Yes
            </button>
          </div>
        </div>
      </div>
      <slot />
    </main>
    <footer class="fixed bottom-0 left-0 w-full bg-sky-500 text-white p-4 text-center shadow-inner">
      &copy; {{ currentYear }} BELTEI E-Learning. All rights reserved.
    </footer>
  </div>
</template>
