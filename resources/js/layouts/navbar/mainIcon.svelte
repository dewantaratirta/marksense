<script>
    import { Link } from "@inertiajs/svelte";
    import Logo from "$lib/components/Logo.svelte";
</script>

<div class="flex items-center space-x-4">
    <button
        class="btn-icon btn-icon-sm lg:!hidden"
        data-svelte-h="svelte-fnxzj7"
        ><i class="fa-solid fa-bars text-xl"></i></button
    >
    <Link
        class="lg:!ml-0 lg:w-auto overflow-hidden"
        href="/"
        title="Go to Homepage"
    >
        <Logo />
    </Link>
</div>
