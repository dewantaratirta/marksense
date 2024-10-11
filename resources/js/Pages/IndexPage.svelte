<script>
    import Layouts from "@/layouts/layouts.svelte";
    import Section from "@/lib/components/Section.svelte";
    import DotPattern from "@/lib/components/DotPattern.svelte";
    import FlipText from "@/lib/components/FlipText.svelte";
    import GridBeam from "@/lib/components/GridBeam.svelte";
    import Ripple from "@/lib/components/Ripple.svelte";
    import MagicCard from "@/lib/components/MagicCard.svelte";
    import { Link } from "@inertiajs/svelte";
    import BinanceIcon from "$lib/components/icon/binance_icon.png";
    import BaseIcon from "$lib/components/icon/base.png";
    import CoinbaseIcon from "$lib/components/svg/smartwallet.svg";
</script>

<Layouts>
    <div class="bg-gradient-1">
        <Section>
            <!-- <h1 class="font-montserrat text-center h1 pt-4">Introducing Marksense</h1> -->
            <section class="relative">
                <div
                    class="relative hero bg-primary-500 rounded-container-token p-20 mt-4"
                >
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
                        <div>
                            <p
                                class="z-10 whitespace-pre-wrap text-center text-5xl font-medium tracking-tighter text-primary-500"
                            >
                                Explore Verified Trades Now
                            </p>
                            <Ripple />
                        </div>
                        </Link>
                    </div>
                </div>
            </section>
        </Section>

        <div class="bg-gradient-2">
            <Section>
                <div class="relative hero rounded-container-token p-20 mt-4">
                    <div
                        class="relative text-primary-500 h1 font-bold text-center"
                        id="text-main"
                    >
                        <h2
                            class="z-10 whitespace-pre-wrap text-center text-5xl font-medium tracking-tighter text-primary-500 mb-12"
                        >
                            Build with
                        </h2>

                        <div
                            class="flex flex-col lg:flex-row items-center justify-evenly
                            whitespace-nowrap text-4xl group hover:border-[#ff770094] transition-all duration-300"
                        >
                            <img
                                src={BaseIcon}
                                alt="svelte_logo"
                                class="h-10 w-auto mt-1.5 m-2"
                            />
                            <div
                                class="flex flex-row justify-center align-middle items-center"
                            >
                                <img
                                    src={CoinbaseIcon}
                                    alt="svelte_logo"
                                    class="h-10 w-auto mt-1.5 m-2"
                                />
                                <p class="ps-2">Smart Wallet</p>
                            </div>
                            <img
                                src={BinanceIcon}
                                alt="svelte_logo"
                                class="h-12 w-auto mt-1.5 m-2"
                            />
                            <div
                                class="flex flex-row justify-center align-middle items-center m-2"
                            >
                                <p class="text-primary-500">zkFetch</p>
                            </div>
                        </div>
                    </div>
                </div>
            </Section>
        </div>
    </div>
</Layouts>

<style>
    #text-main {
        z-index: 140;
    }
</style>
