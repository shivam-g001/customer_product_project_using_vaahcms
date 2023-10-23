<script setup>
import {vaah} from '../../../vaahvue/pinia/vaah'
import {useProductStore} from '../../../stores/store-products'
import {useTaxonomyStore} from "../../../../../../../vendor/webreinvent/vaahcms/Vue/vaahtwo/stores/store-taxonomies";
import {useBlogStore} from "../../../stores/store-blogs";
import {useRoute} from "vue-router";

const store = useProductStore();
const store2 = useBlogStore();
const useVaah = vaah();

const getSeverity = (name) => {
    if (name === 'Electrical') {
        return 'danger';
    } else if (name === 'Electronics' +
        '') {
        return 'warning';
    } else {
        return 'success';
    }
};


</script>

<template>


    <div v-if="store.list">
        <!--table-->
        <DataTable :value="store.list.data"
                   dataKey="id"
                   class="p-datatable-sm p-datatable-hoverable-rows"
                   v-model:selection="store.action.items"
                   stripedRows
                   responsiveLayout="scroll">

            <Column selectionMode="multiple"
                    v-if="store.isViewLarge()"
                    headerStyle="width: 3em">
            </Column>

            <Column field="id" header="ID" :style="{width: store.getIdWidth()}" :sortable="true">
            </Column>

            <Column field="name" header="Name"
                    :sortable="true">

                <template #body="prop">
                    <Badge v-if="prop.data.deleted_at"
                           value="Trashed"
                           severity="danger"></Badge>
                    {{ prop.data.name }}
                </template>

            </Column>
            <Column field="email" header="Email"
                    :sortable="true">
                <template #body="prop">
                    {{ prop.data.email }}
                </template>
            </Column>
            <!---->
            <Column field="taxonomy.name" header="Status"
                    :sortable="true" value="">
            </Column>

            <Column  header="Country" :sortable="true">
                <template #body="prop">
                    <Tag severity="success">{{prop.data.country_name}}</Tag>
                    <span v-if="prop.data.state_name">
            ->{{ prop.data.state_name }}
        </span>
                </template>
            </Column>




            <Column field="blog.name" header="Category" :sortable="true">
                <template #body="prop">

                  <span v-for="(blog, index) in prop.data.blog" :key="index">
<!--      {{ blog.name }}-->

                 <Tag :severity="getSeverity(blog.name)">{{ blog.name }}</Tag>
         <!--        <Tag severity="success">{{ blog.name }}</Tag>-->
                  <span v-if="index < prop.data.blog.length - 1">, </span>
                </span>
                </template>
            </Column>


            <Column field="updated_at" header="Updated"
                    v-if="store.isViewLarge()"
                    style="width:150px;"
                    :sortable="true">

                <template #body="prop">
                    {{ useVaah.toLocalTimeShortFormat(prop.data.updated_at) }}
                </template>

            </Column>

            <Column field="is_active" v-if="store.isViewLarge()"
                    :sortable="true"
                    style="width:100px;"
                    header="Is Active">
                <!--class="p-inputswitch-sm"-->
                <template #body="prop">
                    <InputSwitch v-model.bool="prop.data.is_active"
                                 data-testid="products-table-is-active"
                                 v-bind:false-value="0" v-bind:true-value="1"
                                 class="p-inputswitch-sm"
                                 @input="store.toggleIsActive(prop.data)">
                    </InputSwitch>
                </template>

            </Column>

            <Column field="actions" style="width:150px;"
                    :style="{width: store.getActionWidth() }"
                    :header="store.getActionLabel()">

                <template #body="prop">
                    <div class="p-inputgroup ">

                        <Button class="p-button-tiny p-button-text"
                                data-testid="products-table-to-view"
                                v-tooltip.top="'View'"
                                @click="store.toView(prop.data)"
                                icon="pi pi-eye"/>

                        <Button class="p-button-tiny p-button-text"
                                data-testid="products-table-to-edit"
                                v-tooltip.top="'Update'"
                                @click="store.toEdit(prop.data)"
                                icon="pi pi-pencil"/>

                        <Button class="p-button-tiny p-button-danger p-button-text"
                                data-testid="products-table-action-trash"
                                v-if="store.isViewLarge() && !prop.data.deleted_at"
                                @click="store.itemAction('trash', prop.data)"
                                v-tooltip.top="'Trash'"
                                icon="pi pi-trash"/>


                        <Button class="p-button-tiny p-button-success p-button-text"
                                data-testid="products-table-action-restore"
                                v-if="store.isViewLarge() && prop.data.deleted_at"
                                @click="store.itemAction('restore', prop.data)"
                                v-tooltip.top="'Restore'"
                                icon="pi pi-replay"/>


                    </div>

                </template>


            </Column>


        </DataTable>
        <!--/table-->

        <!--paginator-->
        <Paginator v-model:rows="store.query.rows"
                   :totalRecords="store.list.total"
                   :first="(store.query.page-1)*store.query.rows"
                   @page="store.paginate($event)"
                   :rowsPerPageOptions="store.rows_per_page"
                   class="bg-white-alpha-0 pt-2">
        </Paginator>
        <!--/paginator-->

    </div>

</template>



