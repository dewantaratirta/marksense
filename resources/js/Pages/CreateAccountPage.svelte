<script>
    import Layouts from "@/layouts/layouts.svelte";
    import { connect } from "@wagmi/core";
    import { account, web3modal, wagmiConfig, reconnect } from "$lib/web3modal";
    import Section from "@/lib/components/Section.svelte";
    import { signMessage, verifyMessage } from "@wagmi/core";
    import { getToastStore, initializeStores } from "@skeletonlabs/skeleton";
    import TextError from "@/lib/components/TextError.svelte";

    import { page, router, Link } from "@inertiajs/svelte";

    let form = null; // form element
    let username = "";
    let display_name = "";
    let _token = $page.props.token;
    let connector;
    let account_data;

    let errors = {};

    initializeStores();
    const toastStore = getToastStore();

    const connectWallet = async () => {
        try {
            connector = wagmiConfig.connectors[0];
            connect(wagmiConfig, {
                connector: connector,
            });
        } catch (e) {
            console.log(e);
        }
    };

    /**
     * On click
     * @param e
     */
    let submitHandler = async (e) => {
        e.preventDefault();

        if (!form.checkValidity()) {
            form.reportValidity();
            return;
        }

        const data = new FormData(form);
        const payload = {
            username: data.get("username"),
            display_name: data.get("display_name"),
            address: $account.address,
        };

        let message = JSON.stringify(payload);

        try {
            if (!$account.address) {
                await connectWallet();
            }
            const _signature = await signMessage(wagmiConfig, {
                message: message,
            });

            const _verify = await verifyMessage(wagmiConfig, {
                address: $account.address,
                message: message,
                signature: _signature,
            });

            if (_signature !== "null" && _verify) {
                payload.signature = _signature;
                payload._token = _token;
                payload.message = message;

                // send the payload to the server using ajax
                await sendToServer(payload);
            } else {
                throw new Error("The signature was rejected");
            }
        } catch (error) {
            console.log(`error: ${error.message}`);
            const t = {
                message: error.message,
            };
            toastStore.trigger(t);
        }
        console.log(`finish`);
    };

    /**
     * Send data to server
     * @param payload
     */
    const sendToServer = async (payload) => {
        const response = await fetch($page.props.api_url, {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                Accept: "application/json",
            },
            body: JSON.stringify(payload),
        });

        // get response body
        const data = await response.json();

        if (data.hasOwnProperty("errors")) {
            errors = {};
            errors = data.errors;
        } else {
            errors = {};
            // redirect to the dashboard
            window.location.href = "/app/profile/" + $account.address;
        }
    };

    let once = 0;
    account.subscribe(async (value) => {
        if (!account_data && !account_data?.address && $web3modal && once < 1) {
            await connectWallet();
            once++;
        }
        if (value && value?.address) {
            router.visit("/app/profile/" + value.address);
        }
    });
</script>

<Layouts>
    <Section>
        <div class="pt-10">
            <div
                class="max-w-xl mx-auto card py-8 px-4 shadow sm:rounded-lg sm:px-10"
            >
                <h1 class="text-xl font-bold mb-4">Sign Up</h1>
                <hr class="mb-8" />

                <form
                    class="flex-col space-y-4"
                    method="post"
                    bind:this={form}
                    id="register_form"
                    action={$page.props.api_url}
                >
                    <div class="flex flex-col space-y-2">
                        <label class="block font-medium" for="wallet-address"
                            >Wallet</label
                        ><input
                            id="wallet-address"
                            class="input bg-slate-400 px-4 py-2 outline-none"
                            type="text"
                            name="wallet"
                            bind:value={$account.address}
                            placeholder="Wallet Address"
                            autocomplete="off"
                            disabled
                        />
                    </div>

                    <div class="flex flex-col space-y-2">
                        <label class="block font-medium" for="name"
                            >Display Name</label
                        ><input
                            id="display_name"
                            type="text"
                            name="display_name"
                            bind:value={display_name}
                            class={"form-input px-4 py-3 rounded-full " +
                                (errors?.display_name
                                    ? "border-2 border-red-500"
                                    : "")}
                            required="required"
                        />
                        {#if errors?.display_name}
                            <TextError message={errors.display_name} />
                        {/if}
                    </div>

                    <div class="flex flex-col space-y-2">
                        <label class="block font-medium" for="username"
                            >Username</label
                        ><input
                            id="username"
                            type="text"
                            name="username"
                            bind:value={username}
                            class={"form-input px-4 py-3 rounded-full  " +
                                (errors?.username
                                    ? "border-2 border-red-500"
                                    : "")}
                            required="required"
                        />
                        {#if errors?.username}
                            <TextError message={errors.username} />
                        {/if}
                    </div>

                    <div class="flex flex-col space-y-2">
                        <label
                            class="font-medium text-slate-400 flex items-start space-x-2"
                            ><div>
                                <input
                                    type="checkbox"
                                    class="h-4 w-4 rounded focus:ring-indigo-500 text-indigo-600"
                                    required="required"
                                />
                            </div>
                            <div>
                                I have read and agree to the <a
                                    href="/legal/privacy"
                                    target="_blank"
                                    class="text-primary-600 hover:text-primary-700"
                                    >Privacy Policy</a
                                >
                                and
                                <a
                                    href="/legal/terms"
                                    target="_blank"
                                    class="text-primary-600 hover:text-primary-700"
                                    >Terms and Conditions</a
                                >.
                            </div></label
                        >
                    </div>
                    <div class="flex justify-end">
                        <button
                            class="btn bg-primary-500 text-white rounded-full hover:bg-primary-400 flex items-center space-x-2 w-full text-center"
                            type="submit"
                            name="_action"
                            value="create"
                            on:click|preventDefault={(event) => {
                                submitHandler(event);
                            }}
                            ><div class="relative">
                                <div class="">Sign up</div>
                                <div
                                    class="hidden absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2"
                                >
                                    <svg
                                        class="animate-spin h-5 w-5 text-white"
                                        xmlns="http://www.w3.org/2000/svg"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        ><circle
                                            class="opacity-25"
                                            cx="12"
                                            cy="12"
                                            r="10"
                                            stroke="currentColor"
                                            stroke-width="4"
                                        ></circle><path
                                            class="opacity-75"
                                            fill="currentColor"
                                            d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"
                                        ></path></svg
                                    >
                                </div>
                            </div></button
                        >
                    </div>
                </form>
            </div>
        </div>
    </Section>
</Layouts>
