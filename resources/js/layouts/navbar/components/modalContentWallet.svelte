<script>
    import { account, web3modal, wagmiConfig } from "@/lib/web3modal";
    import { disconnect, getBalance } from "@wagmi/core";
    import { niceAddress } from "@/lib/utils";
    import { getModalStore } from "@skeletonlabs/skeleton";
    import { clipboard } from "@skeletonlabs/skeleton";
    import BtnProfile from "./btnProfile.svelte";

    const { chains } = wagmiConfig;

    const modalStore = getModalStore();
    let walletInfo = {};

    const handleDisconnect = async () => {
        await disconnect(wagmiConfig);
        modalStore.close();
    };

    // const handleChangeChain = async () => {
    //     chains.forEach(async (chain) => {
    //         if (chain.id !== $account?.chainId) {
    //             console.log('switch chain to', chain.id);
    //             let x = await $web3modal.switchNetwork(wagmiConfig, chain.id);
    //             console.log(x);
    //         }
    //     });
    // };
    $: {
        if($web3modal){
            walletInfo = $web3modal?.getWalletInfo();
        }
    }
</script>

<!-- Modal wallet profile -->
<div
    class="modal-content w-auto min-w-96 h-full bg-white px-4 py-2 flex-col rounded-md"
    id="md"
>
    <div>
        <div class="flex items-center justify-between">
            <div class="flex flex-col">
                <div class="flex items-center">
                    {#if walletInfo?.icon}
                        <img
                            src={walletInfo?.icon}
                            alt="wallet"
                            class="w-4 h-4 me-2 rounded-full"
                        />
                    {/if}
                    <span
                        class="font-medium hover:text-primary-400 rounded-md"
                        id="btn-copy-popup"
                    >
                        {niceAddress($account?.address ?? "")}
                    </span>
                </div>

                <!-- chain -->
                <button
                    class="text-sm text-surface-800 hover:text-primary-400 text-left"
                    >{$account?.chain?.name}</button
                >
            </div>

            <button
                class="p-4 btn-close"
                on:click={() => {
                    modalStore.close();
                }}
            >
                <i class="fa-solid fa-times" id="icon-copy"></i>
            </button>
        </div>

        <BtnProfile />
        <div class="flex items" style="margin-top: 2rem;">
            <button
                class="btn w-full bg-primary-500 text-white rounded-full hover:bg-primary-400 flex items-center space-x-2"
                on:click={async () => {
                    await handleDisconnect();
                }}
            >
                <span class="text-white">Disconnect</span>
            </button>
        </div>
    </div>
</div>

<style>
    .modal-content button {
        outline: none !important;
        border: 0px !important;
    }
</style>
