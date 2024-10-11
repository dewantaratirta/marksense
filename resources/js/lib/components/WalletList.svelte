<script>
    import { Link } from "@inertiajs/svelte";
    export let wallet;
    export let title = false;

    console.log(wallet);
</script>

{#if typeof wallet == "object" && wallet.length > 0}
    <div class="p-4 m-4">
        {#if title}
            <h4 class="h4 font-bold">{title}</h4>
        {/if}

        <div class="flex overflow-x-scroll pb-8 hide-scroll-bar">
            {#each wallet as item}
                <div class="flex flex-nowrap md:ml-10 ml-2">
                    <div class="inline-block px-3">
                        <Link href={`/app/profile/${item?.wallet_address}`}
                            class="relative flex flex-col w-40 h-40 max-w-xs overflow-hidden bg-white transition-shadow duration-300 ease-in-out "
                        >
                            <div>
                                <img src={item?.avatar_url} alt="" />
                            </div>
                            <p class="absolute left-0 bottom-0 text-center w-full">@{item?.wallet_username}</p>
                        </Link>
                    </div>
                </div>
            {/each}
        </div>
    </div>
{:else}
    <div class="p-4 m-4">
        {#if title}
            <h4 class="h4 font-bold">{title}</h4>
        {/if}

        <aside class="alert variant-soft-error mt-4">
            <!-- Message -->
            <div class="alert-message py-4">
                <p class="text-center">There is no data</p>
            </div>
        </aside>
    </div>
{/if}
