<script>
    import { niceAddress } from "@/lib/utils.js";
    import { Link } from "@inertiajs/svelte";
    import { getDrawerStore } from "@skeletonlabs/skeleton";
    import { tradeDetails } from "@/stores/tradeDetailStore.js";
    import MintTradeButton from "./wallet/MintTradeButton.svelte";
    import { Confetti } from "svelte-confetti";

    export let trade;
    export let wallet;

    const drawerStore = getDrawerStore();

    tradeDetails.set(trade);

    const handleClickViewData = () => {
        const setting = {
            id: "trade-details",
            width: "w-3/4",
            props: { trade },
            position: "left",
        };
        drawerStore.open(setting);
    };
</script>

<div class="flex flex-col items-center">
    <div class="flex flex-col my-4 max-w-md">
        <div class="bg-white border border-white shadow-lg rounded-3xl">
            <div class="card bg-initial card-hover overflow-hidden">
                <header>
                    <img
                        src={trade?.image_url}
                        class="bg-black/50 w-full"
                        alt="Post"
                    />
                </header>
                <div class="p-4 space-y-4">
                    <h3 class="h3" data-toc-ignore="">
                        {trade?.trade_pnl_symbol}
                    </h3>
                    <button
                        class="btn variant-soft-primary w-full"
                        id="show_data"
                        on:click={handleClickViewData}>View Metadata</button
                    >
                    <MintTradeButton {trade} {wallet} />
                </div>
                <hr class="opacity-50" />
                <footer class="p-4 flex justify-start items-center space-x-4">
                    <figure
                        class="avatar flex aspect-square text-surface-50 font-semibold justify-center items-center overflow-hidden isolate bg-surface-400-500-token w-8 rounded-full"
                        data-testid="avatar"
                    >
                        <img
                            class="avatar-image w-full object-cover"
                            style=""
                            src={wallet?.avatar_url}
                            alt=""
                        />
                    </figure>
                    <div class="flex-auto flex justify-between items-center">
                        <Link href={`/app/profile/${wallet?.wallet_address}`}>
                            <h6 class="font-bold" data-toc-ignore="">
                                @{wallet.wallet_username}
                            </h6>
                            <p class="text-sm text-gray-500">
                                {niceAddress(
                                    wallet?.wallet_address ??
                                        "                                   ",
                                )}
                            </p>
                        </Link>
                        <small>On {trade?.human_date}</small>
                    </div>
                </footer>
            </div>
        </div>
    </div>
</div>
