<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue'
import { Head, Link, useForm } from '@inertiajs/vue3'
import { CheckIcon } from '@heroicons/vue/24/outline'

const props = defineProps({
    status: String,
})

const form = useForm({
    email: '',
    password: '',
    remember: false
})

const submit = () => {
    form.post(route('login'), {
        onFinish: () => form.reset('password'),
        preserveScroll: true,
        onError: () => {
            if (form.errors.email) {
                form.reset('email')
            }
            if (form.errors.password) {
                form.reset('password')
            }
        },
        onSuccess: () => {
            form.reset()
        },
    })
}
</script>

<template>
    <GuestLayout>
        <Head title="Login" />

        <div class="mb-4 text-sm font-medium text-green-600" v-if="status">
            {{ status }}
        </div>

        <form @submit.prevent="submit" class="space-y-6">
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input
                    type="email"
                    id="email"
                    v-model="form.email"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                    required
                    autofocus
                />
                <div class="mt-2 text-sm text-red-600" v-if="form.errors.email">
                    {{ form.errors.email }}
                </div>
            </div>

            <div>
                <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                <input
                    type="password"
                    id="password"
                    v-model="form.password"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                    required
                    autocomplete="current-password"
                />
                <div class="mt-2 text-sm text-red-600" v-if="form.errors.password">
                    {{ form.errors.password }}
                </div>
            </div>

            <div class="flex items-center">
                <input
                    id="remember"
                    type="checkbox"
                    v-model="form.remember"
                    class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500"
                />
                <label for="remember" class="ml-2 block text-sm text-gray-700">
                    Remember me
                </label>
            </div>

            <div class="flex items-center justify-between">
                <Link
                    :href="route('password.request')"
                    class="text-sm font-medium text-indigo-600 hover:text-indigo-500"
                >
                    Forgot your password?
                </Link>

                <button
                    type="submit"
                    :disabled="form.processing"
                    class="inline-flex justify-center rounded-md border border-transparent bg-indigo-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-50"
                >
                    <CheckIcon v-if="form.processing" class="w-5 h-5 mr-2 animate-spin" />
                    Login
                </button>
            </div>
        </form>
    </GuestLayout>
</template>
