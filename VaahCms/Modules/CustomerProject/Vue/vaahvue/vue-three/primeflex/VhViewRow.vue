<script setup>
import {vaah} from '../../pinia/vaah.js'

const props = defineProps({
    label: {
        type: String,
        default: null
    },
    label_width: {
        type: String,
        default: '150px'
    },
    value:{
        default: null,
    },
    type: {
        type: String,
        default: 'text'
    },
    can_copy:{
        type: Boolean,
        default: false
    }
})

//['label', 'value', 'type']

</script>
<template>
    <tr>
        <td :style="{width: label_width}"><b>{{vaah().toLabel(label)}}</b></td>
        <template v-if="can_copy">
            <td v-html="value"></td>
            <td style="width: 40px;">
                <Button icon="pi pi-copy" @click="vaah().copy(value)" class=" p-button-text"></Button>
            </td>
        </template>
        <template v-else-if="type==='user'">
            <td colspan="2" >

                <template v-if="typeof value === 'object' && value !== null">
                    <Button  @click="vaah().copy(value.id)"  class="p-button-outlined p-button-secondary p-button-sm">
                        {{value.name}}
                    </Button>
                </template>

            </td>
        </template>

        <template v-else-if="type==='name'">
            <td colspan="2" >

                <template v-if="typeof value === 'object' && value !== null">

                    <Tag severity="primary">{{ value.name }}</Tag>

                </template>

            </td>
        </template>
        <template v-else-if="type==='count'">
            <td colspan="2" >

                <template v-if="value !== null">

                    <Tag severity="primary">{{ value }}</Tag>

                </template>

            </td>
        </template>
        <template v-else-if="type === 'blog'">
            <td colspan="2">
                <template v-if="typeof value === 'object' && value !== null">
             <span v-for="(blog, index) in value" :key="index">
                  <Tag severity="success">{{ blog.name }}</Tag>
             <span v-if="index < value.length - 1">, </span>
             </span>
                </template>
            </td>
        </template>
<!--        <template v-else-if="type === 'country'">-->
<!--            <td colspan="2">-->
<!--                <template v-if="typeof value === 'object' && value !== null">-->
<!--      <span v-for="(taxonomy, index) in value" :key="index">-->

<!--          <Tag severity="success">{{ taxonomy.name }}</Tag>-->
<!--          &lt;!&ndash; Add a comma or separator if needed between names &ndash;&gt;-->
<!--        <span v-if="index < value.length - 1">, </span>-->
<!--      </span>-->
<!--                </template>-->
<!--            </td>-->
<!--        </template>-->

        <template v-else-if="type==='yes-no'">
            <td colspan="2">
                <Tag value="Yes" v-if="value===1" severity="success"></Tag>
                <Tag v-else value="No" severity="danger"></Tag>
            </td>
        </template>
        <template v-else>
            <td  colspan="2" v-html="value"></td>
        </template>

    </tr>
</template>
