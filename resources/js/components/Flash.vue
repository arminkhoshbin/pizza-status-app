<script setup>
import { onMounted, ref } from "vue";

defineProps({
  message: String,
});

const visible = ref(true);

onMounted(() => setTimeout(() => visible.value = false, 3000))
</script>

<template>
  <div v-if="message && visible" class="mb-4 relative flex w-full p-3 text-sm text-white bg-green-600 rounded-md">
    {{ message }}
  </div>
</template>