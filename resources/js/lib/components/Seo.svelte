<script>
    import { page } from "@inertiajs/svelte";
    import SvelteSeo from "svelte-seo";

    let title = "Marksense";
    let description = "Marksense - Verify your PnL with blockchain";
    const { props } = $page;

    if (props) {
        title = props.title ? props.title : title;
        description = props.description ? props.description : description;
    }
</script>

<SvelteSeo title={title} description={description} />