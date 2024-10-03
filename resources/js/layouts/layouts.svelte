<script>
    import Navbar from "./navbar.svelte";
    import { router } from "@inertiajs/svelte";

    let state = "main";
    if (router.page.url.includes("/app")) {
        state = "app";
    }
    console.log(state);
</script>

<div style="display: contents" class="h-full overflow-hidden">
    <Navbar {state} />
    <slot />
</div>
