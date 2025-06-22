<template>
  <AuthenticatedLayout>
    <Head title="Test Page" />

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
          <div class="p-6 text-gray-900">
            <h1 class="text-2xl font-bold mb-4">Test Page</h1>
            
            <div class="space-y-6">
              <div>
                <h2 class="text-xl font-semibold mb-2">User Information</h2>
                <p>Name: {{ $page.props.auth.user?.name }}</p>
                <p>Email: {{ $page.props.auth.user?.email }}</p>
              </div>

              <div>
                <h2 class="text-xl font-semibold mb-2">Event Subscription Test</h2>
                <div v-if="$page.props.can('create events')">
                  <p>You have admin privileges</p>
                </div>
                <div v-else>
                  <p>You are a regular user</p>
                </div>
              </div>

              <div>
                <h2 class="text-xl font-semibold mb-2">Event Card Test</h2>
                <EventCard
                  :event="testEvent"
                  :is-subscribed="true"
                  :can-subscribe="true"
                />
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import { Head } from '@inertiajs/vue3'
import EventCard from '@/Components/EventCard.vue'

const testEvent = {
  id: 1,
  title: 'Test Event',
  description: 'This is a test event',
  type: 'meteor_shower',
  starts_at: '2025-06-25T20:00:00',
  ends_at: '2025-06-25T22:00:00'
}
</script>
