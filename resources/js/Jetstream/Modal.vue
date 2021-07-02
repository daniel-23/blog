<template>

    <div class="modal fade" :id="idModal" v-show="show">
        <div class="modal-dialog">
            <div class="modal-content">
                <slot v-if="show"></slot>
            </div>
        </div>
    </div>
</template>

<script>
import { onMounted, onUnmounted } from "vue";

export default {
        emits: ['close'],

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

        watch: {
            show: {
                immediate: true,
                handler: (show) => {
                    if (show) {
                        document.body.style.overflow = 'hidden'
                    } else {
                        document.body.style.overflow = null
                    }
                }
            }
        },

        setup(props, {emit}) {
            const close = () => {
                if (props.closeable) {
                    emit('close')
                }
            }

            const closeOnEscape = (e) => {
                if (e.key === 'Escape' && props.show) {
                    close()
                }
            }

            onMounted(() => document.addEventListener('keydown', closeOnEscape))
            onUnmounted(() => {
                document.removeEventListener('keydown', closeOnEscape)
                document.body.style.overflow = null
            })

            return {
                close,
            }
        },

        computed: {
            maxWidthClass() {
                return {
                    'sm': 'sm:max-w-sm',
                    'md': 'sm:max-w-md',
                    'lg': 'sm:max-w-lg',
                    'xl': 'sm:max-w-xl',
                    '2xl': 'sm:max-w-2xl',
                }[this.maxWidth]
            }
        }
    }
</script>
