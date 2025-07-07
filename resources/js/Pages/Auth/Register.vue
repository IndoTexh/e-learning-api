<script setup>
import { useForm } from '@inertiajs/vue3';

const form = useForm({
  name: "",
  email: "",
  password: "",
  password_confirmation: ""
});

const submit = () => {
  form.post(route("register"), {
    onFinish: () => form.reset(),
  });
}
</script>

<template>
  <Head :title="` - ${$page.component}`" />
  <div class="w-full max-w-md mx-auto mt-25 bg-white p-8 rounded-lg shadow-md">
    <h2 class="text-2xl font-bold text-center text-sky-500 mb-6">Create an Account</h2>

    <form class="space-y-3" @submit.prevent="submit">

      <div>
        <label for="name" class="block text-sm font-medium text-gray-700">Full Name</label>
        <input type="text" id="name" name="name" placeholder="Enter your full name" v-model="form.name"
          class="mt-1 w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-sky-500 focus:border-sky-500 outline-none">
          <p v-if="form.errors.name" class="text-sm text-red-500 mt-1">
            {{ form.errors.name }}
          </p>
      </div>

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

      <div>
        <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirm Password</label>
        <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Repeat your password" v-model="form.password_confirmation"
          class="mt-1 w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-sky-500 focus:border-sky-500 outline-none">
      </div>

      <div>
        <button type="submit" :disabled="form.processing"
          class="w-full bg-sky-500 text-white py-2 rounded-md hover:bg-sky-700 transition duration-300 font-semibold">
          Register
        </button>
      </div>
    </form>

    <p class="text-center text-sm text-gray-500 mt-4">
      Already have an account?
      <Link :href="route('login')" class="text-sky-500 hover:underline">Login here</Link>
    </p>
  </div>
</template>