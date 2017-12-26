<template>
    <div class="upload_wrapper">
        <p :style="labelstyle"> {{label}} </p>
        <div class="avatar_wrapper">
            <img class="img img-responsive img-thumbnail" :style="image_style" :src="avatar"/>
        </div>
        <p style="margin-top:10px;text-align:center;">
            <input type="file" v-on:change="selectFile" :id="id" :name="inputname" class="btn btn-primary" style="display:none;" value="انتخاب"/>
            <label :for="id"  class="btn btn-primary">انتخاب</label>
        </p>
    </div>

</template>

<script>

    export default{
        props:{
            'label': '',
            'labelstyle': '',
            'inputname': '',
            'id': '',
            'file': '',
            'height': ''
        },
        mounted(){
            this.avatar = this.file;
            this.image_style.height = this.height;
        },
        data: function(){
            return {
                avatar: '',
                image_style:{
                    width: '100%',
                    height: '100%'
                }
            }
        },
        methods:{
            selectFile(el){
                var vm = this,
                    file = jQuery(el.srcElement)[0].files[0],
                    reader  = new FileReader();

                reader.readAsDataURL(file);
                reader.addEventListener("load", function () {
                    vm.avatar = reader.result;
                    vm.$emit('load', reader.result)
                }, false);
            }
        }
    }

</script>