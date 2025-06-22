<template>
  <div class="flex items-center justify-center mt-4 space-x-2">
    <button
      v-for="page in pages"
      :key="page"
      @click="$emit('change', page)"
      class="px-4 py-2 bg-gray-200 hover:bg-gray-300 rounded"
    >
      {{ page }}
    </button>
  </div>
</template>

<script setup>
const props = defineProps({
  pages: {
    type: Array,
    required: true
  }
})
</script>
