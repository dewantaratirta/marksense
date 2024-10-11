<script>
    import { Link } from "@inertiajs/svelte";
    export let trade;
    export let title = false;

    console.log(trade);
</script>

{#if trade.length > 0}
    <div class="p-4 m-4">
        {#if title}
            <h4 class="h4 font-bold">{title}</h4>
        {/if}

        <div
            class="snap-x scroll-px-4 snap-mandatory scroll-smooth flex gap-4 overflow-x-auto px-4 py-10"
        >
        {#each trade as item, i}
            <div
                class="snap-start shrink-0 card w-40 md:w-80 text-center"
            >
                    <!-- image -->
                    <Link class="flex justify-center" href={'/app/trade/'+ item.ulid}>
                        <img
                            src={item.image_url}
                            alt={item.human_date}
                        />
                    </Link>
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
                <p class="text-center">User doesn't have any trade yet</p>
            </div>
        </aside>
    </div>
{/if}
