<script>
    import Vue from 'vue';
    Vue.directive('loading', {
        bind: function(el, obj, vnode, oldnode) {

            oldnode.data.__$el = jQuery(el)
            oldnode.data.__originalPosition = oldnode.data.__$el.css('position')
            oldnode.data.__$loaderEl = jQuery('<div class="loading"> <div class="loading--inner"> <span></span><span></span><span></span> </div> </div>')
        },
        update: function(el, obj, vnode, oldnode) {

            if( oldnode.data.__$el === undefined ){
                oldnode.data.__$el = jQuery(el);
                oldnode.data.__originalPosition = oldnode.data.__$el.css('position')
                oldnode.data.__$loaderEl = jQuery('<div class="loading"> <div class="loading--inner"> <span></span><span></span><span></span> </div> </div>')
            }

            if( obj.value ){

                oldnode.data.__$el.css('position', 'relative')
                oldnode.data.__$loaderEl.addClass('loading--trans-bg').prependTo(oldnode.data.__$el)
            } else {
                oldnode.data.__$el.css('position', oldnode.data.__originalPosition)
                    .find('.loading').remove()
            }
//            if (value) {
//                this.__$el.style('position', 'relative')
//                this.__$loaderEl.addClass('loading--trans-bg').prependTo(this.el)
//            } else {
//                this.__$el.style('position', this.__originalPosition)
//                        .find('.loading').remove()
//            }
        },
        unbind: function() {
//            delete this.__$el
//            delete this.__originalPosition
//            delete this.__$loaderEl
        }
    })
</script>

