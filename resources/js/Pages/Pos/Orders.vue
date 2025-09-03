<script setup>
import { Link } from "@inertiajs/vue3";
import Layout from "../../components/Layout.vue";

defineProps({
  orders: Object,
});

</script>

<template>
  <Layout>
    <h1 class="text-xl mb-6 text-center font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
      Your Orders
    </h1>
    <div class="w-full bg-white rounded-lg shadow dark:border md:mt-0 sm:max-w-xl xl:p-0 dark:bg-gray-800 dark:border-gray-700">
      <div class="text-center">
        <div class="font-semibold text-white p-5">
          <div v-if="orders.length === 0">
            <p class="text-xl font-bold text-center text-gray-900 dark:text-white">
              You have no orders.
            </p>
            <p class="text-sm mt-4 text-center font-light text-gray-500 dark:text-gray-400">
              <Link href="/pos/create-order" class="font-medium text-blue-600 hover:underline dark:text-blue-500">Create an order</Link>
            </p>
          </div>
          <div v-if="orders.length > 0" class="relative overflow-x-auto">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
              <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
              <tr>
                <th scope="col" class="px-6 py-3">
                  Order
                </th>
                <th scope="col" class="px-6 py-3">
                  Status
                </th>
                <th scope="col" class="px-6 py-3">
                  Action
                </th>
              </tr>
              </thead>
              <tbody>
              <tr v-for="order in orders" class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200">
                <td class="px-6 py-4">
                  {{ order.name }}
                </td>
                <td class="px-6 py-4">
                  {{ order.latest_status }}
                </td>
                <td class="px-6 py-4">
                  <Link
                      v-if="order.latest_status !== 'ready'"
                      :href="`/orders/${order.id}/send-update`"
                      class="font-medium text-blue-600 hover:underline dark:text-blue-500"
                  >
                    Update
                  </Link>
                </td>
              </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </Layout>
</template>