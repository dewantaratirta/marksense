<script>
    import Navbar from "./navbar.svelte";
    import { router } from "@inertiajs/svelte";
    import { initializeStores, Modal } from "@skeletonlabs/skeleton";
    import { Drawer, getDrawerStore } from "@skeletonlabs/skeleton";
    import MenuDrawer from "./navbar/menuDrawer.svelte";
    import TradeDetails from "@/lib/components/TradeDetails.svelte";

    initializeStores();
    import {
        Toast,
        // initializeStores as ToastInitializeStores,
    } from "@skeletonlabs/skeleton";
    import { mainState } from "stores/mainStateStore";
    import Seo from "@/lib/components/Seo.svelte";

    let state = "main";
    if (router.page.url.includes("/app")) {
        state = "app";
        mainState.set("app");
        console.log($mainState);
    } else {
        state = "main";
        mainState.set("main");
        console.log($mainState);
    }
    initializeStores();
    // ToastInitializeStores();
    // InitializeDrawerStore();

    const drawerStore = getDrawerStore();
</script>

<div>
    <Navbar {state} />

    <div id="page-content">
        <slot />
    </div>
    <Modal />
    <Toast />
    <Drawer>
        {#if $drawerStore.id == "mobile-menu"}
            <svelte:component this={MenuDrawer} />
        {:else if $drawerStore.id == "trade-details"}
            <svelte:component this={TradeDetails} />
        {/if}
    </Drawer>
    <Seo />
</div>
