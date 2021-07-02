<template>
    <div class="card">
        <jet-section-title>
            <template #title><slot name="title"></slot></template>
            <template #description><slot name="description"></slot></template>
        </jet-section-title>
        
        <form @submit.prevent="$emit('submitted')" :class="formClass">
            <div class="card-body">
                <slot name="form"></slot>
            </div>
            

            <div class="card-footer" v-if="hasActions">
                <slot name="actions"></slot>
            </div>
        </form>
    </div>
</template>

<script>
    import JetSectionTitle from './SectionTitle'

    export default {
        emits: ['submitted'],

        props: {
            formClass: {
                default: ''
            },
        },

        components: {
            JetSectionTitle,
        },

        computed: {
            hasActions() {
                return !! this.$slots.actions
            }
        }
    }
</script>
