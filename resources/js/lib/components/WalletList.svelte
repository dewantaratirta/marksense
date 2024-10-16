<script>
    import { Link } from "@inertiajs/svelte";
    export let wallet;
    export let title = false;

</script>

{#if typeof wallet == "object" && wallet.length > 0}
    <section class="">
        <div class="p-4 m-4">
            {#if title}
                <h4 class="h4 font-bold">{title}</h4>
            {/if}
        </div>
        <div
            class="py-8 px-4 mx-auto max-w-screen-xl text-center lg:py-16 lg:px-6"
        >
            <div
                class="grid gap-8 lg:gap-16 grid-cols-2 md:grid-cols-3 lg:grid-cols-4"
            >
                {#each wallet as item}
                    <Link href={`/app/profile/${item?.wallet_address}`}>
                        <div
                            class="text-center text-gray-500 dark:text-gray-400"
                        >
                            <img
                                class="mx-auto mb-4 w-36 h-36 rounded-full"
                                src={item?.avatar_url}
                                alt={item?.wallet_name}
                            />
                            <h4
                                class="mb-1 h4 font-bold tracking-tight text-gray-900 dark:text-white"
                            >
                                {item?.wallet_name}
                            </h4>
                            <p>@{item?.wallet_username}</p>
                        </div>
                    </Link>
                {/each}
            </div>
        </div>
    </section>
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
