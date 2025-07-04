<script setup>
defineProps({
  major_detail: Object
})
</script>

<template>


  <div class="max-w-2xl mx-auto bg-white shadow-lg shadow-gray-300 p-2 rounded-lg mt-25">
    <Link :href="route('major')"
      class="border border-sky-500 text-sky-500 py-1 px-4 rounded-lg gap-2 hover:cursor-pointer hover:bg-sky-500 hover:text-white w-1/7">
        <i class="fa-solid fa-arrow-left"></i>
        <span class="font-medium ml-2">Back</span>
    </Link>
    <div class="mt-4">
      <i class="fa-solid fa-book text-sky-500 text-3xl mb-2 text-center"></i>
      <span class="text-gray-400 font-medium text-2xl uppercase ml-2">Major Details</span>
    </div>
    <div class=" border-t border-t-sky-500 py-4 space-y-1">
      <p class="font-bold text-gray-400 text-sm" style="font-family: Khmer Os Battambang;">
        <span class="font-medium text-sky-500">*</span> {{ major_detail.major_kh }}
      </p>
      <p class="font-medium text-lg text-gray-400">
        <span class="font-medium text-sky-500">*</span> {{ major_detail.major_en }}
      </p>
      <p>
        <span class="font-medium text-xl text-sky-500">*</span>
        <span class="font-bold text-sm text-gray-400" style="font-family: Khmer Os Battambang;"> ៨​ ឆមាស</span>
        <span class="font-medium text-lg text-gray-400"> | </span>
        <span class="font-medium text-lg text-gray-400">{{ major_detail.no_of_semester }} semesters</span>
      </p>
      <p>
        <span class="font-medium text-xl text-sky-500">*</span>
        <span class="font-bold text-sm text-gray-400" style="font-family: Khmer Os Battambang;"> ៤០ មុខវិជ្ជា</span>
        <span class="font-medium text-lg text-gray-400"> | </span>
        <span class="font-medium text-lg text-gray-400">{{ major_detail.no_of_course }} courses</span>
      </p>
      <p>
        <span class="font-medium text-xl text-sky-500">*</span>
        <span class="font-bold text-sm text-gray-400" style="font-family: Khmer Os Battambang;"> ៥
          មុខវិជ្ជា​ក្នុងមួយឆមាស</span>
        <span class="font-medium text-lg text-gray-400"> | </span>
        <span class="font-medium text-lg text-gray-400">{{ major_detail.subjects_per_semester }} courses per
          semester</span>
      </p>
      <p>
        <span class="font-medium text-xl text-sky-500">*</span>
        <span class="font-bold text-sm text-gray-400" style="font-family: Khmer Os Battambang;">
          តម្លៃសិក្សាពេញក្នុងរយះពេល ៤ឆ្នាំ</span>
        <span class="font-medium text-lg text-gray-400"> = 2800$</span>
        <span class="font-medium text-lg text-gray-400"> | </span>
        <span class="font-medium text-lg text-gray-400"> Tuition fees for 4 years = {{ major_detail.tuition_fees_total
        }}$</span>
      </p>
      <p>
        <span class="font-medium text-xl text-sky-500">*</span>
        <span class="font-bold text-sm text-gray-400" style="font-family: Khmer Os Battambang;">
          តម្លៃសិក្សាក្នុងមួយឆមាស </span>
        <span class="font-medium text-lg text-gray-400"> = 350$</span>
        <span class="font-medium text-lg text-gray-400"> | </span>
        <span class="font-medium text-lg text-gray-400"> Tuition fees per semester = {{
          major_detail.tuition_fees_per_semester }}$</span>
      </p>
    </div>
  </div>
</template>