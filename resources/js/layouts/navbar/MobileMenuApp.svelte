<script>
    import { Link } from "@inertiajs/svelte";
    import BtnProfile from "./components/btnProfile.svelte";
</script>

<div class="relative">
    <Link class="btn hover:variant-soft-primary w-full mb-2" href="/app"
        ><span>Explore</span>
    </Link>
    <a
        href="https://testnets.opensea.io/assets/base-sepolia/0xe3312476a33e7c51a9dbbf9f843286c428521f74"
        class="btn hover:variant-soft-primary w-full mb-2"
        target="_blank"
        rel="noopener noreferrer"
    >
        <span>NFT</span>
    </a>
    <BtnProfile classNames="hover:variant-soft-primary" />
</div>
