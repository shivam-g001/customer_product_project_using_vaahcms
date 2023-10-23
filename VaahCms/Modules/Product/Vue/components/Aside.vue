<script setup>
import {reactive, ref,onMounted} from 'vue';
import {useProductStore} from '../stores/store-products.js'
const store = useProductStore();

import Menu from 'primevue/menu';

const reset = () => {
    store.resetQuery();
};


const inputs = {
}
const data = reactive(inputs);
const height = ref(window.innerHeight)

const menu = ref();
const items = ref([
    {
        label: 'Product',
        items: [
            {
                label: 'Dashboard',
                icon: 'fa-regular fa-chart-bar',
                to: "/"
            },
            {
                label: 'Products',
                icon: 'fa-regular fa-chart-bar',
                to: "/products",

            },
            {
                label: 'Categories',
                icon: 'fa-regular fa-chart-bar',
                to: "/blogs"
            },
            {
                label: 'Taxonomies',
                icon: 'fa-regular fa-chart-bar',
                to: "/taxonomies"
            },
        ]
    },
]);

if (items.label === 'Products') {
    store.getList();
}
onMounted(async () => {
    await store.getList();
});


</script>
<template>

    <div v-if="height">
        <Menu :model="items"  class="w-full"  @click="reset"/>
    </div>

</template>


