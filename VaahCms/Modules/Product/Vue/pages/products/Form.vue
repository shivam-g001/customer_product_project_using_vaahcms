<script setup>
import {onMounted, ref, watch,computed
} from "vue";
import { useProductStore } from '../../stores/store-products'

import VhField from './../../vaahvue/vue-three/primeflex/VhField.vue'
import {useRoute} from 'vue-router';
import {useBlogStore} from "../../stores/store-blogs";


const store = useProductStore();
const store2 = useBlogStore();
const route = useRoute();

onMounted(async () => {
    if(route.params && route.params.id)
    {
        await store.getItem(route.params.id);
    }

    await store.getFormMenu();
});
const stateData = computed(() => store.assets.state_data);

const filteredStateData = computed(() => {
    if (store.item.country_id) {
        return stateData.value.filter((state) => state.parent_id === store.item.country_id);
    } else {
        return [];
    }
});

const filterStateData = () => {
    store.item.state_id = null;
};

watch(() => store.item?.country_id, () => {
    filteredStateData.value = filteredStateData.value; // This triggers the computed property to update
});




//--------form_menu
const form_menu = ref();
const toggleFormMenu = (event) => {
    form_menu.value.toggle(event);
};

//--------/form_menu

</script>
<template>

    <div class="col-6" >

        <Panel class="is-small">

            <template class="p-1" #header>


                <div class="flex flex-row">
                    <div class="p-panel-title">
                        <span v-if="store.item && store.item.id">
                            Update
                        </span>
                        <span v-else>
                            Create
                        </span>
                    </div>

                </div>


            </template>

            <template #icons>


                <div class="p-inputgroup">
                    <Button label="Save"
                            class="p-button-sm"
                            v-if="store.item && store.item.id"
                            data-testid="products-save"
                            @click="store.itemAction('save')"
                            icon="pi pi-save"/>

                    <Button label="Create & New"
                            v-else
                            @click="store.itemAction('create-and-new')"
                            class="p-button-sm"
                            data-testid="products-create-and-new"
                            icon="pi pi-save"/>


                    <!--form_menu-->
                    <Button
                        type="button"
                        @click="toggleFormMenu"
                        class="p-button-sm"
                        data-testid="products-form-menu"
                        icon="pi pi-angle-down"
                        aria-haspopup="true"/>

                    <Menu ref="form_menu"
                          :model="store.form_menu_list"
                          :popup="true" />
                    <!--/form_menu-->


                    <Button class="p-button-primary p-button-sm"
                            icon="pi pi-times"
                            data-testid="products-to-list"
                            @click="store.toList()">
                    </Button>
                </div>



            </template>


            <div v-if="store.item" class="pt-2">

                <VhField label="Name">
                    <InputText class="w-full"
                               name="products-name"
                               data-testid="products-name"
                               @update:modelValue="store.watchItem"
                               v-model="store.item.name"/>
                </VhField>

                <VhField label="Slug">
                    <InputText class="w-full"
                               name="products-slug"
                               data-testid="products-slug"
                               disabled
                               v-model="store.item.slug"/>
                </VhField>

                <VhField label="Email">
                    <InputText class="w-full"
                               name="products-email"
                               data-testid="products-email"
                               v-model="store.item.email"/>
                </VhField>

                <VhField label="Product Status">
                    <Dropdown class="w-full"
                              v-model="store.item.taxonomy_id"
                              :options="store.assets.taxonomy_training_data"
                              optionLabel="name"
                              placeholder="select status"
                              optionValue="id"
                              name="products-category"
                              data-testid="products-category"
                    />
                </VhField>

                <VhField label="Is Active">
                    <InputSwitch v-bind:false-value="0"
                                 v-bind:true-value="1"
                                 class="p-inputswitch-sm"
                                 name="products-active"
                                 data-testid="products-active"
                                 v-model="store.item.is_active"/>
                </VhField>

                <VhField label="Product Category">
                    <MultiSelect class="w-full"
                                 v-model="store.item.blog_id"
                                 :options="store.assets.blog"
                                 optionLabel="name"
                                 input-id="id"
                                 option-value="id"
                                 display="chip"
                                 placeholder="Select category"
                    ></MultiSelect>
                </VhField>

                <VhField label="Product Country">
                    <Dropdown class="w-full"
                              v-model="store.item.country_id"
                              :options="store.assets.country_data"
                              optionLabel="name"
                              placeholder="select Country"
                              optionValue="id"
                              @change="filterStateData"
                              name="products-category"
                              data-testid="products-category"
                    />
                    {{store.item.country_id}}
                </VhField>
                <VhField label="Product State">
                    <Dropdown class="w-full"
                              v-model="store.item.state_id"
                              :options="filteredStateData"
                              optionLabel="name"
                              placeholder="select Countary"
                              optionValue="id"
                              name="products-category"
                              :disabled="!store.item.country_id"
                              data-testid="products-category"
                    />
                    {{store.item.state_id}}
                </VhField>


            </div>
        </Panel>

    </div>

</template>
