<script>
    import { getModalStore } from "@skeletonlabs/skeleton";
    import { account, web3modal, wagmiConfig } from "@/lib/web3modal";
    import { ConicGradient } from "@skeletonlabs/skeleton";
    import toastError from "@/lib/components/ToastError.js";
    import {onMount} from "svelte";

    export let wallet;
    let mode = "";

    const modalStore = getModalStore();
    let pairList = [];
    let choosenPair = "";
    let loading = true;

    const handleCloseModal = () => {
        modalStore.close();
    };

    const switchMode = async (newMode) => {
        mode = newMode;
        switch (mode) {
            case "choose_pair":
                await getFuturePairList();

                break;
            case "create_pnl":
                await selectTrade();
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
                toastError({ message: "No future pair available" });
                return;
            }
            pairList = result.data;
            choosenPair = pairList[0];
        } catch (err) {
            handleCloseModal();
            toastError({ message: err.message });
        }
    };

    const selectTrade = async () => {
        console.log("select trade");
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
                toastError({ message: "No future pair available" });
                return;
            }
            pairList = result.data;
            choosenPair = pairList[0];
        } catch (err) {
            handleCloseModal();
            toastError({ message: err.message });
        }
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
                    <span class="font-medium">Choose Pair</span>
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
                        switchMode("create_pnl");
                    }}
                >
                    Create Proof
                </button>
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
