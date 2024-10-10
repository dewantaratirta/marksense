<script>
    import Layouts from "@/layouts/layouts.svelte";
    import Section from "@/lib/components/Section.svelte";
</script>

<Layouts>
    <div class="bg-gradient-2">
        <Section>
            <!-- <h1 class="font-montserrat text-center h1 pt-4">Introducing Marksense</h1> -->
            <section>
                <div class="hero bg-primary-500 p-8 rounded-xl mt-4">
                    <h1 class="text-white h1 font-bold text-center">
                        Bring PnL onchain. <br />
                        Build on Base.
                    </h1>
                </div>

                <div class="flex flex-column mt-4">
                    <div class="md:w-1/2 w-full md:pe-4">
                        <div class="bg-black px-4 rounded-xl">
                            <p class="text-white">Verified PnL You Can Trust</p>
                            <p class="text-white">
                                Many platforms display unverified PnL data. At
                                Marksense, we showcase verified results from KOL
                                trades, ensuring transparency through on-chain
                                validation.
                            </p>
                        </div>
                    </div>

                    <div class="md:w-1/2 w-full md: ps-4">
                        <div class="bg-black">
                            <h3 class="text-white">
                                There are many fake PnL now.
                            </h3>
                            <p class="text-white">
                                We only shown how KOL got huge trade PnL. But
                                imagine, how we can verify it? Is it real?
                            </p>
                        </div>
                    </div>
                </div>
            </section>
        </Section>
    </div>
</Layouts>

<style>
</style>
