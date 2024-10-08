<script>
    import { getModalStore } from "@skeletonlabs/skeleton";
    import ModalContentAvatar from "./modalContentAvatar.svelte";

    const modalStore = getModalStore();

    export let wallet;

    const handleClickChangeImage = () => {
        let modalSettings = {
            type: "component",
            component: { ref: ModalContentAvatar },
            props: {
                wallet: wallet,
            },
        };
        modalStore.trigger(modalSettings);
        console.log("Change Image");
    };

    $: {
        console.log($modalStore);
    }
</script>

<div class="card bg-white shadow-md p-4 mt-4">
    <div class="flex">
        <img
            src={wallet?.avatar_url}
            alt="aji"
            class="w-12 h-12 md:w-14 md:h-14 xl:w-32 xl:h-32 object-cover rounded-2xl"
        />

        <div class="ms-2 flex flex-col justify-center">
            <div class="flex items-center">
                <div class="flex flex-col">
                    <div
                        class="w-full flex-none text-lg text-gray-800 font-bold leading-none"
                    >
                        {wallet?.wallet_name}
                    </div>
                    <div class="flex-auto text-gray-500 my-1">
                        <span class="mr-3">@{wallet?.wallet_username}</span>
                    </div>
                </div>
            </div>

            <div class="flex pt-2 text-sm text-gray-500">
                <button
                    class="btn variant-soft-primary"
                    on:click={handleClickChangeImage}>Change Avatar</button
                >
            </div>
        </div>
    </div>
</div>
