<template>
    <div class="notification_wrapper">
        <transition name="slide">
            <div class="notification_success" style="position: fixed; top: 100px; left: 0px; padding: 10px; color: rgb(255, 255, 255); border-radius: 2px; background: #1BBC9B; z-index: 1000000; font-size: 11px;" v-show=" notify_success === true "> {{ notify_text }} </div>
        </transition>
        <transition name="slide">
            <div class="notification_danger" style="position: fixed; top: 100px; left: 0px; padding: 10px; color: rgb(255, 255, 255); border-radius: 2px; background: rgba(220, 76, 76, 0.74); z-index: 1000000; font-size: 11px;" v-show=" notify_warning === true "> {{ notify_text }} </div>
        </transition>
        <transition name="slide">
            <div class="notification_danger" style="position: fixed; top: 100px; left: 0px; padding: 10px; color: rgb(255, 255, 255); border-radius: 2px; background: rgba(220, 76, 76, 0.74);  z-index: 1000000; font-size: 11px;" v-show=" notify_alarm === true ">
                <p>{{notify_text}}</p>
                <a href="javascript:void(0)" class="btn purple-plum" v-on:click="hideAlarm" style="font-size:smaller;">خیر</a>
                <a style="font-size:smaller;" v-on:click="callYes" href="javascript:void(0)" class="btn green-haze">بله</a>
            </div>
        </transition>
    </div>
</template>

<script>
    export default{
        props:{
            notify_danger:false,
            notify_success:false,
            notify_alarm:false,
            notify_warning: false,
            notify_text:""
        },
        methods: {
            hideAlarm: function () {
                this.$parent.notify_alarm = false;
            },
            callYes: function () {

                this.$emit("notify-handler");
            }
        },
        watch: {
//            notify_success: function (notify_success) {
//                var vm = this;
//                if (notify_success == true) {
//                    window.setTimeout(function () {
//                        vm.notify_success = false;
//                    }, 3000)
//                }
//            }
        }
    }
</script>
