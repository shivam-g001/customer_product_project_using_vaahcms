<script setup>
import { vaah } from '../../../vaahvue/pinia/vaah'
import { useCustomerStore } from '../../../stores/store-customers'
import router from "../../../../../Product/Vue/routes/router";

const store = useCustomerStore();
const useVaah = vaah();

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
                    {{prop.data.name}}
                </template>

            </Column>
             <Column header="Name" :sortable="true">

                 <template #body="prop">
<!--                     <Avatar :image="store.assets.images.data[0].url" class="absolute" shape="circle" />-->
<!--                     <Avatar :image="prop.data.image_url" class="absolute" shape="circle" />-->
                     {{prop.data.name}}
                     <Badge v-if="prop.data.deleted_at"
                            value="Trashed"
                            severity="danger"></Badge>
                 </template>

             </Column>


             <Column field="productCount" header="Products Count" :sortable="true"  v-if="store.isViewLarge()">
                 <template v-slot:body="prop">
                     <Tag  severity="secondary"   style="margin-right: 8px;cursor: pointer;"  @click="store.redirectToProductTable(prop.data.slug)"
                            >{{prop.data.products_count}}</Tag>
                     <Button class="click_customer " icon="pi pi-plus" @click="store.redirectToProductPage(prop.data)" severity="success"  rounded />
                 </template>
             </Column>

             <Column  header="Country" :sortable="true"  v-if="store.isViewLarge()" >
                 <template #body="prop">
                     <Button severity="info" rounded>{{prop.data.country_name}}</Button>
                 </template>
             </Column>

             <Column field="updated_at" header="Updated"
                        v-if="store.isViewLarge()"
                        style="width:150px;"
                        :sortable="true">
                 <template #body="prop">
                        {{useVaah.toLocalTimeShortFormat(prop.data.updated_at)}}
                 </template>
             </Column>

            <Column field="is_active" v-if="store.isViewLarge()"
                    :sortable="true"
                    style="width:100px;"
                    header="Is Active">

                <template #body="prop">
                    <InputSwitch v-model.bool="prop.data.is_active"
                                 data-testid="customers-table-is-active"
                                 v-bind:false-value="0"  v-bind:true-value="1"
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
                                data-testid="customers-table-to-view"
                                :disabled="store.item && store.item.id === prop.data.id"
                                v-tooltip.top="'View'"
                                @click="store.toView(prop.data)"
                                icon="pi pi-eye" />

                        <Button class="p-button-tiny p-button-text"
                                data-testid="customers-table-to-edit"
                                :disabled="store.item && store.item.id === prop.data.id"
                                v-tooltip.top="'Update'"
                                @click="store.toEdit(prop.data)"
                                v-if="store.hasPermission('customerproject-can-update-customer')"
                                icon="pi pi-pencil" />
                        <Button class="p-button-tiny p-button-danger p-button-text"
                                data-testid="customers-table-action-trash"
                                :disabled="!store.hasPermission('customerproject-can-delete-customers')"
                                v-if="store.isViewLarge() && !prop.data.deleted_at"
                                @click="store.itemAction('trash', prop.data)"
                                v-tooltip.top="'Trash'"
                                icon="pi pi-trash" />
                        <Button class="p-button-tiny p-button-success p-button-text"
                                data-testid="customers-table-action-restore"
                                v-if="store.isViewLarge() && prop.data.deleted_at"
                                @click="store.itemAction('restore', prop.data)"
                                v-tooltip.top="'Restore'"
                                icon="pi pi-replay" />
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
