<script>
    import { niceAddress } from "@/lib/utils";
    import { account } from "@/lib/web3modal";
    import { Link } from "@inertiajs/svelte";
    import Logo from "./Logo.svelte";
    import { onMount } from "svelte";
    import { clipboard } from "@skeletonlabs/skeleton";
    import { getToastStore } from "@skeletonlabs/skeleton";

    export let wallet;
    export let enable_edit = true;
    let initialize = false;

    const toastStore = getToastStore();

    const handleSuccessCopy = () => {
        toastStore.trigger({
            message: "Copied to clipboard",
        });
    };

    onMount(() => {
        initialize = true;
        console.log(wallet);
    });

    $: {
        console.log(wallet);
    }
</script>

{#if initialize && wallet}
    <div class="flex flex-col mt-4">
        <div class="bg-white border border-white shadow-lg rounded-3xl p-4 m-4">
            <div class="flex-none sm:flex">
                <div class=" relative h-32 w-32 sm:mb-0 mb-3">
                    <img
                        src={wallet?.avatar_url}
                        alt="aji"
                        class=" w-32 h-32 object-cover rounded-2xl"
                    />
                    {#if $account?.address === wallet?.wallet_address && enable_edit}
                        <Link
                            class="absolute -right-2 bottom-2 -ml-3 text-white p-1 text-xs bg-green-400 hover:bg-green-500 font-medium tracking-wider rounded-full transition ease-in duration-300"
                            href={`/app/profile/${$account?.address}/edit`}
                        >
                            <i class="fa-solid fa-pencil"></i>
                        </Link>
                    {/if}
                </div>
                <div class="flex-auto sm:ml-5 justify-evenly">
                    <div class="flex items-center justify-between sm:mt-2">
                        <div class="flex items-center">
                            <div class="flex flex-col">
                                <div
                                    class="w-full flex-none text-lg text-gray-800 font-bold leading-none"
                                >
                                    {wallet?.wallet_name}
                                </div>
                                <div class="flex-auto text-gray-500 my-1">
                                    <span class="mr-3"
                                        >@{wallet?.wallet_username}</span
                                    >
                                </div>
                                <div class="flex-auto text-gray-500 my-1">
                                    <button
                                        class="mr-3 hidden sm:block"
                                        use:clipboard={wallet?.wallet_address}
                                        on:click={handleSuccessCopy}
                                        >{wallet?.wallet_address}
                                        <i
                                            class="fa-regular fa-clipboard cursor-pointer"
                                        />
                                    </button>
                                    <span class="mr-3 sm:hidden block"
                                        >{niceAddress(
                                            wallet?.wallet_address,
                                        )}</span
                                    >
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="flex pt-2 text-sm text-gray-500">
                        <div class="flex-1 inline-flex items-center">
                            <i class="fa-solid fa-eye mr-2"></i>
                            <p class="">{wallet?.wallet_view} Views</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
{/if}
