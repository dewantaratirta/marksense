<script>
    import Layouts from "@/layouts/layouts.svelte";
    import Section from "@/lib/components/Section.svelte";
    import DotPattern from "@/lib/components/DotPattern.svelte";
    import FlipText from "@/lib/components/FlipText.svelte";
    import GridBeam from "@/lib/components/GridBeam.svelte";
    import Ripple from "@/lib/components/Ripple.svelte";
    import { Link } from "@inertiajs/svelte";
</script>

<Layouts>
    <div class="bg-gradient-1">
        <Section>
            <!-- <h1 class="font-montserrat text-center h1 pt-4">Introducing Marksense</h1> -->
            <section class="relative">
                <div class="relative hero bg-primary-500 p-20 mt-4">
                    <div
                        class="relative text-white h1 font-bold text-center"
                        id="text-main"
                    >
                        <FlipText
                            class="relative h1 text-center text-4xl font-bold tracking-[-0.1em] text-white dark:text-white md:text-7xl md:leading-[5rem]"
                            word="Bring PnL onchain."
                        />
                        <FlipText
                            class="relative h1 text-center text-4xl font-bold tracking-[-0.1em] text-white dark:text-white md:text-7xl md:leading-[5rem]"
                            word="Build on Base."
                        />
                    </div>
                    <DotPattern
                        class="[mask-image:radial-gradient(300px_circle_at_center,white,transparent)]"
                        fillColor="rgb(var(--color-primary-400))"
                    />
                </div>

                <div class="flex flex-col sm:flex-row mt-8 overflow-x-hidden">
                    <div class="md:w-1/2 w-full md:pe-4">
                        <GridBeam
                            class="bg-black sm:pl-16 pt-28 pb-24 pl-4 flex items-start justify-start"
                        >
                            <div class="grid gap-2">
                                <h1
                                    class="sm:text-5xl text-4xl font-bold max-w-sm text-white"
                                >
                                    Verified PnL You Can Trust
                                </h1>
                                <p class="text-white max-w-lg pt-4">
                                    Many platforms display unverified PnL data.
                                    At Marksense, we showcase verified results
                                    from KOL trades, ensuring transparency
                                    through on-chain validation.
                                </p>
                            </div>
                        </GridBeam>
                    </div>

                    <div class="md:w-1/2 w-full md:pe-4">
                        <Link
                            href="/app"
                            class="relative flex h-[400px] w-full flex-col items-center justify-center overflow-hidden bg-background"
                        >
                            <p
                                class="z-10 whitespace-pre-wrap text-center text-5xl font-medium tracking-tighter text-primary-500"
                            >
                                Explore Verified Trades Now
                            </p>
                            <Ripple />
                        </Link>
                    </div>
                </div>
            </section>
        </Section>
    </div>
</Layouts>

<style>
    #text-main {
        z-index: 140;
    }
</style>
