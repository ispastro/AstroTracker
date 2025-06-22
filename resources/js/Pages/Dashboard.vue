<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import EventCard from '@/Components/EventCard.vue';

const props = defineProps({
    upcomingEvents: Array,
    subscribedEvents: Array
});
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Dashboard
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Upcoming Events -->
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6">
                            <h3 class="text-lg font-semibold mb-4">Upcoming Events</h3>
                            <div v-if="upcomingEvents.length > 0" class="space-y-4">
                                <EventCard v-for="event in upcomingEvents" :key="event.id" :event="event" />
                            </div>
                            <p v-else class="text-gray-500">No upcoming events found.</p>
                        </div>
                    </div>

                    <!-- Subscribed Events -->
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6">
                            <h3 class="text-lg font-semibold mb-4">Subscribed Events</h3>
                            <div v-if="subscribedEvents.length > 0" class="space-y-4">
                                <EventCard v-for="event in subscribedEvents" :key="event.id" :event="event" />
                            </div>
                            <p v-else class="text-gray-500">No subscribed events found.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
