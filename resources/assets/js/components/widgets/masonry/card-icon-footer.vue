<template functional>
    <div :class="['card-footer-icons d-flex', `justify-content-${props.justifyContent}`]">
        <button v-for="button in props.buttons"
                :key="button.icon"
                type="button"
                :title="button.label"
                @click="button.callback && !button.disabled ? button.callback() : null"
                :disabled="button.disabled ? 'true' : undefined"
                :class="['btn btn-link', props.buttonClass, {'btn-link-gray': props.gray}]">
            <icon :name="button.icon"/>
        </button>
    </div>
</template>

<script>
    export default {
        name: "card-icon-footer",
        props: {
            buttonClass: String,
            gray: {
                type: Boolean,
                default: true
            },
            buttons: {
                type: Array,
                required: true,
            },
            justifyContent: {
                type: String,
                default: 'center'
            }
        }
    }
</script>

<style scoped type="text/scss" lang="scss">
    @import '~CSS/includes';

    button {
        cursor: pointer;
        line-height: 14px;
        padding: 12px;
        flex-grow: 1;
        max-width: 150px;
    }

    .card-footer-icons {
        margin: #{-$card-spacer-y} #{-$card-spacer-x};
    }
</style>