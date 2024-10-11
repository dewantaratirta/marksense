<script>
    import Layouts from "@/layouts/layouts.svelte";
    import { page } from "@inertiajs/svelte";
    import Section from "@/lib/components/Section.svelte";
    import HeroProfile from "@/lib/components/HeroProfile.svelte";
    import ButtonProfile from "@/lib/components/ButtonProfile/Index.svelte";
    import { onMount } from "svelte";
    import TradeList from "@/lib/components/TradeList.svelte";

    let wallet = false;
    let user = {};
    let trade = [];

    onMount(() => {
        page.subscribe((value) => {
            wallet = value.props.wallet;
            trade = value.props.trade;
        });
    });
</script>

<Layouts>
    <Section>
        <svelte:component this={HeroProfile} {wallet} />
        <svelte:component this={ButtonProfile} {wallet} />

        <svelte:component this={TradeList} {trade} title="PnL" />
    </Section>
</Layouts>
