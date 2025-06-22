<template>
  <AuthenticatedLayout>
    <template #header>
      <h2 class="text-xl font-semibold leading-tight text-gray-800">
        Celestial Events
      </h2>
    </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
          <div class="p-6">
            <div class="flex justify-between items-center mb-6">
              <h1 class="text-2xl font-bold">Celestial Events</h1>
              <Link
                :href="route('celestial-events.create')"
                class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"
              >
                Create Event
              </Link>
            </div>

            <!-- Filters -->
            <div class="mb-6">
              <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div>
                  <label class="block text-sm font-medium text-gray-700 mb-2">
                    Event Type
                  </label>
                  <select
                    v-model="filters.type"
                    @change="submit"
                    class="block w-full rounded-md border-gray-300 focus:border-blue-500 focus:ring-blue-500"
                  >
                    <option value="">All Types</option>
                    <option v-for="type in eventTypes" :key="type" :value="type">
                      {{ type.replace('_', ' ').replace(/\w/, (c) => c.toUpperCase()) }}
                    </option>
                  </select>
                </div>
                <div>
                  <label class="block text-sm font-medium text-gray-700 mb-2">
                    Start Date
                  </label>
                  <input
                    type="date"
                    v-model="filters.start_date"
                    @change="submit"
                    class="block w-full rounded-md border-gray-300 focus:border-blue-500 focus:ring-blue-500"
                  />
                </div>
                <div>
                  <label class="block text-sm font-medium text-gray-700 mb-2">
                    End Date
                  </label>
                  <input
                    type="date"
                    v-model="filters.end_date"
                    @change="submit"
                    class="block w-full rounded-md border-gray-300 focus:border-blue-500 focus:ring-blue-500"
                  />
                </div>
              </div>
            </div>

            <!-- Events List -->
            <div v-if="events.data.length > 0" class="space-y-4">
              <EventCard v-for="event in events.data" :key="event.id" :event="event" />
            </div>

            <!-- Empty State -->
            <div v-else class="text-center py-8">
              <p class="text-gray-500">No events found matching your criteria.</p>
            </div>

            <!-- Pagination -->
            <div v-if="events.data.length > 0" class="mt-6">
              <Pagination :links="events.links" />
            </div>
          </div>
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import { Head, Link } from '@inertiajs/vue3'
import EventCard from '@/Components/EventCard.vue'
import Pagination from '@/Components/Pagination.vue'

const props = defineProps({
  events: Object,
  filters: Object
})

const eventTypes = [
  'meteor_shower',
  'eclipse',
  'planet',
  'satellite',
  'comet',
  'asteroid'
]

const submit = () => {
  Inertia.get(route('celestial-events.index'), {
    type: filters.type,
    start_date: filters.start_date,
    end_date: filters.end_date
  }, {
    preserveState: true,
    replace: true
  })
}
</script>
