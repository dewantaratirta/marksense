<script>
    import { Link } from "@inertiajs/svelte";
    import Logo from "$lib/components/Logo.svelte";
    import { getDrawerStore, Drawer } from "@skeletonlabs/skeleton";

    const DrawerStore = getDrawerStore();

    const handleOpenMenu = () => {
        const setting = {id: "mobile-menu", width: "w-1/2"};
        DrawerStore.open(setting);
    };
</script>

<div class="flex items-center space-x-4">
    <button
        class="btn-icon btn-icon-sm lg:!hidden"
        on:click={() => {
            handleOpenMenu();
        }}><i class="fa-solid fa-bars text-xl"></i></button
    >
    <Link
        class="lg:!ml-0 lg:w-auto overflow-hidden"
        href="/"
        title="Go to Homepage"
    >
        <Logo />
    </Link>
</div>
