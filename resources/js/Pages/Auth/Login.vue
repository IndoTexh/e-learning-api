<script setup>
import { useForm } from '@inertiajs/vue3';

const form = useForm({
  email: "",
  password: "",
  remember: null
});

const submit = () => {
  form.post(route("login"), {
    onFinish: () => form.reset("password"),
  });
}
</script>


<template>

  <Head :title="` - ${$page.component}`" />
  <div class="w-full max-w-md mx-auto mt-25 bg-white p-8 rounded-lg shadow-md">
    <h2 class="text-2xl font-bold text-center text-sky-500 mb-6">Login</h2>

    <form class="space-y-3" @submit.prevent="submit">

      <div>
        <label for="email" class="block text-sm font-medium text-gray-700">Email Address</label>
        <input type="email" id="email" name="email" placeholder="Enter your email" v-model="form.email"
          class="mt-1 w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-sky-500 focus:border-sky-500 outline-none">
        <p v-if="form.errors.email" class="text-sm text-red-500 mt-1">
          {{ form.errors.email }}
        </p>
      </div>

      <div>
        <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
        <input type="password" id="password" name="password" placeholder="Create a password" v-model="form.password"
          class="mt-1 w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-sky-500 focus:border-sky-500 outline-none">
        <p v-if="form.errors.password" class="text-sm text-red-500 mt-1">
          {{ form.errors.password }}
        </p>
      </div>

      <div class="flex items-center space-x-1">
        <label class="block text-sm font-medium text-gray-700" for="remember">
          Remember me
        </label>
        <input type="checkbox" id="remember" name="remember"
          class="mt-1 px-4 py-2 border border-gray-300 focus:ring-sky-500 focus:border-sky-500" v-model="form.remember">
      </div>

      <div>
        <button type="submit" :disabled="form.processing"
          class="w-full bg-sky-500 disabled:bg-sky-300 disabled:cursor-wait text-white py-2 rounded-md hover:bg-sky-700 transition duration-300 font-semibold">
          Login
        </button>
      </div>
    </form>

    <p class="text-center text-sm text-gray-500 mt-4">
      Don't have an account yet?
      <Link :href="route('register')" class="text-sky-500 hover:underline">Register here</Link>
    </p>
  </div>
</template>