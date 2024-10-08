<script>
    import { getModalStore } from "@skeletonlabs/skeleton";
    import { account, web3modal, wagmiConfig } from "@/lib/web3modal";
    import { ConicGradient } from "@skeletonlabs/skeleton";
    import toastError from "@/lib/components/ToastError.js";
    import { onMount } from "svelte";
    import { nicePnL } from "@/lib/utils.js";

    export let wallet;
    let mode = "";
    let title = "Choose Pair";

    const modalStore = getModalStore();
    let pairList = [];
    let tradeList = [];
    let choosenTrade = "";
    let choosenPair = "";
    let loading = true;

    const handleCloseModal = () => {
        modalStore.close();
    };

    const switchMode = async (newMode) => {
        mode = newMode;
        switch (mode) {
            case "choose_pair":
                title = "Choose Pair";
                await getFuturePairList();
                break;

            case "choose_trade":
                title = "Choose Trade";
                await getTrades();
                break;
            case "create_proof":
                title = "Create Proof";
                await getSingleTrade();
            break;
        }
    };

    const getFuturePairList = async () => {
        console.log("get future pair list");
        try {
            let result = await fetch(
                `/api/data/futures_pair_list/${$account?.address}`,
                {
                    headers: {
                        "Content-Type": "application/json",
                        Accept: "application/json",
                    },
                },
            ).then((res) => res.json());
            loading = false;

            if (result.data.length == 0) {
                handleCloseModal();
                await toastError({ message: "No future pair available" });
                return;
            }
            pairList = result.data;
            choosenPair = pairList[0];
        } catch (err) {
            await toastError({ message: err.message });
            handleCloseModal();
        }
        loading = false;
    };

    const getTrades = async () => {
        console.log("get trade");
        loading = true;
        try {
            let result = await fetch(
                `/api/data/futures/${$account?.address}?symbol=${choosenPair}`,
                {
                    headers: {
                        "Content-Type": "application/json",
                        Accept: "application/json",
                    },
                },
            ).then((res) => res.json());

            if (Object.keys(result.data).length == 0) {
                toastError({ message: "No future pair available" });
                handleCloseModal();
                return;
            }

            let mod_data = [];
            for (let keys in result.data) {
                mod_data.push({
                    key: keys,
                    ...result.data[keys],
                });
            }

            //sort by time desc
            mod_data.sort((a, b) => {
                return new Date(b.time) - new Date(a.time);
            });

            tradeList = mod_data;
        } catch (err) {
            console.error(err);
            toastError({ message: err.message });
            handleCloseModal();
        }
        loading = false;
    };

    const getSingleTrade = async() => {
        console.log("get single trade");
        loading = true;
        try {
            let result = await fetch(
                `/api/data/futures_summary/${$account?.address}?symbol=${choosenPair}&id=${choosenTrade}`,
                {
                    headers: {
                        "Content-Type": "application/json",
                        Accept: "application/json",
                    },
                },
            ).then((res) => res.json());

            console.log(result);
            // if (Object.keys(result.data).length == 0) {
            //     toastError({ message: "No future pair available" });
            //     handleCloseModal();
            //     return;
            // }

            // let mod_data = [];
            // console.log(result.data);
            // for (let keys in result.data) {
            //     mod_data.push({
            //         key: keys,
            //         ...result.data[keys],
            //     });
            // }

            // //sort by time desc
            // mod_data.sort((a, b) => {
            //     console.log(typeof a.realizedPnl, a.realizedPnl);
            //     return new Date(b.time) - new Date(a.time);
            // });

            // tradeList = mod_data;
        } catch (err) {
            console.error(err);
            await toastError({ message: err.message });
            handleCloseModal();
        }
        loading = false;
    };

    onMount(async () => {
        switchMode("choose_pair");
    });
</script>

<div
    class="modal-content w-auto min-w-96 h-full bg-white px-4 py-2 flex-col rounded-md"
>
    <div>
        <div class="flex items-center justify-between">
            <div class="flex flex-col">
                <div class="flex items-center">
                    <span class="font-medium">{title}</span>
                </div>
            </div>
            <button class="p-4 btn-close" on:click={handleCloseModal}>
                <i class="fa-solid fa-times"></i>
            </button>
        </div>
    </div>

    {#if loading}
        <div class="flex justify-center items-center mb-4">
            <p>Loading...</p>
        </div>
    {/if}

    {#if !loading}
        {#if mode == "choose_pair"}
            <select
                bind:value={choosenPair}
                class="select w-full variant-soft-primary px-4"
            >
                {#each Object.keys(pairList) as pair, i}
                    <option value={pairList[pair]} selected={i == 0}
                        >{pairList[pair]}</option
                    >
                {/each}
            </select>

            <div class="flex justify-center mt-4">
                <button
                    class="btn bg-primary-500 text-white rounded-full hover:bg-primary-400"
                    on:click={() => {
                        switchMode("choose_trade");
                    }}
                >
                    Select Pair
                </button>
            </div>
        {:else if mode == "choose_trade"}
            <div class="flex flex-col">
                {#each tradeList as trade}
                    <div class="flex justify-between items-center mt-4 border-b pb-2">
                        <div class="flex flex-col">
                            <span class="font-medium">{trade.symbol}</span>
                            <div>
                                {#if trade.realizedPnl > 0}
                                    <span class="text-xs text-green-500"
                                        >{nicePnL(trade.realizedPnl)}</span
                                    >
                                {:else if trade.realizedPnl < 0}
                                    <span class="text-xs text-red-500"
                                        >{nicePnL(trade.realizedPnl)}</span
                                    >
                                {:else}
                                    <span class="text-xs"
                                        >{trade.realizedPnl}</span
                                    >
                                {/if}
                                <span class="text-xs">{trade?.human_time}</span>
                            </div>
                        </div>
                        <button
                            class="btn bg-primary-500 text-white rounded-full hover:bg-primary-400"
                            on:click={() => {
                                choosenTrade = trade.id;
                                switchMode("create_proof");
                            }}
                        >
                            Select Trade
                        </button>
                    </div>
                {/each}
            </div>
        {:else if mode == "create_proof"}
            <div class="flex flex-col">
                <div class="flex justify-between items-center mt-4 border-b pb-2">
                    <div class="flex flex-col">
                        <span class="font-medium">{tradeList[0].symbol}</span>
                        <div>
                            {#if tradeList[0].realizedPnl > 0}
                                <span class="text-xs text-green-500"
                                    >{nicePnL(tradeList[0].realizedPnl)}</span
                                >
                            {:else if tradeList[0].realizedPnl < 0}
                                <span class="text-xs text-red-500"
                                    >{nicePnL(tradeList[0].realizedPnl)}</span
                                >
                            {:else}
                                <span class="text-xs"
                                    >{tradeList[0].realizedPnl}</span
                                >
                            {/if}
                            <span class="text-xs">{tradeList[0]?.human_time}</span>
                        </div>
                    </div>
                    <button
                        class="btn bg-primary-500 text-white rounded-full hover:bg-primary-400"
                        on:click={() => {
                            modalStore.close();
                            window.location.href = `/futures_proof/${tradeList[0].id}`;
                        }}
                    >
                        Create Proof
                    </button>
                </div>
            </div>
        {/if}
    {/if}
</div>

<style>
    .modal-content button {
        outline: none !important;
        border: 0px !important;
    }
</style>
