<!-- THIS FILE CAN BE REMOVED, IT SERVES ONLY TO DEMO BEST PRACTICES -->
<script lang="ts">
    import { signMessage } from "@wagmi/core";
    import { wagmiConfig } from "$lib/web3modal";
    import {
        Toast,
        getToastStore,
        initializeStores,
    } from "@skeletonlabs/skeleton";
    import type { ToastSettings, ToastStore } from "@skeletonlabs/skeleton";

    initializeStores();
    const toastStore = getToastStore();

    let signature: string | undefined;
    let label: string = "Sign Message";

    async function handleSign() {
        label = "Signing...";
        signature = "_";

        try {
            const _signature = await signMessage(wagmiConfig, {
                message: "WalletConnect message",
            });
            //@ts-expect-error Wagmi Type bug
            if (_signature !== "null") {
                signature = _signature;
                const t: ToastSettings = {
                    message: "Message signed successfully",
                };
                toastStore.trigger(t);
            } else {
                const t: ToastSettings = {
                    message: "The signature was rejected",
                };
                toastStore.trigger(t);
                signature = "_ personal_sign";
            }
        } catch (error) {
            const t: ToastSettings = {
                message: (error as Error).message,
            };
            toastStore.trigger(t);
        } finally {
            label = "Sign Message";
        }
    }
</script>

<div class="card py-2">
    <Toast />
    <div class="space-y-4">
        <h3 class="text-bold text-md">_eth_signMessage</h3>
        <p class="text-left text-sm">
            Result: <span class="text-sm"> {signature ?? ""} </span>
        </p>
        <button class="btn variant-ghost-primary w-full" on:click={handleSign}
            >{label}</button
        >
    </div>
</div>
