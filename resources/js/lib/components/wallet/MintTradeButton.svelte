<script>
    import { account, wagmiConfig } from "@/lib/web3modal.js";
    import address from "@/lib/abi/address.json";
    import { getToastStore } from "@skeletonlabs/skeleton";
    import { writeContract } from "@wagmi/core";
    import { page } from "@inertiajs/svelte";

    const toastStore = getToastStore();

    export let trade;
    export let wallet;
    export let className = "btn bg-success-300 text-success-800 w-full";
    let success = false;
    
    console.log(trade)

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

            if (_hash == "null") {
                let hash = "Hash: " + _hash;

                let ToastSettings = {
                    message: "Something went wrong. Please try again later",
                    background: "variant-filled-error",
                };
                success = true;
                toastStore.trigger(ToastSettings);
                return;
            }

            // success
            let post = await fetch("/api/proof/futures/mint/" + trade?.ulid, {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    Accept: "application/json",
                },
                body: JSON.stringify({
                    txid: _hash,
                    address: $account.address,
                    _token: $page.props.token,
                }),
            }).then((response) => response.json());

            // error post
            if (post.status !== "success") {
                let ToastSettings = {
                    message: post.message,
                    background: "variant-filled-error",
                };
                toastStore.trigger(ToastSettings);
                return;
            }

            let ToastSettings = {
                message: "Success! NFT minted successfully",
            };
            toastStore.trigger(ToastSettings);

            setTimeout(() => {
                window.location.reload();
            }, 5000);
        } catch (error) {
            let ToastSettings = {
                message: error.message,
                background: "variant-filled-error",
            };
            toastStore.trigger(ToastSettings);
        }
    };
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
