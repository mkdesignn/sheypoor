<template>
    <div class="grid_wrapper">
        <notification v-on:notify-handler="notifyHandler" :notify_danger="notify_danger"  :notify_success="notify_success"
                      :notify_alarm="notify_alarm" :notify_warning="notify_warning" :notify_text="notify_text"></notification>
        <div class="grid_header" style="overflow:hidden;">
            <div class="col-md-3 align_right">
                <div class="form-group">
                    <label for="search">جستجو</label>
                    <div class="input-group" id="search">
                        <input v-model="search" type="text" class="form-control"/>
                        <span class="input-group-addon icomoon-uniE04B" style="font-size: large;"></span>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-md-push-6 align_right">
                <div class="form-group">
                    <label for="row_per_page">تعداد در صفحه</label>
                    <div class="input-group" id="row_per_page">
                        <select v-model="row_per_page" @change="changeRowPerPage" class="form-control">
                            <option value="10">10</option>
                            <option value="20">20</option>
                            <option value="50">50</option>
                            <option value="100">100</option>
                        </select>
                        <span class="input-group-addon icomoon-uniE04B" style="font-size: large;"></span>
                    </div>
                </div>
            </div>
        </div>
        <div class="grid_content" style="clear:both;overflow:hidden;">
            <div class="col-md-12" v-loading="loading.init">
                <!--<pulse-loader :loading="loading.init" :color="loading.color" :size="loading.size"></pulse-loader>-->
                <table class="data_grid">
                    <thead>
                        <tr>
                            <td v-for="h in parseHead">
                                {{h}}
                            </td>
                        </tr>
                    </thead>
                    <tbody>
                       <tr v-for="(row, index) in rows">
                           <td  v-for="cell in Object.keys(parseHead)">
                               <span v-if="cell !== 'operation'">{{traverseCell(cell, row)}}</span>
                               <span v-else>
                                   <a v-for="button in $parent.buttons" target="_blank" :href="button.url.replace('{id}', row.id)"
                                      :class="button.btnClass" v-on:click="showNotification($event, button.action, button.confirm_text, row.fake_id, button.url.replace('{id}', row.id))" :style="button.style">{{button.label}}</a>
                               </span>
                           </td>
                       </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="grid_footer" style="overflow:hidden;">
            <div class="col-md-12">
                <paginate
                    :page-count="last_page"
                    :page-range="3"
                    :prev-text="'Prev'"
                    :next-text="'Next'"
                    :click-handler="changePaginate"
                    :container-class="'pagination'">
                </paginate>
            </div>
        </div>
    </div>
</template>

<script>

    import Paginate from 'vuejs-paginate';
    import loadings from './loading-dirctive.vue';
    import notification from './notification.vue';
    axios.defaults.headers['X-Requested-With'] = 'XMLHttpRequest';

    export default{
        data: function(){
            return {
                row_per_page: 10,
                search: '',
                rows: '',
                total: 0,
                page_id: 0,
                last_page:0,
                loading: {
                    init: false,
                    size: '20px',
                    color: 'rgba(42,42,42,.3)'
                },
                notify_danger:false,
                notify_success:false,
                notify_alarm:false,
                notify_warning: false,
                notify_text:"",
                selected_row: 0,
                request_link: ''
            }
        },
        components:{
            paginate: Paginate,
            notification: notification
        },
        props: {
            head:'',
            url: '',
            created_record: ''
        },
        watch:{
            search: function(){
                this.fillGrid(1);
            },
            created_record: function(createdRecord){
                this.rows.push(createdRecord);
            },
            rows: function(rows){
                var vm = this;
                rows.forEach(function(value, index){
                    value.fake_id = ( (vm.page_id * vm.row_per_page) - vm.row_per_page ) + index + 1;
                })
            }
        },
        computed: {
            parseHead: function(){

                if( Object.keys(this.$parent.buttons).length > 0 )
                    this.head['operation'] =  "تنضیمات";

                return this.head;
                //return JSON.parse(this.head.toString());
            }
        },
        methods:{
            showNotification: function(event, action, confirm_text, row_id, request_link, fill_data){

                if( action === 'confirm' )
                {
                    event.preventDefault();
                    this.notify_alarm = true;
                    this.selected_row = this.rows[row_id];
                    this.notify_text = confirm_text;
                    this.request_link = request_link;
                    this.notify_success = false;
                    return false;

                } else if( action === "ajax-request" ){

                    event.preventDefault();
                    var vm = this;
                    axios.get(this.request_link).then(function(response){
                        vm.$parent[fill_data] = response.data;
                    });

                }

            },
            notifyHandler: function(){
                var vm = this;
                axios.get(this.request_link).then(function(response){
                    vm.notify_alarm = false;
                    vm.notify_success = true;
                    vm.notify_text = "عملیات با موفقیت انجام شد .";
                    window.setTimeout(function(){
                        vm.notify_success = false;
                    }, 1000);
                    vm.fillGrid(1);
                })
            },
            traverseCell: function(cell, row){
                if( cell.indexOf(".") >= 0 ){

                    var cell_traverse = cell.split("."),
                        nested_cell = row;

                    cell_traverse.forEach(function(value, key){
                        nested_cell = nested_cell[value];
                    });

                    return nested_cell;
                } else
                     return row[cell];
            },
            changePaginate: function(pageNum){
                this.page_id = pageNum;
                this.fillGrid(pageNum);
            },
            fillGrid: function(page_num){

                var vm = this;
                vm.loading.init = true;
                axios.get(this.url,{
                    params:{
                        page: page_num,
                        row_per_page: this.row_per_page,
                        search: this.search
                    }
                }).then(function(response){

                    vm.rows = response.data[0].data;
                    vm.last_page = response.data[0].last_page;
                    vm.total = response.data[0].total;
                    vm.loading.init = false;
                });
            },
            changeRowPerPage: function(){
                this.page_id = 1;
                this.fillGrid(1);
            }
        },
        mounted: function(){
            this.page_id = 1;
            this.fillGrid(1);
        }
    }
</script>