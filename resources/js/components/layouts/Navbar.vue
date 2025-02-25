<template>
    <nav class="fixed top-0 z-30 w-full bg-white border-b border-gray-200">
        <div class="px-3 py-3 lg:px-5 lg:pl-3">
            <div class="flex items-center justify-between">
                <div class="flex items-center justify-start">
                    <!-- Logo -->
                    <router-link to="/" class="flex ml-2 md:mr-24">
                        <span class="self-center text-xl font-semibold sm:text-2xl whitespace-nowrap">CariCar</span>
                    </router-link>
                </div>

                <!-- Center Navigation -->
                <div class="items-center hidden space-x-4 md:flex">
                    <router-link to="/"
                        class="px-3 py-2 text-gray-700 rounded-md hover:text-blue-600">Home</router-link>
                    <router-link to="/cars"
                        class="px-3 py-2 text-gray-700 rounded-md hover:text-blue-600">Cars</router-link>
                    <router-link to="/about"
                        class="px-3 py-2 text-gray-700 rounded-md hover:text-blue-600">About</router-link>
                    <router-link to="/contact"
                        class="px-3 py-2 text-gray-700 rounded-md hover:text-blue-600">Contact</router-link>
                </div>

                <!-- Right side buttons -->
                <div class="flex items-center">
                    <div class="items-center hidden space-x-3 md:flex">
                        <button @click="login" class="px-4 py-2 text-gray-700 hover:text-blue-600">Login</button>
                        <button @click="register"
                            class="px-4 py-2 text-white bg-blue-600 rounded-md hover:bg-blue-700">Register</button>
                    </div>

                    <!-- Mobile menu button -->
                    <button @click="toggleMobileMenu" class="ml-3 text-gray-700 md:hidden hover:text-blue-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path v-if="!isMobileMenuOpen" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                            <path v-else stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile menu -->
        <div v-show="isMobileMenuOpen" class="bg-white md:hidden">
            <div class="px-2 pt-2 pb-3 space-y-1">
                <router-link to="/" class="block px-3 py-2 text-gray-700 hover:text-blue-600">Home</router-link>
                <router-link to="/cars" class="block px-3 py-2 text-gray-700 hover:text-blue-600">Cars</router-link>
                <router-link to="/about" class="block px-3 py-2 text-gray-700 hover:text-blue-600">About</router-link>
                <router-link to="/contact"
                    class="block px-3 py-2 text-gray-700 hover:text-blue-600">Contact</router-link>
                <div class="pt-2 border-t border-gray-200">
                    <button @click="login"
                        class="block w-full px-3 py-2 text-left text-gray-700 hover:text-blue-600">Login</button>
                    <button @click="register"
                        class="block w-full px-3 py-2 text-left text-gray-700 hover:text-blue-600">Register</button>
                </div>
            </div>
        </div>
    </nav>
</template>

<script>
export default {
    name: 'Navbar',
    data() {
        return {
            isMobileMenuOpen: false
        }
    },
    methods: {
        toggleMobileMenu() {
            this.isMobileMenuOpen = !this.isMobileMenuOpen
        },
        login() {
            this.$router.push('/login')
        },
        register() {
            this.$router.push('/register')
        }
    }
}
</script>