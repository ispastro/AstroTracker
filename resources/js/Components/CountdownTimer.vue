<template>
  <div class="flex items-center space-x-2">
    <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
    </svg>
    <span class="text-sm font-medium text-gray-600">
      {{ formattedTime }}
    </span>
  </div>
</template>

<script setup>
import { ref, onMounted, onUnmounted } from 'vue'

const props = defineProps({
  date: String
})

const formattedTime = ref('')

const updateCountdown = () => {
  const targetDate = new Date(props.date)
  const now = new Date()
  const diff = targetDate - now

  if (diff <= 0) {
    formattedTime.value = 'Event has started'
    return
  }

  const days = Math.floor(diff / (1000 * 60 * 60 * 24))
  const hours = Math.floor((diff % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60))
  const minutes = Math.floor((diff % (1000 * 60 * 60)) / (1000 * 60))
  const seconds = Math.floor((diff % (1000 * 60)) / 1000)

  formattedTime.value = `${days}d ${hours}h ${minutes}m ${seconds}s`
}

onMounted(() => {
  updateCountdown()
  const interval = setInterval(updateCountdown, 1000)
  onUnmounted(() => clearInterval(interval))
})
</script>
