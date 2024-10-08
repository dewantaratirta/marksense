<script>
    import Layouts from "@/layouts/layouts.svelte";
    import { page } from "@inertiajs/svelte";
    import Section from "@/lib/components/Section.svelte";
    import Avatar from "@/lib/components/edit_profile/avatar.svelte";
    import GeneralInfo from "@/lib/components/edit_profile/generalInfo.svelte";
    import UpdateBinance from "@/lib/components/edit_profile/updateBinance.svelte";
    import { Link } from "@inertiajs/svelte";
    import BtnProfile from "@/layouts/navbar/components/btnProfile.svelte";

    let wallet = false;
    let user = {};

    page.subscribe((value) => {
        wallet = value.props.wallet;
    });
</script>

<Layouts>
    <Section>
        <h1 class="text-xl font-bold">
            <svelte:component
                this={BtnProfile}
                basicClass=" "
                classNames="text-slate-400"
            />
            <i class="fa-sharp fa-regular fa-slash-forward"></i> Edit Profile
        </h1>

        <div class="flex flex-col lg:flex-row mt-4">
            <div class="w-full lg:w-1/4 sm:me-4">
                <Avatar {wallet} />
            </div>

            <div class="w-full lg:w-3/4">
                <GeneralInfo {wallet} />
                <UpdateBinance {wallet} />
            </div>
        </div>
    </Section>
</Layouts>
