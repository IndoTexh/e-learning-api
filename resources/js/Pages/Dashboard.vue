<script setup>
</script>

<template>
  <p class="text-gray-400 font-medium mt-25 text-2xl">{{ $page.component }}</p>
  <div class="w-full grid grid-cols-2 gap-10 mt-5">
    <div class="grid grid-cols-5 gap-2">
      <Link :href="route('academic_year')">
        <div
          class="bg-white shadow-lg rounded-lg flex flex-col items-center py-2 h-40 w-auto hover:border hover:border-sky-500">
          <i class="fa-solid fa-calendar text-sky-500 text-4xl"></i>
          <p class="mt-4 text-gray-400 font-medium">Academic Year</p>
        </div>
      </Link>
      <div
        class="bg-white shadow-lg rounded-lg flex flex-col items-center py-2 h-40 w-auto hover:border hover:border-sky-500">
        <i class="fa-solid fa-list-ol text-sky-500 text-4xl"></i>
        <p class="mt-4 text-gray-400 font-medium">Semester</p>
      </div>
      <Link :href="route('major')">
        <div
          class="bg-white shadow-lg rounded-lg flex flex-col items-center py-2 h-40 w-auto hover:border hover:border-sky-500">
          <i class="fa-solid fa-user-graduate text-sky-500 text-4xl"></i>
          <p class="mt-4 text-gray-400 font-medium">Major</p>
        </div>
      </Link>
      <div
        class="bg-white shadow-lg rounded-lg flex flex-col items-center py-2 h-40 w-auto hover:border hover:border-sky-500">
        <i class="fa-solid fa-person-chalkboard text-sky-500 text-4xl"></i>
        <p class="mt-4 text-gray-400 font-medium">Course</p>
      </div>
      <div
        class="bg-white shadow-lg rounded-lg flex flex-col items-center py-2 h-40 w-auto hover:border hover:border-sky-500">
        <i class="fa-solid fa-person-chalkboard text-sky-500 text-4xl"></i>
        <p class="mt-4 text-gray-400 font-medium">Teachers</p>
      </div>
      <div
        class="bg-white shadow-lg rounded-lg flex flex-col items-center py-2 h-40 w-auto hover:border hover:border-sky-500">
        <i class="fa-solid fa-graduation-cap text-sky-500 text-4xl"></i>
        <p class="mt-4 text-gray-400 font-medium">Students</p>
      </div>
    </div>
    <div class="bg-red-500">right</div>
  </div>
</template>