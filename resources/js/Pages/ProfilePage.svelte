<script>
    import Layouts from "@/layouts/layouts.svelte";
    import { page } from "@inertiajs/svelte";
    import Section from "@/lib/components/Section.svelte";

    let wallet = false;
    let user = {};

    page.subscribe((value) => {
        wallet = value.props.wallet;
    });
</script>

<Layouts>
    <Section>
        <h1 class="text-3xl font-bold mb-6">User Profile</h1>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="card p-6 rounded-lg shadow">
                <h2 class="text-xl font-semibold mb-4">Personal Information</h2>
                <p><strong>Name:</strong> {wallet?.wallet_name || ""}</p>
                <p><strong>Email:</strong> {wallet.wallet_address || "N/A"}</p>
                <p>
                    <strong>Join Date:</strong>
                    {wallet?.created_at
                        ? new Date(wallet.created_at).toLocaleDateString()
                        : "N/A"}
                </p>
            </div>
        </div>
    </Section>
</Layouts>
