<script>
    import Layouts from "@/layouts/layouts.svelte";
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
    } from "stores/wagmi";
    import { createConfig } from "@wagmi/core";
    import { onMount } from "svelte";
    import { walletConnect, injected } from "@wagmi/connectors";
    import { connect, writeContract } from "@wagmi/core";
    import USDC from "$lib/abi/USDC.json";
    import { base_sepolia } from "$lib/base_sepolia_chain";
    import { coinbaseWallet } from "@wagmi/connectors";

    // import { PUBLIC_WALLETCONNECT_ID } from '$env/static/public';

    const PUBLIC_WALLETCONNECT_ID = "3e97282400323fb72cc0545de271fff9";

    onMount(async () => {
        const coinbase = defaultConfig({
            chains: [base_sepolia],
            appName: "baseSepolia",
            connectors: [
                coinbaseWallet({
                    appName: "baseSepolia",
                    preference: "smartWalletOnly",
                }),
            ],
            walletConnectProjectId: PUBLIC_WALLETCONNECT_ID,
        });

        await coinbase.init();
    });
</script>

<Layouts>
    <div class="container">
        <h1>Svelte Wagmi</h1>
        <p>
            Svelte Wagmi is a package that provides a collection of Svelte
            stores and functions for interacting with the Ethereum network. It
            utilizes the @wagmi/core library for connecting to Ethereum networks
            and signing transactions.
        </p>
    </div>
</Layouts>