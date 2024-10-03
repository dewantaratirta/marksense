<script>
    import {
        connected,
        disconnectWagmi,
        signerAddress,
        wagmiConfig,
        configuredConnectors,
        loading,
        chainId,
        web3Modal,
        defaultConfig,
        wagmiLoaded,
        WC,
    } from "stores/wagmi";
    import { onMount } from "svelte";
    import { walletConnect, injected, coinbaseWallet } from "@wagmi/connectors";
    import { connect, writeContract } from "@wagmi/core";
    import { base } from "@wagmi/chains";
    import { base_sepolia } from "$lib/base_sepolia_chain";
    import { niceAddress } from "$lib/utils";

    // import { PUBLIC_WALLETCONNECT_ID } from '$env/static/public';
    const PUBLIC_WALLETCONNECT_ID = "3e97282400323fb72cc0545de271fff9";

    onMount(async () => {
        const coinbase = defaultConfig({
            chains: [base],
            appName: "Marksense",
            connectors: [
                coinbaseWallet({
                    appName: "Marksense",
                    preference: "smartWalletOnly",
                    appLogoUrl: "https://marksense.io/logo.png",
                    version: "4",
                }),
                walletConnect({
                    projectId: PUBLIC_WALLETCONNECT_ID,
                }),
            ],
            alchemyId: "tAfcDp9L5Y6JhEfXQ5oxpcPeOhwY__L7",
            walletConnectProjectId: PUBLIC_WALLETCONNECT_ID,
        });

        await coinbase.init();
        console.log(disconnectWagmi)
    });
</script>

{#if wagmiLoaded}
    {#if $loading}
        <div>
            <span class="loader" />Waiting...
        </div>
    {:else if $connected}
        <button
            on:click={async () => {
                // await disconnectWagmi();
                await WC();
            }}
            class="btn hover:bg-primary-600 bg-primary-800"
        >
            {niceAddress($signerAddress)}
        </button>
    {:else}
        <button
            on:click={async () => {
                $loading = true;
                await $web3Modal.open();
                $loading = false;
            }}
            class="btn hover:bg-primary-600 bg-primary-800"
        >
            {#if $loading}
                <span class="loader" />Connecting...
            {:else}
                Connect
            {/if}
        </button>
    {/if}
{/if}
