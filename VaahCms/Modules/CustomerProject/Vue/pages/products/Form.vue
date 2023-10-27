<script setup>
import {onMounted, ref, watch,} from "vue";
import { useProductStore } from '../../stores/store-products'

import VhField from './../../vaahvue/vue-three/primeflex/VhField.vue'
import {useRoute} from 'vue-router';


const store = useProductStore();
const route = useRoute();

onMounted(async () => {
    if(route.params && route.params.id)
    {
        await store.getItem(route.params.id);
    }

    await store.getFormMenu();
});
let customer = null;


const mapSlugToId = () => {
    const selectedSlug = store.item.customer_slug;
    const customer = store.assets.customer_data.find((c) => c.slug === selectedSlug);


    if (customer) {
        store.item.customer_id = customer.id;
    } else {
        store.item.customer_id = null;
    }
};
if (route.query.customer) {
    customer = route.query.customer;
    store.item.customer_slug=customer;
    mapSlugToId();
}



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

                    <Button class="p-button-sm"
                            v-if="store.item && store.item.id"
                            data-testid="products-view_item"
                            @click="store.toView(store.item)"
                            icon="pi pi-eye"/>

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


            <div v-if="store.item" class="mt-2">

                <Message severity="error"
                         class="p-container-message mb-3"
                         :closable="false"
                         icon="pi pi-trash"
                         v-if="store.item.deleted_at">

                    <div class="flex align-items-center justify-content-between">

                        <div class="">
                            Deleted {{store.item.deleted_at}}
                        </div>

                        <div class="ml-3">
                            <Button label="Restore"
                                    class="p-button-sm"
                                    data-testid="articles-item-restore"
                                    @click="store.itemAction('restore')">
                            </Button>
                        </div>

                    </div>

                </Message>


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
                               v-model="store.item.slug"/>
                </VhField>


                <VhField label="Is Active">
                    <InputSwitch v-bind:false-value="0"
                                 v-bind:true-value="1"
                                 class="p-inputswitch-sm"
                                 name="products-active"
                                 data-testid="products-active"
                                 v-model="store.item.is_active"/>
                </VhField>
                <VhField label="Price">

                    <InputNumber class="w-full"
                        name="products-price"
                        data-testid="products-price"
                        v-model="store.item.price"
                        inputId="stacked-buttons"
                        showButtons
                        mode="currency"
                        currency="INR"
                        style="height: 35px;"
                    />
                </VhField>

                <VhField label="Customer">
                    <AutoComplete name="test-runs-project"
                                  class="w-full"
                                  data-testid="products -customer_id"
                                  v-model="store.item.customer_slug"
                                  option-label = "slug"
                                  dropdown
                                  :suggestions="store.filtered_customers"
                                  @complete="store.search"
                                  @change="store.handleCustomerSelect"
                    />
                </VhField>

                <VhField label="Category">
                    <MultiSelect class="w-full"
                                 v-model="store.item.blog_id"
                                 :options="store.assets.blog_data"
                                 optionLabel="name"
                                 input-id="id"
                                 option-value="id"
                                 display="chip"
                                 placeholder="Select category"
                    ></MultiSelect>
                </VhField>
                <VhField label="Detail">
                    <Editor v-model="store.item.description" editorStyle="height:400px" />
                </VhField>

            </div>
        </Panel>

    </div>

</template>
