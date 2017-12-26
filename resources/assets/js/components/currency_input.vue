<template>
    <div>
        <input type="text" v-bind="attr" v-model="input" class="form-control"/>
    </div>
</template>

<script>
    export default{
        data: function(){
          return {
              input: ''
          }
        },
        props: {
            attr:{

            }
        },
        watch:{
            input: function(input){
                var new_price = input.toString().replace(/,/gi, '');
                this.input = new_price.replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                this.$emit("pass-data", new_price)
            }
        },
        mounted: function(){
            console.log(this.attrr);
        }
    }
</script>