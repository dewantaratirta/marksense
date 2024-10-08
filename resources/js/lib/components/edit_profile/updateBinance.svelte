<script>
    import { getModalStore } from "@skeletonlabs/skeleton";
    import TextError from "@/lib/components/TextError.svelte";
    import { page } from "@inertiajs/svelte";
    import { submitData } from "@/stores/submitData";

    const modalStore = getModalStore();

    export let wallet;
    let key = '';
    let secret = '';
    let errors = {};

    const handleSave = async () => {
        let data = {
            wallet_binance_api_key: key,
            wallet_binance_api_secret: secret,
        };
        let res = await $submitData({
            data: data,
            url: $page?.props.edit_binance_url,
            token: $page.props.token,
        });

        if (res.hasOwnProperty("errors")) {
            errors = {};
            errors = res.errors;
        } else {
            // redirect to the dashboard
            window.location.reload();
        }
    };

    console.log($page?.props?.edit_binance_url);

    $: {
        console.log($page?.props.edit_binance_url);
    }
</script>

<div class="card bg-white shadow-md p-4 mt-4">
    <div class="flex">
        <div class="ms-2 flex flex-col justify-center">
            <div class="flex items-center">
                <div class="flex flex-col">
                    <h4 class="font-bold text-lg">Binance API</h4>
                    <br />

                    <div class="flex flex-col space-y-2">
                        <label class="block font-medium" for="name"
                            >API Key</label
                        ><input
                            id="key"
                            type="text"
                            name="key"
                            bind:value={key}
                            class={"form-input px-4 py-3 rounded-full " +
                                (errors?.key ? "border-2 border-red-500" : "")}
                            required="required"
                        />
                        {#if errors?.name}
                            <TextError message={errors.key} />
                        {/if}
                    </div>

                    <div class="flex flex-col space-y-2">
                        <label class="block font-medium" for="username"
                            >Secret</label
                        ><input
                            id="secret"
                            type="text"
                            name="secret"
                            bind:value={secret}
                            class={"form-input px-4 py-3 rounded-full  " +
                                (errors?.secret
                                    ? "border-2 border-red-500"
                                    : "")}
                            required="required"
                        />
                        {#if errors?.secret}
                            <TextError message={errors.secret} />
                        {/if}
                    </div>

                    <div class="mt-4">
                        <button
                            class="btn variant-soft-primary"
                            on:click={() => {
                                handleSave();
                            }}>Save</button
                        >
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
