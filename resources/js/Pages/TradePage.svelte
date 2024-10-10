<script>
    import Layouts from "@/layouts/layouts.svelte";
    import { account } from "$lib/web3modal";
    import Section from "@/lib/components/Section.svelte";
    import { page } from "@inertiajs/svelte";
    import HeroProfile from "@/lib/components/HeroProfile.svelte";
    import { onMount } from "svelte";
    import ShowTrade from "@/lib/components/ShowTrade.svelte";

    let address = "";
    let wallet = false;
    let trade;
    page.subscribe((value) => {
        wallet = value.props.wallet;
        trade = value.props.trade;
    });

    onMount(() => {

    });
</script>

<Layouts>
    <Section>
        <ShowTrade {trade} {wallet}/>
    </Section>
</Layouts>
