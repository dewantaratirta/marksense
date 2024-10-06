<script>
    import Layouts from "@/layouts/layouts.svelte";
    import { page } from "@inertiajs/svelte";
    import Section from "@/lib/components/Section.svelte";
    import HeroProfile from "@/lib/components/HeroProfile.svelte";

    let wallet = false;
    let user = {};

    page.subscribe((value) => {
        wallet = value.props.wallet;
    });
</script>

<Layouts>
    <Section>
        <HeroProfile {wallet} />
    </Section>
</Layouts>
