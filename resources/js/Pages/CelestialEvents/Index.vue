<template>
  <div>
    <Head title="Celestial Events" />

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
          <div class="p-6 text-gray-900">
            <div class="flex justify-between items-center mb-6">
              <h1 class="text-2xl font-bold">Celestial Events</h1>
              <Link
                v-if="can('create events')"
                :href="route('admin.events.create')"
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
            <div class="space-y-4">
              <EventCard
                v-for="event in events"
                :key="event.id"
                :event="event"
                :is-subscribed="event.is_subscribed"
                :can-subscribe="true"
              />
            </div>

            <!-- Pagination -->
            <div class="mt-6">
              <Pagination :links="events.links" />
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { Head, Link } from '@inertiajs/vue3'
import EventCard from '@/Components/EventCard.vue'
import Pagination from '@/Components/Pagination.vue'
import { computed, ref } from 'vue'

const props = defineProps({
  events: Object,
  filters: Object,
  can: Object
})

const eventTypes = ref([
  'meteor_shower',
  'eclipse',
  'planet',
  'satellite',
  'comet',
  'asteroid'
])

const submit = () => {
  Inertia.get(route('events.index'), {
    ...props.filters,
    type: props.filters.type,
    start_date: props.filters.start_date,
    end_date: props.filters.end_date
  }, {
    preserveState: true,
    replace: true
  })
}
</script>
