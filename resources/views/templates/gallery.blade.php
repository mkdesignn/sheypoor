<style>
    .modal.fade.uploader.in{
        padding:0px !important;
        background-color:rgba(42,42,42,.3);
    }

    .uploader .modal-dialog{
        width: 90%;
        margin: 20px auto auto;
    }

    .uploader .modal-header{
        border-bottom:none;
        padding-bottom:2px;
    }

    .uploader .nav-tabs>li>a{
        border-radius:1px;
    }

    .dropzone{
        border:2px dashed rgba(0, 0, 0, .3);
        margin:20px;
    }

    .uploader .file_container{
        position: relative;
        display: inline-block;
        width: 160px;
        height: 140px;
        box-shadow: 0px 0px 2px 2px rgba(42,42,42,.1);
        margin: 15px;

    }

    .uploader .file_wrapper{
        width: 160px;
        display: inline-block;
        height: 140px;
        position: relative;
        overflow: hidden;
    }

    .uploader .file_wrapper.activate:after{
        position: absolute;
        content: '\e004';
        font-family: "icomoon";
        top: 0px;
        right: 0px;
        background-color: #4995b7;
        width: 25px;
        height: 22px;
        color: #fff;
        padding: 0px 6px;
        border-bottom-left-radius: 3px;
    }

    .uploader .file_wrapper.filter{
        filter:blur(1px);
    }

    .uploader .file_wrapper.activate{
        box-shadow:0px 0px 2px 2px rgb(30, 140, 190);
    }

    .uploader .file_size_wrapper{
        position: absolute;
        top: -35px;
        left: 0px;
        z-index: 1000;
        background-color: #626262;
        border-radius: 3px;
    }

    .uploader .file_size{
        overflow: hidden;
        display: flex;
        border-radius: 3px;
    }

    .uploader .file_size_wrapper:after{
        content:'';
        width:0px;
        height:0px;
        border-right:5px solid transparent;
        border-left:5px solid transparent;
        border-top:5px solid #626262;
        position:absolute;
        left: 8px;
        bottom: -4px;
    }

    .uploader_file_info{
        padding:16px;
        width: 20%;
        float: right;
        border-left: 1px solid rgba(42,42,42,.1);
        background-color: #f7f7f7;
    }

    .uploader_file_info p{
        text-align:right;
    }

    .uploader .thumbnails{
        background-color: #626262;
        color: #fff;
        font-size: smaller;
        border-right: 1px solid #797979;
        padding: 5px;
    }

    .uploader .thumbnails:hover{
        transition: all .3s ease;
        background-color:#929292;
        cursor: pointer;
    }

    .thumbnails.selected_size{
        background-color:#929292;
    }

    .remove_image{
        position:absolute;
        top:0px;
        left:0px;
        z-index: 1000;
        background-color: white;
        padding: 6px 9px 1px 7px;
        border-bottom-right-radius: 5px;
        font-size: smaller;
        border-right: 1px solid #b5b5b5;
        border-bottom: 1px solid #888888;
        cursor:pointer;
        opacity:.5;
        -webkit-transition: all .3s;
        -moz-transition: all .3s;
        -ms-transition: all .3s;
        -o-transition: all .3s;
        transition: all .3s;
    }

    .remove_image:hover{
        -webkit-transition: all .3s;
        -moz-transition: all .3s;
        -ms-transition: all .3s;
        -o-transition: all .3s;
        transition: all .3s;
        opacity:1;
    }
</style>
<template id="gallery">
    <div class="gallery_wrapper">
        <div class="modal fade uploader" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" style="padding:0px !important;">
            <div class="modal-dialog  modal-lg" role="document">
                <div class="modal-content" style="border-radius: 2px;">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" style="float:left;" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">آپلود</h4>
                    </div>
                    <div class="modal-body" style="padding-right:3px;padding-left:0px;">
                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs" role="tablist">
                            <li role="presentation" style="float:right" v-bind:class="{active: active_file_tab}" class="active"><a href=".show_upload" aria-controls="upload" role="tab" data-toggle="tab">آپلود</a></li>
                            <li role="presentation" style="float:right" v-bind:class="{active: !active_file_tab}" ><a href=".show_gallery" v-on:click="getGallery" aria-controls="show" role="tab" data-toggle="tab">نمایش</a></li>
                        </ul>

                        <!-- Tab panes -->
                        <div class="tab-content" style="height:inherit">
                            <div role="tabpanel"  class="tab-pane active show_upload" v-bind:class="{active: active_file_tab}" style="position:relative;height:inherit" id="upload">
                                {!! Form::open(["url"=>action('GalleryController@postUpload'), "class"=>"dropzone", "maxfilesize"=>"1000", "id"=>"dropzone", "style"=>"height:100%;"]) !!}
                                <input type="file" name="file" style="display:none;" />
                                {!! Form::close() !!}
                            </div>
                            <div role="tabpanel" class="tab-pane show_gallery" v-bind:class="{active: !active_file_tab}" id="show">
                                <div class="uploader_file_info">
                                    <p>@{{file_name}}</p>
                                    <p>@{{file_created_date}}</p>
                                    <p>@{{file_size}}</p>
                                    <p>@{{file_dimensions}}</p>
                                </div>
                                <div class="files_wrapper" style="width: 80%;float: left;">
                                    <div class="uploader_tools_wrapper" style="padding:12px;overflow:auto;">
                                        <input type="text" placeholder="جستجو" value="" v-model="searched" v-on:keyup="search" style="width: 16%;height: 30px;font-size: smaller;"/>
                                    </div>
                                    <upload_file_wrapper :selected_file="selected_file"></upload_file_wrapper>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer" style="clear:both;">
                        <button type="button" class="btn btn-primary" v-on:click="useFile">استفاده از فایل</button>
                    </div>
                </div>
            </div>
        </div>
        <a href="javascript:void(0)" class="uploader_modal btn btn-primary" v-bind:style="style" v-on:click="showModal" style="font-size: smaller;float:left;">
            @{{ ( button_name != undefined ) ? button_name : استفاده از گالری}}
        </a>
    </div>
</template>

<template id="upload_file_wrapper">
    <span class="file_container" v-for="file in $parent.files" v-show="file.visible == true">
            <span class="file_size_wrapper" transition="fade" v-show=" file.show_size == true && $parent.selected_file.length > 0 ">
                <span class="file_size">
                    <span class='thumbnails' v-on:click="selectSize(file.name, 'thumbnail_large', $event)"
                          v-show="file.thumbnail_large == true">LG</span>

                    <span class='thumbnails' v-on:click="selectSize(file.name, 'thumbnail_big', $event)"  v-show="file.thumbnail_big == true">BG</span>
                    <span class='thumbnails' v-on:click="selectSize(file.name, 'thumbnail_small', $event)"  v-show="file.thumbnail_small == true">SM</span>
                    <span class='thumbnails' v-on:click="selectSize(file.name, 'thumbnail_extra_small', $event)"  v-show="file.thumbnail_extra_small == true">XS</span>
                </span>
            </span>
            @include("_partials.loading")
            <span class='remove_image' v-on:click='removeImage(file.id)'><span class='icomoon-uniE005'></span></span>
            <span class="file_wrapper" v-bind:class="{activate:file.is_active, filter:file.removeImage}" v-on:click="toggleCheck($index)">
                @{{{filterFiles(file)}}}
            </span>
        </span>
</template>
