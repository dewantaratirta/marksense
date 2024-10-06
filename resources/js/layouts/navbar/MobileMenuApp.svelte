<script>
    import { Link } from "@inertiajs/svelte";
    import BtnProfile from "./components/btnProfile.svelte";
</script>


<div class="relative">
    <Link class="btn hover:variant-soft-primary w-full mb-2" href="/app"
        ><span>Explore</span>
    </Link>
    <BtnProfile classNames="hover:variant-soft-primary"/>
</div>