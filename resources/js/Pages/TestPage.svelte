<script>
    import { onMount } from "svelte";
    let trade = {};
    let loading = true;
    import GenerateImagePnLFutures from "@/lib/components/GenerateImagePnLFutures.svelte";
    const getFutureSummary = async () => {
        let loading = true;
        fetch(
            "/api/data/futures_summary/0xA33470bdd89161B6fB0517c95cE79fA1736EDB9b?symbol=TURBOUSDT&id=953919431",
            {
                referrer:
                    "http://127.0.0.1:8000/app/profile/0xA33470bdd89161B6fB0517c95cE79fA1736EDB9b",
            },
        )
            .then((response) => response.json())
            .then((data) => {
                trade = data.data;
                loading = false;
            });
    };

    onMount(async () => {
        let trade = await getFutureSummary();
        loading = false;
    });
</script>

{#if loading}
    <p>Loading....</p>
{:else}
    <GenerateImagePnLFutures {trade} resizeCanvas={200}/>
{/if}
