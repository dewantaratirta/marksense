<script>
    import { niceAddress } from "@/lib/utils";
    import { account } from "@/lib/web3modal";
    import { Link } from "@inertiajs/svelte";
    import { getModalStore } from "@skeletonlabs/skeleton";
    import CreateFuturesPnLModal from "@/lib/components/ButtonProfile/CreateFuturesPnLModal.svelte";
    const modalStore = getModalStore();

    export let wallet;

    const handleCreateFuturesPNL = () => {
        const modalSetting = {
            type: "component",
            component: { ref: CreateFuturesPnLModal },
        };
        modalStore.trigger(modalSetting);
    };
</script>

{#if $account?.address === wallet?.wallet_address}
    <div class="flex flex-col mt-2">
        <button
            class="btn variant-soft-primary"
            on:click={handleCreateFuturesPNL}>Create Futures PNL</button
        >
    </div>
{/if}
