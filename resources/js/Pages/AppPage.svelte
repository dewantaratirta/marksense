<script>
    import Layouts from "@/layouts/layouts.svelte";
    import { account } from "$lib/web3modal";
    import SignMessage from "@/lib/components/wallet/SignMessage.svelte";
    import Section from "@/lib/components/Section.svelte";
    import { page } from "@inertiajs/svelte";
    import TradeList from "@/lib/components/TradeList.svelte";
    import WalletList from "@/lib/components/WalletList.svelte";

    let address = "";

    account.subscribe((value) => {
        address = value?.address;
    });
</script>

<Layouts>
    <Section>
        <WalletList wallet={$page?.props?.hottest_wallets} title="Hottest User 🔥" />
        <WalletList wallet={$page?.props?.popular_wallets} title="Most Viewed User" />
        <TradeList trade={$page?.props?.hottest_trades} title="Hottest Trade 🔥" />
        <TradeList trade={$page?.props?.popular_trades} title="Most Viewed Trade" />
    </Section>
</Layouts>
