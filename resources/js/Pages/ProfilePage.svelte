<script>
    import Layouts from "@/layouts/layouts.svelte";
    import { page } from "@inertiajs/svelte";
    import Section from "@/lib/components/Section.svelte";
    import HeroProfile from "@/lib/components/HeroProfile.svelte";
    import ButtonProfile from "@/lib/components/ButtonProfile/Index.svelte";
    import {onMount} from "svelte";

    let wallet = false;
    let user = {};

    onMount(()=>{
        page.subscribe((value) => {
            wallet = value.props.wallet;
        });
    })
</script>

<Layouts>
    <Section>
        <svelte:component this={HeroProfile} {wallet} />
        <svelte:component this={ButtonProfile} {wallet} />
    </Section>
</Layouts>
