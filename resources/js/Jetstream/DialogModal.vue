<template>

    <modal :show="show" :max-width="maxWidth" :closeable="closeable" @close="close" :idModal="idModal">
        <div class="modal-header">
            <h4 class="modal-title">
                <slot name="title"></slot>
            </h4>
            <button type="button" class="close" @click="close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <slot name="content"></slot>
        </div>
        <div class="modal-footer justify-content-between">
            <slot name="footer"></slot>
        </div>
    </modal>
</template>

<script>
    import Modal from './Modal'

    export default {
        emits: ['close'],

        components: {
            Modal,
        },

        props: {
            show: {
                default: false
            },
            maxWidth: {
                default: '2xl'
            },
            closeable: {
                default: true
            },
            idModal: {
                default: 'modal-password-confirm'
            },
        },

        methods: {
            close() {
                this.$emit('close')
            },
        }
    }
</script>
