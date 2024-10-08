<script>
    import { getModalStore } from "@skeletonlabs/skeleton";
    import TextError from "@/lib/components/TextError.svelte";
    import { page } from "@inertiajs/svelte";
    import { submitData } from "@/stores/submitData";
    import { getToastStore } from "@skeletonlabs/skeleton";
    import BinanceLogo from "@/lib/components/binanceLogo.svelte";

    export let wallet;
    let key = "";
    let secret = "";
    let errors = {};

    const toastStore = getToastStore();

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
        }

        if (res.hasOwnProperty("status") && res.status === "error") {
            errors = {};
            errors.invalid = res.message;
        }

        let count = Object.keys(errors).length;
        if (count > 0) {
            // loop errors
            let errors_msg = "";
            for (let key in errors) {
                if (errors.hasOwnProperty(key)) {
                    let element = errors[key];
                    errors_msg += element + "\n";
                }
            }
            let ToastSettings = {
                message: errors_msg,
                background: "variant-filled-error",
            };
            toastStore.trigger(ToastSettings);
            return;
        }

        let ToastSettings = {
            message: "Binance API updated successfully",
            callback: () => {
                window.location.reload();
            },
        };
        toastStore.trigger(ToastSettings);
        return;
    };

    $: {
        console.log($page?.props);
    }
</script>

<div class="card bg-white shadow-md p-4 mt-4">
    <div class="flex">
        <div class="ms-2 flex flex-col justify-center">
            <div class="flex items-center">
                <div class="flex flex-col">

                    <div class="flex-row flex items-center">
                        <h4 class="font-bold text-lg">Binance API</h4>
                        {#if wallet?.wallet_binance_api_status && wallet?.wallet_binance_api_status == 1}
                            <span
                                class="font-medium text-primary-500 text-sm mx-2"
                                >Connected
                            </span>
                            <BinanceLogo className="h-4 w-4" />
                        {:else}
                            <span
                                class="font-medium text-slate-400 text-sm mx-2"
                                >Not Connected</span
                            >
                            <BinanceLogo className="h-4 w-4" />
                        {/if}
                    </div>
                    
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
