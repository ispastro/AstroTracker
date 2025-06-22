<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue'
import { Head, Link, useForm } from '@inertiajs/vue3'
import { CheckIcon } from '@heroicons/vue/24/outline'

const props = defineProps({
    status: String,
})

const form = useForm({
    name: '',
    email: '',
    password: '',
    password_confirmation: '',
    terms: false,
})

const submit = () => {
    form.post(route('register'), {
        onFinish: () => form.reset('password', 'password_confirmation'),
        preserveScroll: true,
        onError: () => {
            if (form.errors.name) {
                form.reset('name')
            }
            if (form.errors.email) {
                form.reset('email')
            }
            if (form.errors.password) {
                form.reset('password')
            }
            if (form.errors.password_confirmation) {
                form.reset('password_confirmation')
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
        <Head title="Register" />

        <div class="mb-4 text-sm font-medium text-green-600" v-if="status">
            {{ status }}
        </div>

        <form @submit.prevent="submit" class="space-y-6">
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                <input
                    type="text"
                    id="name"
                    v-model="form.name"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                    required
                    autofocus
                />
                <div class="mt-2 text-sm text-red-600" v-if="form.errors.name">
                    {{ form.errors.name }}
                </div>
            </div>

            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input
                    type="email"
                    id="email"
                    v-model="form.email"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                    required
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
                    autocomplete="new-password"
                />
                <div class="mt-2 text-sm text-red-600" v-if="form.errors.password">
                    {{ form.errors.password }}
                </div>
            </div>

            <div>
                <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirm Password</label>
                <input
                    type="password"
                    id="password_confirmation"
                    v-model="form.password_confirmation"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                    required
                    autocomplete="new-password"
                />
                <div class="mt-2 text-sm text-red-600" v-if="form.errors.password_confirmation">
                    {{ form.errors.password_confirmation }}
                </div>
            </div>

            <div class="flex items-start">
                <div class="flex items-center h-5">
                    <input
                        id="terms"
                        type="checkbox"
                        v-model="form.terms"
                        class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500"
                    />
                </div>
                <div class="ml-3 text-sm">
                    <label for="terms" class="font-medium text-gray-700">
                        I agree to the
                        <a href="#" class="font-semibold text-indigo-600">
                            Terms of Service
                        </a>
                        and
                        <a href="#" class="font-semibold text-indigo-600">
                            Privacy Policy
                        </a>
                    </label>
                </div>
            </div>

            <div class="flex items-center justify-end">
                <Link
                    :href="route('login')"
                    class="text-sm font-medium text-indigo-600 hover:text-indigo-500"
                >
                    Already registered?
                </Link>

                <button
                    type="submit"
                    :disabled="form.processing"
                    class="ml-4 inline-flex justify-center rounded-md border border-transparent bg-indigo-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-50"
                >
                    <CheckIcon v-if="form.processing" class="w-5 h-5 mr-2 animate-spin" />
                    Register
                </button>
            </div>
        </form>
    </GuestLayout>
</template>
