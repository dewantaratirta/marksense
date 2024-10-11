<script>
    import { niceAddress } from "@/lib/utils";
    import { account } from "@/lib/web3modal";
    import { Link } from "@inertiajs/svelte";
    import { getModalStore } from "@skeletonlabs/skeleton";
    import CreateFuturesPnLModal from "@/lib/components/ButtonProfile/CreateFuturesPnLModal.svelte";
    import ButtonEditProfile from "@/lib/components/ButtonProfile/ButtonEditProfile.svelte";

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
    <div class="flex justify-center md:justify-end mt-2 px-4">
        <ButtonEditProfile 
        basicClass={"btn rounded"}
        classNames="block variant-soft-primary bg-white border border-primary-300 me-2"/>


        <button
            class="btn variant-soft-primary block "
            on:click={handleCreateFuturesPNL}>Create Futures PNL
            <i class="fa-sharp-duotone fa-solid fa-sparkles"></i>
            </button
        >
    </div>
{/if}
