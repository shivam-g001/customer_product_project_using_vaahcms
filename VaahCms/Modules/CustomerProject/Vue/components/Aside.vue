<script setup>
import {reactive, ref,onMounted} from 'vue';
import {useCustomerStore} from '../stores/store-customers'
import {useProductStore} from "../stores/store-products";
const store = useCustomerStore();
const store_product = useProductStore();

import Menu from 'primevue/menu';

const reset = () => {
    store.resetQuery();
    // store_product.resetQuery();
};

const inputs = {
}
const data = reactive(inputs);
const height = ref(window.innerHeight)

const menu = ref();

const items = ref([
    {
        label: 'CustomerProject',
        items: [
            {
                label: 'Dashboard',
                icon: 'fa-regular fa-chart-bar',
                to: "/"
            },
            {
                label: 'Customer',
                icon: 'fa-regular fa-chart-bar',
                to: "/customers"
            },
            {
                label: 'Product',
                icon: 'fa-regular fa-chart-bar',
                to: "/products"
            },
            {
                label: 'Users',
                icon: 'fa-regular fa-chart-bar',
                to: "/users"
            },
        ]
    },
]);

if (items.label === 'Product') {
    store.getList();
}
onMounted(async () => {
    await store.getList();
    // await store_product.getList();
});

</script>
<template>

    <div v-if="height">
        <Menu :model="items"  class="w-full" @click="reset" />
    </div>

</template>


