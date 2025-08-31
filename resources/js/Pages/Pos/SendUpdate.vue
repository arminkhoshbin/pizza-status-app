<script setup>
import { router } from "@inertiajs/vue3";
import Flash from "../../components/Flash.vue";
import Layout from "../../components/Layout.vue";

function sendUpdate (update) {
  router.post('/pos/send-update', {
    status: update,
  }, {
    preserveState: false,
  });
}

</script>

<template>
  <Layout>
    <div class="w-full bg-white rounded-lg shadow dark:border md:mt-0 sm:max-w-xl xl:p-0 dark:bg-gray-800 dark:border-gray-700">
      <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
        <h1 class="text-xl font-bold text-center text-gray-900 md:text-2xl dark:text-white">
          Update the status of the pizza
        </h1>
        <Flash :message="$page.props.flash" />
        <div class="flex flex-row justify-between">
          <button @click="sendUpdate('making')" class="text-white bg-blue-700 hover:bg-blue-800 rounded-lg text-sm px-5 py-2.5 text-center items-center">
            Making the Pizza
          </button>
          <button @click="sendUpdate('cooking')" class="text-white bg-orange-700 hover:bg-orange-800 rounded-lg text-sm px-5 py-2.5 text-center items-center">
            Pizza is in the oven
          </button>
          <button @click="sendUpdate('ready')" class="text-white bg-green-700 hover:bg-green-800 rounded-lg text-sm px-5 py-2.5 text-center items-center">
            Pizza is ready!
          </button>
        </div>
      </div>
    </div>
  </Layout>
</template>