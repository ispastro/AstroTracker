<template>
  <AuthenticatedLayout>
    <template #header>
      <h2 class="text-xl font-semibold leading-tight text-gray-800">
        Preferences
      </h2>
    </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
          <div class="p-6">
            <Head title="Preferences" />

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
                          step="0.0001"
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
                          step="0.0001"
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
                    Notification Settings
                  </label>
                  <div class="space-y-2">
                    <div>
                      <label class="flex items-center space-x-2">
                        <input
                          type="checkbox"
                          v-model="form.receive_email_notifications"
                          class="rounded border-gray-300 text-blue-600 focus:ring-blue-500"
                        />
                        <span class="text-sm text-gray-600">Receive email notifications</span>
                      </label>
                    </div>
                  </div>
                </div>

                <div>
                  <button
                    type="submit"
                    class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-500 focus:outline-none focus:border-blue-700 focus:ring focus:ring-blue-200 active:bg-blue-600 disabled:opacity-25 transition"
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
  </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import { Head, useForm } from '@inertiajs/vue3'

const props = defineProps({
  preferences: Object
})

const form = useForm({
  interested_event_types: props.preferences?.interested_event_types || [],
  preferred_location: props.preferences?.preferred_location || '',
  latitude: props.preferences?.latitude || '',
  longitude: props.preferences?.longitude || '',
  receive_email_notifications: props.preferences?.receive_email_notifications || false
})

const eventTypes = ['meteor_shower', 'eclipse', 'planet', 'satellite', 'comet', 'asteroid']

const submit = () => {
  form.post(route('preferences.update'), {
    preserveScroll: true,
    onSuccess: () => {
      form.reset()
    },
    onError: () => {
      if (form.errors.interested_event_types) {
        form.reset('interested_event_types')
      }
      if (form.errors.preferred_location) {
        form.reset('preferred_location')
      }
      if (form.errors.latitude) {
        form.reset('latitude')
      }
      if (form.errors.longitude) {
        form.reset('longitude')
      }
    }
  })
}
</script>
