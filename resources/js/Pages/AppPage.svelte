<script>
    import Layouts from "@/layouts/layouts.svelte";
    import { account } from "$lib/web3modal";
    import SignMessage from "@/lib/components/wallet/SignMessage.svelte";
    import Section from "@/lib/components/Section.svelte";

    let address = "";

    account.subscribe((value) => {
        address = value?.address;
    });
</script>

<Layouts>
    <Section>
        <h1 class="text-lg font-bold mb-4">Sign transactions</h1>

        <p>Address: {address}</p>

        <SignMessage />
    </Section>
</Layouts>
