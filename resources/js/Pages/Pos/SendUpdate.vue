<script setup>
import { Link, router } from "@inertiajs/vue3";
import Flash from "../../components/Flash.vue";
import Layout from "../../components/Layout.vue";

const props = defineProps({
  order: Object,
  nextAvailableStatus: Object
});

function changeStatus (status) {
  router.post(`/orders/${props.order.id}/send-update`, {
    status: status,
  }, {
    preserveState: false,
  });
}

</script>

<template>
  <Layout>
    <div class="w-full bg-white rounded-lg shadow dark:border md:mt-0 sm:max-w-xl xl:p-0 dark:bg-gray-800 dark:border-gray-700">
      <div v-if="!nextAvailableStatus" class="p-6 space-y-4 md:space-y-6 sm:p-8">
        <h1 class="text-xl font-bold text-center text-gray-900 md:text-2xl dark:text-white">
          Your {{ props.order.name }} order is completed!
        </h1>
        <p class="text-sm text-center font-light text-gray-500 dark:text-gray-400">
          <Link href="/pos/create-order" class="font-medium text-blue-600 hover:underline dark:text-blue-500">Create another order</Link>
        </p>
      </div>
      <div v-if="nextAvailableStatus" class="p-6 space-y-4 md:space-y-6 sm:p-8">
        <h1 class="text-xl font-bold text-center text-gray-900 md:text-2xl dark:text-white">
          Update status of the {{ props.order.name }}
        </h1>
        <Flash :message="$page.props.flash" />
        <div class="flex flex-row justify-center">
          <button @click="changeStatus(nextAvailableStatus.status)" class="text-white bg-blue-700 hover:bg-blue-800 rounded-lg text-sm px-5 py-2.5 text-center items-center">
            {{ nextAvailableStatus.label }}
          </button>
        </div>
      </div>
    </div>
  </Layout>
</template>