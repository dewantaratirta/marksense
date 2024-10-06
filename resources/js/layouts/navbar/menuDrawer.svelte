<script>
    import { mainState } from "stores/mainStateStore";
    import MobileMenuMain from "./mobileMenuMain.svelte";
    import MobileMenuApp from "./mobileMenuApp.svelte";

    console.log(`menuDrawer loadded`, $mainState);
</script>

<div class="px-4 py-4">
    {#if $mainState === "main"}
        <svelte:component this={MobileMenuMain} />
    {:else}
        <svelte:component this={MobileMenuApp} />
    {/if}
</div>
