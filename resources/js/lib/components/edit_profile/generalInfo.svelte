<script>
    import { getModalStore } from "@skeletonlabs/skeleton";
    import TextError from "@/lib/components/TextError.svelte";
    import { page } from "@inertiajs/svelte";
    import { submitData } from "@/stores/submitData";

    const modalStore = getModalStore();

    export let wallet;
    let name = wallet?.wallet_name;
    let username = wallet?.wallet_username;
    let errors = {};

    const handleSave = async () => {
        let data = {
            name: name,
            username: username,
        };

        let res = await $submitData({
            data: data,
            url: $page?.props.edit_profile_url,
            token: $page.props.token,
        });

        if (res.hasOwnProperty("errors")) {
            errors = {};
            errors = res.errors;
        } else {
            res = {};
            // redirect to the dashboard
            window.location.reload();
        }
    };

    $: {
        console.log($page?.props.edit_profile_url);
    }
</script>

<div class="card bg-white shadow-md p-4 mt-4">
    <div class="flex">
        <div class="ms-2 flex flex-col justify-center">
            <div class="flex items-center">
                <div class="flex flex-col">
                    <h4 class="font-bold text-lg">General Information</h4>
                    <br />

                    <div class="flex flex-col space-y-2">
                        <label class="block font-medium" for="name"
                            >Display Name</label
                        ><input
                            id="display_name"
                            type="text"
                            name="display_name"
                            bind:value={name}
                            class={"form-input px-4 py-3 rounded-full " +
                                (errors?.name ? "border-2 border-red-500" : "")}
                            required="required"
                        />
                        {#if errors?.name}
                            <TextError message={errors.name} />
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
