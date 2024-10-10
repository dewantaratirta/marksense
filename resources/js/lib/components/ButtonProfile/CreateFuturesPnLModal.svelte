<script>
    import { getModalStore } from "@skeletonlabs/skeleton";
    import { account, web3modal, wagmiConfig } from "@/lib/web3modal";
    import toastError from "@/lib/components/ToastError.js";
    import { onMount } from "svelte";
    import { nicePnL } from "@/lib/utils.js";
    import GenerateImagePnLFutures from "@/lib/components/GenerateImagePnLFutures.svelte";
    import { canvasFutureStore } from "@/stores/canvasFutureStore";
    import { page } from "@inertiajs/svelte";


    console.log('$page',$page);

    export let wallet;
    let mode = "";
    let title = "Choose Pair";

    const modalStore = getModalStore();
    let back = false;
    let pairList = [];
    let tradeList = [];
    let choosenTrade = "";
    let choosenPair = "";
    let tradeData = {};
    let loading = true;
    let canvasFutureUrl = false;
    let generateProofFutureLoading = false;
    let generateProofFutureResult = false;

    const handleCloseModal = () => {
        modalStore.close();
    };

    const switchMode = async (newMode) => {
        mode = newMode;
        switch (mode) {
            case "choose_pair":
                back = false;
                title = "Choose Pair";
                await getFuturePairList();
                break;

            case "choose_trade":
                back = "choose_pair";
                title = "Choose Trade";
                await getTrades();
                break;
            case "create_proof":
                back = "choose_trade";
                title = "Create Proof";
                await getSingleTrade();
                break;
            case "generate_proof":
                back = "create_proof";
                title = "Generate Proof";
                await generateProof();
                break;
        }
    };

    const backClickHandle = () => {
        switchMode(back);
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

    const getSingleTrade = async () => {
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

            tradeData = result.data;
        } catch (err) {
            console.error(err);
            await toastError({ message: err.message });
            handleCloseModal();
        }
        loading = false;
    };

    const generateProof = async () => {

        generateProofFutureLoading = true;
        try {
            //blob_url to file
            const response = await fetch(canvasFutureUrl);
            const blob = await response.blob();
            const file = new File([blob], "canvasFuture.png", { type: "image/png" });
            

            console.log(`tradeData`, tradeData)
            const formData = new FormData();
            formData.append("_token", $page?.props?.token);
            formData.append("file", file);

            Array.from(Object.keys(tradeData)).forEach((key) => {
                formData.append(key, tradeData[key]);
            });
            // for(keys in tradeData){
            //     formData.append(keys, tradeData[keys]);
            // }

            let res = await fetch(
                `/api/proof/future/${$account?.address}?symbol=${choosenPair}&order_id=${choosenTrade}`,
                {
                    method: "POST",
                    headers: {
                        // 'Content-Type': 'multipart/form-data',
                        ContentType: "application/json",
                        Accept: "application/json",
                    },
                    body: formData,
                }
            ).then((res) => res.json());
            if(res.status == 'error'){
                throw new Error(res.message);
            }
            generateProofFutureResult = true;
            window.location.reload();
        } catch (e) {
            console.log(e);
            generateProofFutureResult = false;
        }
        generateProofFutureLoading = false;
    };

    canvasFutureStore.subscribe((value) => {
        canvasFutureUrl = value;
    });

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
                    {#if back !== false}
                        <button on:click={backClickHandle}
                            ><i class="fa fa-chevron-left text-sm me-2"
                            ></i></button
                        >
                    {/if}
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
                    <div
                        class="flex justify-between items-center mt-4 border-b pb-2"
                    >
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
                                choosenTrade = trade.orderId;
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
                <div
                    class="flex flex-col justify-between items-center mt-4 pb-2"
                >
                    <div class="hidden">
                        <GenerateImagePnLFutures trade={tradeData} />
                    </div>
                    {#if canvasFutureUrl}
                        <img src={canvasFutureUrl} alt="canvas" class="w-[70%] max-w-[640px]"/>

                        <button
                            class="btn bg-primary-500 text-white rounded-full hover:bg-primary-400 mt-6"
                            on:click={() => {
                                switchMode("generate_proof");
                            }}
                        >
                            Create Proof
                        </button>
                    {:else}
                        Loading...
                    {/if}
                </div>
            </div>
        {:else if mode == 'generate_proof'}
            {#if generateProofFutureLoading}
                <div class="flex justify-center items-center my-4">
                    <p>Generating Proof...</p>
                </div>
            {:else}
                {#if generateProofFutureResult}
                    <div class="flex justify-center items-center my-4">
                        <p>Proof Generated</p>
                    </div>
                {:else}
                    <div class="flex flex-col justify-center items-center my-4">
                        <p class="mb-2">Failed to generate proof</p>

                        <!-- button retry -->
                        <button
                            class="btn bg-primary-500 text-white rounded-full hover:bg-primary-400"
                            on:click={() => {
                                switchMode("generate_proof");
                            }}
                        >Retry</button>
                    </div>
                {/if}
            {/if}
        {/if}
    {/if}
</div>

<style>
    .modal-content button {
        outline: none !important;
        border: 0px !important;
    }
</style>
