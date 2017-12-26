<template>
    <div class="select2_wrapper">
        <slot name="select">
            <select>
                <option :value="option.key" v-for="option in options">
                    {{option.value}}
                </option>
            </select>
        </slot>
    </div>
</template>

<script>

    export default{
        props: {
                'options': '',
                'value': '',
                'name': ''
        },
        mounted: function () {
            console.log("im coool");
            console.log(this.$el);
            console.log(this.value);
            var vm = this
            jQuery(this.$el).find("select")
            // init select2
                .select2({ data: this.options, width: '100%', height:'32px', tags: true })

                .val(this.value)
                .trigger('change')
                // emit event on change.
                .on('change', function () {

//                    if( typeof this.value === "string" )
//                        jQuery(this).append("<option value='"+this.value+"'>"+this.value+"</option>");

                    console.log(jQuery(this));
                    vm.$emit('input', this.value)
                })
        },
        watch: {
            value: function (value) {
                console.log(value);
                // update value
                jQuery(this.$el).val(value)
            },
            options: function (options) {
                // update options
                jQuery(this.$el).empty().select2({ data: options })
            }
        },
        destroyed: function () {
            jQuery(this.$el).off().select2('destroy')
        }
    }

</script>

<style>
    .select2-selection.select2-selection--single{
        height:100% !important;
    }

    .select2.select2-container.select2-container--default{
        height:32px;
    }
</style>