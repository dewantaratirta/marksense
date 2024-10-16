<script>
    import { page } from "@inertiajs/svelte";
    import BtnWallet from "./components/btnWallet.svelte";
    import { Link } from "@inertiajs/svelte";

    let isActive = $page?.url == "/app" ? true : false;
</script>

<div class="relative lg:block hidden">
    {#if isActive}
        <Link class="btn hover:variant-soft-primary border border-primary-300 text-primary-500" href="/app"
            ><span>Explore</span>
        </Link>
    {:else}
        <Link class="btn hover:variant-soft-primary border" href="/app"
            ><span>Explore</span>
        </Link>
    {/if}
</div>

<div class="relative lg:block flex items-center space-x-2">
    <BtnWallet />
</div>
