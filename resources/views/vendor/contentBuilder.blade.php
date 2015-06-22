{!! HTML::style( asset('/assets/vendor/ContentBuilder/scripts/contentbuilder.css') ) !!}
{!! HTML::style( asset('/assets/DCNCMS-ContentBuilder/content.css') ) !!}

{!! HTML::script( asset('/assets/vendor/ContentBuilder/scripts/contentbuilder.js') ) !!}
{!! HTML::script( asset('/assets/vendor/ContentBuilder/scripts/saveimages.js') ) !!}
<style>
    #parent{
        position:fixed;
        bottom:0px;
        width:100%;
        z-index: 10000;
    }
    #child{
        background-color: #000000;
        width: auto;
        height: 50px;
        text-align: center;
    }
    #rte-toolbar{
        z-index: 10000 !important;
    }
</style>
<script type="text/javascript">
    $(document).ready(function() {

        $("#contentarea").contentbuilder({
            zoom: 1,
            snippetOpen: true,
            snippetFile: '/assets/DCNCMS-ContentBuilder/snippets.html'
        });
    });
</script>