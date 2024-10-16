<script>
    import { account, wagmiConfig } from "@/lib/web3modal.js";
    import address from "@/lib/abi/address.json";
    import { getToastStore } from "@skeletonlabs/skeleton";
    import { writeContract } from "@wagmi/core";

    const toastStore = getToastStore();

    export let trade;
    export let wallet;
    export let className = "btn bg-success-300 text-success-800 w-full";
    let success = false;

    const handleMint = async () => {
        try {
            if (!$account?.address) throw Error("Wallet disconnected");

            const contract = address.mkp.find(
                (item) => item.chainId == $account?.chainId,
            );
            if (!contract) throw Error("Contract not found");
            const publicMint = contract?.abi?.find(
                (item) => item.name == "publicMint",
            );
            if (!publicMint) throw Error("Method not found");
            const abi = contract?.abi;

            const args = [
                [
                    trade?.unserialized_proof?.transformedProof.claimInfo,
                    trade?.unserialized_proof?.transformedProof.signedClaim,
                ],
                trade?.api_proof_metadata_url,
            ];

            const _hash = await writeContract(wagmiConfig, {
                abi,
                address: contract?.address,
                functionName: "publicMint",
                args: args,
            });

            if (_hash !== "null") {
                let hash = "Hash: " + _hash;

                let ToastSettings = {
                    message: "Congratulations! NFT minted successfully",
                };
                success = true;
                toastStore.trigger(ToastSettings);
            } else {
                let ToastSettings = {
                    message: "The signature was rejected",
                    background: "variant-filled-error",
                };
                toastStore.trigger(ToastSettings);
            }
        } catch (error) {
            let ToastSettings = {
                message: error.message,
                background: "variant-filled-error",
            };
            toastStore.trigger(ToastSettings);
        }
    };
    console.log($account);
</script>

{#if $account?.address == trade.wallet.wallet_address && !trade?.trade_pnl_is_minted}
    <button
        class={className}
        on:click={async () => {
            await handleMint();
        }}
    >
        Mint NFT
    </button>
{/if}
