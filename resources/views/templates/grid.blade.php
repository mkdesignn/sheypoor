<template id="post-template">
    <tr v-for="(key, row) in post">
        <td v-for="j in filter_row(key, row)" track-by="$index">
            @{{{j}}}
        </td>
    </tr>
</template>
<template id="search-template">
    <div class="col-md-3">
        <div class="form-group">
            <div class="input-group">
                <input type="text" v-model="search" v-on:keyup="keyup_search" style="font-size:smaller;" autocomplete="off" class="form-control search" placeholder="جستجو">
                    <span class="input-group-addon">
                        <i class="icomoon-uniE015"></i>
                    </span>
            </div>
        </div>
    </div>
</template>
<template id="row_per_page">
    <div class="col-md-2 pull-right">
        <div class="form-group">
            <div class="input-group">
                <select class="row_per_page form-control" v-model="changed_value" v-on:change="onChange">
                    <option selected value="5">5</option>
                    <option value="10">10</option>
                    <option value="15">15</option>
                    <option value="20">20</option>
                    <option value="-1">همه</option>
                </select>
                    <span class="input-group-addon">
                        <i class="icomoon-uniE015"></i>
                    </span>
            </div>
        </div>
    </div>
</template>
<template id="paginate">
    <div v-html="paginate"></div>
</template>