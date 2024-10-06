<script>
    import BtnWallet from "./components/btnWallet.svelte";
    import { Link } from "@inertiajs/svelte";

</script>

<div class="relative lg:block hidden">
    <Link class="btn hover:variant-soft-primary" href="/app"
        ><span>Explore</span>
    </Link>
</div>

<div class="relative lg:block flex items-center space-x-2">
    <BtnWallet />
</div>
