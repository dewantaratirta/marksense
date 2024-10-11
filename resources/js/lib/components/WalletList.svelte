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

        <div
            class="snap-x scroll-px-4 snap-mandatory scroll-smooth flex gap-4 overflow-x-auto px-4 py-10"
        >
            {#each wallet as item, i}
                <div
                    class="snap-start shrink-0 card w-40 md:w-80 text-center md:flex md:flex-row md:grow md:justify-between"
                >
                    <!-- image -->
                    <Link
                        class="flex"
                        href={"/app/profile/" + item.wallet_address}
                    >
                        <img src={item?.avatar_url} class="w-40" />
                    </Link>

                    <div>
                        <p class="text-center">
                            {item?.wallet_username}
                        </p>
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
