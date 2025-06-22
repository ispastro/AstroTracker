<template>
  <div>
    <Head title="Preferences" />

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
          <div class="p-6 text-gray-900">
            <h1 class="text-2xl font-bold mb-6">User Preferences</h1>

            <form @submit.prevent="submit">
              <div class="space-y-6">
                <!-- Event Type Preferences -->
                <div>
                  <label class="block text-sm font-medium text-gray-700 mb-2">
                    Event Types I'm Interested In
                  </label>
                  <div class="space-y-2">
                    <div v-for="type in eventTypes" :key="type">
                      <label class="flex items-center space-x-2">
                        <input
                          type="checkbox"
                          :value="type"
                          v-model="form.interested_event_types"
                          class="rounded border-gray-300 text-blue-600 focus:ring-blue-500"
                        />
                        <span class="text-sm text-gray-600">{{ type }}</span>
                      </label>
                    </div>
                  </div>
                </div>

                <!-- Location Preferences -->
                <div>
                  <label class="block text-sm font-medium text-gray-700 mb-2">
                    Preferred Location
                  </label>
                  <div class="space-y-2">
                    <div>
                      <input
                        type="text"
                        v-model="form.preferred_location"
                        placeholder="City or Region"
                        class="block w-full rounded-md border-gray-300 focus:border-blue-500 focus:ring-blue-500"
                      />
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                      <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                          Latitude
                        </label>
                        <input
                          type="number"
                          step="0.000001"
                          v-model="form.latitude"
                          class="block w-full rounded-md border-gray-300 focus:border-blue-500 focus:ring-blue-500"
                        />
                      </div>
                      <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                          Longitude
                        </label>
                        <input
                          type="number"
                          step="0.000001"
                          v-model="form.longitude"
                          class="block w-full rounded-md border-gray-300 focus:border-blue-500 focus:ring-blue-500"
                        />
                      </div>
                    </div>
                  </div>
                </div>

                <!-- Notification Preferences -->
                <div>
                  <label class="block text-sm font-medium text-gray-700 mb-2">
                    Notifications
                  </label>
                  <div class="space-y-2">
                    <div class="flex items-center space-x-2">
                      <input
                        type="checkbox"
                        v-model="form.receive_email_notifications"
                        class="rounded border-gray-300 text-blue-600 focus:ring-blue-500"
                      />
                      <span class="text-sm text-gray-600">
                        Receive email notifications for upcoming events
                      </span>
                    </div>
                  </div>
                </div>

                <!-- Submit Button -->
                <div>
                  <button
                    type="submit"
                    :disabled="form.processing"
                    class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 disabled:opacity-50"
                  >
                    Save Preferences
                  </button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { Head, useForm } from '@inertiajs/vue3'
import { ref } from 'vue'

const eventTypes = ref([
  'meteor_shower',
  'eclipse',
  'planet',
  'satellite',
  'comet',
  'asteroid'
])

const props = defineProps({
  preferences: Object
})

const form = useForm({
  interested_event_types: props.preferences?.interested_event_types ?? [],
  preferred_location: props.preferences?.preferred_location ?? '',
  latitude: props.preferences?.latitude ?? null,
  longitude: props.preferences?.longitude ?? null,
  receive_email_notifications: props.preferences?.receive_email_notifications ?? true
})

const submit = () => {
  form.post(route('preferences.update'))
}
</script>
