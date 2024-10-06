<script>
    import Navbar from "./navbar.svelte";
    import { router } from "@inertiajs/svelte";
    import { initializeStores, Modal } from "@skeletonlabs/skeleton";

    let state = "main";
    if (router.page.url.includes("/app")) {
        state = "app";
    }
    initializeStores();
    console.log(state);
</script>

<div style="display: contents" class="h-full overflow-hidden">
    <Navbar {state} />

    <div id="page-content" class="flex-auto">
        <slot />
    </div>
    <Modal />
</div>
