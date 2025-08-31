<script setup>
import { usePage } from "@inertiajs/vue3";
import { onMounted, ref } from "vue";
import Layout from "../../components/Layout.vue";

const pizzaStatus = ref(null);

const pizzaStatusMessages = {
  making: 'We are making your pizza!',
  cooking: 'Your pizza is being cooked!',
  ready: 'Your pizza is ready!'
};

onMounted(() => {
  Echo.private(`pizza-status.${usePage().props.user.id}`).listen('.pizza-status.updated', (e) => {
    pizzaStatus.value = pizzaStatusMessages[e.status];
  });
});

</script>

<template>
  <Layout>
    <div class="w-full bg-white rounded-lg shadow dark:border md:mt-0 sm:max-w-xl xl:p-0 dark:bg-gray-800 dark:border-gray-700">
      <div class="text-center">
        <h1 class="font-semibold text-white p-5">
          <span class="text-4xl" v-if="pizzaStatus">{{ pizzaStatus }}</span>
          <span class="text-2xl" v-if="!pizzaStatus">Awaiting pizza update...</span>
        </h1>
      </div>
    </div>
  </Layout>
</template>