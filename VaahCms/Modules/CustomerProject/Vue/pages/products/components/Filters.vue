<script  setup>

import { useProductStore } from '../../../stores/store-products'
import VhFieldVertical from './../../../vaahvue/vue-three/primeflex/VhFieldVertical.vue'
import {useRoute} from "vue-router";
const route = useRoute();
const store = useProductStore();
let customer = null;
if (route.query.customer_name) {
    customer = route.query.customer;

}
store.query.customer_name = customer;
</script>

<template>
    <div>

        <Sidebar v-model:visible="store.show_filters"
                 position="right">
            <VhFieldVertical  v-if="!store.query.customer_name">
                <template #label>
                    <b>By Customer:</b>
                </template>
                <MultiSelect v-model="store.query.filter.customer_name"
                             :options="store.assets.customer_data"
                             optionLabel="name"
                             input-id="id"
                             optionValue="slug"
                             display="chip"
                             placeholder="Select customers"
                             class="w-full md:w-14rem"
                />
            </VhFieldVertical>

            <VhFieldVertical v-if="store.query.customer_name">
                <template #label>
                    <b>Selected Customer: </b>
                </template>
                <Tag type="text" v-model="store.query.customer_name" disabled class="w-full md:w-14rem">{{store.query.customer_name}}</Tag>
            </VhFieldVertical>

            <VhFieldVertical v-if="store.assets.blog_data !== ''">
                <template #label>
                    <b>By Category:</b>
                </template>
                <MultiSelect v-model="store.query.filter.category"
                             :options="store.assets.blog_data"
                             input-id="id"
                             option-value="slug"
                             display="chip"
                             option-label="name"
                             placeholder="Select category"
                             class="w-full md:w-14rem"
                />
            </VhFieldVertical>

            <VhFieldVertical >
                <template #label>
                    <b>Sort By:</b>
                </template>

                <div class="field-radiobutton">
                    <RadioButton name="sort-none"
                                 inputId="sort-none"
                                 data-testid="products-filters-sort-none"
                                 value=""
                                 v-model="store.query.filter.sort" />
                    <label for="sort-none" class="cursor-pointer">None</label>
                </div>
                <div class="field-radiobutton">
                    <RadioButton name="sort-ascending"
                                 inputId="sort-ascending"
                                 data-testid="products-filters-sort-ascending"
                                 value="updated_at"
                                 v-model="store.query.filter.sort" />
                    <label for="sort-ascending" class="cursor-pointer">Updated (Ascending)</label>
                </div>
                <div class="field-radiobutton">
                    <RadioButton name="sort-descending"
                                 inputId="sort-descending"
                                 data-testid="products-filters-sort-descending"
                                 value="updated_at:desc"
                                 v-model="store.query.filter.sort" />
                    <label for="sort-descending" class="cursor-pointer">Updated (Descending)</label>
                </div>

            </VhFieldVertical>

            <Divider/>

            <VhFieldVertical >
                <template #label>
                    <b>Is Active:</b>
                </template>

                <div class="field-radiobutton">
                    <RadioButton name="active-all"
                                 inputId="active-all"
                                 value="null"
                                 data-testid="products-filters-active-all"
                                 v-model="store.query.filter.is_active" />
                    <label for="active-all" class="cursor-pointer">All</label>
                </div>
                <div class="field-radiobutton">
                    <RadioButton name="active-true"
                                 inputId="active-true"
                                 data-testid="products-filters-active-true"
                                 value="true"
                                 v-model="store.query.filter.is_active" />
                    <label for="active-true" class="cursor-pointer">Only Active</label>
                </div>
                <div class="field-radiobutton">
                    <RadioButton name="active-false"
                                 inputId="active-false"
                                 data-testid="products-filters-active-false"
                                 value="false"
                                 v-model="store.query.filter.is_active" />
                    <label for="active-false" class="cursor-pointer">Only Inactive</label>
                </div>

            </VhFieldVertical>

            <VhFieldVertical >
                <template #label>
                    <b>Trashed:</b>
                </template>

                <div class="field-radiobutton">
                    <RadioButton name="trashed-exclude"
                                 inputId="trashed-exclude"
                                 data-testid="products-filters-trashed-exclude"
                                 value=""
                                 v-model="store.query.filter.trashed" />
                    <label for="trashed-exclude" class="cursor-pointer">Exclude Trashed</label>
                </div>
                <div class="field-radiobutton">
                    <RadioButton name="trashed-include"
                                 inputId="trashed-include"
                                 data-testid="products-filters-trashed-include"
                                 value="include"
                                 v-model="store.query.filter.trashed" />
                    <label for="trashed-include" class="cursor-pointer">Include Trashed</label>
                </div>
                <div class="field-radiobutton">
                    <RadioButton name="trashed-only"
                                 inputId="trashed-only"
                                 data-testid="products-filters-trashed-only"
                                 value="only"
                                 v-model="store.query.filter.trashed" />
                    <label for="trashed-only" class="cursor-pointer">Only Trashed</label>
                </div>

            </VhFieldVertical>


        </Sidebar>

    </div>
</template>
