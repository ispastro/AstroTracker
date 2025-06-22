<template>
  <div>
    <Head title="Create Event" />

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
          <div class="p-6 text-gray-900">
            <h1 class="text-2xl font-bold mb-6">Create New Celestial Event</h1>

            <form @submit.prevent="submit">
              <div class="space-y-6">
                <!-- Basic Information -->
                <div>
                  <label class="block text-sm font-medium text-gray-700 mb-2">
                    Title
                  </label>
                  <input
                    type="text"
                    v-model="form.title"
                    class="block w-full rounded-md border-gray-300 focus:border-blue-500 focus:ring-blue-500"
                  />
                  <div v-if="form.errors.title" class="text-sm text-red-600 mt-1">
                    {{ form.errors.title }}
                  </div>
                </div>

                <div>
                  <label class="block text-sm font-medium text-gray-700 mb-2">
                    Description
                  </label>
                  <textarea
                    v-model="form.description"
                    rows="4"
                    class="block w-full rounded-md border-gray-300 focus:border-blue-500 focus:ring-blue-500"
                  ></textarea>
                  <div v-if="form.errors.description" class="text-sm text-red-600 mt-1">
                    {{ form.errors.description }}
                  </div>
                </div>

                <!-- Event Type -->
                <div>
                  <label class="block text-sm font-medium text-gray-700 mb-2">
                    Event Type
                  </label>
                  <select
                    v-model="form.type"
                    class="block w-full rounded-md border-gray-300 focus:border-blue-500 focus:ring-blue-500"
                  >
                    <option v-for="type in eventTypes" :key="type" :value="type">
                      {{ type.replace('_', ' ').replace(/\w/, (c) => c.toUpperCase()) }}
                    </option>
                  </select>
                  <div v-if="form.errors.type" class="text-sm text-red-600 mt-1">
                    {{ form.errors.type }}
                  </div>
                </div>

                <!-- Date and Time -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                  <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                      Start Date and Time
                    </label>
                    <input
                      type="datetime-local"
                      v-model="form.starts_at"
                      class="block w-full rounded-md border-gray-300 focus:border-blue-500 focus:ring-blue-500"
                    />
                    <div v-if="form.errors.starts_at" class="text-sm text-red-600 mt-1">
                      {{ form.errors.starts_at }}
                    </div>
                  </div>
                  <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                      End Date and Time
                    </label>
                    <input
                      type="datetime-local"
                      v-model="form.ends_at"
                      class="block w-full rounded-md border-gray-300 focus:border-blue-500 focus:ring-blue-500"
                    />
                    <div v-if="form.errors.ends_at" class="text-sm text-red-600 mt-1">
                      {{ form.errors.ends_at }}
                    </div>
                  </div>
                </div>

                <!-- Visibility -->
                <div>
                  <label class="block text-sm font-medium text-gray-700 mb-2">
                    Visibility
                  </label>
                  <div class="space-y-2">
                    <label class="flex items-center space-x-2">
                      <input
                        type="checkbox"
                        v-model="form.is_global"
                        class="rounded border-gray-300 text-blue-600 focus:ring-blue-500"
                      />
                      <span class="text-sm text-gray-600">
                        Visible globally
                      </span>
                    </label>
                    <div v-if="!form.is_global">
                      <label class="block text-sm font-medium text-gray-700 mb-1">
                        Visibility Regions
                      </label>
                      <input
                        type="text"
                        v-model="form.visibility_regions"
                        placeholder="Enter regions separated by comma (e.g. USA, Canada, Europe)"
                        class="block w-full rounded-md border-gray-300 focus:border-blue-500 focus:ring-blue-500"
                      />
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
                    Create Event
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

const form = useForm({
  title: '',
  description: '',
  type: 'meteor_shower',
  starts_at: new Date().toISOString().slice(0, 16),
  ends_at: new Date(Date.now() + 24 * 60 * 60 * 1000).toISOString().slice(0, 16),
  visibility_regions: '',
  is_global: false
})

const submit = () => {
  form.post(route('admin.events.store'))
}
</script>
