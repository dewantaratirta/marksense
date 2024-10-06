<script>
    import Navbar from "./navbar.svelte";
    import { router } from "@inertiajs/svelte";
    import { initializeStores, Modal } from "@skeletonlabs/skeleton";
    import {
        Toast,
        initializeStores as ToastInitializeStores,
    } from "@skeletonlabs/skeleton";
    import { mainState } from "stores/mainStateStore";

    let state = "main";
    if (router.page.url.includes("/app")) {
        state = "app";
        mainState.set("app");
        console.log($mainState);
    }
    initializeStores();
    ToastInitializeStores();
</script>

<div style="display: contents" class="h-full overflow-hidden">
    <Navbar {state} />

    <div id="page-content" class="flex-auto">
        <slot />
    </div>
    <Modal />
    <Toast />
</div>
