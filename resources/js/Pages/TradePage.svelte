<script>
    import Layouts from "@/layouts/layouts.svelte";
    import { account, wagmiConfig } from "$lib/web3modal";
    import Section from "@/lib/components/Section.svelte";
    import { page } from "@inertiajs/svelte";
    import HeroProfile from "@/lib/components/HeroProfile.svelte";
    import { onMount } from "svelte";
    import ShowTrade from "@/lib/components/ShowTrade.svelte";
    import { getTransactionReceipt } from "@wagmi/core";

    let address = "";
    let wallet = false;
    let trade;
    page.subscribe((value) => {
        wallet = value.props.wallet;
        trade = value.props.trade;
    });

    onMount(async () => {
    });
</script>

<Layouts>
    <Section>
        <ShowTrade {trade} {wallet} />
    </Section>
</Layouts>
