<template>
  <section class="bg-gray-50 dark:bg-gray-900">
    <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">
      <Link href="/pos/send-update" class="flex items-center mb-6 text-2xl font-semibold text-gray-900 dark:text-white">
        Pizza Status App
      </Link>
      <slot/>
    </div>
  </section>
</template>
<script setup lang="ts">
import {Link} from "@inertiajs/vue3";
</script>