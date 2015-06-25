<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css" />
<script src="{{asset('/assets/DCNCMS/jquery.mjs.nestedSortable.js')}}"></script>
<script type="text/javascript">
    $().ready(function(){
        var ns = $('ol.sortable').nestedSortable({
            forcePlaceholderSize: true,
            handle: 'div',
            helper:	'clone',
            items: 'li',
            opacity: .6,
            placeholder: 'placeholder',
            revert: 250,
            tabSize: 25,
            tolerance: 'pointer',
            toleranceElement: '> div',
            isTree: true,
            expandOnHover: 700,
            startCollapsed: true,
            excludeRoot: true,
            change: function(){
                console.log('Relocated item');
            }
        });
    });
    $('#submit').click(function(e){
        arraied = $('ol.sortable').nestedSortable('toArray', {startDepthCount: 0});
        $('input#pageOrder').val( JSON.stringify(arraied) );
    });
</script>
<style>
    .placeholder {
        outline: 1px dashed #4183C4;
    }

    ol.sortable,ol.sortable ol {
        list-style-type: none;
        !important;
    }

    .sortable li div {
        border: 1px solid #d4d4d4;
        -webkit-border-radius: 3px;
        -moz-border-radius: 3px;
        border-radius: 3px;
        cursor: move;
        border-color: #D4D4D4 #D4D4D4 #BCBCBC;
        margin: 0;
        padding: 3px;
        !important;
    }


</style>