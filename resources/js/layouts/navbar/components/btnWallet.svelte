<script>
    import { connect } from "@wagmi/core";
    import {
        web3modal,
        wagmiConfig,
        account,
        reconnect,
    } from "@/lib/web3modal";
    import modalContentWallet from "./modalContentWallet.svelte";
    import { getModalStore } from "@skeletonlabs/skeleton";

    let connector;

    const modalStore = getModalStore();
    let count = 0;

    $: {
        if ($web3modal) {
            connector = wagmiConfig.connectors[0];
        }

        if (!$account?.address) {
            if (count < 3) {
                reconnect();
                count++;
            }
        }
    }

    const handleConnect = () => {
        try{
            connect(wagmiConfig, {
                connector: connector,
            });
        } catch(e){
            console.log(e);
        }
    };

    const handleModalOpen = () => {
        const modalSetting = {
            type: "component",
            component: { ref: modalContentWallet },
        };
        let x = modalStore.trigger(modalSetting);
    };
</script>

{#if $account?.address}
    <button
        class="btn bg-primary-500 text-white rounded-full hover:bg-primary-400 bg-primary-500 flex items-center space-x-2"
        on:click={() => {
            handleModalOpen();
        }}
    >
        <span class="text-white"
            >{$account.address.slice(0, 6)}...{$account.address.slice(-4)}</span
        >
    </button>
{:else}
    <button
        class="btn bg-primary-500 text-white rounded-full hover:bg-primary-400 bg-primary-500 flex items-center space-x-2"
        on:click={() => {
            handleConnect();
        }}
    >
        <span class="text-white"> Connect Wallet </span>
    </button>
{/if}
