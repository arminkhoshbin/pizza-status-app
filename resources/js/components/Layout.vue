<template>
  <header>
    <nav class="bg-white border-gray-200 px-4 lg:px-6 py-2.5 dark:bg-gray-800">
      <div class="flex flex-wrap justify-between items-center mx-auto max-w-screen-xl">
        <Link href="/" class="flex items-center">
          <span class="self-center text-xl font-semibold whitespace-nowrap dark:text-white">Pizza Status App</span>
        </Link>
        <div v-if="$page.props.user" class="flex items-center lg:order-2 gap-x-4">
          <p class="text-gray-800 dark:text-white">
            Welcome {{ $page.props.user.name }}
          </p>
          <Link
              href="/pos/create-order"
              class="text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
          >
            Create Order
          </Link>
          <Link href="/order/updates"
              class="text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
          >
            View Updates
          </Link>
        </div>
      </div>
    </nav>
  </header>
  <section class="bg-gray-50 dark:bg-gray-900">
    <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">
      <slot/>
    </div>
  </section>
</template>
<script setup lang="ts">
import {Link} from "@inertiajs/vue3";
</script>