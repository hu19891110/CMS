{!! HTML::style( asset('/assets/vendor/ContentBuilder/scripts/contentbuilder.css') ) !!}
{!! HTML::style( asset('/assets/vendor/ContentBuilder/assets/cmit-default/content.css') ) !!}

{!! HTML::script( asset('/assets/vendor/ContentBuilder/scripts/contentbuilder.js') ) !!}
{!! HTML::script( asset('/assets/vendor/ContentBuilder/scripts/saveimages.js') ) !!}
<script type="text/javascript">
    $(document).ready(function() {

        $("#contentarea").contentbuilder({
            zoom: 1,
            snippetOpen: true,
            snippetFile: '/assets/vendor/ContentBuilder/assets/cmit-default/snippets.html'
        });
    });
</script>