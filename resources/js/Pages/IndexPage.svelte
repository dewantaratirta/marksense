<script>
    import Layouts from "@/layouts/layouts.svelte";
    import Section from "@/lib/components/Section.svelte";
</script>

<Layouts>
    <div class="bg-gradient-1">
        <Section>
            <h1 class="h1">Hello Skeleton</h1>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
            <section>
                <a
                    class="btn variant-filled-primary"
                    href="https://kit.svelte.dev/">SvelteKit</a
                >
                <a
                    class="btn variant-filled-secondary"
                    href="https://tailwindcss.com/">Tailwind</a
                >
                <a
                    class="btn variant-filled-tertiary"
                    href="https://github.com/">GitHub</a
                >
            </section>
        </Section>
    </div>
</Layouts>

<style>
</style>
