<template>
  <div class="bg-white rounded-lg shadow-md overflow-hidden">
    <div class="p-6">
      <div class="flex justify-between items-start mb-4">
        <h3 class="text-xl font-semibold text-gray-900">
          {{ event.title }}
        </h3>
        <div class="flex items-center space-x-4">
          <CountdownTimer :date="event.starts_at" />
          <button
            v-if="canSubscribe"
            @click="toggleSubscription"
            class="px-4 py-2 rounded-md text-sm font-medium transition-colors"
            :class="{
              'bg-blue-600 text-white hover:bg-blue-700': !isSubscribed,
              'bg-gray-600 text-white hover:bg-gray-700': isSubscribed
            }"
          >
            {{ isSubscribed ? 'Subscribed' : 'Subscribe' }}
          </button>
        </div>
      </div>

      <div class="text-gray-600 mb-4">
        <p>{{ event.description }}</p>
      </div>

      <div class="flex justify-between items-center text-sm text-gray-500">
        <span>
          <svg class="w-4 h-4 inline-block mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
          </svg>
          {{ event.type }}
        </span>
        <span>
          <svg class="w-4 h-4 inline-block mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
          </svg>
          {{ event.starts_at }} - {{ event.ends_at }}
        </span>
      </div>
    </div>
  </div>
</template>

<script setup>
import { computed } from 'vue'
import CountdownTimer from './CountdownTimer.vue'
import { Inertia } from '@inertiajs/inertia'

const props = defineProps({
  event: Object,
  isSubscribed: Boolean,
  canSubscribe: Boolean
})

const toggleSubscription = () => {
  if (props.isSubscribed) {
    Inertia.delete(route('events.unsubscribe', props.event))
  } else {
    Inertia.post(route('events.subscribe', props.event))
  }
}
</script>
